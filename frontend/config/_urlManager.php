<?php

return [
    'class' => 'yii\web\UrlManager',
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        // Index page
        '' => '/sections/session-management',
        // Pages
        'page/<slug>' => 'page/view',
        // Articles
        'article/page/<page>' => 'article/index',
        'article/index' => 'article/index',
        'article/<slug>' => 'article/view',
        'article/category/<slug>' => 'article/category',
        'article/tag/<slug>' => 'article/tag',
    ],
];
