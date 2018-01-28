<?php

namespace app\modules\lk\controllers;

use yii\web\Controller;

/**
 * Default controller for the `lk` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Отображает график
     * @return string
     */
    public function actionGraph(){
        return $this->render('graph.php');
    }
}
