<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\UserProfile;
use janpan\jn\widgets\FlatpickrWidget;
use vova07\fileapi\Widget as FileApi;
?>
<?php
$modalf = 'signup-modal';
echo yii\bootstrap\Modal::widget([
    'id' => $modalf,
    'size' => 'modal-lg',
//    'clientOptions' => [
//        'backdrop' => false, 'keyboard' => false
//    ],
    'options' => ['tabindex' => false]
]);
?>
<div> 
    <div>
<?php $form = ActiveForm::begin([
    'id'=>$model->formName(),
]); ?>
        <div class="row">
            <div class="col-md-12">
        <?= $this->render('_image-upload', ['model' => $model, 'form' => $form]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
<?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
 
 
                <?= $form->field($model, 'birthday')->widget(kartik\date\DatePicker::ClassName(),
                    [
                    'name' => 'birthday', 
                    'options' => ['placeholder' => 'Select date ...'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ]
                ]);?>
            </div>
            <div class="col-md-6">
                <?=
                $form->field($model, 'gender')->dropDownlist([
                    UserProfile::GENDER_MALE => Yii::t('user', 'Male'),
                    UserProfile::GENDER_FEMALE => Yii::t('user', 'Female'),
                        ], ['prompt' => ''])
                ?>
            </div>
        </div> 

<?= $form->field($model, 'sap_id')->textInput(['maxlength' => true]) ?> 
        <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-8">
        <?php
        $default = common\models\Sitecode::findOne($model->sitecode);

        echo $form->field($model, 'sitecode')->widget(kartik\select2\Select2::classname(), [
            //'language' => 'en-US',
            'initValueText' => "{$default['name']} ({$default['id']})",
            'options' => ['placeholder' => Yii::t('user', 'Search for Sitecode')],
            'pluginOptions' => [
                'allowClear' => true,
                'minimumInputLength' => 1,
                'language' => [
                    'errorLoading' => new yii\web\JsExpression("function () { return 'Waiting for results...'; }"),
                ],
                'ajax' => [
                    'url' => yii\helpers\Url::to(['/account/sitecode/get-site']),
                    'dataType' => 'json',
                    'data' => new yii\web\JsExpression('function(params) { return {q:params.term}; }'),
                ],
                'escapeMarkup' => new yii\web\JsExpression('function (markup) { return markup; }'),
                'templateResult' => new yii\web\JsExpression('function(data) { return data.text;}'),
                'templateSelection' => new yii\web\JsExpression('function (data) { return data.text; }'),
            ],
        ])->label(Yii::t('user', 'Select Sitecode'));
        ?>             
            </div>    
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div style="margin-top:25px;">
<?= Html::button("<i class='fa fa-plus'></i>", ['class' => 'btn btn-success btnAddSite']) ?> 
                </div>    
            </div>
        </div>


        <div class="form-group">
<?= Html::submitButton(Yii::t('user', 'Submit'), ['class' => 'btn btn-success btn-block btn-lg']) ?>
        </div>

            <?php ActiveForm::end() ?>
    </div>
</div>

<?php richardfan\widget\JSRegister::begin(); ?>
<script>
    $('.btnAddSite').on('click', function () {
        $('#<?= $modalf ?> .modal-content').html('<div class=\"sdloader \"><i class=\"sdloader-icon\"></i></div>');
        $('#<?= $modalf ?>').modal('show');
        let url = '/account/sitecode/create';
        $.get(url, function (res) {
            $('#<?= $modalf ?> .modal-content').html(res);
        });
        return false;
    });
    
    $('form#<?= $model->formName()?>').on('beforeSubmit', function(e) {
        var $form = $(this);
        $.post(
            $form.attr('action'), //serialize Yii2 form
            $form.serialize()
        ).done(function(result) { 
            if(result.status == 'success') {
                <?= appxq\sdii\helpers\SDNoty::show('result.message', 'result.status')?>
                $(document).find('#signup-modal').modal('hide');
                
            } else {
                <?= appxq\sdii\helpers\SDNoty::show('result.message', 'result.status')?>
            } 
        }).fail(function() {
            <?= appxq\sdii\helpers\SDNoty::show("'" . appxq\sdii\helpers\SDHtml::getMsgError() . "Server Error'", '"error"')?>
            console.log('server error');
        });
        return false;
    });
</script>
<?php richardfan\widget\JSRegister::end(); ?> 

<?php appxq\sdii\widgets\CSSRegister::begin()?>
<style>
    .select2-container--krajee .select2-selection--single {
        height: 35px;
        line-height: 1.428571;
        padding: 12px 24px 6px 12px;
    }
    .select2-container--krajee .select2-selection__clear {
        color: #000;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        top: 0.2rem;
        font-weight: 700;
        font-size: 20px;
        opacity: 0.4;
        filter: alpha(opacity=40);
        position: absolute;
        left: 85%;
    }
</style>
<?php appxq\sdii\widgets\CSSRegister::end();?>


