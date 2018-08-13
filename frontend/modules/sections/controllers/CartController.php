<?php
namespace frontend\modules\sections\controllers;
use yii\web\Controller;
use Yii; 
 
class CartController extends Controller
{
    public function actionMyCart(){        
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => Yii::$app->session["cart"],
            'sort' => [
                'attributes'=>['pro_name', 'pro_detail','pro_price', 'amount' , 'sum']
            ],
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);
        $breadcrumbs=[];
        $breadcrumbs[] = [
                'label' =>'Home', 
                'url' =>'/sections/session-management',
                'icon'=>'fa-bank'
        ];
        $breadcrumbs[] = [
                'label' =>'MyCart', 
                //'url' =>'#',
                'icon'=>'fa-shopping-cart'
        ];
//        \appxq\sdii\utils\VarDumper::dump($dataProvider);
        return $this->render('my-cart',[
           'dataProvider' => $dataProvider,
           'breadcrumb'=>$breadcrumbs 
        ]);
    }
    public function actionAddCart(){
        header('Access-Control-Allow-Origin: *');  
        $id = Yii::$app->request->post("id","");
        $qty = Yii::$app->request->post("qty","1");
        
        $id_arr = explode(',', $id);
        $data = [];
        foreach($id_arr as $v){
            $model = \common\models\Files::find()->where(["id"=>$v])->one();
            $data['id']   = $model->id;  
            $data['name'] = $model->name;
            $data['detail'] = $model->description;
            $data['price'] = 10;
            $data['image'] = $model->file_name_org;
            \frontend\modules\sections\classes\JCart::addCart($v, $data, $qty, "add");
        }
        $count_cart = [
            'count'=>count(Yii::$app->session["cart"]),
            'res'=> Yii::$app->session["cart"]
        ];
        return \janpan\jn\classes\JResponse::getSuccess(Yii::t('cart', 'Add cart success'), $count_cart, 'cart');
         
        //print_r(Yii::$app->session["cart"]);        return;
         
    }
    public function actionChecksession(){
        if(!empty(Yii::$app->session["cart"])){
            echo count(Yii::$app->session["cart"]);
        }
    }
    public function actionDeleteCart(){
        $data = \Yii::$app->session["cart"];
        $id = \Yii::$app->request->post('id', '');
        $out = [];
        
        foreach($data as $k=>$v){
            if($id == $k){
                \frontend\modules\sections\classes\JCart::addCart($id, $data, 1, 'del');
            }else{
               $out[$k] = $v;
            }
        }
        Yii::$app->session["cart"] = $out;
        return \janpan\jn\classes\JResponse::getSuccess("Delete successfully"); 
        
    }
    public function actionChange(){
        $id = Yii::$app->request->get("id","");
        $amount = Yii::$app->request->get("amount","1");
        $model = Product::find()->where(["id"=>$id])->one();
        if(!empty($model)){
            $data = Yii::$app->session["cart"][$id]["amount"];
           
            if($amount > $data){
                \frontend\assets\Cart::addCart($id, $model, $amount, "add");
            }else{
                \frontend\assets\Cart::addCart($id, $model, $amount, "del");
            }
             print_r(Yii::$app->session["cart"][$id]);exit();
             echo \frontend\assets\Cart::sumCart();
             //print_r(Yii::$app->session["cart"]);exit();
        }//end if
    }
     
}
