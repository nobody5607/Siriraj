<?php 
    use yii\helpers\Html;
    use yii\widgets\ListView;
?>
<div id="dynamic-content">
    <?php 
        echo ListView::widget([
        'id' => 'ezf_dad',
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => ''],
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
<?php \richardfan\widget\JSRegister::begin(); ?>
<script>
 
</script>
<?php \richardfan\widget\JSRegister::end(); ?>