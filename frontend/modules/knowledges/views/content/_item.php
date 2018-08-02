<?php 
    use yii\helpers\Html;
    if($model['file_type'] == '2'){
        //image
        $image = Html::img("/images/{$model['file_name_org']}", ['class'=>'img img-responsive img-rounded', 'style'=>'width:80px;']);
        echo  Html::a($image, '#', ['data-id'=>$model['id'], 'title'=>$model['name']]);
    }else if($model['file_type'] == '3'){
        $video = "
            <video style='width:100%;height: 100px;'>
                <source src='/videos/{$model['file_name_org']}' type='video/mp4'>                 
                Your browser does not support the video tag.
            </video>
        ";
        echo  Html::a($video, '#', ['data-id'=>$model['id'], 'title'=>$model['name']]);
    }else if($model['file_type'] == '4'){
        $sound = "
            
            <audio controls style='width:100%;height: 100px;'>
                <source src='/audio/{$model['file_name_org']}' type='audio/mpeg'>                 
                Your browser does not support the video tag.
            </audio>
        ";
        echo  Html::a($sound, '#', ['data-id'=>$model['id'], 'title'=>$model['name']]);
    }else if($model['file_type'] == '5'){
        $files= " 
            <div><i class='fa fa-file'></i> {$model['file_name_org']}</div>
        ";
        echo  Html::a($files, '#', ['data-id'=>$model['id'], 'title'=>$model['name']]);    
    }
?> 
 
<?php \richardfan\widget\JSRegister::begin();?>
<script>
    
</script>
<?php \richardfan\widget\JSRegister::end();?>
