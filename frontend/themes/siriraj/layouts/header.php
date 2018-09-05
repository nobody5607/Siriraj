<?php

use yii\helpers\Url;
use yii\helpers\Html;
    $email = \backend\modules\cores\classes\CoreOption::getParams("email", "e");
    $tel = \backend\modules\cores\classes\CoreOption::getParams("tel", "e");
      

?>

<header>
    <!-- Header Top Start Here -->
    <div class="header-top-area">
        <div class="container">
            <!-- Header Top Start -->
            <div class="header-top">
                <ul>
                    <li><a href="#"><i class="fa fa-envelope" style="font-size:12pt;"></i> <?= isset($email) ? $email: ''?></a></li>
                    <li><a href="#"><i class="fa fa-phone" style="font-size:12pt;"></i> <?= isset($tel) ? $tel : ''?></a></li> 
                </ul>
                <ul>
                    <li>
                        <?php
                        echo \lajax\languagepicker\widgets\LanguagePicker::widget([
                            'skin' => \lajax\languagepicker\widgets\LanguagePicker::SKIN_DROPDOWN,
                            'size' => \lajax\languagepicker\widgets\LanguagePicker::SIZE_SMALL
                        ]);
                        ?> 
                    </li>
<?php if (Yii::$app->user->isGuest): ?> 
                        <li><a href="#"><?= Yii::t('appmenu', 'Login')?>/<?= Yii::t('appmenu', 'Register')?> <i class="lnr lnr-chevron-down"></i></a>
                            <!-- Dropdown Start -->
                            <ul class="ht-dropdown">
                                <li><a href="/account/sign-in/login"><?= Yii::t('appmenu', 'Login')?></a></li>
                                <li><a href="/account/sign-in/signup"><?= Yii::t('appmenu','Register');?></a></li>
                            </ul>
                            <!-- Dropdown End -->
                        </li>
<?php endif; ?>
                </ul>
            </div>
            <!-- Header Top End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Header Top End Here -->
    <!-- Header Middle Start Here -->
    <div class="header-middle ptb-15">
<?= $this->render("_search", ['directoryAsset' => $directoryAsset]) ?>    
        <div class="header-bottom  header-sticky">
            <div class="container">
                <div class="row align-items-center">

                    <div class="col-xl-9 col-lg-8 col-md-12 ">
                        <nav class="d-none d-lg-block">
                            <ul class="header-bottom-list d-flex">
                                <li><a href="/"><i class="fa fa-home"></i> <?= Yii::t('appmenu', 'Home') ?></a></li>
                                <li><a href="/site/about"><?= Yii::t('appmenu', 'About Us') ?></a></li>
                                <li><a href="/site/contact"><?= Yii::t('appmenu', 'Contact Us') ?></a></li>
                            </ul>
                        </nav>
                        <div class="mobile-menu d-block d-lg-none">
                            <nav>
                                <ul>
                                    <li><a href="/"><i class="fa fa-home"></i> <?= Yii::t('appmenu', 'Home') ?></a></li>
                                    <li><a href="/site/about"><?= Yii::t('appmenu', 'About Us') ?></a></li>
                                    <li><a href="/site/contact"><?= Yii::t('appmenu', 'Contact Us') ?></a></li>
                                    <li class="text-center">
                                        <?php
                                        echo \lajax\languagepicker\widgets\LanguagePicker::widget([
                                            'skin' => \lajax\languagepicker\widgets\LanguagePicker::SKIN_LIST,
                                            'size' => \lajax\languagepicker\widgets\LanguagePicker::SIZE_LARGE
                                        ]);
                                        ?> 
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- Row End -->
            </div>                
        </div>
<?php if($slide == '1'): ?>
        <div class="slider_box" >
            <div class='container'>
                <div class="slider-wrapper theme-default"> 
                    <div id="slider" class="nivoSlider">
                        <a href="shop.html"><img src="http://storage.siriraj.lc/web/files/1535730762082417100/thumbnail/2f0daabfe8d1e67283ec2ecd75ca3227_mark.jpg" data-thumb="http://storage.siriraj.lc/web/files/1535730762082417100/thumbnail/2f0daabfe8d1e67283ec2ecd75ca3227_mark.jpg" alt="" title="#htmlcaption" /></a>
                        <a href="shop.html"><img src="http://storage.siriraj.lc/web/files/1535730768015789200/thumbnail/19f9d71e82b9c42aa666fb2958228b7a_mark.jpg" data-thumb="http://storage.siriraj.lc/web/files/1535730768015789200/thumbnail/19f9d71e82b9c42aa666fb2958228b7a_mark.jpg" alt="" title="#htmlcaption2" /></a>
                    </div>
                </div>
            </div>
        </div>
<?php endif; ?>
</header>