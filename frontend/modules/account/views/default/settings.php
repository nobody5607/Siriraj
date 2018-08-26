<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\UserProfile;
use janpan\jn\widgets\FlatpickrWidget;
use vova07\fileapi\Widget as FileApi;

/* @var $this yii\web\View */
/* @var $model common\models\UserProfile */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('user', 'Settings');
if($breadcrumb){
        echo janpan\jn\widgets\BreadcrumbsWidget::widget([
            'breadcrumb'=>$breadcrumb
        ]);  
    }
?>
<div class="row">
    <div class="col-md-6 col-md-offset-3">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('user', 'Change password'), ['password'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="panel panel-default">
        <div class="panel-heading">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>
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
                    <?= $form->field($model, 'birthday')->widget(FlatpickrWidget::class, [
                        'locale' => strtolower(substr(Yii::$app->language, 0, 2)),
                        'groupBtnShow' => true,
                        'options' => [
                            'class' => 'form-control',
                        ],
                        'clientOptions' => [
                            'allowInput' => true,
                            'defaultDate' => $model->birthday ? date(DATE_ATOM, $model->birthday) : null,
                        ],
                    ])
                    ?>
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

            <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'other')->textarea(['rows' => 6]) ?>

           <div class="form-group">
                <?= Html::submitButton(Yii::t('user', 'Submit'), ['class' => 'btn btn-success btn-block btn-lg']) ?>
            </div>

            <?php ActiveForm::end() ?>
        </div>
    </div>

</div> 
</div>

<?php \appxq\sdii\widgets\CSSRegister::begin()?>
<style>
    @media only screen and (min-width: 768px){
        .cd-breadcrumb, .cd-multi-steps {     
            max-width: 100%;    
            margin-left: 0; 
        }
    }
    .btn-warning{
        border: solid 1px #da7c0c;
        background: #f78d1d;
        background: -webkit-gradient(linear,left top,left bottom,from(#faa51a),to(#f47a20));
    }
    #w3-success{
        margin-top:20px;
    }
</style>
<?php \appxq\sdii\widgets\CSSRegister::end();?>