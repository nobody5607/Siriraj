<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs; 
\frontend\assets\CustomStyleAsset::register($this);
\appxq\sdii\assets\notify\NotifyAsset::register($this);
\appxq\sdii\assets\bootbox\BootBoxAsset::register($this);
frontend\themes\siriraj\assets\SirirajAssets::register($this);
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@frontend/themes/siriraj');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body id="page-top" class="index">
<?php $this->beginBody() ?>

<div class="wrapper">
        
        <?php 
            echo $this->render("header",[
                'slide'=>0,
                'directoryAsset'=>$directoryAsset
            ]);
        ?>
  
        <div class="main-page-banner pb-50 off-white-bg home-3">
            <div class="container">
                <?= $content;?>  
            </div> 
        </div>
        <?= $this->render('footer');?> 
    </div>
<?php \appxq\sdii\widgets\CSSRegister::begin();?>
            <style>
                footer.off-white-bg2.pt-95.bdr-top.pt-sm-55 { 
                    background: #F3D39C url(<?= "/images/open.jpg"?>) no-repeat center top;
                    background-size: cover;
                }
            </style>            
<?php \appxq\sdii\widgets\CSSRegister::end();?>            
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>