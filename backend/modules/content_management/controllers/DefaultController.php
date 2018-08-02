<?php

namespace backend\modules\content_management\controllers;

use yii\web\Controller;

/**
 * Default controller for the `content_management` module
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
