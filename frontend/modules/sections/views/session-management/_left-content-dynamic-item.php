 
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper; 
$url = "/sections/session-management?id={$model['id']}"; 
?>

<div class="col-md-6" id="<?= $model->id?>" data-id="<?= $model->id?>" style="padding: 5px;">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa <?= $model->icon ?>"></i> <?= $model->name; ?></h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="">
                <?php //$model->id?>
                <div id="dynamic-content-<?= $model->id?>"></div>
                <?php \richardfan\widget\JSRegister::begin(); ?>
                    <script>
                         var dynamic_item_url = '/sections/session-management/get-dynamic-item';
                        $.get(dynamic_item_url,{id:<?= $model->id?>}, function(data){
                            $('#dynamic-content-<?= $model->id?>').html(data);
                        })

                    </script>
                <?php \richardfan\widget\JSRegister::end(); ?> 
        </div>
        <!-- /.box-body -->
        <div class="box-footer text-center" style="">
            <a href="<?= $url?>" class="media" style="position: relative;">View All</a>
        </div>
        <!-- /.box-footer -->
    </div>
</div>