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
                          $image = isset($model->files) ? $model->files->file_name_org : '';
                          return \yii\helpers\Html::img("/images/{$image}" , ['style'=>'width:50px;height: 50px;']);
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
                        'label'=> Yii::t('order','Meta text'),
                        'value'=>function($model){
                          $meta_text = isset($model->files) ? $model->files->meta_text : '';
                          return $meta_text;
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
                        'attribute'=>'price',
                        'label'=> Yii::t('order','Price'),
                        'value'=>function($model){
                          return number_format($model->price , 2);
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