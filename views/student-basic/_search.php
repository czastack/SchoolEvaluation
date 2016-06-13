<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StudentBasicSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-basic-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'Sno') ?>

    <?= $form->field($model, 'Sname') ?>

    <?= $form->field($model, 'Ssex') ?>

    <?= $form->field($model, 'Sdept') ?>

    <?php // echo $form->field($model, 'Sclass') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
