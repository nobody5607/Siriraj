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
<div class="clearfix text-center">
    <button class="btn btn-sm btn-warning"><< ดูทั้งหมด >></button>
</div>

<?php 
    echo yii\bootstrap\Modal::widget([
        'size'=>"modal-lg",
        'id'=>'modal-content'
    ]);
    echo $this->registerCss("
        .modal-lg{
            width: 95%;
            right: 0%;
        }
        .navbar-inverse {
            background-color: #3c8dbc;
            border-color: #080808;
        }
        .navbar-inverse .navbar-brand {
            color: #ffffff;
        }
        .navbar-inverse .navbar-nav > li > a {
            color: #ffffff;
        }
    ");
?>
