<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Contents */

$this->title = Yii::t('content', 'Create Contents');
$this->params['breadcrumbs'][] = ['label' => Yii::t('content', 'Contents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contents-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
