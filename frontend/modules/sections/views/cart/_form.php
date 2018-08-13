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
    <?= $form->field($model, 'companey_name')->textarea()?>  
    <?= $form->field($model, 'tel')->widget(\yii\widgets\MaskedInput::className(), [
    'mask' => '9999999999']);?>
    <?= $form->field($model, 'note')->widget(\dosamigos\tinymce\TinyMce::class, [
                'language' => strtolower(substr(Yii::$app->language, 0, 2)),
                'options'=>['id'=>'tests'],
                'clientOptions' => [
                    'height'=> 150,
                    'plugins' => [
                        'advlist autolink lists link image charmap print preview anchor pagebreak',
                        'searchreplace visualblocks code fullscreen',
                        'insertdatetime media table contextmenu paste code textcolor colorpicker',
                    ],
                    'toolbar' => 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
                    //'file_picker_callback' => \backend\widgets\TinyMCECallback::getFilePickerCallback(['/file-manager/frame']),
                ],
            ]) ?>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <?= Html::submitButton(Yii::t('backend', 'Next'), ['class' => 'btn btn-primary btn-block btn-lg']) ?>
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