<div class="container">
    <?=
\yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'options' => [
        'tag' => 'div',
        'class' => 'row',
        'id' => 'section-all'        
    ],
    'itemOptions' => function($model) {
        return ['tag' => 'div', 'data-id' => $model['id'], 'class' => 'col-md-2 col-sm-4 col-xs-4','style'=>'margin-bottom:15px;'];
    },
    'layout' => "{pager}\n{items}\n",
    'itemView' => function ($model, $key, $index, $widget) {
        return $this->render('_item', ['model' => $model]);
    },
]);
?>
</div>