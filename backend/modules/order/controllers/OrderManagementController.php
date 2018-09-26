<?php

namespace backend\modules\order\controllers;

use Yii;
use common\models\Order;
use backend\modules\order\models;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use appxq\sdii\helpers\SDHtml;

/**
 * OrderManagementController implements the CRUD actions for Order model.
 */
class OrderManagementController extends Controller
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
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new models();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = \common\models\OrderDetail::find()->where(['order_id'=>$id]);
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $model,
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);
	if (Yii::$app->getRequest()->isAjax) {
	    return $this->renderAjax('view', [
		'dataProvider' => $dataProvider,
                'model' => $model->one(),
	    ]);
	} else {
	    return $this->render('view', [
		'dataProvider' => $dataProvider,
                'model' => $model->one(),
	    ]);
	}
    }

     
    public function actionUpdate($id)
    {
	if (Yii::$app->getRequest()->isAjax) {
	    $model = $this->findModel($id);

	    if ($model->load(Yii::$app->request->post())) {	
                $invoice= \common\models\Invoice::find()->where(['order_id'=>$id])->one();
                if(!$invoice){
                    $invoice = new \common\models\Invoice();
                    $invoice->id = 'INV'.\appxq\sdii\utils\SDUtility::getMillisecTime();
                }
                $invoice->order_id = $id;
                $invoice->create_date = new \yii\db\Expression('NOW()');
                $invoice->admin_id = Yii::$app->user->id;
                $invoice->user_id = $model->user_id;
		if ($model->save()) {
                    if($model->status != 1){
                         $invoice->save();
                    }                   
		   return \janpan\jn\classes\JResponse::getSuccess("Update successfully", $model);
		} else {
		   return \janpan\jn\classes\JResponse::getError("Update successfully"); 
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
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
	//$id = \Yii::$app->request->post('id', '');
        $order = \common\models\Order::find()->where(['id'=>$id])->one();        
        if($order->delete()){
            $detail = \common\models\OrderDetail::find()->where(['order_id'=>$id])->all();
            foreach($detail as $d){
                $d->delete();
            }
            return \janpan\jn\classes\JResponse::getSuccess("Delete successfully"); 
        }else{
            return \janpan\jn\classes\JResponse::getError("Delete error"); 
        }
    }
    public function actionDeletOrderDetail(){   
        $id = \Yii::$app->request->post('id', '');
        $model = \common\models\OrderDetail::find()->where(['id'=>$id])->one();
        if($model->delete()){
            return \janpan\jn\classes\JResponse::getSuccess("Delete successfully"); 
        }else{
            return \janpan\jn\classes\JResponse::getError("Delete error"); 
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
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionOrderDetail(){
        $order_id = Yii::$app->request->get('order_id', '');        
        $model = \common\models\OrderDetail::find()->where(['order_id'=>$order_id]);
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $model,
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);
       // \appxq\sdii\utils\VarDumper::dump($dataProvider);

        $breadcrumbs=[];
        $breadcrumbs_arr = [
            [
                'label' => Yii::t('section','Home'), 
                'url' =>'/sections/session-management',
                'icon'=>'fa-bank'
            ],
            [
                    'label' => Yii::t('appmenu','My Orders'),
                    'url' => [
                        0 => '/sections/order/my-order'
                    ],                
                    'icon'=>'fa-shopping-cart'
            ],
            [
               'label' => Yii::t('order','Order Detail')
            ]
        ];
        foreach($breadcrumbs_arr as $key=>$v){
            $breadcrumbs[$key]=$v;
        } 
         
        return $this->renderAjax('order-detail',[
           'dataProvider' => $dataProvider,
           'breadcrumb'=>$breadcrumbs,
           //'order'=>$order
        ]);
    }
}
