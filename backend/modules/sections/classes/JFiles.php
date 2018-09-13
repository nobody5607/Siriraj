<?php
 

namespace backend\modules\sections\classes;
use appxq\sdii\utils\SDUtility;
use yii\db\Exception;
use yii\helpers\BaseFileHelper;
use Yii;

class JFiles {
    public static function getTypeFile(){
       $type = \common\models\FileType::find()->all();
       if($type){
           return $type;
       }
    }
    /**
     * 
     * @param type $model model files
     * @param type $fileName filename generator
     * @param type $content_id content id
     * @param type $path @storageUrl/images/...
     * @param type $defaultFile default filename
     * @param type $file array type , size ?
     */
    public static function Save($model, $fileName, $content_id, $path, $defaultFile, $file, $dir_path='', $file_view=""){
        try{
            $meta = [];
            if(!empty($file->type)){
                $meta['type']=$file->type;
            }
            if(!empty($file->size)){
                $meta['size']=$file->size;
            }
            
            $files                  = new \common\models\Files();
            $files->id              = \appxq\sdii\utils\SDUtility::getMillisecTime();
            $files->name            = $fileName;
            $files->description     = "";
            $files->rstat           = 1;
            $files->file_name       = $fileName;
            $files->file_thumbnail  = $fileName;
            $files->file_name_org   = $defaultFile;
            $files->content_id      = $content_id;
            $files->user_create     = \Yii::$app->user->id;
            $files->create_date     = new \yii\db\Expression('NOW()');
            $files->file_path       = $path;
            $files->file_type       = $model->file_type;
            $files->meta_text       = SDUtility::array2String($meta);
            $files->dir_path        = $dir_path;
            $files->file_view      = $file_view;
            if($files->save()){
                return true;
            }else{
                return false;
            }
        } catch (Exception $ex) {
            return FALSE;
        }
    }
    /**
     * 
     * @param type $path Yii::getAlias('@storage') . "/web/images/{$folderName}";
     * @return type boolean true or false
     */
    public static function CreateDir($path, $thum=true){
        if($path != NULL){ 
            if(BaseFileHelper::createDirectory($path,0777, true)){
                if($thum){
                    BaseFileHelper::createDirectory($path.'/thumbnail',0777, true);
                }
                
                return TRUE;
            }
        }
        return FALSE;
   }
   
   /**
    * 
    * @param type $modelForm array ['filename'=>$filename, 'mark'=>$mark, 'target'=>$target]
    * @param type $template  string "magick convert {filename} -gravity SouthEast {mark} -geometry +20+20  -composite {target}"
    */
   public static function getTemplateMark($modelForm, $template){         
        $path = [];
        foreach ($modelForm as $key => $value) {
            $path["{" . $key . "}"] = $value;
        }
        $master = strtr($template, $path); 
        return $master;
   }
    /**
     * 
     * @param type $file UploadedFile::getInstancesByName('name')
     * @param type $filePath /var/www/xx
     * @param string $fileType /obj
     * @param type $thumbnail 
     * @param type $watermark /model
     * @return boolean
     */
    public static function uploadImage($file, $filePath, $fileType,$thumbnail, $watermark){
          try{
              $default_type = ['jpg','png','gif','jpeg'];
              $type = "";
              $sql = "";
              $mark = Yii::getAlias('@storage')."/{$watermark['path']}/{$watermark['name']}";
              
              //\appxq\sdii\utils\VarDumper::dump($mark);
              if(in_array($fileType[1], $default_type)){
                  if($fileType[1] == "jpeg"){
                      $fileType[1]="jpg";
                  }                  
                  if ($file->saveAs("{$filePath}.{$fileType[1]}")) {
                      $type = $fileType[1];
                      set_time_limit(1200);
                      $modelForm = ['filename'=>"{$filePath}.{$fileType[1]}", 'mark'=>$mark, 'target'=>"{$filePath}_mark.{$fileType[1]}"];
                      $template = self::getTemplateMark($modelForm, $watermark['code']);
                      $sql  = "convert {$filePath}_mark.{$fileType[1]} -resize 1024x768 {$thumbnail}_mark.{$fileType[1]}";
                      $sql2  = "convert {$filePath}_mark.{$fileType[1]} -resize 200x200 {$thumbnail}_preview.jpg";
                      @exec($template." && ".$sql." && ".$sql2, $out, $retval);
                      @unlink("{$filePath}.{$fileType[1]}");
                      return ["type"=>$type];
                      
                      //$wm = "magick convert {$filePath}.{$fileType[1]} -resize 1024x768 -gravity SouthEast {$mark} -geometry +20+20  -composite {$filePath}.{$fileType[1]}";
                                           
                   }
              }else{
                 if ($file->saveAs("{$filePath}.{$fileType[1]}")) {
                      $type = "jpg";
                   
                      $sql  = "convert {$filePath}.{$fileType[1]} -resize 1024x768 {$thumbnail}_mark.jpg";                       
                      $modelForm = ['filename'=>"{$filePath}.{$fileType[1]}", 'mark'=>$mark, 'target'=>"{$filePath}_mark.jpg"];
                      $template = self::getTemplateMark($modelForm, $watermark['code']);                      
                      set_time_limit(1200);
                      $sql2  = "convert {$filePath}_mark.jpg -resize 200x200 {$thumbnail}_preview.jpg";
                       @exec($template." && ".$sql." && ".$sql2, $out, $retval);
                      //exec($template." && ".$sql, $out, $retval);
                      @unlink("{$filePath}.{$fileType[1]}");
                      return ["type"=>"jpg"];
                 } 
              }
              
              
              
              
        } catch (Exception $ex) {
              return false;
          }
    }
    
