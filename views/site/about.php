<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = '关于';
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 about animated bounceInRight" >
                <h2>团队</h2>

                <p>大赛八号作品，团队成员：陈振安，钟涵宇，陈治邦
                </p>              
            </div>
            <div class="col-lg-12  animated bounceInRight">
                <h2>作品介绍</h2>
                <p>
                    系统提供教师学生间的相互评价。教师可以对执教班级和校内行政部门进行评价，
                    学生可以对任课教师和职能部门评价。</br>在打分评价的同时提供非必填的文字
                    评价和热词设置。后台采用php开发，数据存储采用MySQL。师生间建立关联表，</br>用户登录后将获得相应的数据，显示所关联的待评价内容。系统将会收集存储用户提交的数据。
                </p>
            </div>
            <div class="col-lg-12  animated bounceInRight">
                <h2>最后</h2>
                <p>
                    系统还存在不足，我们将继续完善开发，欢迎大家给予建议。
                </p>
            </div>
        </div>
    </div>

</div>
