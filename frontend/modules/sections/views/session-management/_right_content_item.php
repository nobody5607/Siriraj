<?php 
    use yii\helpers\Html;
    $folderImage = Yii::getAlias('@storageUrl/avatars/folder.png');
?>

<div class="box-comment" style="display: flex;"> 
    <a href="/sections/content-management/view?content_id=<?= $model['id']?>" style="flex-grow:2">
    <?= \yii\helpers\Html::img($model['thumn_image'], ['class'=>'img-circle img-sm'])?>
    <div class="comment-text">
        <span class="username">
            <?= $model['name'] ?>
            <span class="text-muted pull-right" style="margin-right:30px;">
                <?= \appxq\sdii\utils\SDdate::mysql2phpDate($model['create_date']) ?>                
            </span>
        </span>
    </div> 
    </a> 
     
</div>
 