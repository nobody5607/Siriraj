<?php

namespace backend\modules\template\controllers;

class TemplateManagementController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionFormRequest()
    {
        if(\Yii::$app->request->post()){
            $option_name = \Yii::$app->request->post('option_name', '');
            $option_value = \Yii::$app->request->post('option_value', '');
            \backend\modules\cores\classes\CoreOption::update($option_name, $option_value); 
        }
        return $this->render('form-request');
    }

}
