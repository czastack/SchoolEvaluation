<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\StudentBasic */

$this->title = 'Create Student Basic';
$this->params['breadcrumbs'][] = ['label' => 'Student Basics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-basic-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
