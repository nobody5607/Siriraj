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
            $files->save();
        } catch (Exception $ex) {
            return FALSE;
        }
    }
    /**
     * 
     * @param type $path Yii::getAlias('@storage') . "/web/images/{$folderName}";
     * @return type boolean true or false
     */
    public static function CreateDir($path){
        if($path != NULL){ 
            if(BaseFileHelper::createDirectory($path,0777)){
                BaseFileHelper::createDirectory($path.'/thumbnail',0777);
                return TRUE;
            }
        }
        return FALSE;
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
                      $sql  = "magick convert {$filePath}.{$fileType[1]} -resize 200x200 {$thumbnail}";
                      $wm = "magick convert {$filePath}.{$fileType[1]} -gravity SouthEast {$mark} -geometry +20+20  -composite {$filePath}.{$fileType[1]}";
                      exec($wm, $out, $retval);                      
                   }
              }else{
                 if ($file->saveAs("{$filePath}.{$fileType[1]}")) {
                      $type = "jpg";
                      $sql  = "magick convert {$filePath}.jpg -resize 200x200 {$thumbnail}";                    
                      $wm = "magick convert {$filePath}.{$fileType[1]} -gravity SouthEast {$mark} -geometry +20+20  -composite {$filePath}.jpg";
                      exec($wm, $out, $retval);
                      @unlink("{$filePath}.{$fileType[1]}");
                 } 
              }
              
              exec($sql, $out, $retval);
              if ($retval == '0') {
                  return ["type"=>$type];
              }else{
                  return FALSE;
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
    public static function uploadDocx($model, $files, $content_id, $folderName){
          try{
              if ($files) {
                    $folder = "/web/files";
                    $path = Yii::getAlias('@storage') . "{$folder}/{$folderName}";
                    self::CreateDir($path); //create folder

                    foreach ($files as $file) {                     
                        $fileName = $file->baseName . '.' . $file->extension;
                        $realFileName = md5(SDUtility::getMillisecTime() . time()) . '.' . $file->extension;
                        $filePath = "{$path}/{$realFileName}";
                        if ($file->saveAs($filePath)) {//save image                          
                            //save tbl_files
                            $viewPath = Yii::getAlias('@storageUrl') . "{$folder}/{$folderName}";
                            self::Save($model, $realFileName, $content_id, $viewPath, $fileName, $file, "{$folder}/{$folderName}");
                        }
                    }
                    return true;
                    //return \janpan\jn\classes\JResponse::getSuccess("Upload {$realFileName} Success");
                }
                return false;
          } catch (Exception $ex) {
              return false;
          }
    }
    
    
    
     
}
