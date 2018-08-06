<?php

use yii\bootstrap\Html;
use yii\grid\GridView;
use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-defaut">
    <div class="box-header">
        <?= Html::a(Yii::t('backend', '<i class="fa fa-plus"></i>'), ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <div class="box-body">
        <div class="">
            <?=            appxq\sdii\widgets\GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],

                //'id',
                'username',
                // 'auth_key',
                // 'access_token',
                // 'password_hash',
                'email:email',
                [
                    'attribute' => 'status',
                    'value' => function ($model) {
                        return User::statuses($model->status);
                    },
                    'filter' => User::statuses(),
                ],
                
                [
                        'class' => 'appxq\sdii\widgets\ActionColumn',
                        'contentOptions' => ['style'=>'width:80px;text-align: center;'],
                        'template' => '{update} {delete}',
                        'headerOptions' => ['style' => 'width:250px'],
                        'buttons' => [
                             
                            'update' => function ($url, $model) {
                                $label = Yii::t('section', 'Update');
                                return Html::a('<span class="fa fa-pencil"></span> ', yii\helpers\Url::to(['/user/update', 'id' => $model->id]), [
                                            'title'         => $label,
                                            'class'         => 'btn btn-primary btn-xs',
                                            'data-action'   => 'update',
                                            'data-pjax'     =>0
                                    ]);
                            }, 
                           'delete' => function ($url, $model) {
                                $label = Yii::t('section', 'Delete');
                                return Html::a('<span class="fa fa-trash"></span> ', yii\helpers\Url::to(['/user/delete', 'id' => $model->id]), [
                                            'title'         => $label,
                                            'class'         => 'btn btn-danger btn-xs',
                                            'data-action'   => 'delete',
                                            'data-pjax'     =>0,
                                            'data-confirm'  => Yii::t('section','Are you sure you want to delete this item?'),
                                            'data-method'   => 'post'
                                    ]);
                            },           
                    ]
                ],
            ],
        ]) ?>
        </div>
    </div>
</div>
<?php appxq\sdii\widgets\CSSRegister::begin(); ?>
<style>
    .box-defaut {
         border: none;
         box-shadow: 0px 0px 1px #cacaca;
     }
</style>
<?php appxq\sdii\widgets\CSSRegister::end(); ?>