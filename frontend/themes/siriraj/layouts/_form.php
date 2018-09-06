<?php ?>
<div class="categorie-search-box">
    <form id="formSearch">
        <div class="form-group">
            <select class="bootstrap-select" id="select-type-search" name="poscats">
                <option value="0"><?= Yii::t('section', 'Browse by Category') ?></option>
                <?php foreach ($type as $t) { ?>
                    <option value="<?= $t['id'] ?>" data-id='<?= $t['id'] ?>'><?= $t['name'] ?></option>                                     
                <?php } ?>                               
            </select>
        </div>
        <input type="text" name="search" id="text_search_params" placeholder="<?= Yii::t('section', 'Search Images') ?>">
        <button><i class="lnr lnr-magnifier"></i></button>
    </form>
</div>