<?php
namespace frontend\modules\sections\controllers;
use yii\web\Controller;
use Yii; 
 
class OrderController extends Controller
{
    public function actionMyOrder(){
        $user_id = isset(Yii::$app->user->id) ? Yii::$app->user->id : '';
        $model = \common\models\Order::find()->where(['user_id'=>$user_id]);
        
        $invoice = \common\models\Invoice::find()->where(['user_id'=>$user_id]);
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $model,
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);
        $invoiceProvider = new \yii\data\ActiveDataProvider([
            'query' => $invoice,
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);
       // \appxq\sdii\utils\VarDumper::dump($dataProvider);

        $breadcrumbs=[];
        $breadcrumbs_arr = [
            [
                'label' =>'Home', 
                'url' =>'/sections/session-management',
                'icon'=>'fa-bank'
            ],
            [
                    'label' =>'My Order'
            ]
        ];
        foreach($breadcrumbs_arr as $key=>$v){
            $breadcrumbs[$key]=$v;
        } 
         
        return $this->render('my-order',[
           'dataProvider' => $dataProvider,
            'invoiceProvider'=>$invoiceProvider,
           'breadcrumb'=>$breadcrumbs,
            
        ]);
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
                'label' =>'Home', 
                'url' =>'/sections/session-management',
                'icon'=>'fa-bank'
            ],
            [
                    'label' =>'My Order',
                    'url' => [
                        0 => '/sections/order/my-order'
                    ],                
                    'icon'=>'fa-shopping-cart'
            ],
            [
               'label' =>'Order Detail'
            ]
        ];
        foreach($breadcrumbs_arr as $key=>$v){
            $breadcrumbs[$key]=$v;
        } 
         
        return $this->render('order-detail',[
           'dataProvider' => $dataProvider,
           'breadcrumb'=>$breadcrumbs,
           //'order'=>$order
        ]);
    } 
    
    public function actionDeletOrder(){   
        $id = \Yii::$app->request->post('id', '');
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
    public function actionOrderInvoiceDetail(){
        $id     = \Yii::$app->request->get('id', '');
        $model  = \common\models\Invoice::findOne($id);
        if($model){
            $order  = \common\models\OrderDetail::find()->where(['order_id'=>$model->order_id])->all();           
            return $this->renderAjax('order-invoice-detail',[
                'model'=>$model,
                'order'=>$order
            ]);
        }
    }    
}
