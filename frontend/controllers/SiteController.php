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
}
