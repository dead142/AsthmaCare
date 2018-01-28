<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Examination */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="examination-form">

    <?php $form = ActiveForm::begin(); ?>




    <?= $form->field($model, 'result')->textInput() ?>



    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
