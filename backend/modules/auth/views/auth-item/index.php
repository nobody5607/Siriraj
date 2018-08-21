<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
use appxq\sdii\widgets\GridView;
use appxq\sdii\widgets\ModalForm;
use appxq\sdii\helpers\SDNoty;
use appxq\sdii\helpers\SDHtml;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\auth\models\AuthItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('content', 'Auth Items');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="box box-primary">

    <div class="box-header">
	<h3><?=  Html::encode($this->title) ?></h3>
    </div>
    <div class="box-body">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php  Pjax::begin(['id'=>'auth-item-grid-pjax']);?>
    <?= GridView::widget([
	'id' => 'auth-item-grid',
	'panelBtn' => Html::button(SDHtml::getBtnAdd(), ['data-url'=>Url::to(['auth-item/create']), 'class' => 'btn btn-success btn-sm', 'id'=>'modal-addbtn-auth-item']). ' ' .
		      Html::button(SDHtml::getBtnDelete(), ['data-url'=>Url::to(['auth-item/deletes']), 'class' => 'btn btn-danger btn-sm', 'id'=>'modal-delbtn-auth-item', 'disabled'=>true]),
	'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
        'columns' => [
	    [
		'class' => 'yii\grid\CheckboxColumn',
		'checkboxOptions' => [
		    'class' => 'selectionAuthItemIds'
		],
		'headerOptions' => ['style'=>'text-align: center;'],
		'contentOptions' => ['style'=>'width:40px;text-align: center;'],
	    ],
	    [
		'class' => 'yii\grid\SerialColumn',
		'headerOptions' => ['style'=>'text-align: center;'],
		'contentOptions' => ['style'=>'width:60px;text-align: center;'],
	    ],

            'name',
            'type',
            'description:ntext',
            'rule_name',
            'data',
            // 'created_at',
            // 'updated_at',

	    [
		'class' => 'appxq\sdii\widgets\ActionColumn',
		'contentOptions' => ['style'=>'width:80px;text-align: center;'],
		'template' => '{view} {update} {delete}',
	    ],
        ],
    ]); ?>
    <?php  Pjax::end();?>
    </div>

</div>

<?=  ModalForm::widget([
    'id' => 'modal-auth-item',
    'size'=>'modal-lg',
]);
?>

<?php  \richardfan\widget\JSRegister::begin([
    //'key' => 'bootstrap-modal',
    'position' => \yii\web\View::POS_READY
]); ?>
<script>
// JS script
$('#auth-item-grid-pjax').on('click', '#modal-addbtn-auth-item', function() {
    modalAuthItem($(this).attr('data-url'));
});

$('#auth-item-grid-pjax').on('click', '#modal-delbtn-auth-item', function() {
    selectionAuthItemGrid($(this).attr('data-url'));
});

$('#auth-item-grid-pjax').on('click', '.select-on-check-all', function() {
    window.setTimeout(function() {
	var key = $('#auth-item-grid').yiiGridView('getSelectedRows');
	disabledAuthItemBtn(key.length);
    },100);
});

$('#auth-item-grid-pjax').on('click', '.selectionAuthItemIds', function() {
    var key = $('input:checked[class=\"'+$(this).attr('class')+'\"]');
    disabledAuthItemBtn(key.length);
});

$('#auth-item-grid-pjax').on('dblclick', 'tbody tr', function() {
    var id = $(this).attr('data-key');
    modalAuthItem('<?= Url::to(['auth-item/update', 'id'=>''])?>'+id);
});	

$('#auth-item-grid-pjax').on('click', 'tbody tr td a', function() {
    var url = $(this).attr('href');
    var action = $(this).attr('data-action');

    if(action === 'update' || action === 'view') {
	modalAuthItem(url);
    } else if(action === 'delete') {
	yii.confirm('<?= Yii::t('app', 'Are you sure you want to delete this item?')?>', function() {
	    $.post(
		url
	    ).done(function(result) {
		if(result.status == 'success') {
		    <?= SDNoty::show('result.message', 'result.status')?>
		    $.pjax.reload({container:'#auth-item-grid-pjax'});
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

function disabledAuthItemBtn(num) {
    if(num>0) {
	$('#modal-delbtn-auth-item').attr('disabled', false);
    } else {
	$('#modal-delbtn-auth-item').attr('disabled', true);
    }
}

function selectionAuthItemGrid(url) {
    yii.confirm('<?= Yii::t('app', 'Are you sure you want to delete these items?')?>', function() {
	$.ajax({
	    method: 'POST',
	    url: url,
	    data: $('.selectionAuthItemIds:checked[name=\"selection[]\"]').serialize(),
	    dataType: 'JSON',
	    success: function(result, textStatus) {
		if(result.status == 'success') {
		    <?= SDNoty::show('result.message', 'result.status')?>
		    $.pjax.reload({container:'#auth-item-grid-pjax'});
		} else {
		    <?= SDNoty::show('result.message', 'result.status')?>
		}
	    }
	});
    });
}

function modalAuthItem(url) {
    $('#modal-auth-item .modal-content').html('<div class=\"sdloader \"><i class=\"sdloader-icon\"></i></div>');
    $('#modal-auth-item').modal('show')
    .find('.modal-content')
    .load(url);
}
</script>
<?php  \richardfan\widget\JSRegister::end(); ?>