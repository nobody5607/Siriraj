<?php
namespace frontend\modules\sections\controllers;
use yii\web\Controller;
use Yii; 
 
class CartController extends Controller
{
    public function actionIndex(){
        return $this->render("index");
    }
    public function actionAddCart(){
        header('Access-Control-Allow-Origin: *');  
        $id = Yii::$app->request->post("id","");
        $qty = Yii::$app->request->post("qty","1");
        
        $id_arr = explode(',', $id);
        $data = [];
        foreach($id_arr as $v){
            $model = \common\models\Files::find()->where(["id"=>$v])->one();
            $data['name'] = $model->name;
            $data['detail'] = $model->description;
            $data['price'] = 10;
            $data['image'] = $model->file_name_org;
            \frontend\modules\sections\classes\JCart::addCart($v, $data, $qty, "add");
        }
        echo count(Yii::$app->session["cart"]);
        //print_r(Yii::$app->session["cart"]);        return;
         
    }
    public function actionChecksession(){
        if(!empty(Yii::$app->session["cart"])){
            echo count(Yii::$app->session["cart"]);
        }
    }
    public function actionDeletecart($id){
        $data = Yii::$app->session["cart"];
        $out = [];
          
        foreach($data as $k=>$v){
            if($id == $k){
               
            }else{
               $out[$k] = $v;
            }
        }
        Yii::$app->session["cart"] = $out;
        //\appxq\sdii\utils\VarDumper::dump(Yii::$app->session["cart"]);
        return $this->redirect(["index"]);
        
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
