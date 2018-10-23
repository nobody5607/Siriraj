<?php

use yii\helpers\Html;

//print_r($model);
?>
<?php if ($key % 2 == 0): ?>
    <div class="text-center pd-5 wd-40 over-hidden" >
        <h1><?= Html::encode($model['name']) ?></h1>
        <hr class="hr"/>
        <p><?= Html::encode($model['detail']) ?></p>  
    </div>
    <div class="img1 color-y border-left flex-image wd-60 ">
        <img class="img1 flex-img flex-img-responsive img-right" src="<?= $model['icon'] ?>">
    </div>
<?php else: ?>
    <div  class="img2 color-y  border-right flex-image wd-60">
        <img class="img2 flex-img flex-img-responsive img-left" src="<?= $model['icon'] ?>">
    </div>
    <div class="text-center pd-5 wd-40 over-hidden">
        <h1><?= Html::encode($model['name']) ?></h1>
        <hr class="hr"/>
        <p><?= Html::encode($model['detail']) ?></p>  
    </div>
<?php endif; ?>
