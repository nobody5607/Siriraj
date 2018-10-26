<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"><?= Yii::t('section', 'TOP SEARCH')?></h4>
</div>
<div class="modal-body">
    <?php 
        $topSearch = \backend\modules\sections\classes\JContent::getImageMost();
//        appxq\sdii\utils\VarDumper::dump($topSearch);
        
    ?>
    <div class="row item-search-row">
        
        <?php foreach ($topSearch as $k => $image): ?>
        <?php 
            $detail = backend\modules\sections\classes\JFiles::lengthName($image['details'], 30);
        ?>
        <div class="col-md-2 col-xs-4 top-search-items">
            <a title='<?= $image['details']?>' target="_BLANK" href="/sections/content-management/view-file?content_id=<?= $image['content_id'] ?>&file_id=<?= $image['id'] ?>&filet_id=<?= $image['file_type'] ?>" style="color:#000;" > 
                <img  class="height-100 img img-responsive img-rounded" src="<?= "{$image['file_path']}/thumbnail/{$image['file_view']}" ?>"  >
                <p><?= $detail?></p>
            </a>
        </div>
        <?php endforeach;?>
    </div>
</div>