


<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>

<div class="container">
    <div class="row" style="margin-top:100px;">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-primary">
            <div class="panel-heading"><?= Yii::t('appmenu','Log into your account')?></div>
    <div class="panel-body">
        

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>
         
        <?= $form
            ->field($model, 'identity', $fieldOptions1)            
            ->textInput(['placeholder' => $model->getAttributeLabel('username')])->label(Yii::t('appmenu','Username or e-mail')) ?>

        <?= $form
            ->field($model, 'password', $fieldOptions2)
            
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

        <div class="row">
            <div class="col-xs-12">
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
            </div>
            <!-- /.col -->
            <div class="col-xs-12">
                <?= Html::submitButton(Yii::t('appmenu','Login'), ['class' => 'btn btn-primary btn-block btn-flat btn-lg', 'name' => 'login-button']) ?>
            </div>
            <!-- /.col -->
        </div>


        <?php ActiveForm::end(); ?>

<!--        <div class="social-auth-links text-center">
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in
                using Facebook</a>
            <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign
                in using Google+</a>
        </div>-->
        <!-- /.social-auth-links -->

        <!--<a href="#">I forgot my password</a>-->
        <br>
        <a href="/account/sign-in/signup" class="text-center"><?= Yii::t('appmenu', 'Don\'t have an account, create a new account here')?></a>

    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
    </div>
</div>
</div>
