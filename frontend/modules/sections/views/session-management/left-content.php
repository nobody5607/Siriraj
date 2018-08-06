<?php
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\helpers\Html;


  
?>

<?=
ListView::widget([
    'id' => 'ezf_dad',
    'dataProvider' => $dataProvider,
    'itemOptions' => ['class' => 'item dads-children'],
    'layout' => '<div class=" sidebar-nav-title text-right" ></div>{items}<div class="list-pager">{pager}</div>',
    'itemView' => function ($model, $key, $index, $widget) {
        return $this->render('_left-content-item', [
                    'model' => $model,
                    'key' => $key,
                    'index' => $index,
                    //'widget' => $widget,
                    'ezf_id' => $model['id'],
        ]);
    },
    'emptyText'=> '&nbsp;&nbsp;&nbsp;&nbsp;'.\yii\helpers\Html::a('<i class="fa fa-chevron-left"></i> Back', Yii::$app->request->referrer, ['data-url'=>Yii::$app->request->referrer, 'id'=>'backs','class'=>'btn btn-default btn-sm']),
])
?>
 


<?php
\richardfan\widget\JSRegister::begin([
    //'key' => 'bootstrap-modal',
    'position' => \yii\web\View::POS_READY
]);
?>
<script>
    $('.page-column').addClass('items-views');     
    $('#ezf_dad').dad({
        draggable:'.draggable',
        callback:function(e){
            var positionArray = [];
            $('#ezf_dad').find('.dads-children').each(function(){
                positionArray.push($(this).attr('data-key'));
            });

            $.post('<?= \yii\helpers\Url::to(['/ezforms2/data-lists/order-update'])?>',{position:positionArray},function(result){

            });
        }
    });

    itemsSidebar();

    $('#main-nav-app .navbar-header').append('<a class="a-collapse glyphicon glyphicon-th-list navbar-toggle" data-toggle="collapse" data-target="#items-side">&nbsp;</a>');

    $('#favorite-form-manager').click(function(){
        var url = $(this).attr('data-url');
        modalEzform(url);
        return false;
    });
    
    $('#modal-ezform-favorite').on('hidden.bs.modal', function (e) {
        location.reload();
    });
    
    function modalEzform(url) {
    $('#modal-ezform-favorite .modal-content').html('<div class=\"sdloader \"><i class=\"sdloader-icon\"></i></div>');
    $('#modal-ezform-favorite').modal('show')
    .find('.modal-content')
    .load(url);
}

    function  getHeight() {
        var sidebarHeight = $(window).height() - 51; //- $('.header').height()        
        if ($('body').hasClass("page-footer-fixed")) {
            sidebarHeight = sidebarHeight - $('.footer').height();
        }
        return sidebarHeight;
    }

    function  itemsSidebar() {
        var itemside = $('#items-side-scroll');
//         if ($('.page-sidebar-fixed').length === 0) {             
//            return;
//        }
        if ($(window).width() >= 992) {
            var sidebarHeight = getHeight();
            
            itemside.slimScroll({
                size: '7px',
                color: '#a1b2bd',
                opacity: .8,
                position: 'right',
                height: sidebarHeight,
                allowPageScroll: false,
                disableFadeOut: false
            });
        } else {
            if (itemside.parent('.slimScrollDiv').length === 1) {
                itemside.slimScroll({
                    destroy: true
                });
                itemside.removeAttr('style');
                $('.items-sidebar').removeAttr('style');
            }
        }

    }

</script>
<?php \richardfan\widget\JSRegister::end(); ?>


<?php appxq\sdii\widgets\CSSRegister::begin();?>
<style>
/*    .list-view .item a.media { 
        border-bottom-style: dashed;
    }
    .items-sidebar.navbar-collapse{ 
        background-color: #fff; 
    }
    .list-view .item a.media{
        padding: 5px;         
        font-size: 14px;
    }
    @media (min-width: 768px){
        .items-sidebar.navbar-collapse{
            width: 245px;
        }
        .content-wrapper { 
            background-color: #ffffff;
        }
    }
    @media (min-width: 992px)
    {
        .col-md-offset-2 {
            margin-left: 17.5%;
        }
    }*/
</style>
<?php appxq\sdii\widgets\CSSRegister::end();?>