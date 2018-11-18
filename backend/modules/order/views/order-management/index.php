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

$this->title = Yii::t('appmenu', 'Order Management');
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
                'format' => 'raw',
                'contentOptions' => ['style' => 'width:200px;'],
                'attribute' => 'id',
                'label' => Yii::t('order', 'Order Id'),
                'value' => function($model) {
                    return Html::a("{$model->id}", ["/order/order-management/order-detail?order_id={$model->id}"], ['class'=>'order_details', 'data-id'=>$model->id]);
                }
            ],
            [
                'contentOptions' => ['style' => 'width:160px;'],
                'attribute'=>'user_id',
                'label'=> Yii::t('order', 'Name'),
                'value'=>function($model){
                    $name = "";
                    if(isset($model->user->userProfile)){
                        $name = $model->user->userProfile->firstname. " " . $model->user->userProfile->lastname;
                    }
                    
                    return $name;
                },
                'filter' => \kartik\select2\Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'user_id',
                    'data' => yii\helpers\ArrayHelper::map(common\models\UserProfile::find()->select(['user_id','concat(firstname,"  ", lastname) as name'])->asArray()->all(),'user_id','name'), 
                    'hideSearch' => false,
                    'pluginOptions' => [
                          'allowClear' => true,
                          'width' => 'resolve',
                     ],
                    'options' => [
                           'id'=> appxq\sdii\utils\SDUtility::getMillisecTime(), 
                           'style'=>'width:100%',
                           'placeholder' => Yii::t('order', 'Search for name'),
                     ]
                ]),        
                  
             ],
            [
                'format'=>'raw',
                'attribute'=>'create_date',
                'label'=>'วันที่ขอความอนุเคราะห์',
                'value'=>function($model){
                    return appxq\sdii\utils\SDdate::mysql2phpDate($model->create_date);
                },      
            ],
           [
                'format'=>'raw',
                'attribute'=>'status',
                'label'=>'สถานะ',
                'value'=>function($model){
                    
                    $items = ['1'=>'รอ' , '2'=>'ส่งข้อมูลแล้ว', '3'=>'ไม่อนุมัติ', '100'=>''];
                    if(isset($model->status)){
                        return $items[$model->status];
                    }else{
                        return $items[100];
                    }
                }, 
                'filter'=>['1'=>'รอ' , '2'=>'ส่งข้อมูลแล้ว', '3'=>'ไม่อนุมัติ', '100'=>''],        
            ], 
        [
            'format' => 'raw',
            'attribute' => 'conditions',
            'label' => 'หมายเหตุ',
            'value' => function($model) {
                    return isset($model['conditions']) ? $model['conditions'] : '';
            },
        ],
        [
                        'class' => 'appxq\sdii\widgets\ActionColumn',
                        'contentOptions' => ['style'=>'width:50px;text-align: center;'],
                        'template' => '{confirm} {download} {delete} ',
                        'headerOptions' => ['style' => 'width:250px'],
                        'buttons' => [
                            'confirm' => function ($url, $model) {
                                $label = Yii::t('section', 'แก้ไข');
                                return Html::a('<span class="fa fa-pencil"> แก้ไข</span> ', yii\helpers\Url::to(['/order/order-management/update', 'id' => $model->id]), [
                                            'title'         => $label,
                                            'class'         => 'btn btn-primary btn-xs btnEdit',
                                            'data-action'   => 'edit',
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
                            'download' => function ($url, $model) {
                                
                                return Html::a('<span class="fa fa-file-pdf-o"> ดาวน์โหลด PDF</span> ', yii\helpers\Url::to(['/order/order-management/download', 'id' => $model->id]), [
                                            'title'         => 'ดาวน์โหลด PDF',
                                            'class'         => 'btn btn-success btn-xs btnDownload',
                                            'data-action'   => 'download',
                                            'data-pjax'     =>0
                                    ]);
                            }, 
                           'delete' => function ($url, $model) {
                                $label = Yii::t('section', 'Delete');
                                return Html::a('<span class="fa fa-trash"></span> '.Yii::t('order','Delete'), yii\helpers\Url::to(['/order/order-management/delete', 'id' => $model->id]), [
                                            'title'         => $label,
                                            'data-id'       =>$model->id,
                                            'class'         => 'btn btn-danger btn-xs btnDeleteItems',
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
    //btnDownload
$('.btnDownload').on('click', function(){
        let url = $(this).attr('href');
        let id = $(this).attr('data-id');
        $.post(url, {id:id}, function(result){
              if(result.status == 'success') {
		    <?= SDNoty::show('result.message', 'result.status')?>
		   // console.log(result);
                   // $('#downloadFile').attr('href', result['data']['filename']);
                    let uri = `${result['data']['path']}/${result['data']['filename']}`;
                    window.open(uri, '_BLANK');
		} else {
		    <?= SDNoty::show('result.message', 'result.status')?>
		}
        }); 
        return false;
});     
$('.btnDeleteItems').on('click', function(){
        let url = $(this).attr('href');
        let id = $(this).attr('data-id');
        yii.confirm('<?= Yii::t('app', 'ยืนยันการลบ')?>', function() {
           $.post(url, {id:id}, function(result){
              if(result.status == 'success') {
		    <?= SDNoty::show('result.message', 'result.status')?>
		    setTimeout(function(){
                        location.reload();
                    },1000);
		} else {
		    <?= SDNoty::show('result.message', 'result.status')?>
		}
           }); 
        });
        //modalOrder(url);
        return false;
});    
$('.btnEdit').on('click' ,function(){
 let url = $(this).attr('href');
  modalOrder(url);
  return false;
});
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