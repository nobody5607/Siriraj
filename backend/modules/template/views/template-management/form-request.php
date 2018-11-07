<?php 
    $this->title = Yii::t('_app', 'Request information');
    $this->params['breadcrumbs'][] = $this->title;
    use yii\helpers\Html;
    $template =  backend\modules\cores\classes\CoreOption::getParams('form_request');     
?>

<div class="box box-primary">
    <div class="box-header">
        <?= Html::encode($this->title);?>
    </div>
    <div class="box-body">
        <div style="    width: 650px;">
        <?php 
            echo \janpan\jn\widgets\FroalaEditorWidget::widget([
                'name'=>'template',
                'value'=>$template['option_value'],
                'toolbar_size'=>'lg',
                'options'=>['class'=>'eztemplate', 'id'=>'template'],
            ]);    

        ?>
        </div>
    </div>
    <div class="box-footer">
        <div class="row">
            <div class="col-md-7">
                <?= Html::button('Submit', ['class'=>'btn btn-primary btn-block btn-lg btnSubmit'])?>
            </div>
        </div>
    </div>
</div>

<?php richardfan\widget\JSRegister::begin(); ?>
<script>
    $('.btnSubmit').on('click', function(){
       let option_value = $('#template').val();
       let option_name = '<?= $template['option_name']?>'
       let url = '/template/template-management/form-request';
       let params = { option_name:option_name, option_value:option_value};
       $.post(url, params, function(data){
    
        });
       console.log(template);
       return false; 
    });
</script>
<?php richardfan\widget\JSRegister::end();?>