<?php 
     $images = \backend\modules\sections\classes\JContent::getImage();
?>
<section class="multiple-items">
    <?php foreach($images as $k=>$i): ?>
        <a href="<?= $i['url']?>">
            <img class="img img-responsive img-rounded image-sliders" src="<?= "{$i['view_path']}/{$i['name']}"?>">
            <div class="text-center captur-text"><?= $i['detail']?></div>
        </a>
    <?php endforeach; ?>
</section> 
<?php richardfan\widget\JSRegister::begin(); ?>
<script>
    $('.multiple-items').hide();
    setTimeout(function(){
       $('.multiple-items').show(); 
       $('.multiple-items').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3
        });
    },1000); 
</script>
<?php richardfan\widget\JSRegister::end(); ?>
