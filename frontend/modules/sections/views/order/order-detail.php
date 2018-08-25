<?php 
    use yii\helpers\Html;
    $this->title = Yii::t('order', 'Order Detail');
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
                        'contentOptions'=>['style'=>'width:50px;'],
                        'format'=>'raw',
                        'attribute'=>'image',
                        'label'=> Yii::t('order',''),
                        'value'=>function($model){
                          if(!empty($model->files->file_name) && !empty($model->files->file_path)){
                            $path = "{$model->files->file_path}/{$model->files->file_name}";
                            return \yii\helpers\Html::img($path , ['style'=>'width:50px;height: 50px;']);
                          }
                          
                        }
                    ],
                    [
                        'label'=> Yii::t('order','File name'),
                        'value'=>function($model){
                          $name = isset($model->files) ? $model->files->name : '';
                          return $name;
                        }
                    ],
                    [
                        'format'=>'raw',
                        'label'=> Yii::t('order','Meta text'),
                        'value'=>function($model){
                          $meta_text = appxq\sdii\utils\SDUtility::string2Array($model->files->meta_text);
                          $mb = round(($meta_text['size']/1024)/1024);
                          $meta_file = "<div class='label label-default'>
                                          <label>". Yii::t('file', 'Type')." : {$meta_text['type']}</label> &nbsp;&nbsp;
                                          <label>". Yii::t('file', 'Size')." : {$mb} Mb</label>
                                      </div>";
                          
                          return $meta_file;
                        }
                    ],
                    [
                        'label'=> Yii::t('order','Description'),
                        'value'=>function($model){
                            $description = isset($model->files) ? $model->files->description : '';
                          return $description;
                        }
                    ],         
                    [
                        'contentOptions'=>['style'=>'width:50px;'],
                        'attribute'=>'size',
                        'label'=> Yii::t('order','Size'),
                        'value'=>function($model){
                          return $model->size;
                        }
                    ],
                    [
                        'contentOptions'=>['style'=>'width:50px;'],
                        'attribute'=>'quantity',
                        'label'=> Yii::t('order','Quantity'),
                        'value'=>function($model){
                          return  $model->quantity;
                        }
                    ],
                    [
                        'contentOptions'=>['style'=>'width:50px;text-align:center;'],
                        'class' => 'yii\grid\ActionColumn',
                        'header'=>'Action',
                        'template'=>'{delete}',
                        'buttons'=>[
                          'delete' => function($url,$model,$key){
                               $status = isset($model->order->status) ? $model->order->status : '2';
                               if($status == 1){
                                  return Html::a('<i class="fa fa-trash"></i>','#', ['data-id'=>$model['id'], 'class'=>'btn btn-danger btn-sm btn-delete']);
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

<?php \richardfan\widget\JSRegister::begin();?>
<script>
    $('.btn-delete').on('click', function(){
        let id=$(this).attr('data-id');
        let url = '/sections/order/delet-order-detail';
        
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