<?php 
    \janpan\jn\assets\ListdataAsset::register($this);
    \janpan\jn\assets\EzfToolAsset::register($this);
//    echo $type_id;
?>
<div>
    <?=
        \yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'options' => [
                'tag' => 'div',
                'class' => 'row',
        //        'id' => 'section-all',
                'id'=>'ezf_dad',
            ],
            'itemOptions' => function($model) {
                return ['tag' => 'div','id'=>'img-'.$model['id'], 'data-id' => $model['id'], 'class' => 'col-md-2 col-sm-4 text-center item dads-children','style'=>'height: 200px;'];
            },
            'layout' => "{items}\n",
            'itemView' => function ($model, $key, $index, $widget) {
                return $this->render('view-file/_item', ['model' => $model]);
            },
        ]);
?>
</div>
<?php
\richardfan\widget\JSRegister::begin();
?>
<script>
    
     $('#panel-<?= $type_id?> #ezf_dad').dad({
        draggable:'.draggable',
        callback:function(e){
            var positionArray = [];
            $('#panel-<?= $type_id?>  #ezf_dad').find('.dads-children').each(function(){
                positionArray.push($(this).attr('data-id'));
            });
             
            $.post('<?= \yii\helpers\Url::to(['/sections/session-management/forder-files']) ?>',{data:positionArray.toString(), type_id:'<?= $type_id?>'},function(result){
                console.log(result);
                return false;
            });
        }
    });
</script>
<?php \richardfan\widget\JSRegister::end(); ?>