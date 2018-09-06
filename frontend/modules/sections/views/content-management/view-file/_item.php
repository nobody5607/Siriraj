<?php 
    use yii\helpers\Html;
    use yii\helpers\Url;
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
    ?>
</a>