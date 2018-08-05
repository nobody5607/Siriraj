<?php

use yii\bootstrap\Html;
use kartik\tabs\TabsX;

$this->title = Yii::t('section', $title);
if ($breadcrumb) {
    foreach ($breadcrumb as $b) {
        $this->params['breadcrumbs'][] = $b;
    }
}
?>
<?php foreach ($file_type as $key => $f): ?>
    <?php if ($key > 0): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <i class="fa <?= $f['icon'] ?>"></i> <?= $f['name'] ?><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small id="label_<?= $f['id'] ?>">ภาพ</small>
                        <span class="pull-right">
                            <?php
                                echo Html::button("<i class='fa fa-plus'></i>", [
                                    //'data-id' => $data_id,
                                    //'data-parent_id' => Yii::$app->request->get('id', '0'),
                                    'data-action' => 'create-section',
                                    'class' => 'btn btn-success btnCall',
                                    'title' => Yii::t('appmenu', 'Create'),
                                    'data-url' => '/sections/session-management/create'
                                ]);
                            ?> 
                        </span>
                    </div>
                    <div class="box-body">
                        <div id="files_<?= $f['id'] ?>" data-id='<?= $f['id'] ?>'></div>
                    </div>                     
                    <div class="box-footer read-all">
                        <div class="text-center">
                            <a href="/knowledges/content/view-content-data?content_id=<?= $_GET['content_id'] ?>&file_id=1&filet_id=<?= $f['id'] ?>" ><< ดูทั้งหมด >></a>
                        </div>
                    </div>
                     
                </div>
            </div> 
        </div>
        <?php \richardfan\widget\JSRegister::begin(); ?>
        <script>
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

<?php \appxq\sdii\widgets\CSSRegister::begin(); ?>
<style>
    .box.box-primary {
        border: none;
        box-shadow: 0px 0px 1px #cacaca;
    }
</style>
<?php \appxq\sdii\widgets\CSSRegister::end(); ?>