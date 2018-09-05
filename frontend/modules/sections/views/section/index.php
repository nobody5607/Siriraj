<?php     
    use yii\bootstrap\Html;   
    use yii\widgets\ListView;
    use yii\widgets\Pjax; 
    
    $this->title= Yii::t('section', ($title != '') ? $title : 'Session'); 
    
    $data_id = isset($_GET['id']) ? $_GET['id'] : $content_section['id'];
    $section_obj = \common\models\Sections::findOne($data_id);  
    $name_str = backend\modules\sections\classes\JFiles::lengthName($section_obj['name'], 18);
?>  

<!--  Image Banner  -->
<div class="image-banner pb-30 off-white-bg">
    <div class="text-center">
        <div class="col-imgs" style="background:#fff;">
            <a href="#"><img src="/images/1533128627373.jpg" alt="image banner"></a>
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
    <h2 class="text-center"><?= Yii::t('section','Section')?> <?= $title?></h2>
    <?php endif; ?>
    <div class="container">
        <div class="trending-box">            
            <div class="product-list-box">                  
                    <?php 
                        echo ListView::widget([
                            'dataProvider' => $dataProvider,
                            'itemOptions' => ['class' => 'col-md-3 col-sm-6 col-xs-6 col-lg-3'],
                            'layout' => '<div class=" sidebar-nav-title text-right" >{summary}</div>{items}<div class="list-pager">{pager}</div>',
//                            'options' => [
//                                'tag' => 'div',
//                                'class' => 'col-md-4',
//                            ],
                            'itemView' => function ($model, $key, $index, $widget) {
                                return $this->render('_item', [
                                    'model' => $model 
                                ]);
                            },
                            'emptyText'=> ''        
                        ]);
                    ?> 
            </div>
            <!-- main-product-tab-area-->
        </div>
    </div>
    <!-- Container End -->
</div> 
<?php if(!empty(Yii::$app->request->get("id")) && count($contentProvider->getModels()) != 0):?>
<?php
 
?>
<div class="trendig-product pb-10 off-white-bg">
        <h2 class="text-center"><?= Yii::t('section','Content')?> <?= $title?></h2>
        <div class="container">
            
            <div class="trending-box">            
                <div class="product-list-box">                          
                        <?php 
                            echo ListView::widget([
                                'dataProvider' => $contentProvider,
                                'itemOptions' => ['class' => 'col-md-3 col-sm-6 col-xs-6 col-lg-3'],
                                'layout' => '<div class=" sidebar-nav-title text-right" ></div>{items}<div class="list-pager">{pager}</div>',
                                'itemView' => function ($model, $key, $index, $widget) {
                                    return $this->render('_item-content', [
                                        'model' => $model 
                                    ]);
                                },
                                'emptyText'=> ''        
                            ]);
                        ?> 
                </div>
                <!-- main-product-tab-area-->
            </div>
        </div>
        <!-- Container End -->
    </div>
<?php endif; ?>
 
 