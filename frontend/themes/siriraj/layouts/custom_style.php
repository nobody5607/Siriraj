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
        background: #f3ede1;
        background-size: cover;
        background-attachment: fixed;
    }
    
    
    /*navbar menu สีเนู*/
    .header-bottom.header-sticky{
        background:#F4F4F4;
    }
    /*สีขอบ*/
    .header-bottom-list>li>a{
        border-left: 1px solid #A9A9A9;
    }
    /*สีตัวหนังสือ*/
    .header-bottom-list>li>a, .header-bottom-list>li>ul.ht-dropdown li a{
        color: #1a1a1b;  
    }
    /*สีตัวหนังสือตอนเอาเมาส์ชี้*/
    .header-bottom-list li a:hover{
        color:#fff;
        background: #b2b3b7;
    }
    
    
    /* footer */
    .footer-bottom{
        background: #641a35;
    }
    .copyright-text.text-center>p{
        color:#fff;
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
</style>
<?php appxq\sdii\widgets\CSSRegister::end() ?> 