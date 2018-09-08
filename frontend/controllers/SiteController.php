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
    
    
    /*pdf*/
    public function actionCreateFile(){
       $id = \Yii::$app->request->post('id', '');
       $file = \common\models\Files::find()->where(['id'=>$id])->one();
       $dirPath = Yii::getAlias('@storage')."{$file['dir_path']}";
       $viewPath = "{$file['file_path']}";// storageUrl
       $folderName = "{$dirPath}/pdf";
       //1536390899000085100
       \backend\modules\sections\classes\JFiles::deleteDir("{$folderName}"); 
       $createDir=\backend\modules\sections\classes\JFiles::CreateDir("{$folderName}", false);
       if($createDir){
           set_time_limit(1200);
           $sql = "convert -density 300 {$dirPath}/{$file['file_name']} -quality 100 {$folderName}/preview.jpg";
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
