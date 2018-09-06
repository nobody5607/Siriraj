<?php

use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model frontend\modules\account\models\SignupForm */

$this->title = Yii::t('user', 'Sign up');
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
<div class="container" style="margin-top:30px;">
    <div class="row">
        <?php $form = ActiveForm::begin() ?>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><?= Html::encode($this->title) ?></div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'password_confirm')->passwordInput(['maxlength' => true]) ?>

                    </div>
                    <div class="col-md-12">
                        <?= $form->field($model, 'firstname')->textInput() ?>
                    </div>
                    <div class="col-md-12">
                        <?= $form->field($model, 'lastname')->textInput() ?>
                    </div>
                            <div class="col-md-12">
                                <label style="color:red">**  <?= Yii::t('_user','Siriraj members wait 1-2 days for staff approval.')?></label>
                                <div class="clearfix"></div>
                                <label>
                                    <input type="checkbox" class="btn btn-info" data-toggle="collapse" data-target="#demo"> <?= Yii::t('_user','Staff')?>
                                </label>
                            </div>
                    
                    <div id="demo" class="collapse">
                        <div class="col-md-12">
                            <?= $form->field($model, 'sap_id')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-12">
                                <?php   
                                  echo $form->field($model, 'sitecode')->textInput()->label(Yii::t('user','Sitecode'));      
                                ?>             
                            </div>
                            <div class="col-md-12">
                                <?php   
                                  echo $form->field($model, 'position')->textInput()->label(Yii::t('user','Position'));      
                                ?>             
                            </div> 
                    </div>

                            

                </div>
                <div class="panel-footer">
                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('user', 'Sign up'), ['class' => 'btn btn-success btn-block btn-lg']) ?>
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end() ?>
    </div>
</div>  

<?php appxq\sdii\widgets\CSSRegister::begin() ?>
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
<?php appxq\sdii\widgets\CSSRegister::end(); ?>
 