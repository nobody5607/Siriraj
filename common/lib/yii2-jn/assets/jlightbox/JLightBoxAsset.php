<?php

 
namespace janpan\jn\assets\jlightbox;
 
class JLightBoxAsset extends \yii\web\AssetBundle{
    public $sourcePath='@janpan/jn/assets/jlightbox/assets';
    public $css = [
        'css/lightgallery.css'
    ];
    public $js = [
        'js/lightgallery-all.min.js'         
    ];
    public $depends=[
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
