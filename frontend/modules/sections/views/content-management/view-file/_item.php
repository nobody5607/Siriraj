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
                echo "
                    <div class='row'>
                        <div class='col-md-6 col-xs-6 col-sm-6'>
                            <label class='container' >
                                <input type='checkbox'  class='checkbox' name='check_str' data-id={$model['id']}>
                                <span class='checkmark' style='margin-top: -5px;'></span>
                            </label>
                        </div>
                        <div class='col-md-6 col-xs-6 col-sm-6' style='padding-top:5px;'>
                            <a title='Download' class='btn btn-sm btn-primary download pull-right' data-type='{$model['file_type']}' data-id='{$model['id']}' data-name='{$model['file_name_org']}' href='#'><i class='fa fa-download'></i></a>
                        </div>
                    </div>
                    <div class='clearfix' style='    margin-bottom: 20px;'></div>
                ";
                      
            }
            echo "<a href='/sections/content-management/view-file?content_id={$_GET['content_id']}&file_id={$model['id']}&filet_id={$model['file_type']}' style='margin-top: 5px;' href='#'  data-id='{$model['id']}' id='btn-{$model['id']}' data-action='view-file' class='content-popup btnCall text-left'>";
            echo Html::img("{$model['file_path']}/thumbnail/{$model['file_view']}", 
                    [
                        'class'=>'img img-responsive img-rounded',
                        'style'=>'height:120px;    margin: 0 auto;'
            ]);
            echo "</a>";
           
        }else if($model['file_type'] == '3'){
             if((!Yii::$app->user->isGuest) && (Yii::$app->user->can("administrator") || Yii::$app->user->can("admin"))){
                //echo Html::checkbox('checked', '', ['data-id'=>$model['id'] , 'class'=>'checkbox', 'name'=>"check[]"]); 
                echo "
                    <div class='row'>
                        <div class='col-md-6 col-xs-6 col-sm-6'>
                            <label class='container' >
                                <input type='checkbox'  class='checkbox' name='check_str' data-id={$model['id']}>
                                <span class='checkmark'></span>
                            </label>
                        </div>
                        <div class='col-md-6 col-xs-6 col-sm-6' style='padding-top:5px;'>
                            <a title='Download' class='btn btn-sm btn-primary download pull-right' data-type='{$model['file_type']}' data-id='{$model['id']}' data-name='{$model['file_name_org']}' href='#'><i class='fa fa-download'></i></a>
                        </div>
                    </div>
                    <div class='clearfix'></div>
                ";
                         
            }
            echo "<a href='/sections/content-management/view-file?content_id={$_GET['content_id']}&file_id={$model['id']}&filet_id={$model['file_type']}' style='margin-top: 5px;' href='#'  data-id='{$model['id']}' id='btn-{$model['id']}' data-action='view-file' class='content-popup btnCall text-left'>";
            echo "            
                <div style='font-size: 50pt;text-align: center;padding-top: 15px;'><i class='fa fa-file-video-o'></i></div>
            ";
            echo "</a>";
        }else if($model['file_type'] == '4'){
            if((!Yii::$app->user->isGuest) && (Yii::$app->user->can("administrator") || Yii::$app->user->can("admin"))){
                //echo Html::checkbox('checked', '', ['data-id'=>$model['id'] , 'class'=>'checkbox', 'name'=>"check[]"]); 
                echo "
                    <div class='row'>
                        <div class='col-md-6 col-xs-6 col-sm-6'>
                            <label class='container' >
                                <input type='checkbox'  class='checkbox' name='check_str' data-id={$model['id']}>
                                <span class='checkmark'></span>
                            </label>
                        </div>
                        <div class='col-md-6 col-xs-6 col-sm-6' style='padding-top:5px;'>
                            <a title='Download' class='btn btn-sm btn-primary download pull-right' data-type='{$model['file_type']}' data-id='{$model['id']}' data-name='{$model['file_name_org']}' href='#'><i class='fa fa-download'></i></a>
                        </div>
                    </div>
                    <div class='clearfix'></div>
                ";
                         
            }
            echo "<a href='/sections/content-management/view-file?content_id={$_GET['content_id']}&file_id={$model['id']}&filet_id={$model['file_type']}' style='margin-top: 5px;' href='#'  data-id='{$model['id']}' id='btn-{$model['id']}' data-action='view-file' class='content-popup btnCall text-left'>";
            echo "            
                <div style='font-size: 50pt;text-align: center;padding-top: 15px;'><i class='fa fa-music'></i></div>
            ";
            echo "</a>";
        }else if($model['file_type'] == '6'){           
            if((!Yii::$app->user->isGuest) && (Yii::$app->user->can("administrator") || Yii::$app->user->can("admin") || Yii::$app->user->can("users"))){
                echo "
                    <div class='row'>
                        <div class='col-md-6 col-xs-6 col-sm-6'>
                            <label class='container' >
                                <input type='checkbox'  class='checkbox' name='check_str' data-id={$model['id']}>
                                <span class='checkmark'></span>
                            </label>
                        </div>
                        <div class='col-md-6 col-xs-6 col-sm-6' style='padding-top:5px;'>
                            <a title='Download' class='btn btn-sm btn-primary download pull-right' data-type='{$model['file_type']}' data-id='{$model['id']}' data-name='{$model['file_name_org']}' href='#'><i class='fa fa-download'></i></a>
                        </div>
                    </div>
                    <div class='clearfix'></div>
                ";
            }
            echo "<a href='/sections/content-management/view-file?content_id={$_GET['content_id']}&file_id={$model['id']}&filet_id={$model['file_type']}' style='margin-top: 5px;' href='#'  data-id='{$model['id']}' id='btn-{$model['id']}' data-action='view-file' class='content-popup btnCall text-left'>";
            echo Html::img("{$model['file_path']}/{$model['file_name']}", 
                [
                    'class'=>'img img-responsive img-rounded',
                    'style'=>'width:100px;height: 80px;'
                ]);
            echo "</a>";
        }else{              
            if((!Yii::$app->user->isGuest) && (Yii::$app->user->can("administrator") || Yii::$app->user->can("admin") || Yii::$app->user->can("users"))){
                echo "
                    <div class='row'>
                        <div class='col-md-6 col-xs-6 col-sm-6'>
                            <label class='container' >
                                <input type='checkbox'  class='checkbox' name='check_str' data-id={$model['id']}>
                                <span class='checkmark'></span>
                            </label>
                        </div>
                        <div class='col-md-6 col-xs-6 col-sm-6' style='padding-top:5px;'>
                            <a title='Download' class='btn btn-sm btn-primary download pull-right' data-type='{$model['file_type']}' data-id='{$model['id']}' data-name='{$model['file_name_org']}' href='{$model['file_path']}/{$model['file_name']}'><i class='fa fa-download'></i></a>
                        </div>
                    </div>
                    <div class='clearfix'></div>
                ";
            }
            echo "<a href='/sections/content-management/view-file?content_id={$_GET['content_id']}&file_id={$model['id']}&filet_id={$model['file_type']}' style='margin-top: 5px;' href='#'  data-id='{$model['id']}' id='btn-{$model['id']}' data-action='view-file' class='content-popup btnCall text-left'>";
            echo "<div class='text-center'><i class='fa fa-file-o' style='font-size:30pt;'></i></div>";
        }   echo "</a>";
        $name_str = backend\modules\sections\classes\JFiles::lengthName($model['file_name_org']);
        echo "<div title='{$model['file_name_org']}'>{$name_str}</div>";
        
        
    ?>
