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
        'class' => 'page-container navbar navbar-inverse',
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
    .content-header>.breadcrumb{
       width: 98%;
       font-size: 12pt;
       background:#d2d6de;
    }
    
</style>
<?php \appxq\sdii\widgets\CSSRegister::end();?>
 