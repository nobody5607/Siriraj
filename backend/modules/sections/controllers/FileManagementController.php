<?php

namespace backend\modules\sections\controllers;

use Yii;
use common\models\ContentChoice;
use backend\modules\sections\models\FileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use appxq\sdii\helpers\SDHtml;

/**
 * FileManagementController implements the CRUD actions for ContentChoice model.
 */
class FileManagementController extends Controller
{
    public function behaviors()
    {
        return [
/*	    'access' => [
		'class' => AccessControl::className(),
		'rules' => [
		    [
			'allow' => true,
			'actions' => ['index', 'view'], 
			'roles' => ['?', '@'],
		    ],
		    [
			'allow' => true,
			'actions' => ['view', 'create', 'update', 'delete', 'deletes'], 
			'roles' => ['@'],
		    ],
		],
	    ],*/
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
     * Lists all ContentChoice models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ContentChoice model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
	if (Yii::$app->getRequest()->isAjax) {
	    return $this->renderAjax('view', [
		'model' => $this->findModel($id),
	    ]);
	} else {
	    return $this->render('view', [
		'model' => $this->findModel($id),
	    ]);
	}
    }

    /**
     * Creates a new ContentChoice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
	if (Yii::$app->getRequest()->isAjax) {
	    $model              = new ContentChoice();
            $content_id         = \Yii::$app->request->get('content_id', '');
            $filet_id           = \Yii::$app->request->get('filet_id', '');
            $model->content_id  = $content_id;
            $model->type        = $filet_id;
	    if ($model->load(Yii::$app->request->post())) {
                if($model->default == 1){
                    //default
                    $choice = ContentChoice::find()->where(['content_id'=>$model->content_id, 'type'=>$model->type])->all();
                    foreach($choice as $c){
                        $c->default = 0;
                        $c->update();
                    }
                    //\Yii::$app->db->createCommand()->update($table, $columns, $condition, $params);
                }  
		if ($model->save()) {		 
                    return \janpan\jn\classes\JResponse::getSuccess(Yii::t('file', 'Update completed.'), $model);
                } else {
                    return \janpan\jn\classes\JResponse::getError(Yii::t('app', 'Can not update the data.'), $model);
                }
	    } else {
		return $this->renderAjax('create', [
		    'model' => $model,
		]);
	    }
	} else {
	    throw new NotFoundHttpException('Invalid request. Please do not repeat this request again.');
	}
    }

    /**
     * Updates an existing ContentChoice model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
	if (Yii::$app->getRequest()->isAjax) {
	    $model = $this->findModel($id);
	    if ($model->load(Yii::$app->request->post())) { 
                if($model->default == 1){
                    $choice = ContentChoice::find()->where(['content_id'=>$model->content_id, 'type'=>$model->type])->all();
                    foreach($choice as $c){
                        $c->default = 0;
                        $c->update();
                    }
                    //default
                    //ContentChoice::updateAll(['default'=>0, 'type'=>$model->type, 'content_id'=>$model->content_id]); 
                    //\Yii::$app->db->createCommand()->update($table, $columns, $condition, $params);
                }  
		if ($model->save()) {		 
                    return \janpan\jn\classes\JResponse::getSuccess(Yii::t('file', 'Update completed.'), $model);
                } else {
                    return \janpan\jn\classes\JResponse::getError(Yii::t('app', 'Can not update the data.'), $model);
                }
	    } else {
		return $this->renderAjax('update', [
		    'model' => $model,
		]);
	    }
	} else {
	    throw new NotFoundHttpException('Invalid request. Please do not repeat this request again.');
	}
    }

    /**
     * Deletes an existing ContentChoice model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete()
    {
	if (Yii::$app->getRequest()->isAjax) { 
            $id = \Yii::$app->request->post('id', '');
            $model = $this->findModel($id); 
	    if ($model->delete()) {		 
                return \janpan\jn\classes\JResponse::getSuccess(Yii::t('file', 'Deleted completed.'), $model);
	    } else {
		return \janpan\jn\classes\JResponse::getError(Yii::t('app', 'Can not delete the data.'), $model);
	    }
	} else {
	    throw new NotFoundHttpException('Invalid request. Please do not repeat this request again.');
	}
    }

    public function actionDeletes() {
	if (Yii::$app->getRequest()->isAjax) {
	    Yii::$app->response->format = Response::FORMAT_JSON;
	    if (isset($_POST['selection'])) {
		foreach ($_POST['selection'] as $id) {
		    $this->findModel($id)->delete();
		}
		$result = [
		    'status' => 'success',
		    'action' => 'deletes',
		    'message' => SDHtml::getMsgSuccess() . Yii::t('app', 'Deleted completed.'),
		    'data' => $_POST['selection'],
		];
		return $result;
	    } else {
		$result = [
		    'status' => 'error',
		    'message' => SDHtml::getMsgError() . Yii::t('app', 'Can not delete the data.'),
		    'data' => $id,
		];
		return $result;
	    }
	} else {
	    throw new NotFoundHttpException('Invalid request. Please do not repeat this request again.');
	}
    }
    
    /**
     * Finds the ContentChoice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ContentChoice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ContentChoice::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
