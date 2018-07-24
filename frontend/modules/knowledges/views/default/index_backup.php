<?php

use yii\helpers\Html;

$this->title = $title_arr['title'];
//Yii::$app->meta->keywords = 'ห้องความรู้';
//Yii::$app->meta->description = 'ห้องความรู้'; 
foreach($breadcrumbs as $b){
  $this->params['breadcrumbs'][] = $b;  
}

$asset_path = Yii::$app->assetManager->getPublishedUrl('@frontend/themes/admin/assets');
?>

<?= $this->render("_left", ['section'=>$section, 'title_arr'=>$title_arr])?>
<div id="main-content-wrapper" class="content-wrapper " style="min-height: 314px;">
    <div class="content">
        <?=
            \yii\widgets\Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ])
        ?>
        <div class="row">
            <div class="col-md-12">
                <div style="background: #d4d4d457;
    padding: 5px;
    margin-bottom: 10px;
    border-radius: 5px;">
                     <?= $this->render("_search", ['file_type'=>$file_type]) ?>
                    <div class="">
                        <a href="#" class="pull-left toggle-sidebar-collapse" style="color:#000;margin-top: -6px;"><i class="mdi mdi-menu"></i></a>
                    </div>
                    <div class="main-header" style="    margin-bottom: 25px;">
                        <h2 style="font-size: 14pt;"><?= Html::encode($this->title); ?></h2>
                        <em>Knowledges</em>
                    </div>
                </div>
               
            </div>
        </div>  
      <?= $this->render("_content", ['content'=>$content, 'title_arr'=>$title_arr])?>   
    </div><!-- content -->
</div>
 