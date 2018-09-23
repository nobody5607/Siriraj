<div>
    <?=
\yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'options' => [
        'tag' => 'div',
        'class' => 'row',
        'id' => 'section-all'        
    ],
    'itemOptions' => function($model) {
        return ['tag' => 'div','id'=>'img-'.$model['id'], 'data-id' => $model['id'], 
            'class' => 'col-md-6'];
    },
    'layout' => "{items}\n",
    'itemView' => function ($model, $key, $index, $widget) {
        return $this->render('view-file/_item', ['model' => $model]);
    },
]);
?>
</div>
