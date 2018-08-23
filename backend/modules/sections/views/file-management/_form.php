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
	<h4 class="modal-title" id="itemModalLabel">Content Choice</h4>
    </div>

    <div class="modal-body"> 
        <div class="row">
            <?php
                $file_type = \common\models\FileType::find()->all();
                $items = yii\helpers\ArrayHelper::map($file_type, 'id', 'name');
            ?> 	
            <div class="col-md-6">
                <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'forder')->textInput() ?>
            </div>
            <div class="col-md-12">
                <?php
                    $items = ['1'=>'Yes','0'=>'No'];
                    echo $form->field($model, 'default')->radioList($items, []); 
                ?>
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