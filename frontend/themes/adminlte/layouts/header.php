<?php

use yii\helpers\Html;
use frontend\components\NavBar;
use yii\bootstrap\Nav;

\frontend\components\AppComponent::navbarRightMenu();
?>

<header class="main-header">

    <?php
    NavBar::begin([
        'id' => 'main-nav-app',
        'brandLabel' => 'SIRIRAJ MUSEUM',
        'brandUrl' => Yii::$app->homeUrl,
        'innerContainerOptions' => ['class' => 'container-fluid'],
        'options' => [
            'class' => 'page-container navbar navbar-inverse navbar-fixed-top',
        ],
    ]);

//echo Nav::widget([
//    'options' => ['class' => 'navbar-nav navbar-left'],
//    'items' => [        
//        ['label' => Yii::t('appmenu','ห้องความรู้'), 'icon' => 'file-code-o', 'url' => ['/knowledges/section'],
//            'active'=>(Yii::$app->controller->module->id == 'knowledges' && Yii::$app->controller->id == 'section') ? true : false],
//    ]
//]);


    echo \yii\bootstrap\Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => isset(Yii::$app->params['navbarR']) ? Yii::$app->params['navbarR'] : [],
    ]);
    echo '<div class="navbar-text pull-right">';
    echo \lajax\languagepicker\widgets\LanguagePicker::widget([
        'skin' => \lajax\languagepicker\widgets\LanguagePicker::SKIN_BUTTON,
        'size' => \lajax\languagepicker\widgets\LanguagePicker::SIZE_SMALL
    ]);
    echo '</div>';

    NavBar::end();
    ?>    
</header>
<?php
$this->registerJs("
        $('.search-panel .dropdown-menu').find('a').click(function(e) {
		e.preventDefault();
		var param = $(this).attr('href').replace('#','');
		var concept = $(this).text();
		$('.search-panel span#search_concept').text(concept);
		$('.input-group #search_param').val(param);
	});
    ");
?> 
<?php \appxq\sdii\widgets\CSSRegister::begin(); ?>
<style>
    @media (min-width: 768px){
        .content-header>.breadcrumb {
            top: 60px;
            box-shadow:none;
            padding: 8px 15px;
            margin-bottom: 20px;
            list-style: none;
            border-radius: 4px;
            border: 1px solid #e7e7e7; 
            font-size: 12pt;
            background-color: #f8f8f8;
            float: none; 
        }   
    } 

    .navbar-nav > li > .dropdown-menu {
        margin-top: 0;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        background: #276b92;
        border: 1px solid #3c8dbc;
    }
    .dropdown-menu>li>a:hover {
        background-color: #225979;
        color: #333;
    }
    .box.box-primary {
        border: none;
        box-shadow: 0px 0px 5px #a7a7a7;
    }
    @media (min-width: 768px){

        #items-views {
            margin-left: 250px;            
        }
        .list-view .item a.media { 
            font-size: 14px;
        }
        .items-sidebar.navbar-collapse{
            width: 255px;
        } 

    } 
    .sidebars{
        background:#fff;
        padding:10px;
    }

    .items-sidebar.navbar-collapse{
        border-right: 1px solid #969494a8;
        background-color: #eaeff5;
    }

    .navbar-inverse {
        background-color: #6200ee;
        border-color: #24678e;
    }
    
    .content-wrapper{
        /*background: #fff;*/
        background: #ededed;
    }
    .list-view .item a.media { 
        border-bottom: 1px solid #4e6a8a29;
        color: #474a4c;
        font-weight: bold;
    }
    .list-view .item a.media:hover {
        text-decoration: none;
        background-color: #6200ee;
        color: #fff;
    }
    .box.box-primary {
        box-shadow: 0px 0px 5px #a7a7a7;
         
    }
    .box-header.with-border{
        border-bottom: 1px solid #394c7b;
        background: #6200ee;
        color: #fff;
    }
    .product-list-in-box>.item {
        border-bottom: 1px solid #2a334c38;
    }
    .item a{color:#333;}
    .navbar-inverse .navbar-toggle:hover, .navbar-inverse .navbar-toggle:focus{
        background-color: #6200ee;
    }
</style>
<?php \appxq\sdii\widgets\CSSRegister::end(); ?>
 