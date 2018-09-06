<?php 
    use yii\helpers\Html;
    use yii\helpers\Url;
    \janpan\jn\assets\file_download\FileDownloadAsset::register($this);
    /*
    Yii::$app->user->can("administrator");
    Yii::$app->user->can("admin");
    Yii::$app->user->can("user");
    */
?> 
<?php $this->registerCss("a{color:#000;}")?>


<a href="<?= "/sections/content-management/view-file?content_id={$_GET['content_id']}&file_id={$model['id']}&filet_id={$model['file_type']}"?>" style="margin-top: 5px;" href=""   data-id="<?= $model['id']?>" id="<?= "btn-{$model['id']}"?>" data-action="view-file" class="content-popup btnCall text-left">
    <?php
        
        if($model['file_type'] == '2'){
            if((!Yii::$app->user->isGuest) && (Yii::$app->user->can("administrator") || Yii::$app->user->can("admin") || Yii::$app->user->can("users"))){
                //echo Html::checkbox('checked', '', ['data-id'=>$model['id'] , 'class'=>'checkbox', 'name'=>"check[]"]); 
                echo "
                  <label class='container' >
                        <input type='checkbox'  class='checkbox' name='check_str' data-id={$model['id']}>
                        <span class='checkmark'></span>
                  </label>  
                ";
            }
            echo Html::img("{$model['file_path']}/thumbnail/{$model['file_view']}", 
                    [
                        'class'=>'img img-responsive img-rounded',
                        'style'=>'height:100px;'
            ]);
           
        }else if($model['file_type'] == '3'){
            if((!Yii::$app->user->isGuest) && (Yii::$app->user->can("administrator") || Yii::$app->user->can("admin")) ){
                //echo Html::checkbox('checked', '', ['data-id'=>$model['id'] , 'class'=>'checkbox', 'name'=>"check[]"]); 
                echo "
                  <label class='container' >
                        <input type='checkbox'  class='checkbox' name='check_str' data-id={$model['id']}>
                        <span class='checkmark'></span>
                  </label>  
                ";
            }
            echo "
                <video style='width:100%;height: 100px;' controls>
                    <source src='{$model['file_path']}/{$model['file_name']}' type='video/mp4'>                 
                    Your browser does not support the video tag.
                </video>
            ";         
        }else if($model['file_type'] == '4'){
            if((!Yii::$app->user->isGuest) && (Yii::$app->user->can("administrator") || Yii::$app->user->can("admin"))){
                //echo Html::checkbox('checked', '', ['data-id'=>$model['id'] , 'class'=>'checkbox', 'name'=>"check[]"]); 
                echo "
                  <label class='container' >
                        <input type='checkbox'  class='checkbox' name='check_str' data-id={$model['id']}>
                        <span class='checkmark'></span>
                  </label>  
                ";
            }
            echo "            
                <audio controls style='width:100%;height: 100px;'>
                    <source src='{$model['file_path']}/{$model['file_name']}' type='audio/mpeg'>                 
                    Your browser does not support the video tag.
                </audio>
                ";
        }else if($model['file_type'] == '6'){           
            if((!Yii::$app->user->isGuest) && (Yii::$app->user->can("administrator") || Yii::$app->user->can("admin") || Yii::$app->user->can("users"))){
                echo "
                  <label class='container' >
                        <input type='checkbox'  class='checkbox' name='check_str' data-id={$model['id']}>
                        <span class='checkmark'></span>
                  </label>  
                ";
            }
            echo Html::img("{$model['file_path']}/{$model['file_name']}", 
                [
                    'class'=>'img img-responsive img-rounded',
                    'style'=>'width:100px;height: 80px;'
                ]);
        }else{              
            if((!Yii::$app->user->isGuest) && (Yii::$app->user->can("administrator") || Yii::$app->user->can("admin") || Yii::$app->user->can("users"))){
                echo "
                  <label class='container' >
                        <input type='checkbox'  class='checkbox' name='check_str' data-id={$model['id']}>
                        <span class='checkmark'></span>
                  </label>  
                ";
            }
            echo "<div class='text-center'><i class='fa fa-file-o' style='font-size:30pt;'></i></div>";
        }
        $name_str = backend\modules\sections\classes\JFiles::lengthName($model['file_name_org']);
        echo "<div title='{$model['file_name_org']}'>{$name_str}</div>";
        
        echo "<a class='btn btn-sm btn-info download' data-id='{$model['id']}' href='#'>Download</a>";
    ?>
</a>
 
 
<?php    richardfan\widget\JSRegister::begin();?>
<script> 
    $('.download').on('click', function(){
        let url = '/site/convert';//$(this).attr('data-href');
        let id = $(this).attr('data-id');
        //download("data:image/gif;base64,R0lGODlhRgAVAIcAAOfn5+/v7/f39////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////yH5BAAAAP8ALAAAAABGABUAAAj/AAEIHAgggMGDCAkSRMgwgEKBDRM+LBjRoEKDAjJq1GhxIMaNGzt6DAAypMORJTmeLKhxgMuXKiGSzPgSZsaVMwXUdBmTYsudKjHuBCoAIc2hMBnqRMqz6MGjTJ0KZcrz5EyqA276xJrVKlSkWqdGLQpxKVWyW8+iJcl1LVu1XttafTs2Lla3ZqNavAo37dm9X4eGFQtWKt+6T+8aDkxUqWKjeQUvfvw0MtHJcCtTJiwZsmLMiD9uplvY82jLNW9qzsy58WrWpDu/Lp0YNmPXrVMvRm3T6GneSX3bBt5VeOjDemfLFv1XOW7kncvKdZi7t/S7e2M3LkscLcvH3LF7HwSuVeZtjuPPe2d+GefPrD1RpnS6MGdJkebn4/+oMSAAOw==", "dlDataUrlBin.gif", "image/gif");
        $.get(url, {id:id}, function(data){
             
             download(data);
        }); 
        return false; 
    }); 
</script>
<?php    richardfan\widget\JSRegister::end();?>