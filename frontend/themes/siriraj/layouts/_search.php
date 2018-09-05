<?php 
    $type = frontend\modules\sections\classes\JFiles::getTypeFile();
    //\appxq\sdii\utils\VarDumper::dump($type);
?>
<div class="container">
    <div class="row align-items-center no-gutters">
        <div class="col-lg-2 col-md-12">
            <div class="logo mb-all-30">
                <a href="/"><img src="/images/logosirirajweb3.png" alt="logo-image"></a>
            </div>
        </div>
        <!-- Categorie Search Box Start Here -->
        <?php if (Yii::$app->user->isGuest): ?>
            <div class="col-lg-10 col-md-8 ml-auto  col-10">
            <?php else: ?>
                <div class="col-lg-7 col-md-8 ml-auto  col-10">
                <?php endif; ?>

                <div class="categorie-search-box">
                    <form id="formSearch">
                        <div class="form-group">
                            <select class="bootstrap-select" id="select-type-search" name="poscats">
                                <option value="0"><?= Yii::t('section', 'Browse by Category')?></option>
                                <?php foreach ($type as $t) { ?>
                                    <option value="<?= $t['id'] ?>" data-id='<?= $t['id'] ?>'><?= $t['name'] ?></option>                                     
                                <?php } ?>                               
                            </select>
                        </div>
                        <input type="text" name="search" id="text_search_params" placeholder="<?= Yii::t('section', 'Search  for ...') ?>">
                        <button><i class="lnr lnr-magnifier"></i></button>
                    </form>
                </div>
            </div>
            <!-- Categorie Search Box End Here -->
            <!-- Cart Box Start Here -->
            <?php if (!Yii::$app->user->isGuest): ?>
            <?php 
                $cart = isset(Yii::$app->session["cart"]) ? count(Yii::$app->session["cart"]) : 0;
            ?>
                <div class="col-lg-3 col-md-12">
                    <div class="cart-box mt-all-30">
                        <ul class="d-flex justify-content-center align-items-center">                                     
                            <li>
                                <a href="/sections/cart/my-cart">
                                        <i class="lnr lnr-cart"></i>
                                        <span class="my-cart">
                                            <span class="total-pro" id="globalCart"> <?= $cart?></span>
                                            <span><?= Yii::t('appmenu','My Cart')?></span>                                            
                                        </span>
                                    </a>
                                </li>                                    
                            <li>
                                <?php
                                $userProfile = isset(Yii::$app->user->identity->userProfile) ? Yii::$app->user->identity->userProfile : '';
                                $avatar_img = '<img class="img-circle" width="18" src="' . Yii::$app->user->identity->userProfile->image . '"/>';
                                ?>
                                <a href="#">

                                    <i class='lnr lnr-user'></i>
                                    <ul class="ht-dropdown cart-box-width">
                                        <li><a href="/account/default/settings"><i class="fa fa-user"></i>  <?= Yii::t('appmenu', 'My Profile') ?></a></li>
                                        <li><a href="/sections/order/my-order"><i class="fa fa-check-square-o"></i>  <?= Yii::t('appmenu', 'My Orders') ?></a></li>
                                        <li><a href="/account/sign-in/logout" data-method="post" tabindex="-1"><i class="fa fa-unlock-alt"></i>  <?= Yii::t('appmenu', 'Logout') ?></a></li>
                                    </ul>
                                    <span class="my-cart">
                                        <span></span>
                                        <span> 
                                            <strong><?= "{$userProfile->firstname} {$userProfile->lastname}"; ?></strong>
                                        </span>

                                    </span>
                                </a>



                            </li>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
            <!-- Cart Box End Here -->
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div> 
<?php 
   $controllerID = Yii::$app->controller->id ;
   $actionID = Yii::$app->controller->action->id;
   //\appxq\sdii\utils\VarDumper::dump($actionID);
?>
<?php    richardfan\widget\JSRegister::begin(); ?>
<script>
    var select_type_search=0;
    $('#select-type-search').on('change', function(){
       let value = $(this).val();
       select_type_search = value;        
    });
    $('#formSearch').on('submit', function(){
        let type_id = select_type_search;
        let txtsearch = $('#text_search_params').val();
        let params = {type_id:type_id, txtsearch:txtsearch};
        //console.log(params);return false;
        let url = "/sections/session-management/search?type_id="+type_id+"&txtsearch="+txtsearch;
        let actionID = "<?= $actionID?>";
        
        if(actionID == "search"){
           window.open(url,'_parent');
        }else{
            window.open(url,'_blank');  
        }
       
        //location.href = url;
        
        return false;
    });
    $('.select_type').on('click', function(){
        let id = $(this).attr('data-id');
        $('#search_param').val(id);
       
    });
    
</script>
<?php    richardfan\widget\JSRegister::end();?>