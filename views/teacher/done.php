<?php
class DoneAsset extends \app\assets\BaseAsset {
    public $css = ['css/done.css', 'css/animate.css'];
}

$this->title = '已完成本学期评价';
$this->params['breadcrumbs'][] = $this->title;
DoneAsset::register($this);
$imgUrl = $this->assetBundles[DoneAsset::className()]->baseUrl . '/image/done/';
?>
<!--标题-->
<div>
    <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
    <h1 class="biaoti">2015-2016学年  上学期总评</h1>
    <div class="sekuai"></div>
</div>
<!--提示已填写完全-->
<div class="container">
    <div class="row">
        <div class="col-md-9 ts">
            <?php if ($finished): ?>
            <img src="<?=$imgUrl.'success.png'?>" class="animated fadeInDown"/ >
            <div class="tsw"><span>您已完成本学期评价，谢谢使用！</span></div>
            <?php else: ?>
            <img src="<?=$imgUrl.'donenot.png'?>" class="animated fadeInDown"/ >
            <div class="tsw"><span>填写部分已保存，您有尚未完成的评价，请尽快填写！</span></div>
            <?php endif ?>
        </div>
    </div>
</div>
