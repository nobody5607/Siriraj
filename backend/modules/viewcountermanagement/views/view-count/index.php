<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
use appxq\sdii\widgets\GridView;
use appxq\sdii\widgets\ModalForm;
use appxq\sdii\helpers\SDNoty;
use appxq\sdii\helpers\SDHtml;
 

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\viewcountermanagement\models\ViewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('content', 'สถิติการเข้าใช้งาน');
$this->params['breadcrumbs'][] = $this->title;
 
?>

<div class="box box-primary">
    <div class="box-header"></div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label><?= Yii::t('view','Select Year')?></label>
                    <?php 
                        $itemYear = ['2018'=>'2561'];
                        $itemMonth = ['01'=>"ม.ค.", '02'=>"ก.พ.", '03'=>"มี.ค.", '04'=>"เม.ย.", '05'=>"พ.ค.", '06'=>"มิ.ย.", '07'=>"ก.ค.",'08'=>"ส.ค.",'09'=>"ก.ย.",'10'=>"ต.ค.",'11'=>"พ.ย.",'12'=>"ธ.ค."]
                    ?>
                    <?= Html::dropDownList("year", '', $itemYear, ['class'=>'form-control', 'id'=>'year'])?>
                </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                    <label><?= Yii::t('view','Select Month')?></label>
                    <?= Html::dropDownList("month", '', $itemMonth, ['class'=>'form-control', 'id'=>'month'])?>
                </div> 
            </div>
            <div class="col-md-4">
               <div>
                   <label><?= Yii::t('view','View Chart')?></label>
                   <button class="btn btn-primary btn-block" id="btnView"><?= Yii::t('view','View')?></button>
                </div> 
            </div>
        </div>
    </div>
</div>

<div class="box box-primary">
    <div class="box-body">
        <?=\dosamigos\chartjs\ChartJs::widget([
            'type' => 'bar',
            'options' => [
                'height' => 200,
                'width' => 600
            ],
            'data' => [
                'labels' => ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค."],
                 'datasets' => [
                     [

                         'label'=> 'สถิติการเข้าใช้งาน',
                         'data' => [1, 59, 90, 81, 56, 55, 40],
                         'backgroundColor' => [
                                '#ADC3FF',
                                '#FF9A9A',
                            'rgba(190, 124, 145, 0.8)'
                        ],
                        'borderColor' =>  [
                                '#fff',
                                '#fff',
                                '#fff'
                        ],
                        'borderWidth' => 1,
                        'hoverBorderColor'=>["#999","#999","#999"],   
                     ] 
                 ]
            ]
        ]);?>
    </div>
</div>


<div class="panel panel-default">

    <div class="panel-heading">
	 <?=  Html::encode($this->title) ?> 
    </div> 

    <div class="panel-body">
        <?php  Pjax::begin(['id'=>'view-grid-pjax']);?>
    <?= GridView::widget([
	'id' => 'view-grid',
	'panelBtn' =>  Html::button(SDHtml::getBtnDelete(), ['data-url'=>Url::to(['view-count/deletes']), 'class' => 'btn btn-danger btn-sm', 'id'=>'modal-delbtn-view', 'disabled'=>true]),
	'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
        'columns' => [
	    [
		'class' => 'yii\grid\CheckboxColumn',
		'checkboxOptions' => [
		    'class' => 'selectionViewIds'
		],
		'headerOptions' => ['style'=>'text-align: center;'],
		'contentOptions' => ['style'=>'width:40px;text-align: center;'],
	    ],
	    [
		'class' => 'yii\grid\SerialColumn',
		'headerOptions' => ['style'=>'text-align: center;'],
		'contentOptions' => ['style'=>'width:60px;text-align: center;'],
	    ],

            //'id',
            'ip',
            'view_count',
            
            [
                'attribute'=>'user_id',
                'label'=>'Name',
                'value'=>function($model){
                    if(!$model->user_id){
                        return 'User';
                    }
                    $name = $model->user->userProfile->firstname. " " . $model->user->userProfile->lastname;
                    return $name;
                }
            ],
            [
                'format'=>'raw',
                'attribute'=>'create_date',
                'label'=>'Date',
                'value'=>function($model){
                    return appxq\sdii\utils\SDdate::mysql2phpDate($model->date);
                }
            ],
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
    'id' => 'modal-view',
    'size'=>'modal-lg',
]);
?>

<?php  \richardfan\widget\JSRegister::begin([
    //'key' => 'bootstrap-modal',
    'position' => \yii\web\View::POS_READY
]); ?>
<script>
// JS script
$('#view-grid-pjax').on('click', '#modal-addbtn-view', function() {
    modalView($(this).attr('data-url'));
});

$('#view-grid-pjax').on('click', '#modal-delbtn-view', function() {
    selectionViewGrid($(this).attr('data-url'));
});

$('#view-grid-pjax').on('click', '.select-on-check-all', function() {
    window.setTimeout(function() {
	var key = $('#view-grid').yiiGridView('getSelectedRows');
	disabledViewBtn(key.length);
    },100);
});

$('#view-grid-pjax').on('click', '.selectionViewIds', function() {
    var key = $('input:checked[class=\"'+$(this).attr('class')+'\"]');
    disabledViewBtn(key.length);
});

$('#view-grid-pjax').on('dblclick', 'tbody tr', function() {
    var id = $(this).attr('data-key');
    modalView('<?= Url::to(['view/update', 'id'=>''])?>'+id);
});	

$('#view-grid-pjax').on('click', 'tbody tr td a', function() {
    var url = $(this).attr('href');
    var action = $(this).attr('data-action');

    if(action === 'update' || action === 'view') {
	modalView(url);
    } else if(action === 'delete') {
	yii.confirm('<?= Yii::t('app', 'Are you sure you want to delete this item?')?>', function() {
	    $.post(
		url
	    ).done(function(result) {
		if(result.status == 'success') {
		    <?= SDNoty::show('result.message', 'result.status')?>
		    $.pjax.reload({container:'#view-grid-pjax'});
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

function disabledViewBtn(num) {
    if(num>0) {
	$('#modal-delbtn-view').attr('disabled', false);
    } else {
	$('#modal-delbtn-view').attr('disabled', true);
    }
}

function selectionViewGrid(url) {
    yii.confirm('<?= Yii::t('app', 'Are you sure you want to delete these items?')?>', function() {
	$.ajax({
	    method: 'POST',
	    url: url,
	    data: $('.selectionViewIds:checked[name=\"selection[]\"]').serialize(),
	    dataType: 'JSON',
	    success: function(result, textStatus) {
		if(result.status == 'success') {
		    <?= SDNoty::show('result.message', 'result.status')?>
		    $.pjax.reload({container:'#view-grid-pjax'});
		} else {
		    <?= SDNoty::show('result.message', 'result.status')?>
		}
	    }
	});
    });
}

function modalView(url) {
    $('#modal-view .modal-content').html('<div class=\"sdloader \"><i class=\"sdloader-icon\"></i></div>');
    $('#modal-view').modal('show')
    .find('.modal-content')
    .load(url);
}
</script>
<?php  \richardfan\widget\JSRegister::end(); ?>