</a>
 
 
<?php    richardfan\widget\JSRegister::begin();?>
<script> 
    $('.download').on('click', function(){
        let url = '/site/convert';//$(this).attr('data-href');
        let id = $(this).attr('data-id');
        let name = $(this).attr('data-name');
        let type = $(this).attr('data-type');
        //download("data:image/gif;base64,R0lGODlhRgAVAIcAAOfn5+/v7/f39////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////yH5BAAAAP8ALAAAAABGABUAAAj/AAEIHAgggMGDCAkSRMgwgEKBDRM+LBjRoEKDAjJq1GhxIMaNGzt6DAAypMORJTmeLKhxgMuXKiGSzPgSZsaVMwXUdBmTYsudKjHuBCoAIc2hMBnqRMqz6MGjTJ0KZcrz5EyqA276xJrVKlSkWqdGLQpxKVWyW8+iJcl1LVu1XttafTs2Lla3ZqNavAo37dm9X4eGFQtWKt+6T+8aDkxUqWKjeQUvfvw0MtHJcCtTJiwZsmLMiD9uplvY82jLNW9qzsy58WrWpDu/Lp0YNmPXrVMvRm3T6GneSX3bBt5VeOjDemfLFv1XOW7kncvKdZi7t/S7e2M3LkscLcvH3LF7HwSuVeZtjuPPe2d+GefPrD1RpnS6MGdJkebn4/+oMSAAOw==", "dlDataUrlBin.gif", "image/gif");
        if(type == '5'){
            
            downloadFile($(this).attr('href'), name);
        }else{
            $.get(url, {id:id}, function(data){
             console.log(name);
             download(data, name);
            });
        }
         
        return false; 
    }); 
    
    function downloadFile(url,name){ 

        var a = document.createElement("a");
        a.style.display = "none";
        a.href = url;
        a.download = name; 
        a.click();
    }
</script>
<?php    richardfan\widget\JSRegister::end();?>