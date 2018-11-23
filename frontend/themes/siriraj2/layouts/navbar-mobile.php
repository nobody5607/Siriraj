<?php 
    use yii\helpers\Url;
?>
<div class="topnav" id="myTopnav">
    <a href="<?= Url::to(['/'])?>" class="nav_active"><i class='fa fa-home'></i> หน้าหลัก</a>
    <?php if(!Yii::$app->user->isGuest):?>
     <a href="<?= Url::to(['/account/default/settings'])?>"><i class="fa fa-user"></i> <?= Yii::t('appmenu', 'MY PROFILE') ?></a>
    <?php endif; ?>
    <a href="<?= Url::to(['/site/about'])?>"><i class="fa fa-caret-right" aria-hidden="true"></i> <?= Yii::t('section', 'ABOUT US') ?></a>
    <a href="<?= Url::to(['/site/contact'])?>"><i class="fa fa-caret-right" aria-hidden="true"></i> <?= Yii::t('section', 'CONTACT US') ?></a>
    <a href="<?= Url::to(['/sections/cart/my-cart'])?>" class="nav-cart-popup">
        <img src="<?= \yii\helpers\Url::to('@web/images/cart-icon.png') ?>" style="width:25px;"/>
        ตะกร้าขอข้อมูล
        <span class="my-cart">
            <?php if (!empty($cart)): ?>
                <span class="badge" id="globalCart"><?= $cart ?></span>  
            <?php endif; ?>
        </span>
    </a>
    
    <?php if(!Yii::$app->user->isGuest):?>
     <a href="<?= Url::to(['/sections/order/my-order'])?>"><i class="fa fa-caret-right" aria-hidden="true"></i> <?= Yii::t('appmenu', 'REQUEST INFORMATION') ?></a>
     <a href="<?= Url::to(['/sections/cart/my-cart'])?>" ><i class="fa fa-caret-right" aria-hidden="true"></i> <?= Yii::t('section', 'รายการคำร้องขอ') ?></a>
     <a href="<?= Url::to(['/account/sign-in/logout'])?>" data-method="post" tabindex="-1"><i class="fa fa-unlock-alt"></i>  <?= Yii::t('appmenu', 'LOGOUT') ?></a>
    <?php endif; ?>
    
    <a href="#" class="icon" id="btn-icon-navbar-module">
        <i class="fa fa-bars"></i>
    </a>
    <a class="menu-height clip-right"></a>
</div>
<?php \richardfan\widget\JSRegister::begin();?>
<script>
    $('#btn-icon-navbar-module').on('click', function(){
       myFunction();
       return false;
    });
    function myFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
    }
</script>
<?php \richardfan\widget\JSRegister::end();?>
<?php appxq\sdii\widgets\CSSRegister::begin(); ?>
<style>
   .topnav {
        overflow: hidden;
        background-color: #5aa19f;
        border-radius: 5px;
      }

.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 5px 10px;
  text-decoration: none;
  font-size: 16pt;
  font-weight: bold;
  
}

.topnav a:hover {
      background-color: #425e5d;
    color: #fafafa;
}

.active {
  background-color: #4CAF50;
  color: white;
}

.topnav .icon {
  display: none;
}

@media screen and (max-width: 600px) {
  .topnav a:not(:first-child) {display: none;}
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
}
</style>
<?php appxq\sdii\widgets\CSSRegister::end(); ?>
