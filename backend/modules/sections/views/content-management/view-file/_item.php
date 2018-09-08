<?php 
    use yii\helpers\Html;
?>
<div style='margin-bottom:10px;text-align:center;'>
    <?php 
         echo Html::button("<i class='fa fa-trash'></i>", [
                    'data-id' => $model['id'],
                    'id'=>$model['id'],
                    //'data-parent_id' => Yii::$app->request->get('id', '0'),
                    'data-action' => 'delete',
                    'class' => 'btn btn-danger btn-xs btnDelete',
                    'title' => Yii::t('appmenu', 'Delete'),
                    'data-url' => '/sections/file-management/delete-file',
                    'data-method' => 'POST'
                ]);
    ?>
    <input type="checkbox" data-id="<?= $model['id']?>" value="<?= $model['id']?>">
</div>    
<a href="<?= "/sections/content-management/view-file?content_id={$_GET['content_id']}&file_id={$model['id']}&filet_id={$model['file_type']}"?>" style="margin-top: 5px;" href=""   data-id="<?= $model['id']?>" id="<?= "btn-{$model['id']}"?>" data-action="view-file" class="content-popup btnCall text-left">
    <?php
        if($model['file_type'] == '2'){
            echo Html::img("{$model['file_path']}/thumbnail/{$model['file_name']}", 
                    [
                        'class'=>'img img-responsive img-rounded',
                        'style'=>''
            ]);            
        }else if($model['file_type'] == '3'){
            echo "
                <video style='width:100%;height: 100px;' controls>
                    <source src='{$model['file_path']}/{$model['file_name']}' type='video/mp4'>                 
                    Your browser does not support the video tag.
                </video>
            ";         
        }else if($model['file_type'] == '4'){
            echo "            
                <audio controls style='width:100%;height: 100px;'>
                    <source src='{$model['file_path']}/{$model['file_name']}' type='audio/mpeg'>                 
                    Your browser does not support the video tag.
                </audio>
                ";
        }else if($model['file_type'] == '6'){
            echo Html::img("{$model['file_path']}/{$model['file_name']}", 
                [
                    'class'=>'img img-responsive img-rounded',
                    'style'=>'width:100px;height: 80px;'
                ]);
        }else{
            
        }
        $name_str = backend\modules\sections\classes\JFiles::lengthName($model['file_name_org']);
        echo "<div>{$name_str}</div>";
    ?>
</a>


 
<?php $this->registerCss("a{color:#000;}")?>

<?php $this->registerJs("
    $('#".$model['id']."').on('click', function(){         
        let action = $(this).attr('data-action');
        let id       = $(this).attr('data-id');
        let url      = $(this).attr('data-url');
        yii.confirm('". Yii::t('file', 'Confirm Delete?')."', function(){
            $.post(url, {id:id}, function(result){                    
               ".\appxq\sdii\helpers\SDNoty::show('result.message', 'result.status')."
               $('#img-".$model['id']."').remove();
            });
        });
        return false;   
    });
    
")?>
<?php \richardfan\widget\JSRegister::begin();?>
<script>
        $("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });//Check All
</script>
<?php \richardfan\widget\JSRegister::end();?>
 

