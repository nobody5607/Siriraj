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
     */
    public static function Save($model, $fileName, $content_id, $path, $defaultFile){
        try{
            $files = new \common\models\Files();
            $files->id = \appxq\sdii\utils\SDUtility::getMillisecTime();
            $files->name = $fileName;
            $files->description = "";
            $files->rstat = 1;
            $files->file_name = $fileName;
            $files->file_thumbnail = $fileName;
            $files->file_name_org = $defaultFile;
            $files->content_id = $content_id;
            $files->user_create = \Yii::$app->user->id;
            $files->create_date = new \yii\db\Expression('NOW()');
            $files->file_path = $path;
            $files->file_type = $model->file_type;
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
    * @param type $model model files
    * @param type $images UploadedFile::getInstancesByName('name')
    * @param type $content_id content id
    * @param $folderName folder name
    * @return boolean
    */
    public static function uploadImage($model, $images, $content_id, $folderName){
          try{
              if ($images) {
                    $path = Yii::getAlias('@storage') . "/web/images/{$folderName}";
                    self::CreateDir($path); //create folder

                    foreach ($images as $file) {
                        $fileName = $file->baseName . '.' . $file->extension;
                        $realFileName = md5(SDUtility::getMillisecTime() . time()) . '.' . $file->extension;
                        $filePath = "{$path}/{$realFileName}";
                        if ($file->saveAs($filePath)) {//save image                            
                            $image = \Yii::$app->image->load($filePath);
                            $image->resize(100);
                            $image->save($path . '/thumbnail/' . $realFileName);
                            //save tbl_files
                            $viewPath = Yii::getAlias('@storageUrl') . "/images/{$folderName}";
                            self::Save($model, $realFileName, $content_id, $viewPath, $fileName);
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
