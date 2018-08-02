<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Contents */

$this->title = 'Contents#'.$model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('content', 'Contents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contents-view">

    <div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title" id="itemModalLabel"><?= Html::encode($this->title) ?></h4>
    </div>
    <div class="modal-body">
        <?= DetailView::widget([
	    'model' => $model,
	    'attributes' => [
//		'id',
		'name',
		'description:ntext',
		[
                    'format'=>'raw', 
                    'attribute'=>'section_id',
                    'label'=> Yii::t('content', 'Section'),
                    'value'=>function($model){
                        return  $model->sections->name;
                    }
                ],		 
		[
                    'format'=>'raw',
                    'contentOptions'=>['style'=>'width:100px;text-align:center;'],
                    'attribute'=>'public',
                    'value'=>function($model){
                        return ($model->public == 1) ? '<label class="label label-success">Public</label>' : '<label class="label label-danger">Private</label>';
                    }
                ],  		 
		[
                    'attribute'=>'create_date',
                    'value'=>function($model){
                        return appxq\sdii\utils\SDdate::mysql2phpDate($model->create_date);
                    }
                ],
		'user_create',
		'thumn_image:ntext',
	    ],
	]) ?>
    </div>
</div>
<?php 
$this->registerCss("
    table.detail-view th {
            width: 20%;
    }

    table.detail-view td {
            width: 80%;
    }

");
?>