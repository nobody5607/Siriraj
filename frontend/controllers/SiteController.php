<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\ContactForm;
use vova07\fileapi\actions\UploadAction as FileAPIUpload;

/**
 * Class SiteController.
 */
class SiteController extends Controller
{
    
   
    public function beforeAction($action)
    {
      $this->layout = "@frontend/themes/siriraj/layouts/main-second"; 
      return parent::beforeAction($action);
    }
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
            ],
            'fileapi-upload' => [
                'class' => FileAPIUpload::class,
                'path' => '@storage/tmp',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    
    public function actionIndex()
    {
        //return $this->redirect(['/sections/section']);
        return $this->render('index');
    }
    public function actionAbout()
    {
        $about = \backend\modules\cores\classes\CoreOption::getParams("about", 'c');
        return $this->render('about',['about'=>$about]);
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $contact = \backend\modules\cores\classes\CoreOption::getParams("contact", 'c');
        return $this->render('contact',['contact'=>$contact]); 
    }
    
    public function actionConvert(){
        
        if(\Yii::$app->user->isGuest){
            return '';
        }
        $model = new \common\models\ReportDownload();
         
        $model->count = 1;
        $model->user_id = \Yii::$app->user->id;
        $model->create_at = date('Y-m-d');
        $model->save();
        
        
        
        $id = \Yii::$app->request->get('id', '');
        $multi = \Yii::$app->request->get('multi', '');
        $file = \common\models\Files::findOne($id);
        
        $storageUrl = Yii::getAlias('@storage');
        $path = "{$storageUrl}{$file['dir_path']}/{$file['file_name']}";
        $view = "{$file['file_path']}/{$file['file_name']}";
        if(\Yii::$app->user->can('users')){
            $view = "{$file['file_path']}/thumbnail/{$file['file_view']}";
        }
        
        $arr = ['5','7','8'];
        if(in_array($file['file_type'], $arr)){
            //\appxq\sdii\utils\VarDumper::dump($view);
            if($multi){
                $data = ['file_name'=>$file['file_name_org'], 'href'=>$view, 'type'=>$file['file_type']];
                return \janpan\jn\classes\JResponse::getSuccess("Success", $data);
            }
            return $view;
            
        }
        $img_file = $path;

            // Read image path, convert to base64 encoding
            $imgData = base64_encode(file_get_contents($img_file)); 
            $src = 'data:'.mime_content_type($img_file).';base64,'.$imgData;
            if($multi){
                $data = ['file_name'=>$file['file_name_org'], 'href'=>$src, 'type'=>$file['file_type']];
                return \janpan\jn\classes\JResponse::getSuccess("Success", $data);
            }
            
            
            return $src;
            //return $this->renderAjax("convert",['src'=>$src]);
        
    }
    
    
    public function actionGetUrlFile(){
        
        if(\Yii::$app->user->isGuest){
            return '';
        }
        $model = new \common\models\ReportDownload();
         
        $model->count = 1;
        $model->user_id = \Yii::$app->user->id;
        $model->create_at = date('Y-m-d');
        $model->save();
        
        
        
        $id = \Yii::$app->request->get('id', '');
        $multi = \Yii::$app->request->get('multi', '');
        $file = \common\models\Files::findOne($id);
        
        $storageUrl = Yii::getAlias('@storage');
        $path = "{$storageUrl}{$file['dir_path']}/{$file['file_name']}";
        $view = "{$file['file_path']}/{$file['file_name']}";
         
        $data =[
            'path'=>$view,
            'name'=>$file['file_name_org']
        ];
        return \janpan\jn\classes\JResponse::getSuccess("Success", $data); 
        
    }
    
    /*pdf*/
    
    public function actionDocToPdf(){
       $id = \Yii::$app->request->post('id', '');
       $file = \common\models\Files::find()->where(['id'=>$id])->one();
       $dirPath = Yii::getAlias('@storage')."{$file['dir_path']}";
       $viewPath = "{$file['file_path']}";// storageUrl
       $folderName = "{$dirPath}/pdf";
       set_time_limit(1200);
       //$sql="libreoffice --headless --convert-to pdf:writer_pdf_Export {$dirPath}/{$file['file_name']}";       
       //$sql="export HOME=/var/www; /usr/bin/libreoffice --headless --convert-to pdf:writer_pdf_Export {$dirPath}/{$file['file_name']} --outdir {$dirPath}/{$file['file_name']}";
       $sql="export HOME=/var/www; /usr/bin/libreoffice --headless --convert-to pdf:writer_pdf_Export {$dirPath}/{$file['file_name']} --outdir {$dirPath}";  
       exec($sql, $output, $return_var);
       $fileNameArr = explode('.', $file['file_name']);
       if($return_var){            
            $data=[
                'id'=>$id,
                'path'=>"{$dirPath}/{$fileNameArr[0]}.pdf",
                'sql'=>$sql,
                'out'=>$output,
                'return_var'=>$return_var        
            ];
            return \janpan\jn\classes\JResponse::getSuccess("Success", $data);
       }else{
           $data=[
                'id'=>$id,
                'path'=>"{$dirPath}/{$fileNameArr[0]}.pdf",
                'sql'=>$sql,
                'out'=>$output,
                'return_var'=>$return_var        
            ];
            return \janpan\jn\classes\JResponse::getSuccess("Success", $data);
       }
    }
    public function actionCreateFile(){
      // echo \janpan\jn\widgets\SlideTop::widget([]);return; 
       $id = \Yii::$app->request->post('id', '');
       $path = \Yii::$app->request->post('path', '');
       
       $file = \common\models\Files::find()->where(['id'=>$id])->one();
       $dirPath = Yii::getAlias('@storage')."{$file['dir_path']}";
       $viewPath = "{$file['file_path']}";// storageUrl
       $folderName = "{$dirPath}/pdf";
       //1536390899000085100
       \backend\modules\sections\classes\JFiles::deleteDir("{$folderName}"); 
       $createDir=\backend\modules\sections\classes\JFiles::CreateDir("{$folderName}", false);
       if($createDir){
           set_time_limit(1200);
           $sql = "convert -density 500 {$dirPath}/{$file['file_name']} -quality 50 {$folderName}/preview.jpg";
           if($path){
                $sql = "convert -density 500 {$path} -quality 50 {$folderName}/preview.jpg";
           }           
           //\appxq\sdii\utils\VarDumper::dump($sql);
           exec($sql, $output, $return_var);
           if($return_var){
               return \janpan\jn\classes\JResponse::getSuccess("Success");
           }else{
               return \janpan\jn\classes\JResponse::getSuccess("Success");
           }
       }
       
    }
    public function actionViewFile(){
       $id = \Yii::$app->request->post('id', '');
       if($id==""){
            $id = \Yii::$app->request->get('id', '');
       }
       $file = \common\models\Files::find()->where(['id'=>$id])->one();
       
       $dirPath = Yii::getAlias('@storage')."{$file['dir_path']}";      
       $folderName = "{$dirPath}/pdf"; //c://xxxx
       $viewPath = "{$file['file_path']}/pdf";//http://www.xxx
        return $this->renderAjax('view-file',[
            'folderName'=>$folderName,
            'viewPath'=>$viewPath
        ]);
    }

}
