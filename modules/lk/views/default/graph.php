<?php

use dosamigos\chartjs\ChartJs;

?>



<?php
$userId = \Yii::$app->user->id;

$data     = \app\models\Examination::find()->where(['user_id' => $userId])->all();
$datasetD = [];
foreach ($data as $datum) {
    $datasetD [] = [
        'label'                     => [$datum->create_at],
        'backgroundColor'           => [$datum->exam_category],
        'borderColor'               => "rgba(179,181,198,1)",
        'pointBackgroundColor'      => "rgba(179,181,198,1)",
        'pointBorderColor'          => "#fff",
        'pointHoverBackgroundColor' => "#fff",
        'pointHoverBorderColor'     => "rgba(179,181,198,1)",
        'data'                      => [$datum->result],
    ];

}


$datasetDate   = \yii\helpers\ArrayHelper::getColumn($data, 'create_at');
$datasetDate   = \yii\helpers\ArrayHelper::getColumn($data, 'create_at');
$datasetcolors = \yii\helpers\ArrayHelper::getColumn($data, 'exam_category');
$dataColors    = [];
foreach ($datasetcolors as $color) {

    if ($color == 'red') {
        $dataColors[] = '#FF0026';
    } elseif ($color == 'green') {
        $dataColors[] = '#00C853';
    } else {
        $dataColors[] = '#FFFF8D';
    }

}


?>
<h1>График измерений</h1>
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Bar Chart</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        <?= ChartJs::widget([
            'type'    => 'bar',
            'options' => [
                'height' => 100,
                'width'  => 400,


            ],

            'data' => [

                'labels' => $datasetDate,

                'datasets' => $datasetD,
            ],
        ]);
        ?>


    </div>
</div>

