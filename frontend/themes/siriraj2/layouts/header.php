<?php 
    $images = \backend\modules\sections\classes\JContent::getImage();
    ///sections/content-management/view-file?content_id=1536226767074797500&file_id=1538478070046184200&filet_id=2
    //appxq\sdii\utils\VarDumper::dump($images);
?>
<header>
    <a href='/'>
    <div class="container">
        <div class="col-md-1 text-center">
            <img id="logo" src="https://srr.thaicarecloud.org/images/logosirirajweb3.png" class="img img-responsive"/>
        </div>
        <div class="col-md-9 logo-text">
            <h3>คลังสมบัติของพิพิธภัณฑ์ศิริราช</h3>
            <h3>Siriraj museum (Unravel) treasure</h3>
        </div>
        <div class="col-md-2 text-center">
            <?php
            echo \lajax\languagepicker\widgets\LanguagePicker::widget([
                'skin' => \lajax\languagepicker\widgets\LanguagePicker::SKIN_BUTTON,
                'size' => \lajax\languagepicker\widgets\LanguagePicker::SIZE_LARGE
            ]);
            ?> 
        </div>
    </div></a>
</header>
<div class="container">
    <div class="col-md-6"></div>
    <div class="col-md-6">
        <div class="navbar-menu">
            <ul>
                <li class="active"><a  href="/"><?= Yii::t('section','HOME')?></a></li>
                <?php if (Yii::$app->user->isGuest): ?> 
                
                <li class="bg-green"><a href="/account/sign-in/login"><?= Yii::t('section','LOG IN')?></a></li>
                <li class="bg-green"><a href="/account/sign-in/signup"><?= Yii::t('section','SIGI IN')?></a></li>
                <?php else: ?>
                <li class="bg-green"><a href="/account/default/settings"><i class="fa fa-user"></i>  <?= Yii::t('appmenu', 'My Profile') ?></a></li>
                <!--<li class="bg-green"><a href="/sections/order/my-order"><i class="fa fa-check-square-o"></i>  <?= Yii::t('appmenu', 'My Orders') ?></a></li>-->
                <li class="bg-green"><a href="/account/sign-in/logout" data-method="post" tabindex="-1"><i class="fa fa-unlock-alt"></i>  <?= Yii::t('appmenu', 'Logout') ?></a></li>
                <?php endif; ?>
                
                <li class="active clip-right"><a href="#"><?= Yii::t('section','MORE...')?></a></li>
            </ul>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-6 col-md-offset-4">
        <div class="navbar-menu-center">
            <ul>
                <li ><a class="nav-active-left" href="/"><?= Yii::t('section', 'HIGHLIGHT')?></a></li>
                <li ><a href="#"><?= Yii::t('section', 'TOP SEARCH')?></a></li>
            </ul>
        </div>
    </div>
</div>

<?php if(empty($layoutSecond)):?>
<!-- Slider Image -->
<section class="multiple-items">
    <?php foreach($images as $k=>$i): ?>
        <a href="<?= $i['url']?>">
            <img style="height: 210px;" class="img img-responsive img-rounded" src="<?= "{$i['view_path']}/{$i['name']}"?>">
            <div class="text-center captur-text"><?= $i['detail']?></div>
        </a>
    <?php endforeach; ?>
</section>      
<?php endif; ?>


<!-- Form Search -->      
<div id="form-search">
    <?php echo $this->render('form-search')?>
</div>



<?php richardfan\widget\JSRegister::begin(); ?>
<script>
    
    $(function(){
        $('.multiple-items').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3
        });
    });
</script>
<?php richardfan\widget\JSRegister::end(); ?>