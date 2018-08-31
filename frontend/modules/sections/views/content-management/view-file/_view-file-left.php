<div class="col-md-8 view-file-left">
    <div class="box box-primary">
        <div class="box-header">
            <?php //appxq\sdii\utils\VarDumper::dump($dataDefault);?>
            <?= $dataDefault['file_name_org'] ?>
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
                <div class="col-md-8 col-md-offset-2" style="    background: #d2d6de; padding: 5px; border: 1px solid #bdbdbd; border-radius: 5px;">
                    <?php 
                        if($dataDefault['file_type'] == '2'){
                            if((!Yii::$app->user->isGuest) && (Yii::$app->user->can("administrator") || Yii::$app->user->can("admin"))){
                               echo "<div class='label label-default pull-right'>2124 x 1414 Pixel</div>";
                                echo \yii\helpers\Html::img("{$dataDefault['file_path']}/{$dataDefault['file_name']}", [
                                'class'=>'img img-responsive',
                                'style'=>'width:2124px;'   
                               ]);
                               
                            }else{
                                echo "<div class='label label-default pull-right'>1024 x 768</div>";
                                echo \yii\helpers\Html::img("{$dataDefault['file_path']}/{$dataDefault['file_name']}", [
                                    'class'=>'img img-responsive',
                                    'style'=>'width:1024px;'
                                ]); 
                                
                            }
                            
                            
                           // echo yii\helpers\Html::img("{$dataDefault['file_path']}/{$dataDefault['file_name']}", ['class'=>'img img-responsive','style'=>"width:1024px;"]);
                        }elseif ($dataDefault['file_type'] == 3) {
                            echo"
                                <video style='width:100%' controls>
                                    <source src='{$dataDefault['file_path']}/{$dataDefault['file_name']}' type='video/mp4'>                 
                                    Your browser does not support the video tag.
                                </video>
                            ";
                        }elseif ($dataDefault['file_type'] == 4) {
                            echo"
                                <audio style='width:100%' controls>
                                    <source src='{$dataDefault['file_path']}/{$dataDefault['file_name']}' type='audio/mpeg'>                 
                                    Your browser does not support the audio tag.
                                </audio>
                            ";
                        }else{
                            echo "<div class='text-center'><i class='fa fa-file-o' style='font-size:50pt;'></i></div>";
                            echo "<div class='text-center'>{$dataDefault['file_name_org']}</div>";
                        }
                    ?>
 
                </div>
            </div>
            <?php if(!Yii::$app->user->isGuest):?>
                <div class="col-md-12" style="display:none;">
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
                <hr/>
            <?php             
            echo \yii\widgets\ListView::widget([
                'dataProvider' => $dataProvider,
                'options' => [
                    'tag' => 'div',
                    'class' => 'col-md-12',
                    'id' => 'file_types',
                ],
                'itemOptions' => function($model) {
                    return ['tag' => 'div', 'data-id' => $model['id'], 'class' => 'col-md-3 col-sm-4 col-xs-6','style'=>'margin-bottom:80px;'];
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
                    <button class="btn btn-success btn-lg" id="btnCart"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <?= Yii::t('section','Add to cart')?></button>
                </div>
            <?php } ?>
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
    @media screen and (max-width: 768px){        
        #box div h4 , .box-header{
            font-size:12pt;font-weight: bold;
        }
        #box div div p, .box-body .btn{
            font-size:10pt;
        } 
    }
</style>
<?php appxq\sdii\widgets\CSSRegister::end(); ?>