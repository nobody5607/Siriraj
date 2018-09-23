<?php 
    use yii\helpers\Url;
    use frontend\modules\sections\classes\JFiles;
    /** settings **/
    $images_dir = $folderName;//Yii::getAlias('@storage')."/web/files/1536251432053942100/";
    $url = $viewPath;//Yii::getAlias('@storageUrl')."/web/files/1536251432053942100/";
    $thumbs_width = 200;
    $images_per_row = 3;
     
    $dh  = opendir($images_dir);
    if($dh){
        while (false !== ($filename = readdir($dh))) {
            $files[] = $filename;
        }
        $images=preg_grep ('/\.(jpg|jpeg|png|gif|tif)$/i', $files);
        $image=[];
        sort($images);
        foreach($images as $k=>$v){
            $image[$k] = ['src'=>"{$url}/{$v}", 'content'=>''];
            //echo \yii\helpers\Html::img("{$url}/{$v}",['style'=>'width:100px;']);
        }
    }
    
 
?>  
<?php echo \janpan\jn\widgets\SlideTop::widget(['image' => $image])?>






<?php\appxq\sdii\widgets\CSSRegister::begin()?>
<style>
     
</style>
<?php\appxq\sdii\widgets\CSSRegister::end()?>