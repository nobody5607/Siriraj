<?php 
    $theme = common\models\Themes::findOne("1000");
    $bg_header = isset($theme['bg_header']) ? $theme['bg_header'] : '#f3ede1';
    $bg_menu = isset($theme['bg_menu']) ? $theme['bg_menu'] : '#F4F4F4';
    $bg_border_menu = isset($theme['bg_border_menu']) ? $theme['bg_border_menu'] : '#A9A9A9';
    $bg_menu_link = isset($theme['bg_menu_link']) ? $theme['bg_menu_link'] : '#1a1a1b';
    $bg_menu_link_hover = isset($theme['bg_menu_link_hover']) ? $theme['bg_menu_link_hover'] : '#fff';
    $bg_footer = isset($theme['bg_footer']) ? $theme['bg_footer'] : '#641a35';
    $bg_footer_txt = isset($theme['bg_footer_txt']) ? $theme['bg_footer_txt'] : '#fff';
?>

<?php appxq\sdii\widgets\CSSRegister::begin() ?>
<style>
    .off-white-bg {
        background: #fff;
        background: #fff;
        background: #f3f3f3 url(<?= "/images/open.jpg" ?>) no-repeat center top;
        background-size: cover;
        background-attachment: fixed;
    }
    .ptb-15{    
        padding: 0px 0;
        background: <?= $bg_header?>;
        background-size: cover;
        background-attachment: fixed;
    }
    
    
    /*navbar menu สีเนู*/
    .header-bottom.header-sticky{
        background:<?= $bg_menu?>;
    }
    /*สีขอบ*/
    .header-bottom-list>li>a{
        border-left: 1px solid <?= $bg_border_menu?>;
    }
    /*สีตัวหนังสือ*/
    .header-bottom-list>li>a, .header-bottom-list>li>ul.ht-dropdown li a{
        color: <?= $bg_menu_link?>;  
    }
    /*สีตัวหนังสือตอนเอาเมาส์ชี้*/
    .header-bottom-list li a:hover{
        color:<?= $bg_menu_link_hover?>;
        /*background: #b2b3b7;*/
    }
    
    
    /* footer */
    .footer-bottom{
        background: <?= $bg_footer?>;
    }
    .copyright-text.text-center>p{
        color:<?= $bg_footer_txt?>;
    }
    
    
    
    /*mobile*/
    .mean-container .mean-bar, .mean-container .mean-nav ul li a{
        background:#F4F4F4;
    }
    .mobile-menu::before, .mean-container .mean-nav ul li a{
        color: #565252;
    }
    .mean-container a.meanmenu-reveal{
        background: #565252 none repeat scroll 0 0;
    }
    .mean-container .mean-nav ul li a{
        border-top: 1px solid #cccccc;
    }
    .mean-container .mean-nav ul li a:hover{
        background:#f4f4f4;
    }
    
    .bootstrap-select{
        font-size: 15px;
    }
    
    
    /*custom*/
    .bootstrap-dialog {
        /* background: blue; */
        padding-top: 60px;
        font-size: 20pt;
    }
    .carousel-caption { 
        right: 15%;
        bottom: 5px;
        color: #020202;
        background: #f3e4cabd;
        border-radius: 5px;
    }
</style>
<?php appxq\sdii\widgets\CSSRegister::end() ?> 