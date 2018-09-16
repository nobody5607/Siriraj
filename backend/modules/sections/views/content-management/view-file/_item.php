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
            echo Html::img("{$model['file_path']}/thumbnail/{$model['file_view']}", [
                'class' => 'img img-responsive img-rounded',
                'style' => 'height:120px;    margin: 0 auto;'
            ]);            
        }else if($model['file_type'] == '3'){
             
            if(isset($model['file_thumbnail']) || isset($model['file_thumbnail']) != ""){
                echo "<img src='{$model['file_thumbnail']}'>";
            }else{
                echo "            
                    <div style='font-size: 45pt;text-align: center;padding-top: 15px;'><i class='fa fa-file-video-o'></i></div>
                ";   
            }
                
        }else if($model['file_type'] == '4'){
            echo "            
                <div style='font-size: 50pt;text-align: center;padding-top: 15px;'><i class='fa fa-music'></i></div>
            ";
        }else if ($model['file_type'] == 5 || $model['file_type'] == 6 || $model['file_type'] == 7){
            $fileNameStr = explode(".", $model['file_name']);
            $icon = "";
            if ($fileNameStr[1] == 'doc' || $fileNameStr[1] == 'docx') {
                $icon = "<i class='fa fa-file-word-o'></i>";
            } else if ($fileNameStr[1] == 'ppt' || $fileNameStr[1] == 'pptx') {
                $icon = "<i class='fa fa-file-powerpoint-o'></i>";
            } else if ($fileNameStr[1] == 'xls' || $fileNameStr[1] == 'xlsx') {
                $icon = "<i class='fa fa-file-excel-o'></i>";
            } else if ($fileNameStr[1] == 'pdf') {
                $icon = "<i class='fa fa-file-pdf-o'></i>";
            } else if ($fileNameStr[1] == 'zip' || $fileNameStr[1] == 'rar') {
                $icon = "<i class='fa fa-file-pdf-o'></i>";
            } else {
                $icon = "<i class='fa fa-file-archive-o'></i>";
            }
            echo "<div style='font-size: 45pt;text-align: center;padding-top: 15px;'>{$icon}</div>";
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
 

