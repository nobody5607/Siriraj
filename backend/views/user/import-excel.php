<?php

use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;
use appxq\sdii\helpers\SDNoty;

$this->title = "เพิ่มผู้ใช้จากไฟล์ Excel";
?> 
<?php
$form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data'],
            'id' => $model->formName(),
        ]);
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"><?= $this->title; ?></h4>
</div>
<div class="modal-body">

    <?php
    echo $form->field($model, 'filename')->widget(FileInput::classname(), [
        'options' => ['accept' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'],
    ]);
    ?>


</div>
<div class="modal-footer">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
<?= yii\helpers\Html::submitButton(Yii::t('user', 'Submit'), ['class' => 'btn btn-lg btn-primary btn-block btnSubmit']) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>


<?php richardfan\widget\JSRegister::begin(); ?>
<script>
    $('form#<?= $model->formName()?>').on('beforeSubmit', function(e) {
    $('.btnSubmit').prop('disabled', true);     
    var $form = $(this);
    var formData = new FormData($(this)[0]);
    $.ajax({
        url:$form.attr('action'),
        type:'POST',
        data:formData,
        processData: false,
        contentType: false,
        cache: false,         
        enctype: 'multipart/form-data',
        success:function(result){
           $('.btnSubmit').prop('disabled', false);
           if(result.status == 'success') {
                <?= SDNoty::show('result.message', 'result.status')?>     
                setTimeout(function(){
                    location.reload();
                });            
            } else {
//                let error = result;
                let error = JSON.stringify(result.data);
                <?= SDNoty::show('error', 'result.status')?>
            } 
        }
    }).fail(function(){
            $('.btnSubmit').prop('disabled', false);
    });    
     
    return false;
});
</script>
<?php richardfan\widget\JSRegister::end(); ?> 