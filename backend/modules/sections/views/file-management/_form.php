<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use appxq\sdii\helpers\SDNoty;
use appxq\sdii\helpers\SDHtml;

/* @var $this yii\web\View */
/* @var $model common\models\ContentChoice */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="content-choice-form">

    <?php $form = ActiveForm::begin([
	'id'=>$model->formName(),
    ]); ?>

    <div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title" id="itemModalLabel"><?= Yii::t('section','Note')?></h4>
    </div>

    <div class="modal-body"> 
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'file_name_org')->textInput()->label(Yii::t('section','File Name')) ?>
            </div> 
            <div class="col-md-12">
                <?= $form->field($model, 'details')->textArea(['rows' =>7])->label(Yii::t('section','Note')) ?>
            </div>
            <div class="col-md-12">
                <?= $form->field($model, 'keywords')->textArea(['rows' =>5])->label(Yii::t('section','Keyword')) ?>
            </div>
             
             
        </div>    
    </div>
    <div class="modal-footer">
	<?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	<?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
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
                $(document).find('#modal-content-choice').modal('hide');
                $.pjax.reload({container:'#content-choice-grid-pjax'});
            } else if(result.action == 'update') {
                $(document).find('#modal-content-choice').modal('hide');
                $.pjax.reload({container:'#content-choice-grid-pjax'});
            }
            setTimeout(function(){
                location.reload();
            },1000);
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