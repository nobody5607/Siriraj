<?php

namespace backend\controllers;

use Yii;
use common\models\Slideimg;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use appxq\sdii\helpers\SDHtml;

/**
 * SlideimgController implements the CRUD actions for Slideimg model.
 */
class ThemeController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                //'only' => ['index'],
                'rules' => \backend\components\Rbac::getRbac(),
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action) {
	if (parent::beforeAction($action)) {
	    if (in_array($action->id, array('create', 'update'))) {
		
	    }
	    return true;
	} else {
	    return false;
	}
    }
    
    /**
     * Lists all Slideimg models.
     * @return mixed
     */
    public function actionIndex()
    {
         
        $model = \common\models\Themes::findOne('1000');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return \janpan\jn\classes\JResponse::getSuccess("Success");
        }
        return $this->render('index', [
            'model' => $model,
        ]);
    }

     
}
