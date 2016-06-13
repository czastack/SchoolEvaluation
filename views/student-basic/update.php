<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StudentBasic */

$this->title = 'Update Student Basic: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Student Basics', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="student-basic-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
