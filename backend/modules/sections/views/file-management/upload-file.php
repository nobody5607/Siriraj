<?php 
//    use kartik\widgets\FileInput;
    use yii\bootstrap\ActiveForm;
    use kartik\file\FileInput;
    use yii\helpers\Url;
    use yii\helpers\Html;
    use appxq\sdii\helpers\SDNoty;
    use appxq\sdii\helpers\SDHtml;
?>
<?php 
    $form = ActiveForm::begin([
        'id'=>$model->formName(),
        'options'=>['enctype'=>'multipart/form-data'] // important
    ]);
?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="itemModalLabel">Upload Files</h4>
</div>

<div class="modal-body"> 
    <?php 
        echo $form->field($model, 'name[]')->widget(FileInput::classname(), [
            'options' => ['multiple' => true, 'accept' => 'image/*'],
            'pluginOptions' => ['previewFileType' => 'image']
        ])->label(false);
    ?>
</div>
<div class="modal-footer">
    <div class="col-md-4 col-md-offset-4">
        <?= Html::submitButton('Submit',['class'=>'btn btn-primary btn-lg btn-block']) ?>
    </div>
</div>
<?php ActiveFOrm::end()?>

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