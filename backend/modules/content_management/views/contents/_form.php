<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use appxq\sdii\helpers\SDNoty;
use appxq\sdii\helpers\SDHtml;
use dosamigos\tinymce\TinyMce;
use backend\widgets\TinyMCECallback;
/* @var $this yii\web\View */
/* @var $model common\models\Contents */
/* @var $form yii\bootstrap\ActiveForm */

?>

<div class="contents-form">

    <?php $form = ActiveForm::begin([
	'id'=>$model->formName(),
    ]); ?>

    <div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title" id="itemModalLabel">Contents</h4>
    </div>

    <div class="modal-body">
	 
	<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?> 
        <?= $form->field($model, 'description')->widget(TinyMce::class, [
                'language' => strtolower(substr(Yii::$app->language, 0, 2)),
                'options'=>['id'=>'tests'],
                'clientOptions' => [
                    'height'=> 250,
                    'plugins' => [
                        'advlist autolink lists link image charmap print preview anchor pagebreak',
                        'searchreplace visualblocks code fullscreen',
                        'insertdatetime media table contextmenu paste code textcolor colorpicker',
                    ],
                    'toolbar' => 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | forecolor backcolor',
                    'file_picker_callback' => TinyMCECallback::getFilePickerCallback(['file-manager/frame']),
                ],
            ]) ?>
        <div class="form-group">
            <?php
            echo "<label>Section</label>";
            echo \kartik\tree\TreeViewInput::widget([                
                'name' => 'section_id',
                'value' => $model->section_id, // preselected values
                'query' => backend\modules\content_management\models\TreeSections::find()->addOrderBy('parent_id, id'), //\tests\models\Tree::find()->addOrderBy('root, lft'),
                'headingOptions' => ['label' => 'Store'],
                'rootOptions' => ['label' => '<i class="fa fa-tree text-success"></i>'],
                'fontAwesome' => true,
                'asDropdown' => true,
                'multiple' => false,
                'options' => ['disabled' => false, 'class'=>'test1']
            ]);
            ?>
        </div> 
 

	<?php 
            $model->public = ($model->public != '') ? $model->public : 1;
            echo $form->field($model, 'public')->inline()->radioList(['1' => Yii::t('section', 'Pulbic'), '2' => Yii::t('section','Private')])->label(false) 
        ?> 

    </div>
    <div class="modal-footer">
	<?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php  \richardfan\widget\JSRegister::begin([
    //'key' => 'bootstrap-modal',
    'position' => \yii\web\View::POS_READY
]); ?>
<script>
$('#modal-contents').bind('hidden.bs.modal', function() {
    if(window.tinyMCE !== undefined && tinyMCE.editors.length){
        for(e in tinyMCE.editors){
            tinyMCE.editors[e].destroy();
        }
    }
});     
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
                $(document).find('#modal-contents').modal('hide');
                $.pjax.reload({container:'#contents-grid-pjax'});
            } else if(result.action == 'update') {
                $(document).find('#modal-contents').modal('hide');
                $.pjax.reload({container:'#contents-grid-pjax'});
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