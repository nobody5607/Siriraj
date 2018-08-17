<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use appxq\sdii\helpers\SDNoty;


?>
<div class="col-md-6 col-md-offset-3">
   <?php $form = ActiveForm::begin([
	'id'=>$model->formName(),
    ]); ?>
    <?= $form->field($model, 'firstname')->textInput()?>
    <?= $form->field($model, 'lastname')->textInput()?>
    <?= $form->field($model, 'companey_name')->textarea()->label(Yii::t('cart', 'Address'))?>  
    <?= $form->field($model, 'tel')->widget(\yii\widgets\MaskedInput::className(), [
    'mask' => '9999999999']);?>
    <?= $form->field($model, 'note')->textarea()?>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <?= Html::submitButton(Yii::t('cart', 'Next'), ['class' => 'btn btn-primary btn-block btn-lg']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end() ?>
</div>


<?php  \richardfan\widget\JSRegister::begin([
    //'key' => 'bootstrap-modal',
    'position' => \yii\web\View::POS_READY
]); ?>
<script>
 
$('form#<?= $model->formName()?>').on('beforeSubmit', function(e) {
    var $form = $(this);
    $.post(
        $form.attr('action'), //serialize Yii2 form
        $form.serialize()
    ).done(function(result) {
        if(result.status == 'success') {
            <?= SDNoty::show('result.message', 'result.status')?>
            
            setTimeout(function(){
                location.href = '/sections/order/my-order';
            },1000);
             
            
        } else {
            <?= SDNoty::show('result.message', 'result.status')?>
        } 
    }).fail(function() {
        <?= SDNoty::show("'" . \appxq\sdii\helpers\SDHtml::getMsgError() . "Server Error'", '"error"')?>
        console.log('server error');
    });
    return false;
});
</script>
<?php  \richardfan\widget\JSRegister::end(); ?>