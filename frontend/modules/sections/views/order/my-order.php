<?php 
    use yii\helpers\Html;
    $this->title = Yii::t('order', 'My Order');
    if($breadcrumb){
        echo janpan\jn\widgets\BreadcrumbsWidget::widget([
            'breadcrumb'=>$breadcrumb
        ]);  
    }
?>
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
                        }else if($model->status == 2){
                             return 'จัดส่งแล้ว';
                        }
                      }
                  ],
                  [
                      'format'=>'raw',
                      'label'=> Yii::t('order','Order Detail'),
                      'value'=>function($model){
                        return Html::a('Detail', ["/sections/order/order-detail?order_id={$model->id}"], ['']);
                      }
                  ]         
                ],
                          
            ]) ?>
            </div>
        </div>
        
    </div>
</div>
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