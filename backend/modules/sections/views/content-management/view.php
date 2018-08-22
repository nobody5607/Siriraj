<?php

use yii\bootstrap\Html;
use kartik\tabs\TabsX;

$this->title = Yii::t('section', $title);
if ($breadcrumb) {
    foreach ($breadcrumb as $b) {
        $this->params['breadcrumbs'][] = $b;
    }
}
$modal = "modal-contents";
?>
<?php foreach ($file_type as $key => $f): ?>
    <?php if ($key > 0): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <span class="pull-right">
                            <?php
                                echo yii\helpers\Html::button("<i class='fa fa-plus'></i>", [
                                    'data-id' => $f['id'],
                                    'data-parent_id' => Yii::$app->request->get('id', '0'),
                                    'file_type'=>$f['id'],
                                    'data-action' => 'create',
                                    'class' => 'btn btn-success btnCreateFile',
                                    'title' => Yii::t('appmenu', 'Create'),
                                    'data-url' => '/sections/session-management/create'
                                ]);
                            ?> 
                        </span>
                        <i class="fa <?= $f['icon'] ?>"></i> <?= $f['name'] ?><br>
                        <small id="label_<?= $f['id'] ?>"><?= Yii::t('file','Image')?></small>
                        
                    </div>
                    <div class="box-body">
                        <div id="files_<?= $f['id'] ?>" data-id='<?= $f['id'] ?>'></div>
                    </div>                     
                    <div class="box-footer read-all">
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4">
                                <?=  Html::a('View All',"/sections/content-management/view-file?content_id={$_GET['content_id']}&file_id=&filet_id={$f['id']}" , [
                                    'id'=>"btn-{$f['id']}",
                                    'data-action'=>'view-file',
                                    'class'=>'content-popup btnCall btn btn-default btn-block',
                                    'data-id'=>$f['id'],

                                ]);?>
                            </div>
                        </div>
                    </div>
                     
                </div>
            </div> 
        </div>
        <?php \richardfan\widget\JSRegister::begin(); ?>
        <script>            
            get_form=function(url , params){
                $('#<?= $modal?> .modal-content').html('<div class=\"sdloader \"><i class=\"sdloader-icon\"></i></div>');
                $('#<?= $modal?>').modal('show');
                $.get(url, params, function(res){
                    $('#<?= $modal?> .modal-content').html(res);
                });
            } 
            load_data = function () {
                let url = '/sections/content-management/view-data-content'
                let content_id = "<?= Yii::$app->request->get('content_id') ?>";
                let select_id = "files_<?= $f['id'] ?>";

                let params = {content_id: content_id, type_id: "<?= $f['id'] ?>"};
                $.get(url, params, function (data) {
                    $('#' + select_id).html(data);
                });
                return false;

            }
            load_content_data = function () {
                let url = '/sections/content-management/get-count-data'
                let content_id = "<?= Yii::$app->request->get('content_id') ?>";
                let select_id = "label_<?= $f['id'] ?>";
                
                let params = {content_id: content_id, type_id: "<?= $f['id'] ?>"};
                $.get(url, params, function (data) {
                    //console.log(data);
                    $('#' + select_id).html(data);
                });
                return false;

            }
            load_content_data();
            load_data();            
            
        </script>
        <?php \richardfan\widget\JSRegister::end(); ?>
    <?php endif; ?>
<?php endforeach; ?> 

        

<?php richardfan\widget\JSRegister::begin();?>
 <script>
     $('.btnCreateFile').on('click', function(){
                let id = $(this).attr('data-id');
                let content_id = '<?= Yii::$app->request->get('content_id', '') ?>';
                $('#<?= $modal ?> .modal-content').html('<div class=\"sdloader \"><i class=\"sdloader-icon\"></i></div>');
                $('#<?= $modal ?>').modal('show');
                let url = '/sections/file-management/upload-file';
                let file_type = $(this).attr('file_type');
                
                $.get(url,{id:id,file_type:file_type,content_id:content_id}, function(res){
                    $('#<?= $modal ?> .modal-content').html(res);
                });
               return false;
    }); 
 </script>
<?php richardfan\widget\JSRegister::end();?>        

        
<?php \appxq\sdii\widgets\CSSRegister::begin(); ?>
<style>
    .box.box-primary {
        border: none;
        box-shadow: 0px 0px 1px #cacaca;
    }
</style>
<?php \appxq\sdii\widgets\CSSRegister::end(); ?>