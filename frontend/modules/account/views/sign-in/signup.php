<?php

use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model frontend\modules\account\models\SignupForm */

$this->title = Yii::t('user', 'Sign up');

?>

<?php 
$modalf = 'signup-modal';
echo yii\bootstrap\Modal::widget([
    'id'=>$modalf,
    'size' => 'modal-lg',
//    'clientOptions' => [
//        'backdrop' => false, 'keyboard' => false
//    ],
    'options'=>['tabindex' => false]
]);
?>
<div class="container" style="margin-top:30px;">
    <div class="row">
        <?php $form = ActiveForm::begin() ?>
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
    <div class="panel-heading"><?= Html::encode($this->title) ?></div>
    <div class="panel-body">
        <div class="col-md-12">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'password_confirm')->passwordInput(['maxlength' => true]) ?>
            
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'firstname')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'lastname')->textInput() ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'sap_id')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-8 col-sm-8 col-xs-8">
            <?php 
                
              echo $form->field($model, 'sitecode')->widget(kartik\select2\Select2::classname(), [
                   // 'initValueText' => '10377', // set the initial display text
                    'options' => ['placeholder' => Yii::t('user','Search for Sitecode')],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'minimumInputLength' => 3,
                        'language' => [
                            'errorLoading' => new yii\web\JsExpression("function () { return 'Waiting for results...'; }"),
                        ],
                        'ajax' => [
                            'url' => yii\helpers\Url::to(['/account/sitecode/get-site']),
                            'dataType' => 'json',
                            'data' => new yii\web\JsExpression('function(params) { return {q:params.term}; }')
                        ],
                        'escapeMarkup' => new yii\web\JsExpression('function (markup) { return markup; }'),
                        'templateResult' => new yii\web\JsExpression('function(data) { return data.name; }'),
                        'templateSelection' => new yii\web\JsExpression('function (data) { return data.name; }'),
                    ],
                ]);      
            ?>             
        </div>    
        <div class="col-md-4 col-sm-4 col-xs-4">
            <div style="margin-top:25px;">
            <?= Html::button("<i class='fa fa-plus'></i>", ['class'=>'btn btn-success btnAddSite'])?> 
            </div>    
        </div>
            
    </div>
    <div class="panel-footer">
        <div class="form-group">
            <?= Html::submitButton(Yii::t('user', 'Sign up'), ['class' => 'btn btn-success btn-block btn-lg']) ?>
        </div>
    </div>
</div>
        </div>
<?php ActiveForm::end() ?>
    </div>
</div>  

<?php appxq\sdii\widgets\CSSRegister::begin()?>
<style>
    .select2-container--krajee .select2-selection--single {
        height: 35px;
        line-height: 1.428571;
        padding: 12px 24px 6px 12px;
    }
    .select2-container--krajee .select2-selection__clear {
        color: #000;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        top: 0.2rem;
        font-weight: 700;
        font-size: 20px;
        opacity: 0.4;
        filter: alpha(opacity=40);
        position: absolute;
        left: 85%;
    }
</style>
<?php appxq\sdii\widgets\CSSRegister::end();?>

<?php richardfan\widget\JSRegister::begin(); ?>
<script>
    $('.btnAddSite').on('click', function(){ 
        $('#<?= $modalf ?> .modal-content').html('<div class=\"sdloader \"><i class=\"sdloader-icon\"></i></div>');
        $('#<?= $modalf ?>').modal('show');
        let url = '/account/sitecode/create';    
        $.get(url, function(res){
            $('#<?= $modalf ?> .modal-content').html(res);                    
        });
       return false;
   }); 
</script>
<?php richardfan\widget\JSRegister::end(); ?> 