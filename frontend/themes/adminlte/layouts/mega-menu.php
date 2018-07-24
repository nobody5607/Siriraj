<?php 
    use yii\helpers\Html;
    \janpan\jn\assets\JMegaMenuAssets::register($this);
?>
<div class="wsmenucontainer clearfix navbar-fixed-top">
    <div id="overlapblackbg"></div>
    <div class="wsmobileheader clearfix"> <a id="wsnavtoggle" class="animated-arrow"><span></span></a> <a class="smallogo"><img src="./image/sml-logo.png"  alt="" /></a> <a class="callusicon" href="tel:123456789"><span class="fa fa-phone"></span></a> </div>

    <div class="headerfull">
        <!--Main Menu HTML Code-->
        <div class="wsmain">
            <div class="smllogo">
                <a href="#" >
                    <?= Html::img('@web/images/logo.png', ['style'=>'width: 45px;']);?>
                </a>
            </div>
            <nav class="wsmenu clearfix">
                <ul class="mobile-sub wsmenu-list">                   
                    <li class="wssearchbar clearfix">
                        <form class="topmenusearch">
                            <input placeholder="Search Product By Name, Category...">
                            <button class="btnstyle"><i class="searchicon fa fa-search" aria-hidden="true"></i></button>
                        </form>
                    </li>
                    <li><a href="#" class="navtext"><span></span> <span>ห้องความรู้ </span></a>
                        <div class="megamenu clearfix">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3">
                                        1
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        1
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        1
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        1
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        1
                                    </div>
                                     
                                     
                                </div>
                            </div>
                        </div>
                    </li>
                    
                    <li class="wscarticon clearfix"> <a href="#"><i class="fa fa-shopping-basket"></i> <em class="roundpoint">8</em><span class="mobiletext">Shopping Cart</span></a> </li>
                    <li class="active"> 
                        <a href="#" class=""><span></span> <span>Half menu</span></a>                         
                    </li>
                    <li class="wsshopmyaccount clearfix"><a href="#" class="wtxaccountlink"><i class="fa fa-align-justify"></i>My Account <i class="fa  fa-angle-down"></i></a>
                        <ul class="wsmenu-submenu">
                            <li><a href="#"><i class="fa fa-black-tie"></i>View Profile</a></li>
                            <li><a href="#"><i class="fa fa-heart"></i>My Wishlist</a></li>
                            <li><a href="#"><i class="fa fa-bell"></i>Notnification</a></li>
                            <li><a href="#"><i class="fa fa-question-circle"></i>Help Center</a></li>
                            <li><a href="#"><i class="fa fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
        <!--Menu HTML Code-->
    </div> 
</div>