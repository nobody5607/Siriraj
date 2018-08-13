<?php
namespace frontend\components;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\VarDumper;
use yii\web\Request;
class AppComponent extends Component{
    public static function sectionRoot(){
        $root = \common\models\Sections::find()->where('parent_id=0 and rstat not in(0,3)')->orderBy(['forder'=>SORT_ASC])->all();
        if($root){
            return $root;
        }
    }
    public static function navbarRightMenu() {
        $cart = isset(Yii::$app->session["cart"]) ? count(Yii::$app->session["cart"]) : 0;
        $userProfile = isset(Yii::$app->user->identity->userProfile) ? Yii::$app->user->identity->userProfile : '';
        if (Yii::$app->user->isGuest) {
            Yii::$app->params['navbarR'][] = ['label' => '<i class="fa fa-user-plus"></i> '.Yii::t('appmenu', 'Create new account'), 'encode' => FALSE, 'url' => ['/account/sign-in/signup']];
            Yii::$app->params['navbarR'][] = ['label' => '<i class="fa fa-sign-in"></i> '.Yii::t('appmenu', 'Login'), 'encode' => FALSE, 'url' => ['/account/sign-in/login']];
        } else {
            Yii::$app->params['navbarR'][] = [
                'label' => '<i class="fa fa-shopping-cart"></i> &nbsp;'.\Yii::t('appmenu','My Cart').' <span class="label label-danger" id="globalCart">'.$cart.'</span>', 'encode' => FALSE, 'url' => ['/sections/cart/my-cart']];
            $avatar_url = Yii::getAlias('@storageUrl') . '/avatars/noimage.png';
            if(isset($userProfile->avatar_path) && !empty($userProfile->avatar_path)){
                $avatar_url = Yii::getAlias('@storageUrl/avatars').'/'.$userProfile->avatar_path;
            }
            $avatar_img = '<img class="img-circle" width="18" src="'.$avatar_url.'"/>'; 
            Yii::$app->params['navbarR'][] = ['label' => $avatar_img.' '. (isset($userProfile['firstname'])?$userProfile['firstname'].' '.$userProfile['lastname']:'Unknown'), 'encode' => FALSE, 'items' => [
                    ['label' => '<i class="fa fa-user"></i> '.Yii::t('appmenu', 'My Profile'), 'encode' => FALSE, 'url' => ['/account/default/settings']],
                    ['label' => '<i class="fa fa-check-square-o"></i> '.Yii::t('appmenu', 'My Orders'), 'encode' => FALSE, 'url' => ['/sections/order/my-order']],
                    ['label' => '<i class="fa fa-unlock-alt"></i> '.Yii::t('appmenu', 'Logout'), 'encode' => FALSE, 'url' => ['/account/sign-in/logout'], 'linkOptions' => ['data-method' => 'post']],
            ]];
            
        }
    }
}
