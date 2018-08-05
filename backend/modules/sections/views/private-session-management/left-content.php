<?php

use yii\helpers\Html;
?>
<div class="col-md-3 col-border-right section-left">
    <div class="box-body">
        <div class="text-left">
            <?php
            echo Html::button("<i class='fa fa-plus'></i>", [
                'data-id' => $data_id,
                'data-parent_id' => Yii::$app->request->get('id', '0'),
                'data-action' => 'create-section',
                'class' => 'btn btn-success btnCall',
                'title' => Yii::t('appmenu', 'Create'),
                'data-url' => '/sections/session-management/create'
            ]);
            ?> 
        </div> <br/>
        <?=
        \yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'options' => [
                'tag' => 'ul',
                'class' => 'nav nav-stacked',
                'id' => 'section-all',
            ],
            'itemOptions' => function($model) {
                return ['tag' => 'li', 'data-id' => $model['id'], 'class' => 'section-items'];
            },
            'emptyText'=> \yii\helpers\Html::a('<i class="fa fa-chevron-left"></i> Back', Yii::$app->request->referrer, ['data-url'=>Yii::$app->request->referrer, 'id'=>'backs','class'=>'btn btn-warning btn-sm']),        
            'layout' => "{pager}\n{items}\n",
            'itemView' => function ($model, $key, $index, $widget) {
                return $this->render('_left-content-item', ['model' => $model]);
            },
        ]);
        ?>     
    </div>
</div>   

