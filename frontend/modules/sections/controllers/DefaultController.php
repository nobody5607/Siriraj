<?php

namespace frontend\modules\sections\controllers;

use yii\web\Controller;

/**
 * Default controller for the `sections` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->redirect(['/sections/session-management']);
        return $this->render('index');
    }
}