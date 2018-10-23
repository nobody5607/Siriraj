<?php 
    $images = \backend\modules\sections\classes\JContent::getImage();
?>
<header>
    <div class="container">
        <div class="col-md-1 text-center">
            <img id="logo" src="https://srr.thaicarecloud.org/images/logosirirajweb3.png" class="img img-responsive"/>
        </div>
        <div class="col-md-11 logo-text">
            <h3>คลังสมบัติของพิพิธภัณฑ์ศิริราช</h3>
            <h3>Siriraj museum (Unravel) treasure</h3>
        </div>
    </div>
</header>
<div class="container">
    <div class="col-md-6"></div>
    <div class="col-md-6">
        <div class="navbar-menu">
            <ul>
                <li class="active"><a  href="#home">HOME</a></li>
                <li class="bg-green"><a href="#news">LOG IN</a></li>
                <li class="bg-green"><a href="#contact">SIGI IN</a></li>
                <li class="active clip-right"><a href="#about">MORE...</a></li>
            </ul>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-6 col-md-offset-4">
        <div class="navbar-menu-center">
            <ul>
                <li ><a class="nav-active-left" href="#home">HIGHLIGHT</a></li>
                <li ><a href="#news">TOP SEARCH</a></li>
            </ul>
        </div>
    </div>
</div>

<!-- Slider Image -->
<section class="multiple-items">
    <?php foreach($images as $k=>$i): ?>
        <div>
            <img style="height: 210px;" class="img img-responsive img-rounded" src="<?= "{$i['view_path']}/{$i['name']}"?>">
            <div class="text-center captur-text"><?= $i['detail']?></div>
        </div>
    <?php endforeach; ?>
</section>      


<!-- Form Search -->      
<div id="form-search">
    <form>
        <input type="text" class="form-control"/>
    </form>
</div>

<!-- Header Text -->
<h2 class="text-center header-text"> ค้นพบเรื่องราวประวัติศาสตร์ฝั่งธนฯ และการแพทย์ได้ที่นี่</h2>

<?php richardfan\widget\JSRegister::begin(); ?>
<script>
    console.log('slide images');
    $('.multiple-items').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 3
    });
</script>
<?php richardfan\widget\JSRegister::end(); ?>