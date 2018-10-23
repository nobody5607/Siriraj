<div id="content" class="content">
<?=
\yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'options' => [
        'tag' => 'div',
        'class' => 'row',
        //        'id' => 'section-all',
        'id' => 'ezf_dad',
    ],
    'itemOptions' => function($model) {
        return ['tag' => 'div','class' => 'bg-green flex-display mb10 wd-100'];
    },
    'layout' => "{items}\n",
    'itemView' => function ($model, $key, $index, $widget) {
        
        return $this->render('_items', ['model' => $model, 'key'=>$key+1]);
    },
]);
?>
</div>