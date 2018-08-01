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
    $back = Yii::$app->request->referrer;
//    appxq\sdii\utils\VarDumper::dump($back);
?> 


<div class="row header-bar">
    <div class="col-md-3 col-sm-6 header-bar-left">
        
    </div>
    <div class="col-md-9 col-sm-6">
        
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
                            'emptyText'=> \yii\helpers\Html::a('Back', Yii::$app->request->referrer, ['data-url'=>$back, 'id'=>'backs']),        
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
            <div class="box-header">
                <div><i class="fa fa-<?= $title['icon'];?>"></i> <?= isset($title) ? Html::encode($title['name']) : $this->title?></div>
            </div>
            <div class="box-body">
                <div class="clearfix">
                     <?php 
                            $type= frontend\modules\knowledges\classes\JFiles::getTypeFile();
                        ?>
                        <form class="navbar-form navbar-left" role="search">
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
                        </form>
                </div>
                 <?= $content_section->content;?> 
                <?php 
                    
                    echo \yii\widgets\ListView::widget([
                        'dataProvider' => $contentProvider,
                        'options' => [
                            'tag' => 'div',
                            'class' => 'content-list',
                            'id' => 'section-all',
                        ],
                        'itemOptions' => function($model) {
                            return ['tag' => 'div', 'data-id' => $model['id'], 'class' => 'box-footer box-comments'];
                        },
                        'layout' => "{items}\n{pager}",
                        'itemView' => function ($model, $key, $index, $widget) {
                            return $this->render('_content', ['model' => $model]);
                        },

                    ]);
                    ?>                 
            </div>
        </div>
        
    </div> 
</div>
<?php \appxq\sdii\widgets\CSSRegister::begin();?>
<style>
    .box-comments {
    background: #ffffff;
}
</style>
<?php \appxq\sdii\widgets\CSSRegister::end();?>
