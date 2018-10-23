<header>
    <div class="container">
        <div class="col-md-1 text-center">
            <img src="https://srr.thaicarecloud.org/images/logosirirajweb3.png" class="img img-responsive"/>
        </div>
        <div class="col-md-11">
            <h3>คลังสมบัติของพิพิธภัณฑ์ศิริราช</h3>
            <h3>Siriraj museum (Unravel) treasure</h3>
        </div>
    </div>
</header>
<div class="container">
    <div class="col-md-6"></div>
    <div class="col-md-6">
        <div class="navbar-menu col-md-12">
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
    <div>
        <img class="img img-responsive" src="http://placehold.it/350x300?text=1">
    </div>
    <div>
        <img class="img img-responsive" src="http://placehold.it/350x300?text=2">
    </div>
    <div>
        <img class="img img-responsive" src="http://placehold.it/350x300?text=3">
    </div>
    <div>
        <img class="img img-responsive" src="http://placehold.it/350x300?text=4">
        <div class="text-center captur-text">Test test testsfsd</div>
    </div>
    <div>
        <img class="img img-responsive" src="http://placehold.it/350x300?text=5">
        <div class="text-center captur-text">Test test testsfsd</div>
    </div>
    <div>
        <img class="img img-responsive" src="http://placehold.it/350x300?text=6">
        <div class="text-center captur-text">Test test testsfsd</div>
    </div>
    <div>
        <img class="img img-responsive" src="http://placehold.it/350x300?text=7">
        <div class="text-center captur-text">Test test testsfsd</div>
    </div>
    <div>
        <img class="img img-responsive" src="http://placehold.it/350x300?text=8">
        <div class="text-center captur-text">Test test testsfsd</div>
    </div>
    <div>
        <img class="img img-responsive" src="http://placehold.it/350x300?text=9">
        <div class="text-center captur-text">Test test testsfsd</div>
    </div>
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