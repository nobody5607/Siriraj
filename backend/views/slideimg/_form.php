<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use appxq\sdii\helpers\SDNoty;
use appxq\sdii\helpers\SDHtml;

/* @var $this yii\web\View */
/* @var $model common\models\Slideimg */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="slideimg-form">

    <?php $form = ActiveForm::begin([
	'id'=>$model->formName(),
        'options'=>['enctype'=>'multipart/form-data'] // important
    ]); ?>

    <div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title" id="itemModalLabel">Slideimg</h4>
    </div>

    <div class="modal-body"> 
        <?php
        echo kartik\file\FileInput::widget([
            'name' => 'file',
            'id' => 'file',
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'showPreview' => false,
                'showCaption' => true,
                'showRemove' => true,
                'showUpload' => false,
                
            ]
        ]);
        ?>

	<?= $form->field($model, 'detail')->textarea(['rows' => 6]) ?>
        <?= $form->field($model, 'forder')->textInput() ?> 

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
    var formData = new FormData($(this)[0]);
    $('.btn').prop('disabled', true);
    $.ajax({
        url:$form.attr('action'),
        type:'POST',
        data:formData,
        processData: false,
        contentType: false,
        cache: false,         
        enctype: 'multipart/form-data',
        success:function(result){
           if(result.status == 'success') {
                <?= SDNoty::show('result.message', 'result.status')?>           
                $('#modal-slideimg').modal('toggle');
                $.pjax.reload({container: "#slideimg-grid-pjax", async:false});
                $('.btn').prop('disabled', false);
            } else {
                <?= SDNoty::show('result.message', 'result.status')?>
                    $('.btn').prop('disabled', false);
            } 
        }
    });    
    return false;
});
</script>
<?php  \richardfan\widget\JSRegister::end(); ?>