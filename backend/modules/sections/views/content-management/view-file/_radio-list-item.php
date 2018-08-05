<?php
    use yii\helpers\Html;
?>
<div style="display: flex;">
    <div style="flex-grow: 2">
        <?php
            echo Html::radio($name, $checked, [
                'value' => $value,
                'label' => Html::encode($label),
                'disabled' => $disabled,
           ]);
         ?>
    </div>
    <div class="button">
        <?php 
            echo Html::button("<i class='fa fa-pencil'></i>", [
                 'data-id' => $value,
                'id'=>"id-{$value}",
                //'data-parent_id' => Yii::$app->request->get('id', '0'),
                'data-action' => 'update-section',
                'class' => 'btn btn-primary btn-xs btnCall',
                'title' => Yii::t('appmenu', 'Edit'),
                'data-url' => '/sections/file-management/update'
            ]);
            echo " ";
            echo Html::button("<i class='fa fa-trash'></i>", [
                'data-id' => $value,
                'id'=>"id-{$value}",
                'data-action' => 'delete',
                'class' => 'btn btn-danger btn-xs btnCall',
                'title' => Yii::t('appmenu', 'Delete'),
                'data-url' => '/sections/session-management/delete',
                'data-method' => 'POST'
            ]);
        ?>
    </div>
</div>
 
 

<?php 
    $modal = "modal-contents";
?>
<?php \richardfan\widget\JSRegister::begin();?>

<script>
   $("#id-<?= $value?>").on('click', function(){
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