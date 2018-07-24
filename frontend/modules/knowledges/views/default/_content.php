 <?=

\yii\widgets\ListView::widget([
    'dataProvider' => $dataProviderContent,
    'options' => [
        'tag' => 'div',
        'class' => 'list-content',
        'id' => 'list-contents',
    ],
    'itemOptions' => function($model) {
        return ['data-id' => $model['id'], 'class' => 'list-content-items'];
    },
    'layout' => "{pager}\n{items}\n",
    'itemView' => function ($model, $key, $index, $widget) {
        return $this->render('_list_item_content', ['model' => $model]);
    },
]);
?>

<?php

$this->registerCss("
   #list-contents{
    
   } 
   #list-contents .list-content-items a{text-decoration:none;color:#6d6d6d;}   
");
?>