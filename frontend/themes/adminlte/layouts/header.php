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
     'brandLabel' => 'Siriraj',
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
<?php \appxq\sdii\widgets\CSSRegister::begin();?>
<style>
     
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
            width: 98%;
         
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
    
     
</style>
<?php \appxq\sdii\widgets\CSSRegister::end();?>
 