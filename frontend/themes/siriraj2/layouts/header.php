<?php 
   
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
            
        </div>
    </div></a>
</header>
<div class="container">
    <div class="col-md-6"></div>
    <div class="col-md-6 float-right">
        <div class="navbar-menu">
            <ul>
                
                
                <li class="nav_active"><a  href="/"><i class='fa fa-home'></i> <?= Yii::t('section','HOME')?></a></li>
                <?php if (Yii::$app->user->isGuest): ?> 
                
                <li class="bg-green"><a href="/account/sign-in/login"><?= Yii::t('section','SIGN IN')?></a></li>
                <li class="bg-green"><a href='#'>/</a></li>
                <li class="bg-green"><a href="/account/sign-in/signup"><?= Yii::t('section','SIGN UP')?></a></li>
                <?php else: ?>
                    <li class="bg-green"><a href="/account/default/settings"> <?= Yii::t('appmenu', 'MY PROFILE') ?></a></li>
                    <li class="bg-green"><a href="/sections/order/my-order"><?= Yii::t('appmenu', 'REQUEST INFORMATION') ?></a></li>
                <?php endif; ?>
                <li class="dropdown nav_active">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= Yii::t('section','MORE...')?> <span class="caret"></span></a>
                    <ul class="dropdown-menu ">
                        <li><a href="/sections/cart/my-cart"><?= Yii::t('section','รายการคำร้องขอ')?></a></li>
                      <li><a href="/site/about"><?= Yii::t('section','ABOUT US')?></a></li>
                      <li><a href="/site/contact"><?= Yii::t('section','CONTACT US')?></a></li>
                      <?php if (!Yii::$app->user->isGuest): ?> 
                         
                        <li><a href="/account/sign-in/logout" data-method="post" tabindex="-1"><i class="fa fa-unlock-alt"></i>  <?= Yii::t('appmenu', 'LOGOUT') ?></a></li>
                      <?php endif; ?>
                    </ul>
                </li>
                <li class="clip-right nav_active"><a class="menu-height"></a></li>
               
            </ul>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-6 col-md-offset-4">
        <div class="navbar-menu-center">
            <ul>
                <?php if(empty($layoutSecond)):?>
                    <li ><a href="#" id="btnHighlight"><?= Yii::t('section', 'HIGHLIGHT')?></a></li>
                    <li ><a href="#" id="btnTopSearch"><?= Yii::t('section', 'TOP SEARCH')?></a></li>
                <?php endif; ?>
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

<!-- Slider Image -->
<?php if(empty($layoutSecond)):?>
<div id="slideer-image"></div>  
<?php endif; ?>
<!-- Form Search -->      
<div id="form-search">
    <?php echo $this->render('form-search')?>
</div> 

<?php richardfan\widget\JSRegister::begin(); ?>
<script>
    
    function loadHighlight(){
       let url = '/site/highlight';
       
       $('#btnHighlight').addClass('nav-active-right');
        $('#btnTopSearch').removeClass('nav-active-left');
       
       loadSlideImage(url);
       return false;
    }
    function loadSlideImage(url){
        $('#slideer-image').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-fw"></i></div>');
        $.get(url,function(data){
            $('#slideer-image').html(data); 
        });
        return false;
    }
    $('#btnHighlight').on('click', function(){
        loadHighlight();
        return false;
    }); 
    $('#btnTopSearch').on('click', function(){
        $('#btnHighlight').removeClass('nav-active-right');
        $('#btnTopSearch').addClass('nav-active-left');
        let url = '/site/top-search';
        loadSlideImage(url);
       return false;
    }); 
    
    loadHighlight();
</script>
<?php richardfan\widget\JSRegister::end(); ?>
