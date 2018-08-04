<?php

use yii\helpers\Html;
?>
<div style="display: flex;padding: 5px;">
    <a href="/content_management/section/view?id=<?= $model['id']; ?>" style="flex-grow: 2">
        <i class="fa <?= $model['icon'] ?>"></i> <?= $model['name'] ?>    
    </a>
    <div class="btn-group">
        <?php
        echo Html::button("<i class='fa fa-ellipsis-v'></i><i class='fa fa-ellipsis-v'></i>", [
            'data-id' => $model['id'],
            'data-parent_id'=>Yii::$app->request->get('id', '0'),
            'data-action' => 'drag-section',
            'class' => 'btn btn-default btn-xs btnCall',
            'title' => Yii::t('appmenu', 'Drag'),
            'data-url' => '/content_management/section/update-content'
        ]);
        
        echo Html::button("<i class='fa fa-pencil'></i>", [
            'data-id' => $model['id'],
            'data-parent_id'=>Yii::$app->request->get('id', '0'),
            'data-action' => 'update-section',
            'class' => 'btn btn-primary btn-xs btnCall',
            'title' => Yii::t('appmenu', 'Edit'),
            'data-url' => '/section_management/sections/update'
           
        ]);
        
        echo Html::button("<i class='fa fa-trash'></i>", [
            'data-id' => $model['id'],
            'data-parent_id'=>Yii::$app->request->get('id', '0'),
            'data-action' => 'delete-section',
            'class' => 'btn btn-danger btn-xs btnCall',
            'title' => Yii::t('appmenu', 'Delete'),
            'data-url' => '/section_management/sections/update',
            'data-method' => 'POST'
        ]);
        ?>
    </div>
</div>

<div>
    <?php \appxq\sdii\widgets\CSSRegister::begin();?>
    <style>
        a {
            color: #525252;
        }
    </style>
    <?php \appxq\sdii\widgets\CSSRegister::end();?>
    <?php
//                use yii\helpers\Html;
//                echo Html::button("<i class='fa fa-pencil'></i>", ['class'=>'btn btn-primary btn-xs']);
//                echo " ";
//                echo Html::button("<i class='fa fa-trash'></i>", ['class'=>'btn btn-danger btn-xs']);
    ?>
</div>
