<?php 
    use yii\helpers\Html;
     
    if($model['file_type'] == '2'){
        //image
        $link  = "";        
        $link .= Html::img("{$model['file_path']}/{$model['file_name']}", 
                [
                    'class'=>'img img-responsive img-rounded',
                    'style'=>'width:100px;height: 100px;'
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
    }
    else{
        $name_str = backend\modules\sections\classes\JFiles::lengthName($model['file_name_org']);
          
       $link= " 
            <div><i class='fa fa-file'></i> {$name_str}</div>
        ";   
    }
    $taga = "";
   
    $taga .=  Html::a($link,"/sections/content-management/view-file?content_id={$_GET['content_id']}&file_id={$model['id']}&filet_id={$model['file_type']}" ,
    //['/knowledges/content/view-content-data','content_id'=>$_GET['content_id'], 'file_id'=>$model['id'], 'filet_id'=>$model['file_type']], 
    [
        'id'=>"btn-{$model['id']}",
        'data-action'=>'view-file',
        'class'=>'content-popup btnCall',
        'data-id'=>$model['id'],
                'title'=>$model['file_name_org'],
        'data-url'=>"/sections/content-management/view-file?content_id={$_GET['content_id']}&file_id={$model['id']}&filet_id={$model['file_type']}"
    ]);
    echo $taga;
?> 
<?php $this->registerCss("a{color:#000;}")?>
<?php 
    $modal = "modal-contents";
?>
<?php \richardfan\widget\JSRegister::begin();?>
<script>
    
</script>
<?php \richardfan\widget\JSRegister::end();?>