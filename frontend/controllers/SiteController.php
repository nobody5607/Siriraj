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
    public function actionTest(){
         
    }
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
        $file = \common\models\Files::findOne($id);
        $storageUrl = Yii::getAlias('@storage');
        $path = "{$storageUrl}{$file['dir_path']}/{$file['file_name']}";
        $view = "{$file['file_path']}/{$file['file_name']}";    
        
        $arr = ['5','7','8'];
        if(in_array($file['file_type'], $arr)){
            //\appxq\sdii\utils\VarDumper::dump($view);
            return $view;
            
        }
        $img_file = $path;

            // Read image path, convert to base64 encoding
            $imgData = base64_encode(file_get_contents($img_file)); 
            $src = 'data:'.mime_content_type($img_file).';base64,'.$imgData;
            return $src;
            //return $this->renderAjax("convert",['src'=>$src]);
        
    }
}
