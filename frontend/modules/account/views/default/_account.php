<div>
    <label><?= Yii::t('user','Username')?> : <?= $model->username;?></label>
</div>
<div>    
    <label><?= Yii::t('user','Email')?> : <?= $model->email;?></label>
</div>
<div>    
    <label><?= Yii::t('user','Create Date')?> : <?= appxq\sdii\utils\SDdate::mysql2phpDate(date('Y-m-d', $model->created_at));?></label>
</div>
<div>    
    <label><?= Yii::t('user','IP')?> : <?= $model->ip;?></label>
</div>