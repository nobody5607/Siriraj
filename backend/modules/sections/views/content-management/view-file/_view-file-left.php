<div class="col-md-8 view-file-left">
    <div class="row" style="margin-bottom:10px;">
        <div class="col-md-6 col-md-offset-3">
            <img class="img img-responsive img-rounded" src="/images/<?= $dataDefault['file_name_org'] ?>" style="width:1024px;">
        </div>
    </div>
    <?=
    \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'options' => [
            'tag' => 'div',
            'class' => 'col-md-12',
            'id' => 'file_types',
        ],
        'itemOptions' => function($model) {
            return ['tag' => 'div', 'data-id' => $model['id'], 'class' => 'col-md-2 col-sm-4 col-xs-6'];
        },
        'layout' => "{pager}\n{items}\n",
        'itemView' => function ($model, $key, $index, $widget) {
            return $this->render('_item', ['model' => $model]);
        },
    ]);
    ?>
    <div class="clearfix"></div>
    <?php if (!Yii::$app->user->isGuest) { ?>
        <div class="btnCart text-center" style="margin-top:50px;margin-bottom:50px;">
            <button class="btn btn-success">เลือกลงตะกร้า</button>
        </div>
    <?php } ?>
</div>
<?php appxq\sdii\widgets\CSSRegister::begin(); ?>
<style>
     
    .view-file-left{
        border-right: 1px solid #ecf0f5;
    } 
</style>
<?php appxq\sdii\widgets\CSSRegister::end(); ?>