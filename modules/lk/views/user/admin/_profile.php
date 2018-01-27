<?php

/*
 * This file is part of the Dektrium project
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use kartik\date\DatePicker;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var dektrium\user\models\User $user
 * @var dektrium\user\models\Profile $profile
 */
?>

<?php $this->beginContent('@dektrium/user/views/admin/update.php', ['user' => $user]) ?>

<?php $form = ActiveForm::begin([
    'layout'                 => 'horizontal',
    'enableAjaxValidation'   => true,
    'enableClientValidation' => false,
    'fieldConfig'            => [
        'horizontalCssClasses' => [
            'wrapper' => 'col-sm-9',
        ],
    ],
]); ?>
<!------------------------------------------user photo --------------------------------------------------------------------->


<?= $form->field($profile, 'surname') ?>
<?= $form->field($profile, 'name') ?>
<?= $form->field($profile, 'middlename') ?>
<?= $form->field($profile, 'phone') ?>
<?= $form->field($profile, 'birth_date')->widget(DatePicker::className(), [
    'pluginOptions' => [
        'autoclose' => true,
        'format'    => 'yyyy-mm-dd',
    ],

]) ?>
<?= $form->field($profile, 'sex')->dropDownList([
        0 => Yii::t('profile', 'female'),
        1 => Yii::t('profile', 'male'),
]) ?>
<?= $form->field($profile, 'growth') ?>

<?= $form->field($profile, 'location') ?>
<?= $form->field($profile, 'gravatar_email') ?>


<div class="form-group">
    <div class="col-lg-offset-3 col-lg-9">
        <?= Html::submitButton(Yii::t('user', 'Update'), ['class' => 'btn btn-block btn-success']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

<?php $this->endContent() ?>
