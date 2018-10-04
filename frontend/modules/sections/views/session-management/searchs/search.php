<?php 
    $this->title = isset($_GET['txtsearch']) ? $_GET['txtsearch'] : Yii::t('section', 'Section');
?>

<div class="row" style="margin-top:20px;"> 
     
<div class="col-md-10 col-md-offset-1">
    <?php 
        $itemCount = $dataProvider->getModels();
        echo "<h1>";
            echo Yii::t('section','Keyword');
            echo " : ";
            echo isset($_GET['txtsearch']) ? $_GET['txtsearch'] : Yii::t('section','All');   
            
            
            echo " ";
            echo Yii::t('section','Found all');
            echo " ";
            echo count($itemCount);
            echo " ";
            echo Yii::t('section', 'Item');
        echo "</h1><br>"; 
        
        
   ?>
    <?php 
        echo yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'item col-md-4 col-50'],
            //'layout' => "{items}",
            'layout' => '<div class=" sidebar-nav-title text-right" >{summary}</div><div class="row">{items}</div><div class="clearfix">{pager}</div>',
            'itemView' => function ($model, $key, $index, $widget) {
            return $this->render('_item', [
                            'model' => $model,
                            'key' => $key,
                            'index' => $index,
                            //'widget' => $widget,
                            'ezf_id' => $model['id'],
                ]);
            },
            'pager' => [
                'class' => \kop\y2sp\ScrollPager::className(),
                'delay'=>'100',
                'triggerTemplate'=>'
                    <div class="row">
                        <div style="
                            margin: 0 auto;
                            width: 100%;
                            /* background: blue; */
                            position: absolute;
                            bottom: -20px;
                            left: 0;
                        ">
                            <div class="ias-trigger" style="text-align: center; cursor: pointer;"><a class="btn btn-primary btn-block btnScroll">'. Yii::t('section','Loading data').'</a></div>
                        </div>
                    </div>
                ',
                'noneLeftText'=>'',
                'eventOnScroll'=>"function(){
                    let scrollHeight = $(document).height();
                    let scrollPosition = $(window).height() + $(window).scrollTop();
                    if ((scrollHeight - scrollPosition) / scrollHeight == 0) {
                        //console.log(scrollPosition);
                        $( '.btnScroll' ).trigger('click');
                    }
                 }   
                "
            ]
       ]);
    ?> 
</div>
</div>
<?php    appxq\sdii\widgets\CSSRegister::begin()?>
<style>
    @media only screen and (min-width: 768px)
    {
        .cd-breadcrumb, .cd-multi-steps {
            width: 100%;
            max-width: 100%;
            margin-left: 0px;
            border: 1px solid #d2d6de;
            background:#fff;
        }
        .cd-breadcrumb li, .cd-multi-steps li {
            margin: 0.2em 0;
        }
    }
    .cd-breadcrumb.custom-separator li::after, .cd-multi-steps.custom-separator li::after {
        content: '/';
        height: 22px;
        width: 1px;
        background: transparent;
        vertical-align: bottom;
    }
    .cd-breadcrumb, .cd-multi-steps { ;
        padding: 1px; 
        margin-bottom:30px;
    }
    .ias-spinner{
            text-align: center;
        position: absolute;
        bottom: -20px;
        width: 100%;
        font-size: 20pt;
    }
    a.btn.btn-primary.btn-block.btnScroll {
        color: #fff;
        font-size: 10pt;
        width: 50%;
        margin: 0 auto;
        /* position: absolute; */
    }
</style>
<?php    appxq\sdii\widgets\CSSRegister::end()?>