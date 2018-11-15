<?php
   $this->title= Yii::t('order','Print');
   \Yii::$app->name = "Siriraj";
   $date = isset($model->date) ? appxq\sdii\utils\SDdate::mysql2phpDate($model->date) : "";
   $fullName = Yii::$app->user->identity->userProfile->firstname .' '.Yii::$app->user->identity->userProfile->lastname;
   $sitecode = isset(Yii::$app->user->identity->userProfile->sitecode) ? Yii::$app->user->identity->userProfile->sitecode : '';
   $modelForm = [
        'product' => isset($product) ? $product : '',
        'count' => isset($count) ? $count : '',
        'detail' => isset($model['note']) ? $model['note'] : '',
        'date' => date('d/m/Y'),
        'sitecode' => $sitecode,
        'name' => $fullName,
        'title' => $title,
        'address' => isset($model->companey_name) ? $model->companey_name : '',
        'tel' => isset($model->tel) ? $model->tel : ''
    ];
   $data = \backend\modules\sections\classes\JFiles::getTemplateMark($modelForm, $template->option_value);
?>
<div class="container">
    <?php
        echo $data;
    ?>
</div>