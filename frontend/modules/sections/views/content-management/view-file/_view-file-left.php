<?php

use yii\helpers\Html;

\janpan\jn\assets\jlightbox\JLightBoxAsset::register($this);
\janpan\jn\assets\file_download\FileDownloadAsset::register($this);
?>
<div class="col-md-8 view-file-left">
    <div class="panel panel-default">
        <div class="panel-heading">
<?php //appxq\sdii\utils\VarDumper::dump($dataDefault); ?>
<?= $dataDefault['file_name_org'] ?>
        </div> 
        <div class="panel-body" style="overflow: hidden;">  
            <div class="row" style="margin-bottom:10px;text-align: center;" id="preview-file">
                <div class="col-md-12">                     
                    <div style="background: #292929; padding: 5px; border: 1px solid #bdbdbd; border-radius: 5px;">
                        <?php
                        if ($dataDefault['file_type'] == '2') {                            
                            if ((!Yii::$app->user->isGuest) && (Yii::$app->user->can("administrator") || Yii::$app->user->can("admin"))) {
                                //echo "<div class='label label-default pull-left'><a href='{$dataDefault['file_path']}/{$dataDefault['file_name']}' download>Download</a></div>";
                                echo "<div class='label label-default pull-right'>2124 x 1414 Pixel</div>";
                                echo "<div id='lightgallerys'>";
                                echo Html::beginTag("div", ['class' => 'flex-3', 'data-src' => "{$dataDefault['file_path']}/{$dataDefault['file_name']}", 'data-sub-html' => "{$dataDefault['description']}"]);
                                echo \yii\helpers\Html::img("{$dataDefault['file_path']}/{$dataDefault['file_name']}", [
                                    'class' => 'img img-responsive'
                                ]);                                
                                echo Html::endTag("div");                                
                                echo "</div>";                                
                                
                            } else {

                                echo "<div class='label label-default pull-right'>1024 x 768 Pixel</div>";
                                echo "<div id=''>";
                                echo Html::beginTag("div", ['class' => 'flex-3', 'data-src' => "{$dataDefault['file_path']}/thumbnail/{$dataDefault['file_name']}", 'data-sub-html' => "{$dataDefault['description']}"]);
                                    echo \yii\helpers\Html::img("{$dataDefault['file_path']}/thumbnail/{$dataDefault['file_name']}", [
                                        'class' => 'img img-responsive'
                                    ]);
                                echo Html::endTag("div");
                                echo "</div>";
                            }
                            $modelImage = $dataProvider->getModels();
                                echo "<div id='lightgallery' style='height: 80px;
                                                                    overflow: hidden;
                                                                    display: flex;
                                                                    flex-direction: row;
                                                                    /* flex-basis: 54%; */
                                                                    flex-wrap: wrap;
                                                                    padding: 10px;'>";
                                    foreach($modelImage as $k=>$v){
                                        echo Html::beginTag("div", ['class' => '', 'data-src' => "{$v['file_path']}/{$v['file_name']}", 'data-sub-html' => "{$v['description']}"]);
                                        echo \yii\helpers\Html::img("{$v['file_path']}/{$v['file_name']}", [
                                            'class' => 'img img-responsive',
                                            'style'=>'width:80px;height:80px;    padding: 5px;'
                                        ]);                                
                                        echo Html::endTag("div"); 
                                    }
                               echo "</div>"; 


                            // echo yii\helpers\Html::img("{$dataDefault['file_path']}/{$dataDefault['file_name']}", ['class'=>'img img-responsive','style'=>"width:1024px;"]);
                        } elseif ($dataDefault['file_type'] == 3) {
                            echo"
                                <video style='width:100%' controls controlsList='nodownload'>
                                    <source src='{$dataDefault['file_path']}/{$dataDefault['file_name']}' type='video/mp4'>                 
                                    Your browser does not support the video tag.
                                </video>
                            ";
                        } elseif ($dataDefault['file_type'] == 4) {
                            echo"
                                <audio style='width:100%' controls controlsList='nodownload'>
                                    <source src='{$dataDefault['file_path']}/{$dataDefault['file_name']}' type='audio/mpeg'>                 
                                    Your browser does not support the audio tag.
                                </audio>
                            ";
                        } else {
                            //echo "{$dataDefault['file_path']}/{$dataDefault['file_name']}";
                            $api = \backend\modules\cores\classes\CoreOption::getParams("preview_doc", 'e');
                            $file_type = ['ppt','pptx','doc','docx','xls','xlsx']; 
                            $type = explode('.', $dataDefault['file_name']);
                            $type = isset($type[1]) ? $type[1] : 'doc';
                             
                            if(in_array($type, $file_type)){
                                echo " 
                                    <iframe id='iframe' src='{$api}{$dataDefault['file_path']}/{$dataDefault['file_name']}&amp;wdStartOn=1' width='100%' height='500px' frameborder='0'>This is an embedded <a target='_blank' href='https://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='https://office.com/webapps'>Office Online</a>.</iframe>
                                ";
                                if($type == "doc" || $type == 'docx'){
                                    echo "<div id='#myFrame' style='    background: #ffffff; position: absolute; bottom: 12px; height: 16px; width: 28%;    right: 28px;'></div>";
                                }else if($type == "xls" || $type == 'xlsx'){
                                    echo "<div id='#myFrame' style='    background: url(https://c1-excel-15.cdn.office.net:443/x/s/161090431876__layouts/Resources/ewaembed.png); position: absolute; bottom: 12px; height: 25px; width: 28%;    right: 28px;'></div>";
                                }else{
                                    echo "<div id='#myFrame' style='    background: #444444; position: absolute; bottom: 12px; height: 20px; width: 28%;    right: 28px;'></div>";
                                }    
                            }else if($type == 'pdf'){
                                $this->registerJs("
                                    
                                    
                                    function convert(){
                                        let url='/site/create-file';
                                        let params={id:'".$dataDefault['id']."'};
                                        $('#preview-file').html('<div style=\'text-align:center;margin:0 auto;\'><i class=\"fa fa-spinner fa-spin fa-3x fa-fw\"></i></div>')    
                                        $.post(url,params, function(data){
                                            if(data['status'] == 'success'){
                                                view();
                                            }
                                        });
                                    }
                                    function view(){
                                        let url='/site/view-file';
                                        let params={id:'".$dataDefault['id']."'};
                                        $.post(url,params, function(data){
                                            $('#preview-file').html(data);
                                        });
                                    } 
                                    view();
                                    //convert();
                                ");
                            }
                            
                           
                        }
                        ?>
                    </div>
                </div>
            </div> 
        </div>
    </div> 

    <div class="panel">
        <div class="panel-body">
            <?php
            echo \yii\widgets\ListView::widget([
                'dataProvider' => $dataProvider,
                'options' => [
                    'tag' => 'div',
                    'class' => 'row',
                    'id' => 'file_types',
                ],
                'itemOptions' => function($model) {
                    return ['tag' => 'div', 'data-id' => $model['id'], 'class' => 'col-md-4 col-50', 'style' => '    border: 1px solid #f3f3f3; margin-bottom:0px;'];
                },
                'layout' => "{pager}\n{items}\n",
                'itemView' => function ($model, $key, $index, $widget) {
                    return $this->render('_item', ['model' => $model]);
                },
            ]);
            ?>
            <div class="clearfix"></div>
            <?php if (!Yii::$app->user->isGuest) { ?>

<?php } ?>
        </div>
    </div>
</div>


<?php richardfan\widget\JSRegister::begin(); ?>
<script>

    setTimeout(function () {
        $('#lightgallery').lightGallery();
    }, 1000);
     
    
    $('#btnDownload').on('click', function () {
        let checkboxValues = [];
        $('input[type="checkbox"]:checked').each(function (index, elem) {
            checkboxValues.push($(elem).attr('data-id'));
        });
        let id_str = checkboxValues.toString();
        if (!id_str) {
            let res = {message:'<?= Yii::t('section','Please select a file.')?>',status:'error'};
            <?= \appxq\sdii\helpers\SDNoty::show('res.message', 'res.status') ?>
            return false;
        }
        checkboxValues.map(function(id){
            let url = '/site/convert';//$(this).attr('data-href');           
            let name = id;
            let type = $(this).attr('data-type');
            //download("data:image/gif;base64,R0lGODlhRgAVAIcAAOfn5+/v7/f39////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////yH5BAAAAP8ALAAAAABGABUAAAj/AAEIHAgggMGDCAkSRMgwgEKBDRM+LBjRoEKDAjJq1GhxIMaNGzt6DAAypMORJTmeLKhxgMuXKiGSzPgSZsaVMwXUdBmTYsudKjHuBCoAIc2hMBnqRMqz6MGjTJ0KZcrz5EyqA276xJrVKlSkWqdGLQpxKVWyW8+iJcl1LVu1XttafTs2Lla3ZqNavAo37dm9X4eGFQtWKt+6T+8aDkxUqWKjeQUvfvw0MtHJcCtTJiwZsmLMiD9uplvY82jLNW9qzsy58WrWpDu/Lp0YNmPXrVMvRm3T6GneSX3bBt5VeOjDemfLFv1XOW7kncvKdZi7t/S7e2M3LkscLcvH3LF7HwSuVeZtjuPPe2d+GefPrD1RpnS6MGdJkebn4/+oMSAAOw==", "dlDataUrlBin.gif", "image/gif");
            $.get(url, {id:id,multi:'true'}, function(data){
                if(data.status=='success'){
                    if(data['data']['type']==5 || data['data']['type']==7){
                        downloadFile(data['data']['href'], data['data']['file_name']);
                    }else{
                        download(data['data']['href'], data['data']['file_name']);
                    }
                }
                 //download(data, name);
            });    
//            if(type == '5'){
//
//                downloadFile($(this).attr('href'), name);
//            }else{
//                
//            }
        });
        
        
        return false;
    });
    
    $('#btnCart').on('click', function () {
        let checkboxValues = [];
        $('input[type="checkbox"]:checked').each(function (index, elem) {
            checkboxValues.push($(elem).attr('data-id'));
        });
        let id_str = checkboxValues.toString();
        if (!id_str) {
            let res = {message:'<?= Yii::t('section','Please select a file.')?>',status:'error'};
            <?= \appxq\sdii\helpers\SDNoty::show('res.message', 'res.status') ?>
            return false;
        }
        let url = "/sections/cart/add-cart";
        let size = $('.check-size:checked').val();
        $.post(url, {id: id_str, size: size}, function (res) {
            if (res['status'] == 'success') {
                $('#globalCart').html(res['data']['count']);
<?= \appxq\sdii\helpers\SDNoty::show('res.message', 'res.status') ?>
                setTimeout(function () {
                    location.reload();
                }, 1000);
            }

        });
        return false;
    });

    $('input[name="selectAll"]').change(function () {
        let id = $(this).attr('data-id');
        if ($(this).is(":checked")) {

            $('#label-' + id).css({background: '#3867d6', color: '#fff', padding: '5px'});
            $('.checkbox').each(function () { //loop through each checkbox
                $(this).attr('checked', true); //check 
            });
        } else {
            //console.log('uncheck');
            $('.checkbox').each(function () { //loop through each checkbox
                $(this).attr('checked', false); //uncheck              
            });

            $('#label-' + id).css({background: 'transparent', color: '#000', padding: '5px'});
        }
        //$('#textbox1').val($(this).is(':checked'));        
    });








 function disableselect(e){
return false
}

function reEnable(){
return true
}

//if IE4+
document.onselectstart=new Function ("return false")

//if NS6
if (window.sidebar){
document.onmousedown=disableselect
document.onclick=reEnable
}

var message="Function Disabled!";
///////////////////////////////////
function clickIE() {if (document.all) {alert(message);return false;}}
function clickNS(e) {if 
(document.layers||(document.getElementById&&!document.all)) {
if (e.which==2||e.which==3) {return false;}}}
if (document.layers) 
{document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;}
else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;}

