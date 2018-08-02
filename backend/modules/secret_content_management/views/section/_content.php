<?php 
    use yii\helpers\Html;
    $folderImage = Yii::getAlias('@storageUrl/avatars/folder.png');
?>

<div class="box-comment" style="display: flex;"> 
    <a href="/content_management/content/view?content_id=<?= $model['id']?>" style="flex-grow:2">
    <?= \yii\helpers\Html::img('/images/logo.png', ['class'=>'img-circle img-sm'])?>
    <div class="comment-text">
        <span class="username">
            <?= $model['name'] ?>
            <span class="text-muted pull-right" style="margin-right:30px;">
                <?= \appxq\sdii\utils\SDdate::mysql2phpDate($model['create_date']) ?>                
            </span>
        </span>
    </div> 
    </a> 
    <div>
        <?php
        echo Html::button("<i class='fa fa-pencil'></i>", [
            'data-id' => $model['id'],
            'data-action' => 'update',
            'class' => 'btn btn-primary btn-xs btnCall',
            'title' => Yii::t('appmenu', 'Edit'),
            'data-url' => '/content_management/section/update-content'
        ]);
        echo " ";
         echo Html::button("<i class='fa fa-trash'></i>", [
            'data-id' => $model['id'],
            'data-action' => 'delete',
            'class' => 'btn btn-danger btn-xs btnCall',
            'title' => Yii::t('appmenu', 'Delete'),
            'data-url' => '/content_management/section/delete-content',
            'data-method'=>'POST'
        ]);
        ?>
    </div>
</div>
 