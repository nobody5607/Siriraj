<div class="col-md-8 view-file-left">
    <div class="box box-primary">
        <div class="box-header">
            <?php //appxq\sdii\utils\VarDumper::dump($dataDefault);?>
            <?= $dataDefault['name'] ?>
        </div> 
        <div class="box-body">
            
            
            <?php \appxq\sdii\widgets\CSSRegister::begin();?>
            <style>
                                /* The container */
                .container {     
                    position: relative;
                    padding-left: 35px;
                    margin-bottom: 12px;
                    cursor: pointer;
                    font-size: 22px;
                    -webkit-user-select: none;
                    -moz-user-select: none;
                    -ms-user-select: none;
                    user-select: none;
                }

                /* Hide the browser's default checkbox */
                .container input {
                    position: absolute;
                    opacity: 0;
                    cursor: pointer;
                }

                /* Create a custom checkbox */
                .checkmark {
                    position: absolute;
                    top: -15px;
                    left: 0;
                    height: 25px;
                    width: 25px;
                    background-color: #fff;
                    border: 1px solid #88888c;
                    border-radius: 5px;
                }

                /* On mouse-over, add a grey background color */
                .container:hover input ~ .checkmark {
                    background-color: #19a2cb;
                }

                /* When the checkbox is checked, add a blue background */
                .container input:checked ~ .checkmark {
                    background-color: #3867d6;
                }

                /* Create the checkmark/indicator (hidden when not checked) */
                .checkmark:after {
                    content: "";
                    position: absolute;
                    display: none;
                }

                /* Show the checkmark when checked */
                .container input:checked ~ .checkmark:after {
                    display: block;
                }

                /* Style the checkmark/indicator */
                .container .checkmark:after {
                    left: 10px;
                    top: 3px;
                    width: 6px;
                    height: 15px;
                    border: solid white;
                    border-width: 0 3px 3px 0;
                    -webkit-transform: rotate(45deg);
                    -ms-transform: rotate(45deg);
                    transform: rotate(45deg);
                }
            </style>
            <?php \appxq\sdii\widgets\CSSRegister::end();?>
            
            
            <div class="row" style="margin-bottom:10px;">
                <div class="col-md-6 col-md-offset-3">
                    <?php 
                        if($dataDefault['file_type'] == '2'){
                            echo yii\helpers\Html::img("/images/{$dataDefault['file_name_org']}", ['class'=>'img img-responsive','style'=>"width:1024px;"]);
                        }elseif ($dataDefault['file_type'] == 3) {
                            echo"
                                <video style='width:100%' controls>
                                    <source src='/videos/{$dataDefault['file_name_org']}' type='video/mp4'>                 
                                    Your browser does not support the video tag.
                                </video>
                            ";
                        }
                    ?>
 
                </div>
            </div>
            <?php if(!Yii::$app->user->isGuest):?>
            <div class="col-md-12">
                <div class="col-md-12">
                    <div class="col-md-12">
                        <label class='container' >
                            <input type='checkbox'  id='checkbox' name='selectAll' data-id="<?= $dataDefault['id']?>">
                            <span class='checkmark'></span>
                            <span style="width: 100px;position: absolute;top: -14px;font-size: 14px;left: 30px;">Select all</span>
                        </label>
                    </div>
                </div>  
            </div><br>
            <?php endif;?>
            <?php             
            echo \yii\widgets\ListView::widget([
                'dataProvider' => $dataProvider,
                'options' => [
                    'tag' => 'div',
                    'class' => 'col-md-12',
                    'id' => 'file_types',
                ],
                'itemOptions' => function($model) {
                    return ['tag' => 'div', 'data-id' => $model['id'], 'class' => 'col-md-2 col-sm-4 col-xs-6','style'=>'margin-bottom:80px;height: 80px;'];
                },
                'layout' => "{pager}\n{items}\n",
                'itemView' => function ($model, $key, $index, $widget) {
                    return $this->render('_item', ['model' => $model]);
                },
            ]);
            ?>
            <div class="clearfix"></div>
            <?php if (!Yii::$app->user->isGuest) { ?>
                <div class="text-center" style="margin-top:50px;margin-bottom:50px;">
                    <button class="btn btn-success btn-lg" id="btnCart"><i class="fa fa-shopping-cart" aria-hidden="true"></i> เลือกลงตะกร้า</button>
                </div>
            <?php } ?>
        </div>
    </div>
    
    <div class="row"> 
        <div class="col-md-12">
            <?php if (!Yii::$app->user->isGuest):  ?>
            <div class="box box-primary">
                <div class="box-body">
                    <h3 class="text-center">ขอความอนุเคราะห์ภาพหรือข้อมูล โปรดปฏิบัติตามกติกา ดังนี้ </h3>
                    <div>
                        <p>1. <i class="fa fa-check-square-o"></i> คลิกเลือกภาพหรือข้อมูลที่ต้องการ ลง เลือกลงตะกร้า</p> 
                        <p>2. ระบบจะรวบรวมข้อมูล ออกเป็นแบบฟอร์มให้ท่านกรอกคำร้องขอ</p>
                        <p>3. เมื่อเจ้าหน้าที่ได้รับอีเมล์ จะติดต่อกลับ เพื่อตกลงวิธีส่งมอบข้อมูล</p>
                    </div>
                </div>
            </div>           
            <?php endif; ?>
        </div>
    </div>
</div>
<?php richardfan\widget\JSRegister::begin();?>
<script>
    $('#btnCart').on('click', function(){
        let checkboxValues = [];
        $('input[type="checkbox"]:checked').each(function(index, elem) {
            checkboxValues.push($(elem).attr('data-id'));
        });
       let id_str = checkboxValues.toString();
       if(!id_str){return false;}
       let url = "/sections/cart/add-cart";  
       let size = $('.check-size:checked').val();
       $.post(url, {id:id_str, size:size}, function(res){
           if(res['status'] == 'success'){
               $('#globalCart').html(res['data']['count']);
               <?= \appxq\sdii\helpers\SDNoty::show('res.message', 'res.status') ?>
               setTimeout(function(){
                  location.reload();     
               },1000);
           }
           
       });
       return false; 
    });
    
    $('input[name="selectAll"]').change(function() {
        let id = $(this).attr('data-id');
        if($(this).is(":checked")) {            
             
            $('#label-'+id).css({background:'#3867d6', color:'#fff', padding:'5px'});
            $('.checkbox').each(function () { //loop through each checkbox
                $(this).attr('checked', true); //check 
            });
        }else{
            //console.log('uncheck');
            $('.checkbox').each(function () { //loop through each checkbox
                $(this).attr('checked', false); //uncheck              
            });
            
            $('#label-'+id).css({background:'transparent', color:'#000', padding:'5px'});
        }
        //$('#textbox1').val($(this).is(':checked'));        
    });
    
    
     
    
</script>
<?php richardfan\widget\JSRegister::end();?>

<?php appxq\sdii\widgets\CSSRegister::begin(); ?>
<style> 
</style>
<?php appxq\sdii\widgets\CSSRegister::end(); ?>