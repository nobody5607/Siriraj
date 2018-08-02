<?php

namespace backend\modules\section_management\controllers;

use yii\web\Controller;

/**
 * Default controller for the `section_management` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        //\common\models\Sections::find()->all();
        return $this->render('index');
    }
}
