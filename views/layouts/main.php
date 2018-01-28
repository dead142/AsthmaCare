<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

// TODO delete
$directoryAsset = null;

AppAsset::register($this);
?>

<?
$userIdentity = null;
if (\Yii::$app->user->identity){
    $userIdentity =  \Yii::$app->user->identity;
}

 ?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <? $this->registerCssFile('/web/css/site.css'); ?>
    <?php $this->head() ?>
</head>
<body class="hold-transition skin-black sidebar-collapse sidebar-mini">
<?php $this->beginBody() ?>
<div class="wrapper">

    <?= $this->render(
        'header.php',
        ['directoryAsset' => $directoryAsset,'userIdentity'=>$userIdentity]
    ) ?>

    <?= $this->render(
        'left.php',
        ['directoryAsset' => $directoryAsset,'userIdentity'=>$userIdentity]
    )
    ?>

    <?= $this->render(
        'content.php',
        ['content' => $content, 'directoryAsset' => $directoryAsset]
    ) ?>

</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>