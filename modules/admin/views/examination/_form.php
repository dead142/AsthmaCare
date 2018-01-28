<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Examination */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="examination-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'exam_category')->dropDownList([ 'green' => 'Green', 'yellow' => 'Yellow', 'red' => 'Red', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'result')->textInput() ?>

    <?= $form->field($model, 'result_standart')->textInput() ?>

    <?= $form->field($model, 'result_percent')->textInput() ?>

    <?= $form->field($model, 'create_at')->textInput() ?>

    <?= $form->field($model, 'update_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
