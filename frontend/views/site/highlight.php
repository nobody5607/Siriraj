<?php 
     $images = \backend\modules\sections\classes\JContent::getImage();
?>
<section class="multiple-items">
    <?php foreach($images as $k=>$i): ?>
    <?php 
        $fileName = backend\modules\sections\classes\JFiles::lengthName($i['detail'], 60);
    ?>
        <a href="<?= $i['url']?>">
            <img class="img img-responsive img-rounded image-sliders" src="<?= "{$i['view_path']}/{$i['name']}"?>">
            <div class="text-center captur-text"><?= $fileName?></div>
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
