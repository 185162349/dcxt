<div class="row-fluid">
    <div class="span8">
        <h3>
            <?= $model['title']?>
        </h3>
        <h4><?= date('Y-m-d',$model['created_at'])?></h4>
    </div>
    <div class="span4">
    </div>
</div>
<div class="row-fluid">
    <div class="span12">
        <?= $model['content']?>
    </div>
</div>