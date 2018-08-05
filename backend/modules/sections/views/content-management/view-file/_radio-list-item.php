<?php
    use yii\helpers\Html;
?>
<div style="display: flex;">
    <div style="flex-grow: 2">
        <?php
            echo Html::radio($name, $checked, [
                'value' => $value,
                'label' => Html::encode($label),
                'disabled' => $disabled,
           ]);
         ?>
    </div>
    <div class="button">
        <?php 
            echo Html::button("<i class='fa fa-pencil'></i>", [
                //'data-id' => $model['id'],
                //'data-parent_id' => Yii::$app->request->get('id', '0'),
                'data-action' => 'update-section',
                'class' => 'btn btn-primary btn-xs btnCall',
                'title' => Yii::t('appmenu', 'Edit'),
                'data-url' => '/sections/session-management/update'
            ]);
            echo " ";
            echo Html::button("<i class='fa fa-trash'></i>", [
                //'data-id' => $model['id'],
                //'data-parent_id' => Yii::$app->request->get('id', '0'),
                'data-action' => 'delete',
                'class' => 'btn btn-danger btn-xs btnCall',
                'title' => Yii::t('appmenu', 'Delete'),
                'data-url' => '/sections/session-management/delete',
                'data-method' => 'POST'
            ]);
        ?>
    </div>
</div>
 
 

