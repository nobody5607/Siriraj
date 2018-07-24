<div class="panel panel-default">
    <div class="panel-body">
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

