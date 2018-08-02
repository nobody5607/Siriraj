<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
use appxq\sdii\widgets\GridView;
use appxq\sdii\widgets\ModalForm;
use appxq\sdii\helpers\SDNoty;
use appxq\sdii\helpers\SDHtml;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\content_management\models\ContentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('content', 'Contents');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="contents-index">
 
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php  Pjax::begin(['id'=>'contents-grid-pjax']);?>
    <?= GridView::widget([
	'id' => 'contents-grid',
	'panelBtn' => Html::button(SDHtml::getBtnAdd(), ['data-url'=>Url::to(['contents/create']), 'class' => 'btn btn-success btn-sm', 'id'=>'modal-addbtn-contents']). ' ' .
		      Html::button(SDHtml::getBtnDelete(), ['data-url'=>Url::to(['contents/deletes']), 'class' => 'btn btn-danger btn-sm', 'id'=>'modal-delbtn-contents', 'disabled'=>true]),
	'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
        'columns' => [
	    [
		'class' => 'yii\grid\CheckboxColumn',
		'checkboxOptions' => [
		    'class' => 'selectionContentIds'
		],
		'headerOptions' => ['style'=>'text-align: center;'],
		'contentOptions' => ['style'=>'width:40px;text-align: center;'],
	    ],
	    [
		'class' => 'yii\grid\SerialColumn',
		'headerOptions' => ['style'=>'text-align: center;'],
		'contentOptions' => ['style'=>'width:60px;text-align: center;'],
	    ],
            [
                'contentOptions'=>['style'=>'width:250px'],
                'attribute'=>'name',
                'value'=>function($model){
                    return $model['name'];
                }
            ], 
            [
                'attribute'=>'user_create',
                'value'=>function($model){
                    return \common\modules\cores\User::getProfileNameByUserId($model['user_create']);
                }
            ],
            [
                'attribute'=>'create_date',
                'value'=>function($model){
                    return appxq\sdii\utils\SDdate::mysql2phpDate($model->create_date);
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
           // 'description:ntext',
            //'section_id',
            //'rstat',
            // 'public',
            // 'content_date',
            // 'create_date',
            // 'user_create',
            // 'thumn_image:ntext',

	    [
		'class' => 'appxq\sdii\widgets\ActionColumn',
		'contentOptions' => ['style'=>'width:80px;text-align: center;'],
		'template' => '{view} {update} {delete}',
                'headerOptions' => ['style' => 'width:250px'],
                'buttons' => [
                    'view' => function ($url, $model) {                        
                        if ($model->public != 1) {
                            return '';
                        }
                        $label = Yii::t('section', 'View');
                        return Html::a('<span class="fa fa-eye"></span> ' . $label, yii\helpers\Url::to(['/content_management/contents/view', 'id' => $model->id]), [
                                    'title'         => $label,
                                    'class'         => 'btn btn-default btn-xs',
                                    'data-action'   => 'view',
                                    'data-pjax'     =>0
                            ]);
                    },
                    'update' => function ($url, $model) {
                        if ($model->public != 1) {
                            return '';
                        }
                        $label = Yii::t('section', 'Update');
                        return Html::a('<span class="fa fa-pencil"></span> ' . $label, yii\helpers\Url::to(['/content_management/contents/update', 'id' => $model->id]), [
                                    'title'         => $label,
                                    'class'         => 'btn btn-warning btn-xs',
                                    'data-action'   => 'update',
                                    'data-pjax'     =>0
                            ]);
                    }, 
                   'delete' => function ($url, $model) {
                         
                        if ($model->public != 1) {
                            return '';
                        }                         
                        $label = Yii::t('section', 'Delete');
                        return Html::a('<span class="fa fa-trash"></span> ' . $label, yii\helpers\Url::to(['/content_management/contents/delete', 'id' => $model->id]), [
                                    'title'         => $label,
                                    'class'         => 'btn btn-danger btn-xs',
                                    'data-action'   => 'delete',
                                    'data-pjax'     =>0,
                                    'data-confirm'  => Yii::t('section','Are you sure you want to delete this item?'),
                                    'data-method'   => 'post'
                            ]);
                    },           
            ]
        ],
        ],
    ]); ?>
    <?php  Pjax::end();?>

</div>

<?=  ModalForm::widget([
    'id' => 'modal-contents',
    'size'=>'modal-lg',
]);
?>

<?php  \richardfan\widget\JSRegister::begin([
    //'key' => 'bootstrap-modal',
    'position' => \yii\web\View::POS_READY
]); ?>
<script>
// JS script
$('#contents-grid-pjax').on('click', '#modal-addbtn-contents', function() {
    modalContent($(this).attr('data-url'));
});

$('#contents-grid-pjax').on('click', '#modal-delbtn-contents', function() {
    selectionContentGrid($(this).attr('data-url'));
});

$('#contents-grid-pjax').on('click', '.select-on-check-all', function() {
    window.setTimeout(function() {
	var key = $('#contents-grid').yiiGridView('getSelectedRows');
	disabledContentBtn(key.length);
    },100);
});

$('#contents-grid-pjax').on('click', '.selectionContentIds', function() {
    var key = $('input:checked[class=\"'+$(this).attr('class')+'\"]');
    disabledContentBtn(key.length);
});

$('#contents-grid-pjax').on('dblclick', 'tbody tr', function() {
    var id = $(this).attr('data-key');
    modalContent('<?= Url::to(['contents/update', 'id'=>''])?>'+id);
});	

$('#contents-grid-pjax').on('click', 'tbody tr td a', function() {
    var url = $(this).attr('href');
    var action = $(this).attr('data-action');

    if(action === 'update' || action === 'view') {
	modalContent(url);
    } else if(action === 'delete') {
	yii.confirm('<?= Yii::t('app', 'Are you sure you want to delete this item?')?>', function() {
	    $.post(
		url
	    ).done(function(result) {
		if(result.status == 'success') {
		    <?= SDNoty::show('result.message', 'result.status')?>
		    $.pjax.reload({container:'#contents-grid-pjax'});
		} else {
		    <?= SDNoty::show('result.message', 'result.status')?>
		}
	    }).fail(function() {
		<?= SDNoty::show("'" . SDHtml::getMsgError() . "Server Error'", '"error"')?>
		console.log('server error');
	    });
	});
    }
    return false;
});

function disabledContentBtn(num) {
    if(num>0) {
	$('#modal-delbtn-contents').attr('disabled', false);
    } else {
	$('#modal-delbtn-contents').attr('disabled', true);
    }
}

function selectionContentGrid(url) {
    yii.confirm('<?= Yii::t('app', 'Are you sure you want to delete these items?')?>', function() {
	$.ajax({
	    method: 'POST',
	    url: url,
	    data: $('.selectionContentIds:checked[name=\"selection[]\"]').serialize(),
	    dataType: 'JSON',
	    success: function(result, textStatus) {
		if(result.status == 'success') {
		    <?= SDNoty::show('result.message', 'result.status')?>
		    $.pjax.reload({container:'#contents-grid-pjax'});
		} else {
		    <?= SDNoty::show('result.message', 'result.status')?>
		}
	    }
	});
    });
}

function modalContent(url) {
    $('#modal-contents .modal-content').html('<div class=\"sdloader \"><i class=\"sdloader-icon\"></i></div>');
    $('#modal-contents').modal('show')
    .find('.modal-content')
    .load(url);
}
</script>
<?php  \richardfan\widget\JSRegister::end(); ?>