<?php

use yii\bootstrap\Html;
use yii\grid\GridView;
use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('_user', 'User');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-default">
    <div class="box-header">
        <?= yii\helpers\Html::encode($this->title)?>
        <div class="pull-right">
            <?= Html::a(Yii::t('backend', '<i class="fa fa-plus"></i>'), ['create'], ['class' => 'btn btn-success']) ?>
        </div>    
    </div>
    <div class="box-body">
        <div class="">
            <?=            appxq\sdii\widgets\GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'tableOptions'=>['class'=>'table table-hover table-bordered table-responsive'],
            'columns' => [
                
                [
                    'contentOptions'=>['style'=>'widh:100px;'],
                    'label' => Yii::t('_user','Email'),
                    'value' => function ($model) {
                        return $model->email;
                    } 
                ], 
                [
                    'contentOptions'=>['style'=>'widh:100px;'],
                    'label' => Yii::t('_user','Uswename'),
                    'value' => function ($model) {
                        return $model->username;
                    } 
                ],
                [
                    'contentOptions'=>['style'=>'widh:100px;'],
                    'label' => Yii::t('_user','Firstname'),
                    'value' => function ($model) {
                        return isset($model->userProfile->firstname) ? $model->userProfile->firstname : '';
                    } 
                ],
                [
                    'label' => Yii::t('_user','Lastname'),
                    'contentOptions'=>['style'=>'widh:100px;'],
                    'value' => function ($model) {
                        return isset($model->userProfile->lastname) ? $model->userProfile->lastname : '';
                    } 
                ],         
                [
                    'contentOptions'=>['style'=>'widh:100px;'],
                    'label' => Yii::t('_user','Sap_id'),
                    'value' => function ($model) {
                        return isset($model->userProfile->sap_id) ? $model->userProfile->sap_id : '';
                    } 
                ],
                [
                    'label' => Yii::t('_user','Site Code'),
                    'value' => function ($model) {
                        return isset($model->userProfile->sitecode) ? $model->userProfile->sitecode : '';
                        
                    } 
                ],         
                [
                    'header' => Yii::t('_user', 'approval'),
                    'value' => function ($model) {
                        $auth = Yii::$app->authManager->getAssignment('adminsite', $model->id);

                        if (isset($model->userProfile->approval) && $model->userProfile->approval == 1) {
                            return Html::button('<i class="glyphicon glyphicon-ok"></i>', [
                                        'class' => 'manager-btn btn btn-xs btn-primary',
                                       
                                        'data-id' => $model->id,
                                        'data-action'=>'admin',
                                        'data-url' => yii\helpers\Url::to(['/user/manager', 'id' => $model->id, 'auth' => 'admin'])
                            ]);
                        } else {

                            return Html::button('<i class="glyphicon " style="padding-right: 6px; padding-left: 6px;"></i>', [
                                        'class' => 'manager-btn btn btn-xs btn-default',
//                                        'style'=>'padding: 6px 6px 16px 6px;',
                                        'data-id' => $model->id,
                                        'data-action'=>'admin',
                                        'data-url' => yii\helpers\Url::to(['/user/manager', 'id' => $model->id, 'auth' => 'admin'])
                            ]);
                        }
                    },
                    'format' => 'raw',
                    'headerOptions' => ['style' => 'text-align: center;'],
                    'contentOptions' => ['style' => 'width:90px;text-align: center;'],
                ],
                [
                        'class' => 'appxq\sdii\widgets\ActionColumn',
                        'headerOptions' => ['style'=>'width:80px;text-align: center;'],
                        'contentOptions' => ['style'=>'width:80px;text-align: center;'],
                        'template' => '{update} {delete}',
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
 <?php \richardfan\widget\JSRegister::begin();?>
<script>
    
    $('.manager-btn').click(function(){
        let url = $(this).attr('data-url');
        if($(this).hasClass('btn-default')){
                $(this).removeClass('btn-default');
                $(this).addClass('btn-primary');
                $(this).html('<i class=\'glyphicon glyphicon-ok\'></i>');
            }else{
                $(this).removeClass('btn-primary');
                $(this).addClass('btn-default');
                $(this).html('<i class=\"glyphicon \" style=\"padding-right: 6px; padding-left: 6px;\"></i>');

            } 
        $.get(url, function(data){           
           
        });
});
</script>
<?php \richardfan\widget\JSRegister::end();?>