<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
use appxq\sdii\widgets\GridView;
use appxq\sdii\widgets\ModalForm;
use appxq\sdii\helpers\SDNoty;
use appxq\sdii\helpers\SDHtml;
?>
<link rel="stylesheet" href="<?= Url::to('@web/css/bootstrap.min.css') ?>"/>

<div class="container">
    <?php if($print == 0):?>
    <button class="btn btn-success"><?= Yii::t('view','Print')?></button>
    <?php endif;?>
    <h3 class="text-center">สถิติการเข้าชมเว็บไซต์</h3>
    <?=
    \dosamigos\chartjs\ChartJs::widget([
        'type' => 'bar',
        'options' => [
            'height' => 200,
            'width' => 600,
            'id' => 'xxx'
        ],
        'data' => [
            'labels' => ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."],
            'datasets' => [
                [
                    'label' => 'สถิติการเข้าใช้งาน',
                    'data' => [1, 59, 90, 81, 56, 55, 40],
                    'backgroundColor' => [
                        '#ADC3FF',
                        '#FF9A9A',
                        'rgba(190, 124, 145, 0.8)'
                    ],
                    'borderColor' => [
                        '#fff',
                        '#fff',
                        '#fff'
                    ],
                    'borderWidth' => 1,
                    'hoverBorderColor' => ["#999", "#999", "#999"],
                ]
            ]
        ]
    ]);
    ?>
    <?=
    GridView::widget([
        'id' => 'view-grid',
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['style' => 'text-align: center;'],
                'contentOptions' => ['style' => 'width:60px;text-align: center;'],
            ],
            //'id',
            'ip',
            'view_count',
            [
                'attribute' => 'user_id',
                'label' => 'Name',
                'value' => function($model) {
                    if (!$model->user_id) {
                        return 'User';
                    }
                    $name = $model->user->userProfile->firstname . " " . $model->user->userProfile->lastname;
                    return $name;
                }
            ],
            [
                'format' => 'raw',
                'attribute' => 'create_date',
                'label' => 'Date',
                'value' => function($model) {
                    return appxq\sdii\utils\SDdate::mysql2phpDate($model->date);
                }
            ]
        ],
    ]);
    ?>
</div>