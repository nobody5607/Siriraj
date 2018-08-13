<?php 
    use yii\helpers\Html;
    $this->title = Yii::t('cart', 'MyCart');
    if($breadcrumb){
        echo janpan\jn\widgets\BreadcrumbsWidget::widget([
            'breadcrumb'=>$breadcrumb
        ]);  
    }
?>
<div class="col-md-12" id="10" data-id="10" style="padding: 5px;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title"><i class="fa fa-shopping-cart"></i> รถเข็นของฉัน</div>             
        </div>
        <!-- /.box-header -->
        <div class="panel-body" style="">
            <div id="dynamic-content-10">
            <?= kartik\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                  [
                      'contentOptions'=>['style'=>'width:50px;'],
                      'format'=>'raw',
                      'attribute'=>'image',
                      'label'=> Yii::t('cart',''),
                      'value'=>function($model){
                        return \yii\helpers\Html::img("/images/{$model['image']}" , ['style'=>'width:50px;height: 50px;']);
                      }
                  ],
                  [
                      'attribute'=>'pro_name',
                      'label'=> Yii::t('cart','Name'),
                      'value'=>'pro_name'
                  ],
                  [
                      'attribute'=>'pro_detail',
                      'label'=> Yii::t('cart','Detail'),
                      'value'=>'pro_name'
                  ],
                  [
                      'attribute'=>'amount',
                      'label'=> Yii::t('cart','Amount'),
                      'value'=>'amount'
                  ],
                  [
                      'attribute'=>'sum',
                      'label'=> Yii::t('cart','Price'),
                      'value'=>function($model){
                          return number_format($model['sum'], 2);
                      }
                  ],
                  [
                        'contentOptions'=>['style'=>'width:50px;text-align:center;'],
                        'class' => 'yii\grid\ActionColumn',
                        'header'=>'Action',
                        'template'=>'{delete}',
                        'buttons'=>[
                          'delete' => function($url,$model,$key){
                              return Html::a('<i class="fa fa-trash"></i>','#', ['data-id'=>$model['id'], 'class'=>'btn btn-danger btn-sm btn-delete']);
                            }
                        ]
                  ],
                ],
                          
            ]) ?>
            </div>
        </div>
        <!-- /.box-body -->
        <?php if($count):?>
        <div class="panel-footer text-center" style="">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <a href="/sections/cart/my-check-out?step=1" class="btn btn-warning btn-block btn-lg" style="position: relative;">
                        <i class="fa fa-shopping-cart"></i> Checkout
                    </a>
                </div>
            </div>
        </div>
        <?php endif;?>
        <!-- /.box-footer -->
    </div>
</div>
<?php \richardfan\widget\JSRegister::begin();?>
<script>
    $('.btn-delete').on('click', function(){
        let id=$(this).attr('data-id');
        let url = '/sections/cart/delete-cart';
        
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