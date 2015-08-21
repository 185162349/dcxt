<div class="site-index">
    <div class="body-content">

        <div class="row">
            <table class="table">
                <tr>
                    <td>菜品名称</td>
                    <td>单价</td>
                    <td>数量</td>
                    <td>总金额</td>
                </tr>
                <?php foreach($models as $model) :?>
                    <tr>
                        <td><span><?= $model['cai_name']?></span></td>
                        <td><span><?= $model['cai_money']?></span></td>
                        <td><span><?= $model['num']?></span></td>
                        <td><span><?= $model['total_money']?></span></td>
                    </tr>
                <?php endforeach;?>
                <td><button><a href="<?= \yii\helpers\Url::to(['site/index'])?>">继续订购</a></button></td>
                <?php
                if(!empty($models)) :
                ?>
                <td><button><a href="<?= \yii\helpers\Url::to(['cai/address'])?>">下一步</a></button></td>
                <?php endif ;?>
            </table>
        </div>

    </div>
</div>
