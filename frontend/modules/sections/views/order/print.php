<?php
   $this->title= Yii::t('order','Print');
   \Yii::$app->name = "Siriraj";
   $date = isset($model->date) ? appxq\sdii\utils\SDdate::mysql2phpDate($model->date) : "";
   //$modelForm=['product'=>$product,'count'=>$count,'detail'=>$model['note'],'date'=>$model->date, 'sitecode'=>$model->sitecode, 'name'=>"{$model['firstname']} {$model['lastname']}", 'title'=>$title, 'address'=>$model->companey_name, 'tel'=>$model->tel]; 
   //$modelForm = ['product' => isset($product) ? $product : '', 'count' => isset($count) ? $count : '', 'detail' => isset($model['note']) ? $model['note'] : '', 'date' => $date, 'sitecode' => isset($model->sitecode) ? $model->sitecode : '', 'name' => "{$model['firstname']} {$model['lastname']}", 'title' => $title, 'address' => isset($model->companey_name) ? $model->companey_name : '', 'tel' => isset($model->tel) ? $model->tel : ''];

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

<link href="<?= \yii\helpers\Url::to('@web/css/bootstrap.min.css')?>" rel="stylesheet" />
<div class="container">
    <?php
        echo $data;
    ?>
</div>


<?php appxq\sdii\widgets\CSSRegister::begin()?>
<style>
    .borBottom{
       
    }
</style>
<?php appxq\sdii\widgets\CSSRegister::end()?>
<?php if(isset($autoPrint) && $autoPrint == true):?>
    <?php \richardfan\widget\JSRegister::begin();?>
    <script>
        window.print();
    </script>
    <?php \richardfan\widget\JSRegister::end();?>
<?php endif; ?>
