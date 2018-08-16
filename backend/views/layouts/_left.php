<?php

use backend\models\Log;
use backend\widgets\Menu;
$moduleID = Yii::$app->controller->module->id;
$controllerID = Yii::$app->controller->id;
$actionID = Yii::$app->controller->action->id;

/* @var $this \yii\web\View */
?>
<aside class="main-sidebar">
    <section class="sidebar">
        <?= Menu::widget([
            'options' => ['class' => 'sidebar-menu'],
            'items' => [  
                [
                    'label' => Yii::t('backend', 'Main'),
                    'options' => ['class' => 'header'],
                ],
                [
                    'label' => Yii::t('backend', 'Section Management'),
                    'url' => ['/sections/session-management'],
                    'icon' => '<i class="fa fa-sitemap"></i>',
                    'active'=>($moduleID == 'sections' && $controllerID == 'session-management') ? TRUE : FALSE,
                    //'visible' => Yii::$app->user->can('administrator'),
                ],
                [
                    'label' => Yii::t('backend', 'Private Section Management'),
                    'url' => ['/sections/private-session-management'],
                    'icon' => '<i class="fa fa-lock"></i>',
                    'active'=>($moduleID == 'sections' && $controllerID == 'private-session-management') ? TRUE : FALSE,
                    //'visible' => Yii::$app->user->can('administrator'),
                ],
                [
                    'label' => Yii::t('backend', 'Order Management'),
                    'url' => ['/order/order-management'],
                    'icon' => '<i class="fa fa-shopping-cart"></i>',
                    'active'=>($moduleID == 'order') ? TRUE : FALSE,
                    //'visible' => Yii::$app->user->can('administrator'),
                ],
                 
                [
                    'label' => Yii::t('backend', 'Users Management'),
                    'url' => ['/user/index'],
                    'icon' => '<i class="fa fa-users"></i>',
                    'visible' => Yii::$app->user->can('administrator'),
                ],
                [
                    'label' => Yii::t('backend', 'View Counter Management'),
                    'url' => ['/viewcountermanagement/view-count'],
                    'icon' => '<i class="fa fa-eye"></i>',
                    'visible' => Yii::$app->user->can('administrator'),
                ],
                [
                    'label' => Yii::t('backend', 'Authentication'),
                    'url' => '#',
                    'icon' => '<i class="fa fa-cogs"></i>',
                    'options' => ['class' => 'treeview'],
                    'items' => [
                           [
                                        'label' => 'Role',
                                        'url' => ['/rbac/access/role'],
                                        'icon' => '<i class="fa fa-angle-double-right"></i>',
                                        'visible' => Yii::$app->user->can('administrator'),
                                    ],
                                    [
                                        'label' => 'Permission',
                                        'url' => ['/rbac/access/permission'],
                                        'icon' => '<i class="fa fa-angle-double-right"></i>',
                                        'visible' => Yii::$app->user->can('administrator'),
                                    ]
                    ],
                ],
                [
                    'label' => Yii::t('backend', 'System'),
                    'options' => ['class' => 'header'],
                ],
                
                [
                    'label' => Yii::t('backend', 'Settings'),
                    'url' => '#',
                    'icon' => '<i class="fa fa-cog"></i>',
                    'options' => ['class' => 'treeview'],
                    'items' => [
//                            [
//                                'label' => 'Authentication',
//                                'url' => '#',
//                                'icon' => '<i class="fa fa-cogs"></i>',
//                                'options' => ['class' => 'treeview'],
//                                'items'=>[
//                                    [
//                                        'label' => 'Role',
//                                        'url' => ['/rbac/access/role'],
//                                        'icon' => '<i class="fa fa-angle-double-right"></i>',
//                                        'visible' => Yii::$app->user->can('administrator'),
//                                    ],
//                                    [
//                                        'label' => 'Permission',
//                                        'url' => ['/rbac/access/permission'],
//                                        'icon' => '<i class="fa fa-angle-double-right"></i>',
//                                        'visible' => Yii::$app->user->can('administrator'),
//                                    ]
//                                ],
//                            
//                            ],
                        [
                            'label' => 'Gii',
                            'url' => ['/gii'],
                            'icon' => '<i class="fa fa-angle-double-right"></i>',
                            'visible' => YII_ENV_DEV,
                        ],
                        ['label' => Yii::t('backend', 'File manager'), 'url' => ['/file-manager/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                        [
                            'label' => Yii::t('backend', 'DB manager'),
                            'url' => ['/db-manager/default/index'],
                            'icon' => '<i class="fa fa-angle-double-right"></i>',
                            'visible' => Yii::$app->user->can('administrator'),
                        ],
//                        [
//                            'label' => Yii::t('backend', 'System information'),
//                            'url' => ['/phpsysinfo/default/index'],
//                            'icon' => '<i class="fa fa-angle-double-right"></i>',
//                            'visible' => Yii::$app->user->can('administrator'),
//                        ],
                        ['label' => Yii::t('backend', 'Key storage'), 'url' => ['/key-storage/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                        ['label' => Yii::t('backend', 'Cache'), 'url' => ['/service/cache'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                        ['label' => Yii::t('backend', 'Clear assets'), 'url' => ['/service/clear-assets'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                        [
                            'label' => Yii::t('backend', 'Logs'),
                            'url' => ['/log/index'],
                            'icon' => '<i class="fa fa-angle-double-right"></i>',
                            'badge' => Log::find()->count(),
                            'badgeOptions' => ['class' => 'label-danger'],
                        ],
                    ],
                ],
            ],
        ]) ?>
    </section>
</aside>
