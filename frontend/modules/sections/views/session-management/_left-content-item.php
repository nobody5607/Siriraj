 
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper; 
$url = "/sections/session-management?id={$model['id']}"; 
?>
 
<a href="<?= $url?>" class="media" style="position: relative;">
    <div class="media-left"> 
      <?php // backend\modules\ezforms2\classes\EzfUiFunc::getEzformIcon($model, 42)?>
    </div>
    <div class="media-body"> 
        
        <p class="list-group-item-text"> 
        <div class=""><i style="font-size:20px;" class="fa <?= $model['icon']?>"></i> <?= Html::encode($model->name) ?> </div>
        </p>
        
    </div>
</a>
 