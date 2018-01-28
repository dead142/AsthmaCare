<?php
/**
 * Created by PhpStorm.
 * User: Andrei
 * Date: 28.01.2018
 * Time: 2:31
 */

namespace app\modules\api\controllers;


use app\models\Examination;
use yii\helpers\VarDumper;
use yii\web\Controller;

class PushesController extends Controller
{
    /**
     * TODO функция в разработке
     * pushes для доктора при добвлении записи
     * @param bool $someresultsAdds
     * @return array|bool
     */
    public function actionGetRedResults($someresultsAdds = false){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $examinationQuery = Examination::find()->where(['exam_category'=>'red']);
        $old_count = \Yii::$app->request->post('old_count');

        if ($old_count != NULL){
            $new_count = $examinationQuery->count();

            if($new_count > $old_count){
                $someresultsAdds = true;
                $examination = $examinationQuery->asArray()->limit(1)->one();
                return ['old_count'=>$new_count,'code'=> 200,
            'message'=> 'success',];
            }
        }else {
            return false;
        }



            //VarDumper::dump($examination,10,true);


    }
}