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
		 
		'name',
		[
                    'format'=>'raw',                     
                    'attribute'=>'name',
                    'value'=>function($model){
                        return $model->name;
                    }
                ],  
		//'list_content',
		//'parent_id',
		 
		[
                    'format'=>'raw',
                     
                    'attribute'=>'public',
                    'value'=>function($model){
                        return ($model->public == 1) ? '<label class="label label-success">Public</label>' : '<label class="label label-danger">Private</label>';
                    }
                ],  		 
		[
                    'label'=>'icon',
                    'format'=>'raw',
                     
                    'value'=>function($model){
                        return "<i class='fa {$model->icon}'></i>";
                    }
                ],
		[
                    'attribute'=>'create_by',
                    'value'=>function($model){
                        return \common\modules\cores\User::getProfileNameByUserId($model['create_by']);
                    }
                ],
                [
                    'format'=>'raw',
                    'attribute'=>'create_date',
                    'value'=>function($model){
                        return "<i class='fa fa-calendar'></i> ".appxq\sdii\utils\SDdate::mysql2phpDate($model->create_date);
                    }
                ], 
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