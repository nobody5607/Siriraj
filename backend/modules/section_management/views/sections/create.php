<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Sections */

$this->title = Yii::t('section', 'Create Sections');
$this->params['breadcrumbs'][] = ['label' => Yii::t('section', 'Sections'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-default">

    <div class="box-body">
         <?= $this->render('_form', [
            'parent_section'=>$parent_section,
            'model' => $model,
        ]) ?>
    </div>
</div>

