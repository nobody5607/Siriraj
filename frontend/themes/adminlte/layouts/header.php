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
    $search = '';
    $search .= '
        <form class="navbar-form navbar-left" role="search">
            <div class="col-md-8">
                <div class="input-group">
                
                    <input type="hidden" name="search_param" value="all" id="search_param">         
                    <input type="text" class="form-control" name="x" placeholder="ค้นหา">
                    <div class="input-group-btn search-panel">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="border-radius:0;background: #fff;">
                            <span id="search_concept">เลือกประเภทไฟล์</span> <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                           
                        ';
    $type= frontend\modules\knowledges\classes\JFiles::getTypeFile();
            foreach($type as $t){
                $search .= "<li data-id='{$t['id']}'><a href='#{$t['name']}' data-id='{$t['id']}'>{$t['name']}</a></li>";
            }
        $search .= '</ul>
                    </div>
                    <span class="input-group-btn">
                        <button class="btn btn-default  btn-search" type="button"><span class="glyphicon glyphicon-search"></span></button>
                    </span>
                </div>
            </div></form>';
            
echo $search;

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
<?php\appxq\sdii\widgets\CSSRegister::begin();?>
<style>
    

</style>
<?php\appxq\sdii\widgets\CSSRegister::end();?>