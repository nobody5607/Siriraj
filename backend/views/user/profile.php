<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use common\models\User;
use common\models\UserProfile;
use bs\Flatpickr\FlatpickrWidget;
use vova07\fileapi\Widget as FileApi; 
$this->title = Yii::t('_user', 'User Profile');

$this->params['breadcrumbs'][] = $this->title;
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


<div class="row">
    <div class="col-md-12">
        <div class="box box-default">
            <div class="box-header">
                <h4><i class="fa fa-user"> <?= yii\helpers\Html::encode($this->title) ?></i></h4>
            </div>
            <div class="box-body">
                <div class="col-md-6 col-md-offset-3">
                    <?php $form = ActiveForm::begin() ?>
                    <?= $this->render('_image-upload', ['model' => $profile, 'form' => $form]) ?>

                    <?= $form->field($user, 'username')->textInput(['maxlength' => true])->label(Yii::t('_user','Username')) ?>

                    <?= $form->field($user, 'password')->passwordInput(['maxlength' => true])->label(Yii::t('_user','Password')) ?>

                    <?= $form->field($user, 'email')->textInput(['maxlength' => true])->label(Yii::t('_user','Email')) ?>

                    

                    <?= $form->field($profile, 'firstname')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($profile, 'lastname')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($profile, 'birthday')->widget(kartik\date\DatePicker::ClassName(),
                    [
                    'name' => 'birthday', 
                    'options' => ['placeholder' => 'Select date ...'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ]
                ]);?>

                    
                    <?= $form->field($profile, 'sap_id')->textInput()->label(Yii::t('_user','Sap_id')) ?>
                    <?=
                    $form->field($profile, 'gender')->dropDownlist(
                            [
                        UserProfile::GENDER_MALE => Yii::t('_user', 'Male'),
                        UserProfile::GENDER_FEMALE => Yii::t('_user', 'Female'),
                            ], ['prompt' => '']
                    )->label(Yii::t('_user','Gender'))
                    ?>
                    <div class="row">
                        <div class="col-md-8 col-sm-8 col-xs-8">
                            <?php
                            $default = common\models\Sitecode::findOne($profile->sitecode);

                            echo $form->field($profile, 'sitecode')->widget(kartik\select2\Select2::classname(), [
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
                                        'url' => yii\helpers\Url::to(['/sitecode/get-site']),
                                        'dataType' => 'json',
                                        'data' => new yii\web\JsExpression('function(params) { return {q:params.term}; }'),
                                    ],
                                    'escapeMarkup' => new yii\web\JsExpression('function (markup) { return markup; }'),
                                    'templateResult' => new yii\web\JsExpression('function(data) { return data.text;}'),
                                    'templateSelection' => new yii\web\JsExpression('function (data) { return data.text; }'),
                                ],
                            ])->label(Yii::t('_user', 'Select Sitecode'));
                            ?>             
                        </div>    
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <div style="margin-top:25px;">
                                <?= Html::button("<i class='fa fa-plus'></i>", ['class' => 'btn btn-success btnAddSite']) ?> 
                            </div>    
                        </div>
                    </div>
                      

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                    <?= Html::submitButton(Yii::t('_user', 'Save'), ['class' => 'btn btn-primary btn-block btn-lg']) ?>
                            </div>
                        </div>
                    </div>

<?php ActiveForm::end() ?>
                </div>

            </div>
        </div>

    </div>
</div>
<?php richardfan\widget\JSRegister::begin(); ?>
<script>
    $('.btnAddSite').on('click', function () {
        $('#<?= $modalf ?> .modal-content').html('<div class=\"sdloader \"><i class=\"sdloader-icon\"></i></div>');
        $('#<?= $modalf ?>').modal('show');
        let url = '/sitecode/save';
        $.get(url, function (res) {
            $('#<?= $modalf ?> .modal-content').html(res);
        });
        return false;
    });
    
    
</script>
<?php richardfan\widget\JSRegister::end(); ?> 