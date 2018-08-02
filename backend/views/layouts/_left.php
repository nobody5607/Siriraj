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
                    'url' => ['/section_management/sections'],
                    'icon' => '<i class="fa fa-sitemap"></i>',
                    'active'=>($moduleID == 'section_management' && $controllerID == 'sections') ? TRUE : FALSE,
                    //'visible' => Yii::$app->user->can('administrator'),
                ],
                [
                    'label' => Yii::t('backend', 'Content Management'),
                    'url' => ['/content_management/contents'],
                    'icon' => '<i class="fa fa-tags"></i>',
                    'active'=>($moduleID == 'content_management' && $controllerID == 'contents') ? TRUE : FALSE,
                ],
                [
                    'label' => Yii::t('backend', 'Secret Content Management'),
                    'url' => ['/secret_content_management/sections'],
                    'icon' => '<i class="fa fa-tags"></i>',
                    'active'=>($moduleID == 'secret_content_management') ? TRUE : FALSE,
                ],
                [
                    'label' => Yii::t('backend', 'Content'),
                    'url' => '#',
                    'icon' => '<i class="fa fa-edit"></i>',
                    'options' => ['class' => 'treeview'],
                    'items' => [
                        ['label' => Yii::t('backend', 'Static pages'), 'url' => ['/page/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                        ['label' => Yii::t('backend', 'Articles'), 'url' => ['/article/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                        ['label' => Yii::t('backend', 'Article categories'), 'url' => ['/article-category/index'], 'icon' => '<i class="fa fa-angle-double-right"></i>'],
                    ],
                ],
                [
                    'label' => Yii::t('backend', 'System'),
                    'options' => ['class' => 'header'],
                ],
                [
                    'label' => Yii::t('backend', 'Users'),
                    'url' => ['/user/index'],
                    'icon' => '<i class="fa fa-users"></i>',
                    'visible' => Yii::$app->user->can('administrator'),
                ],
                [
                    'label' => Yii::t('backend', 'Other'),
                    'url' => '#',
                    'icon' => '<i class="fa fa-terminal"></i>',
                    'options' => ['class' => 'treeview'],
                    'items' => [
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
                        [
                            'label' => Yii::t('backend', 'System information'),
                            'url' => ['/phpsysinfo/default/index'],
                            'icon' => '<i class="fa fa-angle-double-right"></i>',
                            'visible' => Yii::$app->user->can('administrator'),
                        ],
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
