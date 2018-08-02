<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
use appxq\sdii\widgets\GridView;
use appxq\sdii\widgets\ModalForm;
use appxq\sdii\helpers\SDNoty;
use appxq\sdii\helpers\SDHtml;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\section_management\models\SectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('section', 'Section Management');
$this->params['breadcrumbs'][] = $this->title;

?>
<ul class="nav nav-tabs">
    <li class="active"><a href="#">Section Private</a></li>
    <li><a href="<?= Url::to(['/secret_content_management/contents'])?>">Content Private</a></li> 
</ul> 
<br>
<div class="tab-content">  
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php  Pjax::begin(['id'=>'sections-grid-pjax']);?>
    <?= GridView::widget([
	'id' => 'sections-grid',
	'panelBtn' => Html::button(SDHtml::getBtnAdd(), ['data-url'=>Url::to(['sections/create']), 'class' => 'btn btn-success btn-sm', 'id'=>'modal-addbtn-sections']). ' ' .
		      Html::button(SDHtml::getBtnDelete(), ['data-url'=>Url::to(['sections/deletes']), 'class' => 'btn btn-danger btn-sm', 'id'=>'modal-delbtn-sections', 'disabled'=>true]),
	'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
//        'rowOptions'=>function($model, $key, $index, $grid){
//            if($model->public == 2){
//                return ['class'=>'danger'];
//            }
//        },
        'columns' => [
	    [
		'class' => 'yii\grid\CheckboxColumn',
		'checkboxOptions' => [
		    'class' => 'selectionSectionIds'
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
                'label'=>'icon',
                'format'=>'raw',
                'contentOptions'=>['style'=>'width:100px;text-align:center;'],
                'value'=>function($model){
                    return "<i class='fa {$model->icon}'></i>";
                }
            ],

//            'id',
            'name',
//            'content:ntext',
//            'list_content',
            [
                'attribute'=>'create_by',
                'value'=>function($model){
                    return \common\modules\cores\User::getProfileNameByUserId($model['create_by']);
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
            // 'forder',
             
            // 'rstat',
            // 'icon',
            // 'create_by',
            // 'create_date',

	    [
		'class' => 'appxq\sdii\widgets\ActionColumn',
		'contentOptions' => ['style'=>'width:80px;text-align: center;'],
		'template' => '{view} {update} {delete}',
                'headerOptions' => ['style' => 'width:250px'],
                'buttons' => [
                    'view' => function ($url, $model) {                        
                        if ($model->public != 2) {
                            return '';
                        }
                        $label = Yii::t('section', 'View');
                        return Html::a('<span class="fa fa-eye"></span> ' . $label, yii\helpers\Url::to(['/section_management/sections/view', 'id' => $model->id]), [
                                    'title'         => $label,
                                    'class'         => 'btn btn-default btn-xs',
                                    'data-action'   => 'view',
                                    'data-pjax'     =>0
                            ]);
                    },
                    'update' => function ($url, $model) {
                        if ($model->public != 2) {
                            return '';
                        }
                        $label = Yii::t('section', 'Update');
                        return Html::a('<span class="fa fa-pencil"></span> ' . $label, yii\helpers\Url::to(['/section_management/sections/update', 'id' => $model->id]), [
                                    'title'         => $label,
                                    'class'         => 'btn btn-warning btn-xs',
                                    'data-action'   => 'update',
                                    'data-pjax'     =>0
                            ]);
                    }, 
                   'delete' => function ($url, $model) {
                         
                        if ($model->public != 2) {
                            return '';
                        }
                        $parent_id = "parent_{$model->parent_id}";
                         
                        if ($parent_id == 'parent_') {
                            return '';
                        }
                        $label = Yii::t('section', 'Delete');
                        return Html::a('<span class="fa fa-trash"></span> ' . $label, yii\helpers\Url::to(['/section_management/sections/delete', 'id' => $model->id]), [
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
    'id' => 'modal-sections',
    'size'=>'modal-lg',
]);
?>

<?php  \richardfan\widget\JSRegister::begin([
    //'key' => 'bootstrap-modal',
    'position' => \yii\web\View::POS_READY
]); ?>
<script>      
    
// JS script
$('#sections-grid-pjax').on('click', '#modal-addbtn-sections', function() {
    modalSection($(this).attr('data-url'));
});

$('#sections-grid-pjax').on('click', '#modal-delbtn-sections', function() {
    selectionSectionGrid($(this).attr('data-url'));
});

$('#sections-grid-pjax').on('click', '.select-on-check-all', function() {
    window.setTimeout(function() {
	var key = $('#sections-grid').yiiGridView('getSelectedRows');
	disabledSectionBtn(key.length);
    },100);
});

$('#sections-grid-pjax').on('click', '.selectionSectionIds', function() {
    var key = $('input:checked[class=\"'+$(this).attr('class')+'\"]');
    disabledSectionBtn(key.length);
});

$('#sections-grid-pjax').on('dblclick', 'tbody tr', function() {
    var id = $(this).attr('data-key');
    //modalSection('<?= Url::to(['sections/update', 'id'=>''])?>'+id);
});	
//$('#sections-grid-pjax').on('click', 'thead tr th a', function() {
//    let url = $(this).attr('href');
//    alert(url);
//    return false;
//});
$('#sections-grid-pjax').on('click', 'tbody tr td a', function() {
    var url = $(this).attr('href');
    var action = $(this).attr('data-action');

    if(action === 'update' || action === 'view') {
	modalSection(url);
    } else if(action === 'delete') {
	yii.confirm('<?= Yii::t('app', 'Are you sure you want to delete this item?')?>', function() {
	    $.post(
		url
	    ).done(function(result) {
		if(result.status == 'success') {
		    <?= SDNoty::show('result.message', 'result.status')?>
		    $.pjax.reload({container:'#sections-grid-pjax'});
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

function disabledSectionBtn(num) {
    if(num>0) {
	$('#modal-delbtn-sections').attr('disabled', false);
    } else {
	$('#modal-delbtn-sections').attr('disabled', true);
    }
}

function selectionSectionGrid(url) {
    yii.confirm('<?= Yii::t('app', 'Are you sure you want to delete these items?')?>', function() {
	$.ajax({
	    method: 'POST',
	    url: url,
	    data: $('.selectionSectionIds:checked[name=\"selection[]\"]').serialize(),
	    dataType: 'JSON',
	    success: function(result, textStatus) {
		if(result.status == 'success') {
		    <?= SDNoty::show('result.message', 'result.status')?>
		    $.pjax.reload({container:'#sections-grid-pjax'});
		} else {
		    <?= SDNoty::show('result.message', 'result.status')?>
		}
	    }
	});
    });
}

function modalSection(url) {
    $('#modal-sections .modal-content').html('<div class=\"sdloader \"><i class=\"sdloader-icon\"></i></div>');
    $('#modal-sections').modal('show')
    .find('.modal-content')
    .load(url);
}
</script>
<?php  \richardfan\widget\JSRegister::end(); ?>