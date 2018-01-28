<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini"><i class="fa fa-heartbeat" aria-hidden="true"></i></span><span class="logo-lg"><i class="fa fa-heartbeat" aria-hidden="true"></i>' . Yii::$app->name . '</span>',
        Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">


                <!-- Tasks: style can be found in dropdown.less -->
                <!-- TODO не работает, нужно выспаться -->
                <? if ($userIdentity) : ?>
                    <? $queryEx = \app\models\Examination::find()->where(['user_id' => $userIdentity->id]); ?>
                    <li class="dropdown tasks-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-flag-o"></i>
                            <span class="label label-danger"><?= $queryEx->count() ?></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li class="header">
                                <?= Yii::t('app', 'You have') ?>

                                <?= $sumEx = $queryEx->count() ?>

                                <?= Yii::t('app', 'tasks') ?>
                            </li>
                            <li>
                                <!-- inner menu: contains the actual data -->

                                <ul class="menu">
                                    <? $colors = [
                                        'green',
                                        'yellow',
                                        'red',
                                    ] ?>
                                    <? foreach ($colors as $color) : ?>

                                        <? $value = $queryEx->Andwhere
                                        (['exam_category' => $color])->count() ?>

                                        <? if ($value): ?>
                                            <li><!-- Task item -->
                                                <a href="#">
                                                    <h3>
                                                        <?= Yii::t('app', $color . '  tasks') ?>

                                                        <small class="pull-right"><?= $procents = round(($value / $sumEx) *
                                                                100) ?> %

                                                        </small>
                                                    </h3>
                                                    <div class="progress xs">
                                                        <div class="progress-bar progress-bar-<?= $color ?>"
                                                             style="width:
                                                             <?= $value ?>%"
                                                             role="progressbar" aria-valuenow=""
                                                             aria-valuemin="0"
                                                             aria-valuemax="100">
                                                            <span class="sr-only"><?= $procents ?>Complete</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <? $value = null;
                                            $procents = null; ?>
                                        <? endif; ?>
                                    <? endforeach ?>


                                    <!-- end task item -->

                                </ul>
                            </li>
                            <li class="footer">
                                <a href="<?= \yii\helpers\Url::toRoute('/lk/examination/index') ?> "><?= Yii::t('app', 'View all tasks') ?></a>
                            </li>
                        </ul>
                    </li>
                <?php endif ?>
                <!-- User Account: style can be found in dropdown.less -->
                <? if ($userIdentity) : ?>
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?= $userIdentity->profile->getAvatarUrl(150) ?>" class="user-image"
                                 alt="User Image"/>
                            <span class="hidden-xs">     <? $userIdentity->profile->name ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="<?= $userIdentity->profile->getAvatarUrl(150) ?>" class="img-circle"
                                     alt="User Image"/>

                                <p>
                                    <?= $userIdentity->profile->fullName ?>
                                    <small>
                                        <?= Yii::t('app', 'Member since') ?>
                                        <?= Yii::$app->formatter->asDate($userIdentity->created_at, 'd MMMM Y  ') ?>
                                    </small>
                                </p>
                            </li>

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <?= Html::a(
                                        Yii::t('app', 'Profile'),
                                        ['/user/settings/profile'],
                                        [

                                            'class' => 'btn btn-default btn-flat',
                                        ]
                                    ) ?>
                                </div>
                                <div class="pull-right">
                                    <?= Html::a(
                                        Yii::t('app', 'Sign out'),
                                        ['/user/security/logout'],
                                        [
                                            'data-method' => 'post',
                                            'class'       => 'btn btn-default btn-flat',
                                        ]
                                    ) ?>
                                </div>
                            </li>
                        </ul>
                    </li>
                <? endif; ?>
                <!-- User Account: style can be found in dropdown.less -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
