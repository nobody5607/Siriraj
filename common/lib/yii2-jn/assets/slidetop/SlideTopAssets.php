<?php

 
namespace janpan\jn\assets\slidetop;
 
class SlideTopAssets extends \yii\web\AssetBundle{
    public $sourcePath='@janpan/jn/assets/slidetop/assets';
    public $css = [ 
        'magnific-popup.css'
    ];
    public $js = [
        //'index.js',
        'jquery.carousel.js', 
        'jquery.magnific-popup.js'
    ];
    public $depends=[
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
