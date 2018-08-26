<?php     
    use yii\bootstrap\Html;    
    \janpan\jn\assets\ListdataAsset::register($this);
    \janpan\jn\assets\EzfToolAsset::register($this);
    $this->title= Yii::t('section',$title);    
    if($breadcrumb){
       foreach($breadcrumb as $b){
        $this->params['breadcrumbs'][] = $b;  
      } 
    }else{
       // $this->params['breadcrumbs'][]=$this->title;
    }
?> 
   
<div class="row content-bar">
    <?= $this->render('left-content',[
        'dataProvider'=>$dataProvider, 
        'data_id'=> isset($_GET['id']) ? $_GET['id'] : $content_section['id'], 
    ]);?>
    <?= 
        $this->render('right-content',[
            'contentProvider'=>$contentProvider, 
            'data_id'=> isset($_GET['id']) ? $_GET['id'] : $content_section['id'], 
            'parent_id'=>$content_section['id'],
            'public'=>$public,
            'content_section'=>$content_section]
    );?>    
</div>
 
 

<?php 
    $modal = "modal-contents";
?>
<?php \richardfan\widget\JSRegister::begin();?>

<script>
   $('.btnCall').on('click', function(){
       let id       = $(this).attr('data-id');
       let url      = $(this).attr('data-url');
       let action   = $(this).attr('data-action');
       let parent_id = $(this).attr('data-parent_id'); 
       let params   = {id:id, parent_id:parent_id};
       if(action == 'delete'){
           delete_form(url , id);
       }else{
           get_form(url , params); 
       }      
       return false; 
   });
   get_form=function(url , params){
       $('#<?= $modal?> .modal-content').html('<div class=\"sdloader \"><i class=\"sdloader-icon\"></i></div>');
       $('#<?= $modal?>').modal('show');
       $.get(url, params, function(res){
           $('#<?= $modal?> .modal-content').html(res);
       });
   } 
   delete_form=function(url, id){
        yii.confirm('<?= Yii::t('user', 'Confirm Delete?') ?>', function(){
            $.post(url, {id:id}, function(result){
                <?= appxq\sdii\helpers\SDNoty::show('result.message', 'result.status') ?>
                setTimeout(function(){
                    location.reload();
                },1000);
            });
        });   
    return false;
   }

   
</script>
<?php \richardfan\widget\JSRegister::end();?>

<?php \appxq\sdii\widgets\CSSRegister::begin();?>
<style>
    .box.box-primary {
        border: none;
        box-shadow: 0px 0px 1px #cacaca;
    }
</style>
<?php \appxq\sdii\widgets\CSSRegister::end();?>
<?php
\richardfan\widget\JSRegister::begin([
    //'key' => 'bootstrap-modal',
    'position' => \yii\web\View::POS_READY
]);
?>
<script>
     $('#ezf_dad').dad({
        draggable:'.draggable',
        callback:function(e){
            var positionArray = [];
            $('#ezf_dad').find('.dads-children').each(function(){
                positionArray.push($(this).attr('data-id'));
            });
            $.post('<?= \yii\helpers\Url::to(['/sections/session-management/forder'])?>',{data:positionArray.toString()},function(result){
                console.log(result);
                return false;
            });
        }
    });
</script>
<?php \richardfan\widget\JSRegister::end(); ?>