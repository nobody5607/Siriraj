<?php 
    $fileType = common\models\FileType::find()->all();
    //\appxq\sdii\utils\VarDumper::dump($section);
?>
<footer class="off-white-bg2 pt-95 bdr-top pt-sm-55">
    <!-- Footer Top Start -->
    <div class="footer-top">
        <div class="container">
            <h2 style="margin-bottom:25px;"><?= Yii::t('section','ตัวอย่างข้อมูลในคลังความรู้')?></h2> 
            <!-- Signup-Newsletter End -->
            <div class="row"> 
                <?php if($fileType): ?>
                    <?php foreach($fileType as $k=>$v):?>
                        <div class="col-md-3 col-sm-6">
                            <div class="single-footer mb-sm-40">
                                <div class="footer-content">
                                    <ul class="footer-list">
                                        <li>
                                            <a target="_blank" href="/sections/session-management/search?type_id=<?= $v['id']?>&txtsearch=">
                                              <?= $v['name'] ?>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>    
                <?php endif; ?>
                <!-- Single Footer Start -->
                
                 
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div><br>
    <div class="footer-top">
        <div class="container">
            <h2 style="margin-bottom:25px;"><?= Yii::t('section','Browse by Category')?></h2> 
            <!-- Signup-Newsletter End -->
            <div class="row"> 
                <?php if($fileType): ?>
                    <?php foreach($fileType as $k=>$v):?>
                        <div class="col-md-3 col-sm-6">
                            <div class="single-footer mb-sm-40">
                                <div class="footer-content">
                                    <ul class="footer-list">
                                        <li>
                                            <a target="_blank" href="/sections/session-management/search?type_id=<?= $v['id']?>&txtsearch=">
                                              <?= $v['name'] ?>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>    
                <?php endif; ?>
                <!-- Single Footer Start -->
                
                 
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Footer Top End -->
    <!-- Footer Middle Start -->
<!--    <div class="footer-middle text-center">
        <div class="container">
            <div class="footer-middle-content pt-20 pb-30">
                <ul class="social-footer">
                    <li><a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://twitter.com/"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="https://plus.google.com/"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="https://www.linkedin.com/"><i class="fa fa-linkedin"></i></a></li>
                    <li>
                        <a href="#"><img src="#" alt="google play"></a>
                    </li>
                    <li>
                        <a href="#"><img src="#" alt="app store"></a>
                    </li>
                </ul>
            </div>
        </div>
         Container End 
    </div>-->
    <!-- Footer Middle End -->
    <!-- Footer Bottom Start -->
    <div class="footer-bottom pb-30">
        <div class="container">

            <div class="copyright-text text-center">
                <p>Copyright © 2018 <a target="_blank" href="#">พิพิธภัณฑ์ศิริราช Website: <a href="http://www.sirirajmuseum.com" target="_blank">www.sirirajmuseum.com  </a>  &nbsp;All Rights Reserved.</p>
            </div>
        </div>
        <!-- Container End -->
    </div>
    <!-- Footer Bottom End -->
</footer>

<?php \appxq\sdii\widgets\CSSRegister::begin();?>
            <style>
                footer.off-white-bg2.pt-95.bdr-top.pt-sm-55 { 
                    background: #F3D39C url(<?= "/images/open.jpg"?>) no-repeat center top;
                    background-size: cover;
                }
            </style>                
<?php \appxq\sdii\widgets\CSSRegister::end();?>   