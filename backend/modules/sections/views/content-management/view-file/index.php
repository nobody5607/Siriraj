<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><b>&times;</b></button>
    <h4 class="modal-title" id="itemModalLabel"><b>Sections</b></h4>
</div>
<div class="modal-body">

    <div class="row">
        <?= $this->render('_view-file-left',['dataProvider'=>$dataProvider,'dataDefault'=>$dataDefault])?>
        <?= $this->render('_view-file-right',['dataProvider'=>$dataProvider,'dataDefault'=>$dataDefault])?>
        
    </div>
</div>
<?php appxq\sdii\widgets\CSSRegister::begin(); ?>
<style>
    @media (min-width: 992px)
    {
        .col-md-2 {
            width: 15.666667%;            
            margin: 4px;
            border-radius: 3px;
            height: 100px;
            padding-top: 10px;
            padding-left: 25px;
        }
    }
</style>
<?php appxq\sdii\widgets\CSSRegister::end(); ?>