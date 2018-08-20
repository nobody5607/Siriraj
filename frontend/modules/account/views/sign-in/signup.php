<?php

use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model frontend\modules\account\models\SignupForm */

$this->title = Yii::t('user', 'Sign up');

?>
<div class="container" style="margin-top:30px;">
    <div class="row">
        <?php $form = ActiveForm::begin() ?>
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
    <div class="panel-heading"><?= Html::encode($this->title) ?></div>
    <div class="panel-body">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'password_confirm')->passwordInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'verifyCode')->widget(Captcha::class, [
                    'captchaAction' => '/site/captcha',
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
            ]) ?>
    </div>
    <div class="panel-footer">
        <div class="form-group">
            <?= Html::submitButton(Yii::t('user', 'Sign up'), ['class' => 'btn btn-success btn-block']) ?>
        </div>
    </div>
</div>
        </div>
<?php ActiveForm::end() ?>
    </div>
</div>