document.oncontextmenu=new Function("return false");
document.addEventListener("keydown", onKeyDown, false);

function onKeyDown(e) {
 var x = e.keyCode;
 if(x==123){
  console.log('Your pressed Fn+F7');
  return false;
 }
}

 

</script>
<?php richardfan\widget\JSRegister::end(); ?>

<?php \appxq\sdii\widgets\CSSRegister::begin(); ?>
<style>
    #myFrame {
        
    }
    #iframe div#WordViewerStatusBar {
        display: none;
    }

    /* Hide the browser's default checkbox */
    .container input[type='checkbox'] {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }

    /* Create a custom checkbox */
    .checkmark {
        position: absolute;
        top: 5px;
        left: 36px;
        height: 25px;
        width: 25px;
        background-color: #fff;
        border: 1px solid #88888c;
        border-radius: 5px;
        cursor: pointer;
    }

    /* On mouse-over, add a grey background color */
    .container:hover input ~ .checkmark {
        background-color: #fff;
        border: 1px solid #4e1228;
    }

    /* When the checkbox is checked, add a blue background */
    .container input:checked ~ .checkmark {
        background-color: #d2ab66;
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
    .view-file-left,.view-file-right{margin-top:5px;}
</style>
<?php \appxq\sdii\widgets\CSSRegister::end(); ?>