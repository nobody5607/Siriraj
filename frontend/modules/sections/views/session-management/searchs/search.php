<?php 
    $this->title = isset($_GET['txtsearch']) ? $_GET['txtsearch'] : Yii::t('section', 'Section');
?>
<div class="row">
    <div style="margin-top:40px;"></div>

 
<div style="margin-top:20px;"></div>
<div class="col-md-10 col-md-offset-1">
    <?php 
        echo yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'item'],
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
                'delay'=>'1000',
                'triggerTemplate'=>'
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="ias-trigger" style="text-align: center; cursor: pointer;"><a class="btn btn-primary btn-block btnScroll">{text}</a></div>
                        </div>
                    </div>
                ',
                'noneLeftText'=>'',
                'eventOnScroll'=>"function(){
                    let scrollHeight = $(document).height();
                    let scrollPosition = $(window).height() + $(window).scrollTop();
                    if ((scrollHeight - scrollPosition) / scrollHeight === 0) {
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
</style>
<?php    appxq\sdii\widgets\CSSRegister::end()?>