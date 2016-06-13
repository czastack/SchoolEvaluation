<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StudentBasic */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-basic-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Sno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Sname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Ssex')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Sdept')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Sclass')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
