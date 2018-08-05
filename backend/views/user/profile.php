<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use common\models\User;
use common\models\UserProfile;
use bs\Flatpickr\FlatpickrWidget;
use vova07\fileapi\Widget as FileApi; 

$this->title = Yii::t('backend', 'User Profile');

$this->params['breadcrumbs'][] = $this->title;
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

                    <?= $form->field($user, 'username')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($user, 'password')->passwordInput(['maxlength' => true]) ?>

                    <?= $form->field($user, 'email')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($user, 'status')->label(Yii::t('backend', 'Status'))->radioList(User::statuses()) ?>

                    <?= $form->field($user, 'roles')->checkboxList($roles) ?>

                    <?= $form->field($profile, 'firstname')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($profile, 'lastname')->textInput(['maxlength' => true]) ?>

                    <?=
                    $form->field($profile, 'birthday')->widget(FlatpickrWidget::class, [
                        'locale' => strtolower(substr(Yii::$app->language, 0, 2)),
                        'groupBtnShow' => true,
                        'options' => [
                            'class' => 'form-control',
                        ],
                        'clientOptions' => [
                            'allowInput' => true,
                            'defaultDate' => $profile->birthday ? date(DATE_ATOM, $profile->birthday) : null,
                        ],
                    ])
                    ?>

                    <?=
                    $form->field($profile, 'avatar_path')->widget(FileApi::class, [
                        'settings' => [
                            'url' => ['/site/fileapi-upload'],
                        ],
                        'crop' => true,
                        'cropResizeWidth' => 100,
                        'cropResizeHeight' => 100,
                    ])
                    ?>

                    <?=
                    $form->field($profile, 'gender')->dropDownlist(
                            [
                        UserProfile::GENDER_MALE => Yii::t('backend', 'Male'),
                        UserProfile::GENDER_FEMALE => Yii::t('backend', 'Female'),
                            ], ['prompt' => '']
                    )
                    ?>

<?= $form->field($profile, 'website')->textInput(['maxlength' => true]) ?>

                                <?= $form->field($profile, 'other')->textarea(['rows' => 6, 'maxlength' => true]) ?>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                    <?= Html::submitButton(Yii::t('backend', 'Submit'), ['class' => 'btn btn-primary btn-block btn-lg']) ?>
                            </div>
                        </div>
                    </div>

<?php ActiveForm::end() ?>
                </div>

            </div>
        </div>

    </div>
</div>
<?php appxq\sdii\widgets\CSSRegister::begin(); ?>
<style>
    .box-default {
        border: none;
        box-shadow: 0px 0px 1px #cacaca;
    }
</style>
<?php appxq\sdii\widgets\CSSRegister::end(); ?>