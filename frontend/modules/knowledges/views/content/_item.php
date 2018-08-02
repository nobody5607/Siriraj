<div class="text-center">
    <a href='#' class="content-data" data-id='<?= $model['id']?>'>  
        <?php 
            if($model['file_type'] == 2){
                //render image
               echo \yii\helpers\Html::img("/images/{$model['file_name_org']}", ['class'=>'img img-rounded', 'style'=>'width:100px;']);
            }
        ?>
    </a>     
</div>
<?php \richardfan\widget\JSRegister::begin(); ?>
<script>
    $('.content-data').on('click', function(){
       $('#modal-content').modal('show');
       return false;
    });
    
</script>
<?php \richardfan\widget\JSRegister::end();?>