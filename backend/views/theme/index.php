<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use appxq\sdii\helpers\SDNoty;
use appxq\sdii\helpers\SDHtml;
use kartik\color\ColorInput;
 
?>

<div class="box box-primary">

    <?php $form = ActiveForm::begin([
	'id'=>$model->formName(),
        'options'=>['enctype'=>'multipart/form-data'] // important
    ]); ?>

    <div class="box-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <div class="modal-title" id="itemModalLabel"><?= Yii::t('section','Themes')?></div>
    </div>

    <div class="box-body"> 
        
        <div class="row">
            <div class="col-md-4"><?= $form->field($model, 'bg_header')->widget(ColorInput::classname(), ['pluginOptions' => ['showInput' => false,'preferredFormat' => 'rgb'],'options' => ['placeholder' => 'Select color ...'],]); ?> </div>
            <div class="col-md-4"><?= $form->field($model, 'bg_menu')->widget(ColorInput::classname(), ['pluginOptions' => ['showInput' => false,'preferredFormat' => 'rgb'],'options' => ['placeholder' => 'Select color ...'],]); ?>  </div>
            <div class="col-md-4"><?= $form->field($model, 'bg_border_menu')->widget(ColorInput::classname(), ['pluginOptions' => ['showInput' => false,'preferredFormat' => 'rgb'],'options' => ['placeholder' => 'Select color ...'],]); ?> </div>
            <div class="col-md-4"><?= $form->field($model, 'bg_menu_link')->widget(ColorInput::classname(), ['pluginOptions' => ['showInput' => false,'preferredFormat' => 'rgb'],'options' => ['placeholder' => 'Select color ...'],]); ?> </div>
            <div class="col-md-4"><?= $form->field($model, 'bg_menu_link_hover')->widget(ColorInput::classname(), ['pluginOptions' => ['showInput' => false,'preferredFormat' => 'rgb'],'options' => ['placeholder' => 'Select color ...'],]); ?> </div>
            <div class="col-md-4"><?= $form->field($model, 'bg_footer')->widget(ColorInput::classname(), ['pluginOptions' => ['showInput' => false,'preferredFormat' => 'rgb'],'options' => ['placeholder' => 'Select color ...'],]); ?> </div>
            <div class="col-md-4"><?= $form->field($model, 'bg_footer_txt')->widget(ColorInput::classname(), ['pluginOptions' => ['showInput' => false,'preferredFormat' => 'rgb'],'options' => ['placeholder' => 'Select color ...'],]); ?></div>
        </div> 
    </div>
    <div class="box-footer">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <?= Html::submitButton(Yii::t('section', 'Save'), ['class' => 'btn btn-primary btn-block btn-lg']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php  \richardfan\widget\JSRegister::begin([
    //'key' => 'bootstrap-modal',
    'position' => \yii\web\View::POS_READY
]); ?>
<script>
// JS script
$('form#<?= $model->formName()?>').on('beforeSubmit', function(e) {
    var $form = $(this);
    $.post(
        $form.attr('action'), //serialize Yii2 form
        $form.serialize()
    ).done(function(result) {
        if(result.status == 'success') {
            <?= SDNoty::show('result.message', 'result.status')?>
            if(result.action == 'create') {
                //$(\$form).trigger('reset');
                $(document).find('#modal-options').modal('hide');
                $.pjax.reload({container:'#options-grid-pjax'});
            } else if(result.action == 'update') {
                $(document).find('#modal-options').modal('hide');
                $.pjax.reload({container:'#options-grid-pjax'});
            }
        } else {
            <?= SDNoty::show('result.message', 'result.status')?>
        } 
    }).fail(function() {
        <?= SDNoty::show("'" . SDHtml::getMsgError() . "Server Error'", '"error"')?>
        console.log('server error');
    });
    return false;
});
</script>
<?php  \richardfan\widget\JSRegister::end(); ?>