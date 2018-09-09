<?php 
    use yii\helpers\Html;
    $this->title = Yii::t('order', 'My Order');
    if($breadcrumb){
        echo janpan\jn\widgets\BreadcrumbsWidget::widget([
            'breadcrumb'=>$breadcrumb
        ]);  
    }
?>
<div class="row"> 
<div class="col-md-12" id="10" data-id="10" style="padding: 5px;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title"><i class="fa fa-shopping-cart"></i> <?= Html::encode($this->title);?></div>              
        </div>
        <!-- /.box-header -->
        <div class="panel-body" style="">
            <div id="dynamic-content-10">
            <?= kartik\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                  [
                      'format'=>'raw',
                      'contentOptions'=>['style'=>'width:50px;'],
                      'attribute'=>'id',
                      'label'=> Yii::t('order','Order Id'),
                      'value'=>function($model){
                        return Html::a("{$model->id}", ["/sections/order/order-detail?order_id={$model->id}"], ['']);                        
                      }
                  ],
                  [
                    
                      'attribute'=>'create_date',
                      'label'=> Yii::t('order','Date'),
                      'value'=>function($model){
                        return appxq\sdii\utils\SDdate::mysql2phpDate($model->create_date);
                      }
                  ],
                  [
                    
                      'attribute'=>'status',
                      'label'=> Yii::t('order','Status'),
                      'value'=>function($model){
                        if($model->status == 1){
                            return 'ยังไม่ชำระเงิน';
                        }else if($model->status == 2){
                            return 'ชำระเงินแล้ว';
                        }
                      }
                  ],
                  [
                        'contentOptions'=>['style'=>'width:150px;text-align:center;'],
                        'class' => 'yii\grid\ActionColumn',
                        'header'=>'',
                        'template'=>'{preview} {send-mail} {print} {delete}',
                        'buttons'=>[
                          'preview' => function($url,$model,$key){                               
                             return Html::a('<i class="fa fa-eye"></i>', "/sections/order/print?id=1536467432080124500&type=preview", ['title'=>Yii::t('order','Preview'),'data-id'=>$model['id'], 'class'=>'btn btn-info btn-sm', 'target'=>'_blank']);   
                          },  
                          'send-mail' => function($url,$model,$key){
                              
                                  return Html::a('<i class="fa fa-envelope"></i>',"/sections/order/print?id={$model['id']}&type=mail", ['title'=> Yii::t('order','Send Email'),'data-id'=>$model['id'], 'class'=>'btn btn-success btn-sm', 'target'=>'_blank' ]);
                               
                          },
                          'print' => function($url,$model,$key){                               
                             return Html::a('<i class="fa fa-print"></i>',$url."&type=print", ['title'=>Yii::t('order','Print'),'data-id'=>$model['id'], 'class'=>'btn btn-primary btn-sm', 'target'=>'_blank']);   
                          },        
                          'delete' => function($url,$model,$key){
                              if($model['status'] == 1){
                                  return Html::a('<i class="fa fa-trash"></i>','#', ['data-id'=>$model['id'],'title'=>Yii::t('order','Delete'), 'class'=>'btn btn-danger btn-sm btn-delete']);
                              }
                          }
                        ]
                  ],
                      
                ],
                          
            ]) ?>
            </div>
        </div>
        
    </div>
</div>


</div>
<?php \richardfan\widget\JSRegister::begin();?>
<script>
    $('.btn-delete').on('click', function(){
        let id=$(this).attr('data-id');
        let url = '/sections/order/delet-order';
        
        yii.confirm('<?= Yii::t('cart', 'Are you sure you want to delete this item?')?>', function() {
            $.post(url, {id:id}, function(data){
                if(data['status'] == 'success'){
                    <?= \appxq\sdii\helpers\SDNoty::show('data.message', 'data.status') ?>
                    setTimeout(function(){
                        location.reload();
                    },1000);
                }
            });
        })
        
        
        return false;
    });
</script>
<?php \richardfan\widget\JSRegister::end();?>



<?php \appxq\sdii\widgets\CSSRegister::begin()?>
<style>
    @media only screen and (min-width: 768px){
        .cd-breadcrumb, .cd-multi-steps {     
            max-width: 100%;    
            margin-left: 0; 
        }
    }
</style>
<?php \appxq\sdii\widgets\CSSRegister::end();?>