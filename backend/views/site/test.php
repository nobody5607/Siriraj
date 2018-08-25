<?php 
    kartik\file\FileInputAsset::register($this);
?>
<div class="file-loading">
    <input id="input-700" name="kartik-input-700[]" type="file" multiple>
</div>

<br><br><br><br><br><br>
<?php \richardfan\widget\JSRegister::begin();?>
<script>
    $("#input-700").fileinput({
        uploadUrl: "/site/test",
        maxFileCount: 5
    });
    $("#input-700").on("filepredelete", function(jqXHR) {
        var abort = true;
        if (confirm("Are you sure you want to delete this image?")) {
            abort = false;
        }
        return abort; // you can also send any data/object that you can receive on `filecustomerror` event
    });
</script>
<?php \richardfan\widget\JSRegister::end();?>