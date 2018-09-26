<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
use appxq\sdii\widgets\GridView;
use appxq\sdii\widgets\ModalForm;
use appxq\sdii\helpers\SDNoty;
use appxq\sdii\helpers\SDHtml;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SitecodeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('sitecode', 'Sitecode');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="box box-primay">

    <div class="box-header">
	 <?=  Html::encode($this->title) ?> 
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="box-body">
        <?php  Pjax::begin(['id'=>'sitecode-grid-pjax']);?>
    <?= GridView::widget([
	'id' => 'sitecode-grid',
	'panelBtn' => Html::button(SDHtml::getBtnAdd(), ['data-url'=>Url::to(['sitecode/create']), 'class' => 'btn btn-success btn-sm', 'id'=>'modal-addbtn-sitecode']). ' ' .
		      Html::button(SDHtml::getBtnDelete(), ['data-url'=>Url::to(['sitecode/deletes']), 'class' => 'btn btn-danger btn-sm', 'id'=>'modal-delbtn-sitecode', 'disabled'=>true]),
	'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
        'columns' => [
	    [
		'class' => 'yii\grid\CheckboxColumn',
		'checkboxOptions' => [
		    'class' => 'selectionSitecodeIds'
		],
		'headerOptions' => ['style'=>'text-align: center;'],
		'contentOptions' => ['style'=>'width:40px;text-align: center;'],
	    ],
	    [
		'class' => 'yii\grid\SerialColumn',
		'headerOptions' => ['style'=>'text-align: center;'],
		'contentOptions' => ['style'=>'width:60px;text-align: center;'],
	    ],

            'id',
            'name',

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
    'id' => 'modal-sitecode',
    'size'=>'modal-lg',
]);
?>

<?php  \richardfan\widget\JSRegister::begin([
    //'key' => 'bootstrap-modal',
    'position' => \yii\web\View::POS_READY
]); ?>
<script>
// JS script
$('#sitecode-grid-pjax').on('click', '#modal-addbtn-sitecode', function() {
    modalSitecode($(this).attr('data-url'));
});

$('#sitecode-grid-pjax').on('click', '#modal-delbtn-sitecode', function() {
    selectionSitecodeGrid($(this).attr('data-url'));
});

$('#sitecode-grid-pjax').on('click', '.select-on-check-all', function() {
    window.setTimeout(function() {
	var key = $('#sitecode-grid').yiiGridView('getSelectedRows');
	disabledSitecodeBtn(key.length);
    },100);
});

$('#sitecode-grid-pjax').on('click', '.selectionSitecodeIds', function() {
    var key = $('input:checked[class=\"'+$(this).attr('class')+'\"]');
    disabledSitecodeBtn(key.length);
});

$('#sitecode-grid-pjax').on('dblclick', 'tbody tr', function() {
    var id = $(this).attr('data-key');
    modalSitecode('<?= Url::to(['sitecode/update', 'id'=>''])?>'+id);
});	

$('#sitecode-grid-pjax').on('click', 'tbody tr td a', function() {
    var url = $(this).attr('href');
    var action = $(this).attr('data-action');

    if(action === 'update' || action === 'view') {
	modalSitecode(url);
    } else if(action === 'delete') {
	yii.confirm('<?= Yii::t('app', 'Are you sure you want to delete this item?')?>', function() {
	    $.post(
		url
	    ).done(function(result) {
		if(result.status == 'success') {
		    <?= SDNoty::show('result.message', 'result.status')?>
		    $.pjax.reload({container:'#sitecode-grid-pjax'});
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

function disabledSitecodeBtn(num) {
    if(num>0) {
	$('#modal-delbtn-sitecode').attr('disabled', false);
    } else {
	$('#modal-delbtn-sitecode').attr('disabled', true);
    }
}

function selectionSitecodeGrid(url) {
    yii.confirm('<?= Yii::t('app', 'Are you sure you want to delete these items?')?>', function() {
	$.ajax({
	    method: 'POST',
	    url: url,
	    data: $('.selectionSitecodeIds:checked[name=\"selection[]\"]').serialize(),
	    dataType: 'JSON',
	    success: function(result, textStatus) {
		if(result.status == 'success') {
		    <?= SDNoty::show('result.message', 'result.status')?>
		    $.pjax.reload({container:'#sitecode-grid-pjax'});
		} else {
		    <?= SDNoty::show('result.message', 'result.status')?>
		}
	    }
	});
    });
}

function modalSitecode(url) {
    $('#modal-sitecode .modal-content').html('<div class=\"sdloader \"><i class=\"sdloader-icon\"></i></div>');
    $('#modal-sitecode').modal('show')
    .find('.modal-content')
    .load(url);
}
</script>
<?php  \richardfan\widget\JSRegister::end(); ?>