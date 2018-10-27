
<?php 
     $images = \backend\modules\sections\classes\JContent::getImageMost();
?>
<section class="multiple-items">
    <?php foreach($images as $k=>$i): ?>
    <?php $detail = backend\modules\sections\classes\JFiles::lengthName($i['details'], 60);?>
        <a title='<?= $i['details']?>' target="_BLANK" href="/sections/content-management/view-file?content_id=<?= $i['content_id'] ?>&file_id=<?= $i['id'] ?>&filet_id=<?= $i['file_type'] ?>">    
            <img class="img img-responsive img-rounded image-sliders" src="<?= "{$i['file_path']}/thumbnail/{$i['file_view']}"?>">
            <div class="text-center captur-text"><?= $detail?></div>
            
        </a>
    <?php endforeach; ?>
</section> 
<?php richardfan\widget\JSRegister::begin(); ?>
<script>
       $('.multiple-items').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3
        });
    
</script>
<?php richardfan\widget\JSRegister::end(); ?>