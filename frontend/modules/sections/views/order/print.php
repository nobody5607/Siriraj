<link href="<?= \yii\helpers\Url::to('@web/css/bootstrap.min.css')?>" rel="stylesheet" />
<div class="container">
    <?php
        echo $template->option_value;
    ?>
</div>


<?php appxq\sdii\widgets\CSSRegister::begin()?>
<style>
    .borBottom{
       
    }
</style>
<?php appxq\sdii\widgets\CSSRegister::end()?>
<?php \richardfan\widget\JSRegister::begin();?>
<script>
    //window.print();
</script>
<?php \richardfan\widget\JSRegister::end();?>