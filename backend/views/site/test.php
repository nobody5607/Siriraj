<form enctype="multipart/form-data" action="upload.php" method="post">
    <input name="file[]" type="file" />
    <button class="add_more">Add More Files</button>
    <input type="button" value="Upload File" id="upload"/>
</form>

<?php \richardfan\widget\JSRegister::begin();?>
<script>
    $('.add_more').click(function(e){
        e.preventDefault();
        $(this).before("<input name='file[]' type='file'/>");
    });
</script>
<?php \richardfan\widget\JSRegister::end();?>