<?php
/* @var $this yii\web\View */
$this->title = '校园订餐系统';
\frontend\assets\AppIndexAsset::register($this);
?>
<div class="row">
<div class="span12">
<div class="row">
    <div class="span8">
    <div class="row">
        <?php foreach($models as $model) :?>
    <div class="span4" style="margin-top: 20px;">
        <div class="row">
            <div class="span3">
                <img alt="140x140" src="image/<?= $model['img']?>" style="width: 250px;height: 180px"/>
            </div>
            <div class="span1">
                <dl>
                    <dt>
                        <?= $model['name'] ?>
                    </dt>
                </dl>
                <dl>
                    <dt>
                        <?= $model['money'] ?> 元
                    </dt>
                </dl>
                <button class="btn" type="button"><a class="yuding" title="<?= $model['name']?>" href="<?= \common\helpers\LoginHelper::isGuest()? '' : \yii\helpers\Url::to(['cai/view','id' => $model['id']]) ?>">预定</a>
                    </button>
            </div>
        </div>
    </div>
    <?php endforeach ;?>
    </div>
    </div>
<div class="row">
<div class="span4" style="position: fixed;top:50px;right: 0px">
    <h3>系统公告</h3>
    <ol>
        <?php foreach($noticeModels as $noticeModel) :?>
        <li >
            <a href="<?= \yii\helpers\Url::to(['notice/view','id' => $noticeModel['id']]) ?>" target="_blank"><?= $noticeModel['title']?></a>
        </li>
        <?php endforeach ;?>
    </ol>
</div>
<?php if($orderModels) : ?>
<div class="span4" style="position: fixed;bottom: 0px;right: 0px">
        <table class="table">
            <tr>
                <td>菜品名称</td>
                <td>数量</td>
                <td>单价</td>
            </tr>
            <?php foreach($orderModels as $orderModel) :?>
                <tr>
                    <td><span><?= $orderModel['cai_name']?></span></td>
                    <td><span><?= $orderModel['num']?></span></td>
                    <td><span><?= $orderModel['cai_money']?></span></td>
                </tr>
            <?php endforeach;?>
                <td>总金额：￥<?= $sum?></td>
                <td><button><a href="<?= \yii\helpers\Url::to(['cai/address'])?>">下订单</a></button></td>
                <td><button><a href="<?= \yii\helpers\Url::to(['cai/delete-order'])?>">取消订单</a></button></td>
        </table>

    </div>
<?php endif ;?>
</div>
</div>
</div>
</div>
<script type="text/javascript">
    var sub = $(".yuding");
        sub.on("click",function(){
//            e.preventDefault();
            $.ajax({
                type:"post",
                url:'http://www.dcxt.com/index.php?r=site%2Fis-login',
                dataType:'json',
                success:function(ret){
                    console.log("sec");
                    console.log(ret);
                    if(ret.err == 1){
                    }else{
                        alert('请先登录在订购！')
                        window.location.href = 'http://www.dcxt.com/index.php?r=site%2Flogin';
                    }
                },
                error:function(ret){
                    console.log("err");
                    console.log(ret);
                }
            });
        });
</script>
