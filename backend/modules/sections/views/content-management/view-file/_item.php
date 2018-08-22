<?php 
    use yii\helpers\Html;
     
    if($model['file_type'] == '2'){
        //image
        $link  = "";        
        $link .= Html::img("{$model['file_path']}/thumbnail/{$model['file_name']}", 
                [
                    'class'=>'img img-responsive img-rounded',
                    'style'=>'width:100px;height: 80px;'
                ]);
        $name_str = backend\modules\sections\classes\JFiles::lengthName($model['file_name_org']);
        $link .= "<div>{$name_str}</div>";
    }else if($model['file_type'] == '3'){
        //video
        $link = "";
        $link .= "
            <video style='width:100%;height: 100px;' controls>
                <source src='{$model['file_path']}/{$model['file_name']}' type='video/mp4'>                 
                Your browser does not support the video tag.
            </video>
        ";
        $name_str = backend\modules\sections\classes\JFiles::lengthName($model['file_name_org']);        
        $link .= "<div>{$name_str}</div>";
    }else if($model['file_type'] == '4'){
        //audio
        $link = "";
        $link .= "
            
            <audio controls style='width:100%;height: 100px;'>
                <source src='{$model['file_path']}/{$model['file_name']}' type='audio/mpeg'>                 
                Your browser does not support the video tag.
            </audio>
        ";
        $name_str = backend\modules\sections\classes\JFiles::lengthName($model['file_name_org']);
        $link .= "<div>{$name_str}</div>";        
    }else if($model['file_type'] == '6'){
        //image
        $link  = "";        
        $link .= Html::img("{$model['file_path']}/{$model['file_name']}", 
                [
                    'class'=>'img img-responsive img-rounded',
                    'style'=>'width:100px;height: 80px;'
                ]);
        $name_str = backend\modules\sections\classes\JFiles::lengthName($model['file_name_org']);
        $link .= "<div>{$name_str}</div>";
    }else{
       $name_str = backend\modules\sections\classes\JFiles::lengthName($model['file_name_org']);
          
       $link= " 
            <div><i class='fa fa-file'></i> {$name_str}</div>
        ";  
    }
    $taga = "";
    $taga .= "<div style='margin-bottom:10px;text-align:center;'>";            
            $taga .= Html::button("<i class='fa fa-trash'></i>", [
                'data-id' => $model['id'],
                'id'=>$model['id'],
                //'data-parent_id' => Yii::$app->request->get('id', '0'),
                'data-action' => 'delete',
                'class' => 'btn btn-danger btn-xs btnDelete',
                'title' => Yii::t('appmenu', 'Delete'),
                'data-url' => '/sections/file-management/delete-file',
                'data-method' => 'POST'
            ]);
        $taga .= "</div>";
    $taga .=  Html::a($link,"/sections/content-management/view-file?content_id={$_GET['content_id']}&file_id={$model['id']}&filet_id={$model['file_type']}" ,
    [
        'id'=>"btn-{$model['id']}",
        'data-action'=>'view-file',
        'class'=>'content-popup btnCall text-left',
        'data-id'=>$model['id'],
        'style'=>'margin-top: 5px;',
        'title'=>$model['file_name_org'],
        //'data-url'=>"/sections/content-management/view-file?content_id={$_GET['content_id']}&file_id={$model['id']}&filet_id={$model['file_type']}"
    ]);
    echo $taga;
?>



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
 

