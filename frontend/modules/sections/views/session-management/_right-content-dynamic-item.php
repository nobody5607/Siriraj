 
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper; 
$url = "/sections/session-management?id={$model['id']}";
//appxq\sdii\utils\VarDumper::dump($model);
?>

<div class="col-md-12" id="<?= $model->id?>" data-id="<?= $model->id?>" style="padding: 5px;">
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
                        function loadContent(){
                            let dynamic_item_url = '/sections/session-management/get-dynamic-item';
                            let id = "<?= $model->id?>";
                            $.get(dynamic_item_url,{id:id}, function(data){
                                $('#dynamic-content-'+id).html(data);
                            });
                        }
                        loadContent();
                         

                    </script>
                <?php \richardfan\widget\JSRegister::end(); ?> 
        </div>
        <!-- /.box-body -->
        <div class="box-footer text-center" style="">
            <div class="col-md-4 col-md-offset-4">
                <a href="<?= $url?>" class="" style="position: relative;color:#000;">more...</a>
            </div>
        </div>
        <!-- /.box-footer -->
    </div>
</div>