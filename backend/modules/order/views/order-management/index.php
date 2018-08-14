<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
use appxq\sdii\widgets\GridView;
use appxq\sdii\widgets\ModalForm;
use appxq\sdii\helpers\SDNoty;
use appxq\sdii\helpers\SDHtml;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\order\models */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('content', 'Orders Management');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="panel panel-primary">

    <div class="panel-heading">
        <i class="fa fa-shopping-cart"></i> <?=  Html::encode($this->title) ?>
    </div>
    <div class="panel-body">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php  Pjax::begin(['id'=>'order-grid-pjax']);?>
    <?= GridView::widget([
	'id' => 'order-grid',
	'panelBtn' => Html::button(SDHtml::getBtnDelete(), ['data-url'=>Url::to(['/order/order-management/deletes']), 'class' => 'btn btn-danger btn-sm', 'id'=>'modal-delbtn-order', 'disabled'=>true]),
	'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
        'columns' => [
	    [
		'class' => 'yii\grid\CheckboxColumn',
		'checkboxOptions' => [
		    'class' => 'selectionOrderIds'
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
                'attribute'=>'user_id',
                'label'=>'Name',
                'value'=>function($model){
                    $name = $model->user->userProfile->firstname. " " . $model->user->userProfile->lastname;
                    return $name;
                }
            ],
            [
                'format'=>'raw',
                'attribute'=>'status',
                'label'=>'Status',
                'value'=>function($model){
                    $str = "";
                    if($model->status == 2){
                        $msg = Yii::t('order', 'Delivered');//ชำระเงินแล้ว
                        $str = "<div class='label label-success'>{$msg}</div>";
                    }
                    return $str;
                }
            ],
            [
                'format'=>'raw',
                'attribute'=>'create_date',
                'label'=>'Date',
                'value'=>function($model){
                    return appxq\sdii\utils\SDdate::mysql2phpDate($model->create_date);
                }
            ],
            [
                        'class' => 'appxq\sdii\widgets\ActionColumn',
                        'contentOptions' => ['style'=>'width:80px;text-align: center;'],
                        'template' => '{view} {update} {delete}',
                        'headerOptions' => ['style' => 'width:250px'],
                        'buttons' => [
                            'view' => function ($url, $model) {
                                $label = Yii::t('section', 'View Detail');
                                return Html::a('<span class="fa fa-eye"></span> ', yii\helpers\Url::to(['/order/order-management/view', 'id' => $model->id]), [
                                            'title'         => $label,
                                            'class'         => 'btn btn-default btn-xs',
                                            'data-action'   => 'view',
                                            'data-pjax'     =>0
                                    ]);
                            }, 
                            'update' => function ($url, $model) {
                                $label = Yii::t('section', 'Update');
                                return Html::a('<span class="fa fa-pencil"></span> ', yii\helpers\Url::to(['/order/order-management/update', 'id' => $model->id]), [
                                            'title'         => $label,
                                            'class'         => 'btn btn-primary btn-xs',
                                            'data-action'   => 'update',
                                            'data-pjax'     =>0
                                    ]);
                            }, 
                           'delete' => function ($url, $model) {
                                $label = Yii::t('section', 'Delete');
                                return Html::a('<span class="fa fa-trash"></span> ', yii\helpers\Url::to(['/order/order-management/delete', 'id' => $model->id]), [
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

</div>

<?=  ModalForm::widget([
    'id' => 'modal-order',
    'size'=>'modal-lg',
]);
?>

<?php  \richardfan\widget\JSRegister::begin([
    //'key' => 'bootstrap-modal',
    'position' => \yii\web\View::POS_READY
]); ?>
<script>
// JS script
$('#order-grid-pjax').on('click', '#modal-addbtn-order', function() {
    modalOrder($(this).attr('data-url'));
});

$('#order-grid-pjax').on('click', '#modal-delbtn-order', function() {
    selectionOrderGrid($(this).attr('data-url'));
});

$('#order-grid-pjax').on('click', '.select-on-check-all', function() {
    window.setTimeout(function() {
	var key = $('#order-grid').yiiGridView('getSelectedRows');
	disabledOrderBtn(key.length);
    },100);
});

$('#order-grid-pjax').on('click', '.selectionOrderIds', function() {
    var key = $('input:checked[class=\"'+$(this).attr('class')+'\"]');
    disabledOrderBtn(key.length);
});

$('#order-grid-pjax').on('dblclick', 'tbody tr', function() {
    var id = $(this).attr('data-key');
    modalOrder('<?= Url::to(['/order/order-management/update', 'id'=>''])?>'+id);
});	

$('#order-grid-pjax').on('click', 'tbody tr td a', function() {
    var url = $(this).attr('href');
    var action = $(this).attr('data-action');

    if(action === 'update' || action === 'view') {
	modalOrder(url);
    } else if(action === 'delete') {
	yii.confirm('<?= Yii::t('app', 'Are you sure you want to delete this item?')?>', function() {
	    $.post(
		url
	    ).done(function(result) {
		if(result.status == 'success') {
		    <?= SDNoty::show('result.message', 'result.status')?>
		    $.pjax.reload({container:'#order-grid-pjax'});
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

function disabledOrderBtn(num) {
    if(num>0) {
	$('#modal-delbtn-order').attr('disabled', false);
    } else {
	$('#modal-delbtn-order').attr('disabled', true);
    }
}

function selectionOrderGrid(url) {
    yii.confirm('<?= Yii::t('app', 'Are you sure you want to delete these items?')?>', function() {
	$.ajax({
	    method: 'POST',
	    url: url,
	    data: $('.selectionOrderIds:checked[name=\"selection[]\"]').serialize(),
	    dataType: 'JSON',
	    success: function(result, textStatus) {
		if(result.status == 'success') {
		    <?= SDNoty::show('result.message', 'result.status')?>
		    $.pjax.reload({container:'#order-grid-pjax'});
		} else {
		    <?= SDNoty::show('result.message', 'result.status')?>
		}
	    }
	});
    });
}

function modalOrder(url) {
    $('#modal-order .modal-content').html('<div class=\"sdloader \"><i class=\"sdloader-icon\"></i></div>');
    $('#modal-order').modal('show')
    .find('.modal-content')
    .load(url);
}
</script>
<?php  \richardfan\widget\JSRegister::end(); ?>