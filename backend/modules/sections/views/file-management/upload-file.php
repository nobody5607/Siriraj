<?php 
    use yii\helpers\Html;
    kartik\file\FileInputAsset::register($this);
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="itemModalLabel">Upload Files</h4>
</div>
<div class="modal-body">
    <?php
        $url_upload = "";
        $accept = '';
        if ($model->file_type == 2 || $model->file_type == 6) {            
            $accept = 'image/*';
        } else if ($model->file_type == 3) {//วีดีโอ (ตัดต่อ)
            $accept = 'video/*';
        } else if ($model->file_type == 5) {//document 
            $accept = '*';
        }
    ?>
    <div class="file-loading">
        <input id="input-700" name="name[]" type="file" multiple accept="<?= $accept?>">
    </div>
</div>
<div class="modal-footer">
    <div class="col-md-4 col-md-offset-4">
        <?= Html::submitButton('Close',['class'=>'btn btn-default btn-lg btn-block', 'data-dismiss'=>'modal']) ?>
    </div>
</div>
<?php \richardfan\widget\JSRegister::begin();?>
<script>
    $('.btnSubmit').prop('disabled', true);
    $("#input-700").fileinput({        
        uploadUrl: "/sections/file-management/upload-file",
        minFileCount:0,
        maxFileCount:1000,
        showUpload:false,
        showRemove:false,
        uploadExtraData: function() {
            return {
                content_id: "<?= Yii::$app->request->get('content_id', '')?>",
                file_type: "<?= $model->file_type?>"
            };
        },
        //ajaxSettings: { headers: { Authorization: 'Bearer ' + localStorageService.get('authorizationData').token } }    
    }).on("filebatchselected", function(event, files) {
        $("#input-700").fileinput("upload");
        $('.btnSubmit').prop('disabled', false);
    }).on('filebatchuploadcomplete', function (event, data, previewId, index) {
           $('#input-700').fileinput('reset');
          // location.reload();
    }).on('filebatchuploaderror', function (event, data, previewId, index) {
       console.log(data);
    });
    $(document).on('hide.bs.modal','#modal-contents', function () {
      location.reload();
    //Do stuff here
   });
    
</script>
<?php \richardfan\widget\JSRegister::end();?>

