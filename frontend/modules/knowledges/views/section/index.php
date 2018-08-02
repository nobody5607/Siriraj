<?php
    use yii\bootstrap\Html;
    $this->title= Yii::t('section','คลังความรู้พิพิธภัณฑ์ศิริราช');    
    if($breadcrumb){
       foreach($breadcrumb as $b){
        $this->params['breadcrumbs'][] = $b;  
      } 
    }else{
       // $this->params['breadcrumbs'][]=$this->title;
    }
?> 


<div class="">
    <div class="">
        <div class="row header-bar">
    <div class="col-md-3 col-sm-6 header-bar-left">
        <div>
            <?= \yii\helpers\Html::img('images/1533128627373.jpg', ['class'=>'img img-responsive'])?>
        </div>
    </div>
    <div class="col-md-9 col-sm-6">
        <?php 
            $type= frontend\modules\knowledges\classes\JFiles::getTypeFile();
        ?>
             
        <div class="box">
            <div class="box-body">
                <div class="col-md-8">
                <div class="input-group">

                    <input type="hidden" name="search_param" value="all" id="search_param">         
                    <input type="text" class="form-control" name="x" placeholder="ค้นหา">
                    <div class="input-group-btn search-panel">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="border-radius:0;background: #fff;">
                            <span id="search_concept">เลือกประเภทไฟล์</span> <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <?php foreach ($type as $t) { ?>    
                                <li data-id='<?= $t['id'] ?>'><a href='#<?= $t['name'] ?>' data-id='<?= $t['id'] ?>'><?= $t['name'] ?></a></li>
                            <?php } ?>

                        </ul>
                    </div>
                    <span class="input-group-btn">
                        <button class="btn btn-default  btn-search" type="button"><span class="glyphicon glyphicon-search"></span></button>
                    </span>
                </div>
            </div>
            </div>
        </div> 
         
    </div>
</div>
<div class="row content-bar">
        <div class="col-md-3 col-border-right section-left">
            <div class="box box-primary">
                <div class="box-body">
                    <?= \yii\widgets\ListView::widget([
                            'dataProvider' => $dataProvider,
                            'options' => [
                                'tag' => 'ul',
                                'class' => 'nav nav-stacked',
                                'id' => 'section-all',
                            ],
                            'itemOptions' => function($model) {
                                return ['tag'=>'li','data-id' => $model['id'], 'class' => 'section-items'];
                            },
                            'layout' => "{pager}\n{items}\n",
                            'itemView' => function ($model, $key, $index, $widget) {
                                return $this->render('_item', ['model' => $model]);
                            },
                        ]);?>     
                </div>
            </div>  
            <!-- /.widget-user -->
        </div>     
    <div class="col-md-9 section-right">
        <div class="box box-primary">
            <div class="box-body">
                <br>
                <?= $content_section->content;?>                
            </div>
        </div>
        
    </div>
</div>
    </div>
</div>
 <?php 
    $this->registerJs("$('.content-header').remove();")
 ?>