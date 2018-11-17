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
        <div class="col-md-7 logo-text">
            <h3>คลังสมบัติของพิพิธภัณฑ์ศิริราช</h3>
            <h3>Siriraj Museum Treasure</h3>
        </div>
        <div class="col-md-3 text-center"> 
             <?php if (!Yii::$app->user->isGuest): ?> 
            <a href="/account/default/settings">
                ยินดีต้อนรับ  : <?= Yii::$app->user->identity->userProfile->firstname. ' '.Yii::$app->user->identity->userProfile->lastname;?>
            </a>
            <?php endif; ?>
        </div>
    </div></a>
</header>
<div class="container">
    <div class="col-md-12">
        <div class="navbar-menu" id="navbar-desktop" style='display:none;'>
            <ul>
                <?php if (!Yii::$app->user->isGuest): ?>
                    <?= $this->render('navbar-user') ?>
                <?php else: ?>
                    <?= $this->render('navbar-guest') ?>
                <?php endif; ?>

            </ul>
        </div>
        <div id="navbar-mobile" style="display: none;">
            <?= $this->render('navbar-mobile')?>
        </div>
    </div>
    <?php appxq\sdii\widgets\CSSRegister::begin()?>
    <style>
        
    </style>
    <?php appxq\sdii\widgets\CSSRegister::end()?>
    <div class="clearfix"></div>
    <div class="col-md-6 col-md-offset-4">
        <div class="navbar-menu-center">
            <ul>
                <?php if(empty($layoutSecond)):?>
                    <li ><a href="#" id="btnHighlight"><?= Yii::t('section', 'HIGHLIGHT')?></a></li>
                    <li ><a href="#" id="btnTopSearch"><?= Yii::t('section', 'TOP SEARCH')?></a></li>
                <?php endif; ?>
                
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
    var windowWidth = jQuery(window).width();
    //console.log(windowWidth);
    if(windowWidth > 769){
        $('#navbar-desktop').show();
        $('#navbar-mobile').hide();
    }else{
        $('#navbar-desktop').hide();
        $('#navbar-mobile').show();
    }
    
    
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

<?php \appxq\sdii\widgets\CSSRegister::begin();?>
<style>
    .space{
       padding: 0;
        width: 20px;
    }
    .nav-login{
        padding:0px;
            padding: 0px;
    /* background: blue; */
    margin-right: -12px;

    }
</style>
<?php \appxq\sdii\widgets\CSSRegister::end();?>