<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <? if ($userIdentity) :  ?>
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $userIdentity->profile->getAvatarUrl(150)   ?>" class="img-circle" alt="User
                Image"/>
            </div>
            <div class="pull-left info">
                <p><?= $userIdentity->username ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <? endif; ?>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Добавить данные', 'icon' => 'plus', 'url' => ['/gii'],'visible' =>
                        Yii::$app->user->can('patient')],
                    ['label' => 'График исследований', 'icon' => 'area-chart', 'url' => ['/gii'],'visible' =>
                        Yii::$app->user->can('patient')],
                    ['label' => 'Таблица исследований', 'icon' => 'table', 'url' => ['/debug'],'visible' =>
                        Yii::$app->user->can('patient')],
                    Yii::$app->user->isGuest ?
                        ['label' => 'Sign in', 'url' => ['/user/security/login']] :
                        ['label' => 'Sign out (' . Yii::$app->user->identity->username . ')',
                         'url' => ['/user/security/logout'],
                         'linkOptions' => ['data-method' => 'post']],
                    ['label' => 'Register', 'url' => ['/user/registration/register'], 'visible' => Yii::$app->user->isGuest]

                ],
            ]
        ) ?>

    </section>

</aside>
