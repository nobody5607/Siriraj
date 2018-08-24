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
    public static function Save($model, $fileName, $content_id, $path, $defaultFile, $file, $dir_path=''){
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
            return $files->save();
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
                      $sql  = "convert {$filePath}_mark.{$fileType[1]} -resize 150x150 {$thumbnail}_mark.{$fileType[1]}"; 
                      @exec($template." && ".$sql, $out, $retval);
                      if ($retval == '0') {
                            return ["type"=>$type];
                      }else{
                            return FALSE;
                      } 
                      
                      //$wm = "magick convert {$filePath}.{$fileType[1]} -resize 1024x768 -gravity SouthEast {$mark} -geometry +20+20  -composite {$filePath}.{$fileType[1]}";
                                           
                   }
              }else{
                 if ($file->saveAs("{$filePath}.{$fileType[1]}")) {
                      $type = "jpg";
                   
                      $sql  = "convert {$filePath}.{$fileType[1]} -resize 150x150 {$thumbnail}_mark.jpg";                       
                      $modelForm = ['filename'=>"{$filePath}.{$fileType[1]}", 'mark'=>$mark, 'target'=>"{$filePath}_mark.jpg"];
                      $template = self::getTemplateMark($modelForm, $watermark['code']);                      
                      set_time_limit(1200);
                     // exec($template, $out, $retval);
                      exec($template." && ".$sql, $out, $retval);
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
    public static function uploadDocx($file,$filePath){
        if ($file->saveAs("{$filePath}.{$file->extension}")) {//save image
            return ['type'=>$file->extension];
        }     
    }
    
    
    public static function uploadVideo($file,$filePath,$watermark){
        $format = ["mp4", "mpg", "mpeg", "mov", "avi", "flv", "wmv"];
        $path = "{$filePath}.{$file->extension}";
        $mark = Yii::getAlias('@storage')."/{$watermark['path']}/{$watermark['name']}";
        if ($file->saveAs($path)) {//save image
               set_time_limit(1200);
                //$command = "ffmpeg -i {$path} -ss 00:00:00 -t 00:00:10 -async 1 {$filePath}.mp4 -y";
                //$command = "ffmpeg -i {$path} -i {$mark} -ss 00:00:00 -t 00:05:00 -filter_complex \"overlay=main_w-(overlay_w+10):main_h-(10+overlay_h)\" -async 1 {$filePath}_mark.mp4 -y";
                
                
                $modelForm = ['filename'=>"{$path}", 'mark'=>$mark, 'target'=>"{$filePath}_mark.mp4 -y"];
                $template = self::getTemplateMark($modelForm, $watermark['code']);
                exec($template, $output, $return_var);
                //\appxq\sdii\utils\VarDumper::dump($return_var);
                if ($return_var === 0) {
                    if($file->extension != "mp4"){
                        @unlink($path);
                    }                    
                }
                 
            return ['type'=>'mp4'];
        }  
         
    }
    
    public static function lengthName($gname, $length=""){         
        $checkthai = preg_replace('/[^ก-๙]/ u', '', $gname);;
        
        $len = ($length == "") ? 12 : $length;
        
        //$len = 12;
        if ($checkthai != '') {
            $len = $len * 3;
        }
        if (strlen($gname) > $len) {
            $gname = substr($gname, 0, $len) . '...';
        }
        return $gname;
    }
    
    
     
}
