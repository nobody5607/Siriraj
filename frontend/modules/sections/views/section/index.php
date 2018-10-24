<?php     
    use yii\bootstrap\Html;   
    use yii\widgets\ListView;
    use yii\widgets\Pjax; 
    
    $this->title= Yii::t('section', ($title != '') ? $title : 'Session Management'); 
    
    $data_id = isset($_GET['id']) ? $_GET['id'] : $content_section['id'];
    $section_obj = \common\models\Sections::findOne($data_id);  
    $name_str = backend\modules\sections\classes\JFiles::lengthName($section_obj['name'], 18);
?>  

<!--  Image Banner  -->
<div class="image-banner pb-0 off-white-bg">
    <div class="text-center">
        <div class="col-imgs">
             
            <?php 
                if($breadcrumb){        
                    echo janpan\jn\widgets\BreadcrumbsWidget::widget([
                        'breadcrumb'=>$breadcrumb
                    ]);
                }
            ?>
        </div>
    </div> 
</div>
 
<div class="trendig-product pb-10 off-white-bg">
    <?php if(count($dataProvider->getModels()) != 0):?>
    <h2 class="text-center" style="padding-top: 20px;
    background: #f3f3f3;
    padding-bottom: 20px;
        font-size: 22pt;
    font-weight: bold;
    border-bottom: 1px solid #e8e6e1;"><?= Yii::t('section','Siriraj Museum ... more than you think.')?> : <?= $title?></h2>
    <?php endif; ?>

<div class="">
    <?=
        \yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'options' => [
                'tag' => 'div',
                'class' => 'row',
                //        'id' => 'section-all',
                'id' => 'ezf_dad',
            ],
            'itemOptions' => function($model) {
                return ['tag' => 'div','class' => 'bg-green flex-display mb10 wd-100 btn-parent', 'data-id'=>"{$model['id']}"];
            },
            'emptyText'=>false,        
            'layout' => "{items}\n<div class='list-pager'>{pager}</div>",
            'itemView' => function ($model, $key, $index, $widget) {

                return $this->render('_item', ['model' => $model, 'key'=>$key+1]);
            },
        ]);
    ?>
    <?php richardfan\widget\JSRegister::begin();?>
    <script>
        $('.btn-parent').css({ cursor:'pointer' });
        $('.btn-parent').on('click',function(){
            let id = $(this).attr('data-id');   
            let url = '/sections/section?id='+id;  
            location.href = url;
        });
    </script>
    <?php richardfan\widget\JSRegister::end();?>
    
        
    </div>
    <!-- Container End -->
</div> 
<?php if(!empty(Yii::$app->request->get("id")) && count($contentProvider->getModels()) != 0):?>
<?php
 
?>
<div class="trendig-product pb-10 off-white-bg">
    <h2 class="text-center" style="padding-top: 20px;
    background: #f3f3f3;
    padding-bottom: 20px;
    border-bottom: 1px solid #e8e6e1;"><?= Yii::t('section','Data')?> : <?= $title?></h2>
        <div class="">
            <?=
                \yii\widgets\ListView::widget([
                    'dataProvider' => $contentProvider,
                    'options' => [
                        'tag' => 'div',
                        'class' => 'row',
                        //        'id' => 'section-all',
                        'id' => 'ezf_dad',
                    ],
                    'itemOptions' => function($model) {
                        return ['tag' => 'div','class' => 'bg-green flex-display mb10 wd-100 btn-content', 'data-id'=>"{$model['id']}"];
                    },
                    'layout' => "{items}\n<div class='list-pager'>{pager}</div>",
                    'itemView' => function ($model, $key, $index, $widget) {

                        return $this->render('_item-content', ['model' => $model, 'key'=>$key+1]);
                    },
                ]);
            ?>
            
            <?php richardfan\widget\JSRegister::begin();?>
    <script>
        $('.btn-content').css({ cursor:'pointer' });
        $('.btn-content').on('click',function(){
            let id = $(this).attr('data-id');   
            let url = '/sections/section/content-management?content_id='+id;  
            location.href = url;
        });
    </script>
    <?php richardfan\widget\JSRegister::end();?>
             
        </div>
        <!-- Container End -->
    </div>
<?php endif; ?>
 
 