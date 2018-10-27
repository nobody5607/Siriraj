<?php 
    $images = \backend\modules\sections\classes\JContent::getImage();
    $cart = isset(Yii::$app->session["cart"]) ? count(Yii::$app->session["cart"]) : 0;
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
    <div class="col-md-6 float-right">
        <div class="navbar-menu">
            <ul>
                
                
                <li class="active"><a  href="/"><?= Yii::t('section','HOME')?></a></li>
                <?php if (Yii::$app->user->isGuest): ?> 
                
                <li class="bg-green"><a href="/account/sign-in/login"><?= Yii::t('section','LOG IN')?></a></li>
                <li class="bg-green"><a href="/account/sign-in/signup"><?= Yii::t('section','SIGI IN')?></a></li>
                <?php else: ?>
                    <li class="bg-green"><a href="/account/default/settings"><i class="fa fa-user"></i>  <?= Yii::t('appmenu', 'MY PROFILE') ?></a></li>
                   
                <?php endif; ?>
                <li class="dropdown active">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= Yii::t('section','MORE...')?> <span class="caret"></span></a>
                    <ul class="dropdown-menu ">
                      <li><a href="/site/about"><?= Yii::t('section','ABOUT US')?></a></li>
                      <li><a href="/site/contact"><?= Yii::t('section','CONTACT US')?></a></li>
                      <?php if (!Yii::$app->user->isGuest): ?> 
                         <li class="bg-green"><a href="/sections/order/my-order"><i class="fa fa-check-square-o"></i>  <?= Yii::t('appmenu', 'REQUEST INFORMATION') ?></a></li>
                        <li><a href="/account/sign-in/logout" data-method="post" tabindex="-1"><i class="fa fa-unlock-alt"></i>  <?= Yii::t('appmenu', 'LOGOUT') ?></a></li>
                      <?php endif; ?>
                    </ul>
                </li>
                <li class="clip-right active"><a class="menu-height"></a></li>
               
            </ul>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-6 col-md-offset-4">
        <div class="navbar-menu-center">
            <ul>
                <li ><a class="nav-active-left" href="/"><?= Yii::t('section', 'HIGHLIGHT')?></a></li>
                <li ><a href="#" id="btnTopSearch"><?= Yii::t('section', 'TOP SEARCH')?></a></li>
                <li>
                    <a href="/sections/cart/my-cart">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="my-cart">
                            <?php if(!empty($cart)):?>
                            <span class="badge" id="globalCart"> <?= $cart ?></span>  
                            <?php endif; ?>
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<?php if(empty($layoutSecond)):?>
<!-- Slider Image -->
<section class="multiple-items">
    <?php foreach($images as $k=>$i): ?>
        <a href="<?= $i['url']?>">
            <img class="img img-responsive img-rounded image-sliders" src="<?= "{$i['view_path']}/{$i['name']}"?>">
            <div class="text-center captur-text"><?= $i['detail']?></div>
        </a>
    <?php endforeach; ?>
</section>      
<?php endif; ?>


<!-- Form Search -->      
<div id="form-search">
    <?php echo $this->render('form-search')?>
</div>


<?php
    echo \appxq\sdii\widgets\ModalForm::widget([
        'id' => 'modal-top-search',
        'size' => 'modal-lg',
        'tabindexEnable' => false,
    ]);
?>
<?php richardfan\widget\JSRegister::begin(); ?>
<script>
    $('.multiple-items').hide();
    setTimeout(function(){
       $('.multiple-items').show(); 
       $('.multiple-items').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3
        });
    },1000);
    $('#btnTopSearch').on('click', function(){
        $('#modal-top-search').modal('show');
        $('#modal-top-search .modal-content').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-fw"></i></div>');
        let url = '/site/top-search';
        $.get(url,function(data){
            $('#modal-top-search .modal-content').html(data); 
        });
       return false;
    }); 
</script>
<?php richardfan\widget\JSRegister::end(); ?>