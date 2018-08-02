<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Sections */

$this->title = 'Sections#'.$model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('section', 'Sections'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sections-view">

    <div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title" id="itemModalLabel"><?= Html::encode($this->title) ?></h4>
    </div>
    <div class="modal-body">
        <?= DetailView::widget([
	    'model' => $model,
	    'attributes' => [
		'id',
		'name',
		'content:ntext',
		'list_content',
		'parent_id',
		'forder',
		'public',
		'rstat',
		'icon',
		'create_by',
		'create_date',
	    ],
	]) ?>
    </div>
</div>
