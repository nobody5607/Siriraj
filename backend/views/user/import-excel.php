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
//        'options' => ['accept' => 'csv'],
    ])->label('ไฟล์')
            ->hint(
                    "<span style='color:#F44336;'>* หมายเหตุ ขนาดข้อมูลในไฟล์ Excel ไม่ควรเกิน 500 - 1000 แถว เนื่องจากจะทำให้ระบบช้า<br> และ รูปแบบข้อมูลจะต้องตรงตาม Template ตัวอย่าง เท่านั้น <br> และ ไฟล์จะต้องเป็น .xls , xlsx เท่านั้น</span>
                    <div><a href=".\yii\helpers\Url::to('@web/files/001.xls')."><i class=\"fa fa-download\"></i> ดาวน์โหลด Template  ตัวอย่าง</a></div>    
            ");
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
                },1000);            
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