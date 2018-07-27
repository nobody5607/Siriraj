<?php
    $this->title= Yii::t('section','ห้องความรู้');
    $this->params['breadcrumbs'][] = $this->title;
?> 


<div class="row header-bar">
    <div class="col-md-3 col-sm-6 header-bar-left">
        <div>ห้องความรู้</div>
    </div>
    <div class="col-md-9 col-sm-6"></div>
</div>
<div class="row content-bar">
    <div class="row padding-10">
        <div class="col-md-3 col-xs-3 col-lg-3 col-sm-3 text-center">
            <button class="btn btn-success"><i class="fa fa-plus"></i> Add</button>
        </div>
        <div class="col-md-9 col-xs-9 col-lg-9 col-sm-9" style="padding-left: 26px; ">
            <input type="checkbox"/> check all
            <button class="btn btn-danger"><i class="fa fa-trash"></i> ลบ</button> 
        </div>
    </div>
        <div class="col-md-3 col-border-right section-left">
            <div class="box box-widget widget-user-2">           
                <div class="box-footer no-padding">
                    <?= \yii\widgets\ListView::widget([
                            'dataProvider' => $dataProvider,
                            'options' => [
                                'tag' => 'ul',
                                'class' => 'nav nav-stacked',
                                'id' => 'section-all',
                            ],
                            'itemOptions' => function($model) {
                                return ['tag'=>'li','data-id' => $model['id'], 'class' => 'section-items'];
                            },
                            'layout' => "{pager}\n{items}\n",
                            'itemView' => function ($model, $key, $index, $widget) {
                                return $this->render('_item', ['model' => $model]);
                            },
                        ]);?>            
                </div>
            </div>
            <!-- /.widget-user -->
        </div>
     
    <div class="col-md-9 section-right">
        <?=
        \yii\widgets\ListView::widget([
            'dataProvider' => $contentProvider,
            'options' => [
                'tag' => 'div',
                'class' => 'content-list',
                'id' => 'section-all',
            ],
            'itemOptions' => function($model) {
                return ['tag' => 'div', 'data-id' => $model['id'], 'class' => 'box box-widget'];
            },
            'layout' => "{items}\n{pager}",
            'itemView' => function ($model, $key, $index, $widget) {
                return $this->render('_content', ['model' => $model]);
            },
                    
        ]);
        ?>      
    </div>
</div>
 <?php\appxq\sdii\widgets\CSSRegister::begin();?>
<style>
    .widget-user-2 .widget-user-header {
        padding: 5px;
    }
    .widget-user-2 .widget-user-username, .widget-user-2 .widget-user-desc {
        margin-left: 15px;
    }
    .widget-user-2 .widget-user-username {
        font-size: 14pt;
    }
</style>
<?php\appxq\sdii\widgets\CSSRegister::end();?>

<?php $this->registerJs("
    $('.padding-10').css({padding:'10px'});
    web_device=function(){
        $('.content-header>.breadcrumb').css({
            position: 'fixed',
            marginTop: '50px',
            top: '1px',
            right: '0',
            float: 'none',
            background: '#ecf0f5',
            paddingLeft: '10px',
            border: 'navajowhite',
            padding: '10px',
            width: '100%',
            left: '0',
            borderBottom: '1px solid #cccbcb',
        });
        $('.content-header>.breadcrumb>li>a , .breadcrumb > .active').css({
            fontSize: '12pt'
        });
        $('.content').css({
             background: '#fff',
             marginTop: '60px',
        });
        $('body').css({
            overflow: 'hidden'
        });
        $('.header-bar').css({
            background: '#ecf0f58f',
            position: 'fixed',
            top: '90px',
            zIndex: '1',
            width: '100%',
            paddingLeft: '10px',
            borderBottom: '1px solid #bebfbf2e',
        });
        $('.header-bar-left').css({
            textAlign: 'left',
            fontSize: '16pt',
            padding: '5px',
            color: '#444'
        });
        $('.content-bar').css({
            position: 'fixed',
            zIndex: '1',
            top: '135px',
            left: '20px',
            background: '#fff',
            width: '100%',
        });
        $('.col-border-right').css({
            padding:'0',    
            borderRight: '1px solid #d1d4d8',
            width: '341px'
        });
        $('.section-left').css({
            height: '100%',
            position: 'fixed',   
            zIndex: '1',      
            backgroundColor: '#fff',
            overflowX: 'hidden'
        });
        $('.section-right').css({
            height: '100%',
            position: 'fixed',
            zIndex: '1',
            backgroundColor: '#fff',
            overflowX: 'hidden',
            left: '345px'
        });
        $('.content-wrapper').css({background:'#fff'});
        
    }
    mobile_device=function(){
        $('.content-header>.breadcrumb').css({
            position: 'fixed',
            marginTop: '50px',
            top: '1px',
            right: '0',
            float: 'none',
            background: '#ecf0f5',
            paddingLeft: '10px',
            border: 'navajowhite',
            padding: '10px',
            width: '100%',
            left: '0',
            borderBottom: '1px solid #cccbcb',
            zIndex: '1'
        });
        $('.content-header>.breadcrumb>li>a , .breadcrumb > .active').css({
            fontSize: '12pt'
        });
         $('.header-bar').css({
            background: 'rgb(236, 240, 245)',
            position: 'fixed',
            top: '94px',
            zIndex: '1',
            width: '100%',
            paddingLeft: '10px',
            borderBottom: '1px solid rgba(190, 191, 191, 0.72)',
        });
        $('.header-bar-left').css({
            textAlign: 'left',
            fontSize: '16pt',
            padding: '5px',
            color: '#444'
        });
        $('.content-bar').css({marginTop: '50px'});
    }

    //detect mobile device
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
         mobile_device();
    }else{
        web_device();
    }
    $('.content-list').css({marginBottom:'300px'});
    
")?>