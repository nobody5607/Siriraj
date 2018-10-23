<?php

namespace frontend\themes\siriraj2\assets;

use yii\web\AssetBundle;
class Siriraj2Assets extends AssetBundle{
    public $sourcePath = '@frontend/themes/siriraj2';
    public $css = [
        'slick/slick.css',
        'slick/slick-theme.css',
        'css/style.css',
        
        //'css/ionicons.min.css',
         
    ];

    public $js = [ 
        'slick/slick.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset', 
    ];
}
