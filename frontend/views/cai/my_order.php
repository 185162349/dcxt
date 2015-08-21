<div class="site-index">
    <div class="body-content">

        <div class="row">
            <table class="table">
                <tr>
                    <td>订单总额</td>
                    <td>下单时间</td>
                    <td>受理时间</td>
                    <td>订单状态</td>
                </tr>
                <?php foreach($models as $model) :?>
                    <tr>
                        <td><span><?= $model['money']?></span></td>
                        <td><span><?= date("Y-m-d H:i:s",$model['created_at'])?></span></td>
                        <td><span><?= empty($model['updated_at']) ? '未受理' : date("Y-m-d H:i:s",$model['updated_at'])?></span></td>
                        <td><span><?= $model['status'] == 0 ? '已提交' : '已受理'?></span></td>
                        <td><button class="btn" type="button"><a href="<?= \yii\helpers\Url::to(['cai/views','id' => $model['id']]) ?>">查看详情</a>
                        </button></td>
                    </tr>
                <?php endforeach;?>
            </table>
        </div>

    </div>
</div>