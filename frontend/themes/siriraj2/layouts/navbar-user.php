<li class="nav_active"><a href="/"><i class='fa fa-home'></i> <?= Yii::t('section', 'HOME') ?></a></li>
<li class="bg-green"><a href="/account/default/settings"><i class="fa fa-user"></i> <?= Yii::t('appmenu', 'MY PROFILE') ?></a></li> 
<li class="nav-active"><a href="/site/about"><?= Yii::t('section', 'ABOUT US') ?></a></li>
<li class="bg-green"><a href="/site/contact"><?= Yii::t('section', 'CONTACT US') ?></a></li>
<li class="nav-active">
    <a href="/sections/cart/my-cart" >
        <img src="<?= \yii\helpers\Url::to('@web/images/cart-icon.png') ?>" style="width:25px;"/>
        ตะกร้าสินค้า
        <span class="my-cart">
            <?php if (!empty($cart)): ?>
                <span class="badge" id="globalCart"><?= $cart ?></span>  
            <?php endif; ?>
        </span>
    </a>
</li>
<li class="dropdown bg-green">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= Yii::t('section', 'MORE...') ?> <span class="caret"></span></a>
    <ul class="dropdown-menu ">
        <li><a href="/sections/order/my-order"><?= Yii::t('appmenu', 'REQUEST INFORMATION') ?></a></li>
        <li><a href="/sections/cart/my-cart"><?= Yii::t('section', 'รายการคำร้องขอ') ?></a></li>
        <li><a href="/account/sign-in/logout" data-method="post" tabindex="-1"><i class="fa fa-unlock-alt"></i>  <?= Yii::t('appmenu', 'LOGOUT') ?></a></li>
    </ul>
</li>
<li class="clip-right bg-green"><a class="menu-height"></a></li>
