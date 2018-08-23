<?php
namespace developeruz\db_rbac\views\access;

use Yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Links */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('rbac', 'Update Permission: ') . ' ' . $permit->description;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac', 'Permission'), 'url' => ['permission']];
$this->params['breadcrumbs'][] = Yii::t('rbac', 'Permission');
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="links-form">

        <?php
        if (!empty($error)) {
            ?>
            <div class="error-summary">
                <?php
                echo implode('<br>', $error);
                ?>
            </div>
        <?php
        }
        ?>

        <?php $form = ActiveForm::begin(); ?>

        <div class="form-group">
            <?= Html::label(Yii::t('db_rbac', 'Текстовое описание')); ?>
            <?= Html::textInput('description', $permit->description); ?>
        </div>

        <div class="form-group">
            <?= Html::label(Yii::t('db_rbac', 'Разрешенный доступ')); ?>
            <?= Html::textInput('name', $permit->name); ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('db_rbac', 'Сохранить'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>