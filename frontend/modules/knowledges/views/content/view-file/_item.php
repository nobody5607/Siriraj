<?php 
    use yii\helpers\Html;
    if(!Yii::$app->user->isGuest){
        echo Html::checkbox('checked', '', []); 
    }
    
    if($model['file_type'] == '2'){
        //image
        $image = Html::img("/images/{$model['file_name_org']}", ['class'=>'img img-responsive img-rounded', 'style'=>'width:80px;']);
        echo  Html::a($image, ['/knowledges/content/view-content-data','content_id'=>$_GET['content_id'], 'file_id'=>$model['id'], 'filet_id'=>$model['file_type']], 
                ['class'=>'content-popup','data-id'=>$model['id'], 'title'=>$model['name']]);
    }else if($model['file_type'] == '3'){
        //video
        $video = "
            <video style='width:100%;height: 100px;'>
                <source src='/videos/{$model['file_name_org']}' type='video/mp4'>                 
                Your browser does not support the video tag.
            </video>
        ";
        echo  Html::a($video, ['/knowledges/content/view-content-data','content_id'=>$_GET['content_id'], 'file_id'=>$model['id'], 'filet_id'=>$model['file_type']], ['class'=>'content-popup','data-id'=>$model['id'], 'title'=>$model['name']]);
    }else if($model['file_type'] == '4'){
        //audio
        $sound = "
            
            <audio controls style='width:100%;height: 100px;'>
                <source src='/audio/{$model['file_name_org']}' type='audio/mpeg'>                 
                Your browser does not support the video tag.
            </audio>
        ";
        echo  Html::a($sound, ['/knowledges/content/view-content-data','content_id'=>$_GET['content_id'], 'file_id'=>$model['id'], 'filet_id'=>$model['file_type']], ['class'=>'content-popup','data-id'=>$model['id'], 'title'=>$model['name']]);
    }else if($model['file_type'] == '5'){
        //docx or pdf
        $files= " 
            <div><i class='fa fa-file'></i> {$model['file_name_org']}</div>
        ";
        echo  Html::a($files, ['/knowledges/content/view-content-data','content_id'=>$_GET['content_id'], 'file_id'=>$model['id'], 'filet_id'=>$model['file_type']], ['class'=>'content-popup','data-id'=>$model['id'], 'title'=>$model['name']]);    
    }
?> 
 
