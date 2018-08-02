<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Contents */

$this->title = Yii::t('content', 'Update {modelClass}: ', [
    'modelClass' => 'Contents',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('content', 'Contents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contents-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
