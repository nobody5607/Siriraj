<?php 
    use yii\helpers\Html;
?>
<div class="row" style="margin-bottom:20px;">    
    <div class="col-md-12">
 
            <div class="input-group">
              <?= Html::textInput('search', '', ['class'=>'form-control', 'placeholder'=>'Search'])?>
              <div class="input-group-btn">
                  <?php
//                        use kartik\select2\Select2;
//
//                           $data = \common\models\FileType::find()->all();
//                           $data = \yii\helpers\ArrayHelper::map($data, 'id', 'name');
//                           echo Select2::widget([
//                               'name' => 'state_2',
//                               'id'=>'xxx',
//                               'value' => '',
//                               'data' => $data,
//                               'options' => ['multiple' => true, 'placeholder' => 'Select Type']
//                           ]);
                 ?>
                <button class="btn btn-primary btnSearch" type="submit"><i class="fa fa-search"></i></button>
              </div>
            </div>
       
 
    </div>
</div>
<?php 
    $this->registerCss("
   .input-group-addon, .input-group-btn {
    width: 30%;
    white-space: nowrap;
    vertical-align: middle;
}
.input-group {
    position: relative;
    display: table;
    border-collapse: separate;
    width: 90%;
}
.select2-container--krajee .select2-selection {
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    box-shadow: inset 0 1px 1px rgb(255, 255, 255);
    background-color: #fff;
    border: 1px solid #ccc;
    /* border-radius: 4px; */
    color: #555555;
    font-size: 14px;
    outline: 0;
    margin-left: -2px;
    border-radius:0;
}
");
?>
 
<?php 
    $this->registerJs("
       $('.btnSearch').on('click', function(){
            let url ='/knowledges?parent_id=11';
            location.href = url;
        }); 
    ");
?>