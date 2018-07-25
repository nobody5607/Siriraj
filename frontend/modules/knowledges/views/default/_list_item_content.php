<div class="card" style="margin: 15px;">
    <div class="card-body">
        <a href="/knowledges?parent_id=<?= $model['id']?>">
            <h4> <?= $model['name']?></h4>
            <div>
               <small><i class="fa fa-calendar"></i> <?= appxq\sdii\utils\SDdate::mysql2phpDate($model['create_date']); ?></small>
            </div>
            <div class="description">
                <?= $model['description']?>
            </div>
        </a>
    </div>
</div>