    /**
    * 
    * @param type $model model files
    * @param type $images UploadedFile::getInstancesByName('name')
    * @param type $content_id content id
    * @param $folderName folder name
    * @return boolean
    */
    public static function uploadDocx($file,$filePath="",$path="", $fileName=""){        
        if ($file->saveAs("{$filePath}.{$file->extension}")) {//save image
            if($file){
                $fileNameArr = explode(".", $file->name);
                $type = end($fileNameArr);
                if($type != "pdf"){
                    self::DocToPdf($path, "{$fileName}.{$file->extension}");
            }else{
                self::PdfToJpg($path, "{$fileName}.{$file->extension}");
            }

            }
            return ['type'=>"{$file->extension}"];
        }     
    }
    public static function DocToPdf($path, $fileName){         
       $dirPath = Yii::getAlias('@storage')."{$path}";
       $viewPath = "{$path}";// storageUrl
       $folderName = "{$path}/pdf";
       set_time_limit(1200);
       $sql="export HOME=/var/www; /usr/bin/libreoffice --headless --convert-to pdf:writer_pdf_Export {$path}/{$fileName} --outdir {$path}"; 
       exec($sql, $output, $return_var);
       $fileNameArr = explode('.', $fileName);
       self::PdfToJpg($path, "{$fileNameArr[0]}.pdf");
       $data=[
                //'id'=>$id,
                'path'=>"{$path}/{$fileNameArr[0]}.pdf",
                'sql'=>$sql,
                'out'=>$output,
                'return_var'=>$return_var        
            ];
       return true;         
    }
    public static function PdfToJpg($path, $fileName){ 
       $dirPath = Yii::getAlias('@storage')."{$path}"; 
       $folderName = "{$path}/pdf"; 
       \backend\modules\sections\classes\JFiles::deleteDir("{$folderName}"); 
       $createDir=\backend\modules\sections\classes\JFiles::CreateDir("{$folderName}", false);
       if($createDir){
           set_time_limit(1200);
           $sql = "convert -density 500 {$path}/{$fileName} -quality 300 {$folderName}/preview.jpg";   
           exec($sql, $output, $return_var);
           @unlink("{$path}/{$fileName}");
           return true; 
       }
    }
    
    
    public static function uploadVideo($file,$filePath,$watermark,$status){
        $format = ["mp4", "mpg", "mpeg", "mov", "avi", "flv", "wmv"];
        $path = "{$filePath}.{$file->extension}";
         
        $mark = Yii::getAlias('@storage')."/{$watermark['path']}/{$watermark['name']}";
        if ($file->saveAs($path)) {//save image
                if($status == '2' && $file->extension == "mp4"){
                    return ['type'=>'mp4', 'default'=>'1'];
                    
                }
               set_time_limit(1200);
                $modelForm = ['filename'=>"{$path}", 'mark'=>$mark, 'target'=>"{$filePath}_mark.mkv", 'output'=>"{$filePath}_mark.mp4"];
                $w = $watermark['code'];
                if($status == '2'){
                    $w = \backend\modules\cores\classes\CoreOption::getParams('water_video', 'e');
                } 
                $template = self::getTemplateMark($modelForm, $w);
               
                exec($template, $output, $return_var);
                @unlink("{$filePath}_mark.mkv");
               // \appxq\sdii\utils\VarDumper::dump($path);
                @unlink("{$path}");
               
                 
            return ['type'=>'mp4', 'default'=>'0'];
        }  
         
    }
    
    public static function uploadAudio($file,$filePath){
         
        $path = "{$filePath}.{$file->extension}";
        $output = "{$filePath}.mp3"; 
        if ($file->saveAs($path)) {//save image
               set_time_limit(1200); 
                $template = "ffmpeg -i {$path} -acodec libmp3lame {$output}";
                exec($template, $output, $return_var);           
            return ['type'=>'mp3'];
        }  
         
    }
    
    public static function lengthName($gname, $length=""){         
        $checkthai = preg_replace('/[^ก-๙]/ u', '', $gname);;
        
        $len = ($length == "") ? 12 : $length;
        
        //$len = 12;
        if ($checkthai != '') {
            $len = $len * 1;
        }
        if (strlen($gname) > $len) {
            $gname = mb_substr($gname, 0, $len, "utf-8") . '...';
        }
         
        return $gname;
    }
    
    
    public static function deleteDir($dirPath) {
        if (! is_dir($dirPath)) {
            return TRUE;
            throw new \InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                @unlink($file);
            }
        }
        rmdir($dirPath);
    }
    
    
    //get image properti
    public static function setImageProperty($path,$jsonData){
        $data = '';
        $iptc = [
            '2#120'=>$jsonData
        ];
        foreach($iptc as $tag=>$string){
            $tag = substr($tag, 2);
            $data .= self::iptc_make_tag(2,$tag, $string);
        }
        $content = iptcembed($data, $path);
        $fp = fopen($path, "wb");
        fwrite($fp,$content);
        fclose($fp);
    }
    public static function iptc_make_tag($rec, $data, $value){
        $length = strlen($value);
        $retval = chr(0x1c).chr($rec).chr($data);
        if($length<0x8000){
            $retval .= chr($length>>8).chr($length & 0xFF);
        }else{
            $retval .= chr(0x80).
                    chr(0x04).
                    chr(($length >> 24) & 0xFF).
                    chr(($length >> 16) & 0xFF).
                    chr(($length >> 8) & 0xFF).
                    chr($length & 0xFF);
        }
        return $retval.$value;
    }
    public static function getImageProperty($filePath){
        $size = getimagesize($filePath, $info);
        $returnArray = null;
        if(isset($info['APP13'])){
            $iptc = iptcparse($info['APP13']);
            $returnArray = json_decode($iptc["2#120"][0]);
        }
        return $returnArray;
    }
     
}
