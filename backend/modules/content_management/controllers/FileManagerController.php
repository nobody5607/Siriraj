<?php

namespace backend\modules\content_management\controllers;

use yii\web\Controller;

class FileManagerController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionFrame()
    {
        return $this->renderAjax('frame');
    }
}
