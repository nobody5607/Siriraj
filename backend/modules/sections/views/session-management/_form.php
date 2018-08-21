<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use appxq\sdii\helpers\SDNoty;
use appxq\sdii\helpers\SDHtml;
use backend\widgets\TinyMCECallback;
use dosamigos\tinymce\TinyMce;
use dominus77\iconpicker\IconPicker;

/* @var $this yii\web\View */
/* @var $model common\models\Sections */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div>

    <?php
    $form = ActiveForm::begin([
                'id' => $model->formName(),
    ]);
    ?>

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><b>&times;</b></button>
        <h4 class="modal-title" id="itemModalLabel"><b>Sections</b></h4>
    </div>

    <div class="modal-body">
        <div class="row"> 

            <div class="col-md-8">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?> 
            </div>
            <div class="col-md-4">                
                <?=
                $form->field($model, 'icon')->widget(IconPicker::className(), [
                    'options' => ['id' => 'icon-picker', 'class' => 'form-control'],                    
                ]);
                ?>
            </div>
            <div class="col-md-8">
                <?php
                $parent_list = \yii\helpers\ArrayHelper::map($parent_section, 'id', 'name');
                echo $form->field($model, 'parent_id')->dropDownList($parent_list, ['prompt' => Yii::t('section', 'Select Section')]);
                ?>
            </div>
            <div class="col-md-4">
                <?php
                $model->public = ($model->public != '') ? $model->public : 1;
                echo $form->field($model, 'public')->inline()->radioList(['1' => Yii::t('section', 'Pulbic'), '2' => Yii::t('section', 'Private')])
                ?>
            </div>


            <div class="col-md-12">
                <?php  echo $form->field($model, 'content')->widget(\janpan\jn\widgets\FroalaEditorWidget::className(), [
                        'toolbar_size'=>'lg',
                        'options'=>['class'=>'eztemplate'],
                    ]);//->hint('Default Template <a class="btn btn-warning btn-xs btn-template" data-widget="{tab-widget}">Use Default</a>'); 
                ?>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <?= Html::submitButton("Submit", ['class'=>'btn btn-primary btn-block btn-lg'])?>
                <?php // Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block btn-lg' : 'btn btn-primary btn-block btn-lg']) ?>
            </div>
        </div>
    </div>

<?php ActiveForm::end(); ?>

</div>

<?php
\richardfan\widget\JSRegister::begin([
    //'key' => 'bootstrap-modal',
    'position' => \yii\web\View::POS_READY
]);
?>
<script>
    $('#modal-contents').bind('hidden.bs.modal', function () {
        if (window.tinyMCE !== undefined && tinyMCE.editors.length) {
            for (e in tinyMCE.editors) {
                tinyMCE.editors[e].destroy();
            }
        }
    });
// JS script
    $('form#<?= $model->formName() ?>').on('beforeSubmit', function (e) {
        var $form = $(this);
        $.post(
                $form.attr('action'), //serialize Yii2 form
                $form.serialize()
                ).done(function (result) {
            if (result.status == 'success') {//console.log(result);return false;
                <?= SDNoty::show('result.message', 'result.status') ?>
                $(document).find('#modal-contents').modal('hide');
                setTimeout(function () {
                    location.reload();
                }, 1000);
                if (result.action == 'create') {
                    //$(\$form).trigger('reset');
                    $(document).find('#modal-sections').modal('hide');
                    $.pjax.reload({container: '#sections-grid-pjax'});
                } else if (result.action == 'update') {
                    $(document).find('#modal-sections').modal('hide');
                    $.pjax.reload({container: '#sections-grid-pjax'});
                }

            } else {
<?= SDNoty::show('result.message', 'result.status') ?>
            }
        }).fail(function () {
<?= SDNoty::show("'" . SDHtml::getMsgError() . "Server Error'", '"error"') ?>
            console.log('server error');
        });
        return false;
    });
</script>
<?php \richardfan\widget\JSRegister::end(); ?>