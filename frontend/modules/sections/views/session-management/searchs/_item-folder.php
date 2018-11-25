<div class="single-product">
    <?php if($data_type == 'section'):?>
    <a href="<?= \yii\helpers\Url::to(['/sections/section?id='])?><?= isset($model->id) ? $model->id : ''?>"> 
    <?php else:?>
        <a href="<?= \yii\helpers\Url::to(['/sections/section/content-management?content_id='])?><?= isset($model->id) ? $model->id : ''?>"> 
    <?php endif; ?>    
        <div class="pro-img">
            <img class="primary-img img img-responsive" src="<?= isset($model->icon) ? $model->icon : ''?>"/>
        </div> 
        <div class="pro-content">
            <div class="pro-infos">
                <h2 title="<?= isset($model->name) ? $model->name : ''?>"><?= isset($model->name) ? $model->name : ''?></h2>
            </div>

        </div>
    </a>
</div>