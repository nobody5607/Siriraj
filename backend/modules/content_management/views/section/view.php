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
<?= appxq\sdii\widgets\ModalForm::widget([
    'id' => 'modal-contents',
    'size'=>'modal-lg',
    'options'=>['tabindex' => false]
]);?>

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
                        <form class="" role="search">
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
                <hr/>
                <div class="content-data" style="display: flex;flex-direction: column;margin-top:20px;margin-bottom:50px;">                    
                    <div class="col-md-12" style="text-align: right;">
                        <?php  
                           echo Html::button("<i class='fa fa-pencil'></i>", 
                            [
                                'data-id'=>$content_section['id'],
                                'data-action'=>'update',
                                'class'=>'btn btn-primary btn-xs btnCall', 
                                'title'=> Yii::t('appmenu', 'Edit'),
                                'data-url'=>'/content_management/section/update'
                            ]);                                  
                        ?> 
                    </div>
                    <div id="content-html">                         
                        <?= $content_section->content;?>
                    </div>
                </div>
                
                <div class="pull-right" style="margin-bottom:20px;">
                    <div class="col-md-12">
                        <?php  
                           echo Html::button("<i class='fa fa-plus'></i>", 
                            [
                                'data-id'=>$content_section['id'],
                                'data-action'=>'create',
                                'class'=>'btn btn-success btn-xs btnCall', 
                                'title'=> Yii::t('appmenu', 'Create'),
                                'data-url'=>'/content_management/section/create-content'
                            ]);                                  
                    ?> 
                    </div>
                </div>
                <div class="clearfix"></div>
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
<?php \richardfan\widget\JSRegister::begin();?>
<?php 
    $modal = "modal-contents";
?>

<script>
   $('.btnCall').on('click', function(){
       let id       = $(this).attr('data-id');
       let url      = $(this).attr('data-url');
       let action   = $(this).attr('data-action');
       if(action == 'create'){
           callCreate(url , id);
       }
       else if(action == 'update'){
           callUpdate(url , id);
       }else if(action == 'delete'){
           callDelete(url ,id);
       }
       
       return false; 
   });
   callCreate=function(url , id){
       //id = section_id
       $('#<?= $modal?> .modal-content').html('<div class=\"sdloader \"><i class=\"sdloader-icon\"></i></div>');
       $('#<?= $modal?>').modal('show');
       $.get(url, {id:id,public:1}, function(res){
           $('#<?= $modal?> .modal-content').html(res);
       });
   }
   callUpdate=function(url , id){
       $('#<?= $modal?> .modal-content').html('<div class=\"sdloader \"><i class=\"sdloader-icon\"></i></div>');
       $('#<?= $modal?>').modal('show');
       $.get(url, {id:id,public:1}, function(res){
           $('#<?= $modal?> .modal-content').html(res);
       });
   }
   callDelete=function(url ,id){
        yii.confirm('<?= Yii::t('user', 'Confirm Delete?')?>', function(){
            $.post(url, {id:id}, function(result){
                <?= appxq\sdii\helpers\SDNoty::show('result.message', 'result.status') ?>
                setTimeout(function(){
                    location.reload();
                },1000);
            });
        });      
   }
</script>
<?php \richardfan\widget\JSRegister::end();?>
