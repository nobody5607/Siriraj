<?php

use yii\bootstrap\Html;
use kartik\tabs\TabsX;

$this->title = Yii::t('section', $title);
if ($breadcrumb) {
    echo janpan\jn\widgets\BreadcrumbsWidget::widget([
        'breadcrumb' => $breadcrumb
    ]);
}
$modal = "modal-contents";
?>
<?php foreach ($file_type as $key => $f): ?>
    <?php if ($key > 0): ?>
        <?php
        $content_id = Yii::$app->request->get('content_id');
        $files = \common\models\Files::find()
                        ->where('content_id=:content_id AND file_type=:file_type AND rstat not in(0,3)', [':content_id' => $content_id, ':file_type' => $f['id']])->all();
        ?> 
        <?php if ($files): ?>
            <div class="trendig-product pb-10 off-white-bg" id="row-<?= $f['id'] ?>"> 
                <div class="container-fluid">
                    <div class="trending-box">            
                        <div class="product-list-box">                  

                            <h3 class="text-center" style="padding: 10px;">
                                <i class="fa <?= $f['icon'] ?>"></i> <?= $f['name'] ?>                         
                                <small ><?= count($files) ?> <?= Yii::t('section', 'Item') ?> </small>

                            </h3>
                            <div class="row" >
                                <?php foreach ($files as $key => $file): ?>
                                    <div class="col-md-3 col-sm-4 col-xs-4">
                                        <?=
                                        $this->render('_item_file', [
                                            'model' => $file
                                        ]);
                                        ?>
                                    </div>    
                                <?php endforeach; ?>
                            </div>  

                            <div class="panel-footer text-center">
                                <?=
                                Html::a(Yii::t('section', 'more...'), "/sections/content-management/view-file?content_id={$_GET['content_id']}&file_id=&filet_id={$f['id']}", [
                                    'id' => "btn-{$f['id']}",
                                    'data-action' => 'view-file',
                                    'class' => 'content-popup btnCall text-center',
                                    'data-id' => $f['id'],
                                    'style' => 'color:#000;'
                                ]);
                                ?>
                            </div> 

                        </div>
                        <!-- main-product-tab-area-->
                    </div>
                </div>
                <!-- Container End -->
            </div> 
        <?php endif; ?>     
    <?php endif; ?>
<?php endforeach; ?>  
