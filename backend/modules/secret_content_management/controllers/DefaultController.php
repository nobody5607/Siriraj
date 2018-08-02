<?php

namespace backend\modules\secret_content_management\controllers;

use yii\web\Controller;

/**
 * Default controller for the `secret_content_management` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
