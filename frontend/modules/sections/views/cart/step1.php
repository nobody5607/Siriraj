<?php
use yii\helpers\Html;
$this->title = Yii::t('cart', 'Shipping address');

if($breadcrumb){
        echo janpan\jn\widgets\BreadcrumbsWidget::widget([
            'breadcrumb'=>$breadcrumb
        ]);  
    }
?>

<div class="panel panel-default">
    <div class="panel-heading"><?= Html::encode($this->title)?></div>
    <div class="panel-body">
        <?php
            echo $this->render('_form',['model'=>$model]);
        ?>
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
</style>
<?php \appxq\sdii\widgets\CSSRegister::end();?>