<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\UserProfile;
use janpan\jn\widgets\FlatpickrWidget;
use vova07\fileapi\Widget as FileApi;
use kartik\tabs\TabsX;
/* @var $this yii\web\View */
/* @var $model common\models\UserProfile */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('user', 'Settings');
if($breadcrumb){
        echo janpan\jn\widgets\BreadcrumbsWidget::widget([
            'breadcrumb'=>$breadcrumb
        ]);  
    }
    
  
?>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
 
    <div class="box box-primary">
        <div class="box-header">
            <div>
                <?= Html::encode($this->title) ?>
                <div class="pull-right">
                    <?= Html::a(Yii::t('user', 'Change password'), ['password'], ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
        <div class="box-body">
            <?php 
                $items = [
                       [
                           'label'=>'<i class="fa fa-cog"></i> '.Yii::t('user','Settings'),
                           'content'=>$this->render("_serring",['model'=>$model]),
                           'active'=>true
                       ],
                       [
                           'label'=>'<i class="fa fa-user"></i> '.Yii::t('user','Account'),
                           'content'=>$this->render("_account",['model'=>$user]),
                       ]   
                   ];

                  echo TabsX::widget([
                   'items'=>$items,
                   'position'=>TabsX::POS_ABOVE,
                   'encodeLabels'=>false
               ]);
           ?>
        </div>
    </div>
</div> 
</div>

<?php \appxq\sdii\widgets\CSSRegister::begin()?>
<style>
    @media only screen and (min-width: 768px){
        .cd-breadcrumb, .cd-multi-steps {     
            max-width: 100%;    
            margin-left: 0; 
        }
    }
    .btn-warning{
        border: solid 1px #da7c0c;
        background: #f78d1d;
        background: -webkit-gradient(linear,left top,left bottom,from(#faa51a),to(#f47a20));
    }
    #w3-success{
        margin-top:20px;
    }
</style>
<?php \appxq\sdii\widgets\CSSRegister::end();?>