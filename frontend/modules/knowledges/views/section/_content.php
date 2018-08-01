<?php 
    $folderImage = Yii::getAlias('@storageUrl/avatars/folder.png');
?>

<div class="box-comment"> 
    <a href="/knowledges/content/view?content_id=<?= $model['id']?>">
    <?= \yii\helpers\Html::img('/images/logo.png', ['class'=>'img-circle img-sm'])?>
    <div class="comment-text">
        <span class="username">
            <?= $model['name'] ?>
            <span class="text-muted pull-right"><?= \appxq\sdii\utils\SDdate::mysql2phpDate($model['create_date']) ?></span>
        </span>
    </div> 
    </a>    
</div>
 