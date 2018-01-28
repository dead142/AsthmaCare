<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ExaminationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t('app', 'Examinations');
$this->params['breadcrumbs'][] = $this->title;


?>

<?php
$script = <<< JS
$(document).ready(function() {
     setInterval(function(){ $("#refreshButton").click(); }, 5000);
  
    Notification.requestPermission( newMessage );


    Notification.requestPermission( newMessage );

    function newMessage(permission) {
        if( permission != "granted" ) return false;
        var notify = new Notification(".Yii::t('adminExamination','Thanks for letting notify you').");
    };
    
 
 
  
});
JS;
$this->registerJs($script);
?>
<? $this->registerJsFile('/web/js/pushes.js'); ?>
<div class="examination-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php Pjax::begin(); ?>
    <?= Html::a("Обновить", ['examination/index'], ['class' => 'btn btn-lg btn-primary', 'style'=>'display:none','id'
     =>
    'refreshButton']) ?>


    <p>
        <?= Html::a(Yii::t('app', 'Create Examination'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],

            //    'id',

            [
                'attribute' => 'user_id',
                'value'     => 'user.profile.fullName',
            ],

            [
                'attribute' => 'exam_category',

                'value'               => function ($model, $key, $index, $widget) {
                    $model->exam_category == 'yellow' ? $color = 'black' : $color = 'white';
                    return "<div style='text-align: center; color:" . $color . "'>  " .
                        Yii::t('app', $model->exam_category) . '</div> ';
                },
                'filterType'          => GridView::FILTER_SELECT2,
                'filter'              => [
                    'green'  => Yii::t('app', 'green'),
                    'yellow' => Yii::t('app', 'yellow'),
                    'red'    => Yii::t('app', 'red'),
                ],
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true,],
                ],
                'filterInputOptions'  => ['placeholder' => 'Select'],
                'format'              => 'raw',
                'contentOptions'      => function ($model, $key, $index, $column) {
                    return [
                        'style' => 'background-color:' . $model->exam_category . ';',
                        'id'    => 'corners',
                    ];
                },
            ],
            'result',
            'result_standart',
            'result_percent',
            'create_at:datetime',
            //'update_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
