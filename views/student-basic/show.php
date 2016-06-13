<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\StudentBasic */

class ShowAsset extends \app\assets\BaseAsset {
    public $css = ['css/animate.css', 'css/student_show.css'];
}
ShowAsset::register($this);
?>
<div class="student-basic-show animated rotateInDownLeft">
    <div class="constraints">
        <h2>提交成功，谢谢使用</h2>
    </div>
</div>
