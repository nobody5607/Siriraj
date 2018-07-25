<?php
use yii\helpers\Html;
use frontend\components\NavBar;
use yii\bootstrap\Nav;
\frontend\components\AppComponent::navbarRightMenu();
?>

<header class="main-header">
    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

<?php
 NavBar::begin([
    'id' => 'main-nav-app',
     'brandLabel' => 'My Company',
     'brandUrl' => Yii::$app->homeUrl,
    'innerContainerOptions' => ['class' => 'container-fluid'],
    'options' => [
        'class' => 'page-container navbar navbar-inverse navbar-fixed-top',
    ],
]);

echo Nav::widget([
    'options' => ['class' => 'navbar-nav'],
    'items' => [        
        ['label' => Yii::t('appmenu','ห้องความรู้'), 'icon' => 'file-code-o', 'url' => ['/knowledges/section'],
            'active'=>(Yii::$app->controller->module->id == 'knowledges' && Yii::$app->controller->id == 'section') ? true : false],
    ]
]);
echo \yii\bootstrap\Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => isset(Yii::$app->params['navbarR']) ? Yii::$app->params['navbarR'] : [],
]);

NavBar::end();
?>
     
</header>
<?php \appxq\sdii\widgets\CSSRegister::begin();?>
<style> 
    .main-header .navbar{
          /*margin-left: 0px;*/  
    }
    @media (min-width: 768px){
        .sidebar-mini.sidebar-collapse .main-header .navbar {
            /*margin-left: 0;*/
        }
    }
    .navbar-inverse .navbar-toggle:hover, .navbar-inverse .navbar-toggle:focus {
        background-color: #056298;
    }
    .navbar-inverse .navbar-toggle {
        margin-top: 3px;
    }
    .navbar-inverse .navbar-collapse, .navbar-inverse .navbar-form {
        border-color: #056298;
    }
    @media (max-width: 767px){
        .main-sidebar {
            padding-top: 50px;
        }
        .fixed .content-wrapper, .fixed .right-side {
            padding-top: 45px;
        }
    }
   .content-header>.breadcrumb { 
        left: 15px; 
        padding-left: 10px; 
        padding: 8px 15px;
        list-style: none;
        background-color: #f8f8f8;
        border-radius: 4px;
        border: 1px solid #e7e7e7;
    }
    .content-header>.breadcrumb>li+li:before {
        content: '/\00a0';
        color: #2f2f2f;
    }
    @media (max-width: 991px){
        .content-header>.breadcrumb {           
            background: #d3d5da;
            padding-left: 10px;
            border: 1px solid #c1bdbd;
        }
    }

    .content-header>.breadcrumb>li>a {
        color: #3c8dbc; 
        font-family: sans-serif;
        font-size: 12pt;
    }
    .breadcrumb > .active {
        color: #222d32;
        font-size: 12pt;
    }


</style>
<?php \appxq\sdii\widgets\CSSRegister::end();?>
