<?php 
    use yii\helpers\Html;
    use yii\widgets\ListView; 
//    appxq\sdii\utils\VarDumper::dump($contentProvider);
//appxq\sdii\utils\VarDumper::dump($contentProvider);
?>
<div id="dynamic-content">
    <?php 
        echo ListView::widget([
        'id' => 'ezf_dad',
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => ''],
        'layout' => "{items}\n{pager}",
        //'layout' => '<div class=" sidebar-nav-title text-right" ></div>{items}<div class="list-pager">{pager}</div>',
        'itemView' => function ($model, $key, $index, $widget) {
            return $this->render('_left-content-dynamic-item', [
                        'model' => $model,
                        'key' => $key,
                        'index' => $index,
                        //'widget' => $widget,
                        'ezf_id' => $model['id'],
            ]);
        },
        'emptyText'=>'',
    ])
    ?>
</div>    
