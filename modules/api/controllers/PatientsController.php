<?php
/**
 * Created by PhpStorm.
 * User: Andrei
 * Date: 27.01.2018
 * Time: 15:43
 */

namespace app\modules\api\controllers;


use app\models\Examination;
use app\models\ExamStandart;
use app\models\Profile;
use yii\web\Controller;

class PatientsController extends Controller
{
    /**
     * Функция не используется
     * @param $id
     * @return Examination[]|array|\yii\db\ActiveRecord[]
     */
    public function getResultByUser($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $userResult                  = Examination::find()->where(['id' => $id])->asArray()->all();
        return $userResult;
    }

    /**
     * Сохраняет результат выдоха от приложения
     * TODO должна еще возращать два последних значения из таблицы с учетом id user
     * @param $id
     * @param $exam
     * @param $time
     * @return array
     */
    public function actionResult($id, $exam, $time)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $profile                     = Profile::find()->where(['user_id' => $id])->one();
        $ages                        = $this->getAgesByBirthDate($profile->birth_date);
        $standartValues              = $this->actionStandart($profile->growth, $profile->sex);

        $result_procent = round($exam / $standartValues[$ages] * 100);
        #Дикикй треш от рпедыдущих разработчиков для приложения
        if ($result_procent >= 80) {
            $exam_cathegory = 'green';
        } elseif ($result_procent >= 60 AND $result_procent < 80) {
            $exam_cathegory = 'yellow';
        } elseif ($result_procent < 60) {
            $exam_cathegory = 'red';
        }
        $model                  = new Examination();
        $model->exam_category   = $exam_cathegory;
        $model->result          = $exam;
        $model->user_id         = $id;
        $model->result_standart = $standartValues['id']; //норма
        $model->result_percent  = $result_procent;
        if ($model->save()) {
            #Дикикй треш от рпедыдущих разработчиков для приложения
            if ($exam_cathegory == "red") {
                $exam_cathegory = "красный";
            }
            if ($exam_cathegory == "yellow") {
                $exam_cathegory = "желтый";
            }
            if ($exam_cathegory == "green") {
                $exam_cathegory = "зелёный";
            }
            return [
                'code'      => 200,
                'message'   => "ACCESS",
                ' $result'  => $model->result,
                'id'        => $model->id,
                'percent'   => $result_procent,
                'cathegory' => $exam_cathegory,

            ];
        } else {
            return [
                'code'    => 200,
                'message' => $model->errors,
            ];
        }

    }

    /**
     * Модель со стандартными значения для росто и поля
     * @param $growth
     * @param $sex
     * @return ExamStandart|array|null|\yii\db\ActiveRecord
     */
    public function actionStandart($growth, $sex)
    {
        $examStandart = ExamStandart::find()->where([
            'growth' => $growth,
            'sex'    => $sex,
        ])->asArray()->one();
        return $examStandart;

    }

    /**
     * Опять треш от предыдущих разработчиков
     * @param $age
     * @return string
     */
    public function yearLikeInTable($age)
    {
        $age_tbl = '';
        if ($age >= 5 AND $age < 8) {
            $age_tbl = '5';
        } elseif ($age >= 8 AND $age < 11) {
            $age_tbl = '8';
        } elseif ($age >= 11 AND $age < 15) {
            $age_tbl = '11';
        } elseif ($age >= 15 AND $age < 20) {
            $age_tbl = '15';
        } elseif ($age >= 20 AND $age < 25) {
            $age_tbl = '20';
        } elseif ($age >= 25 AND $age < 30) {
            $age_tbl = '25';
        } elseif ($age >= 30 AND $age < 35) {
            $age_tbl = '30';
        } elseif ($age >= 35 AND $age < 40) {
            $age_tbl = '35';
        } elseif ($age >= 40 AND $age < 45) {
            $age_tbl = '40';
        } elseif ($age >= 45 AND $age < 50) {
            $age_tbl = '45';
        } elseif ($age >= 50 AND $age < 55) {
            $age_tbl = '50';
        } elseif ($age >= 55 AND $age < 60) {
            $age_tbl = '55';
        } elseif ($age >= 60 AND $age < 65) {
            $age_tbl = '60';
        } elseif ($age >= 65 AND $age < 70) {
            $age_tbl = '65';
        } elseif ($age >= 70 AND $age < 75) {
            $age_tbl = '70';
        } elseif ($age >= 75 AND $age < 80) {
            $age_tbl = '75';
        } elseif ($age >= 80 AND $age < 85) {
            $age_tbl = '80';
        } elseif ($age >= 85) {
            $age_tbl = '85';
        }
        return $age_tbl;
    }

    /**
     * @param $birthday
     * @return false|string
     */
    public function getAgesByBirthDate($birthday)
    {
        $birthday_timestamp = strtotime($birthday);
        $age                = date('Y') - date('Y', $birthday_timestamp);
        if (date('md', $birthday_timestamp) > date('md')) {
            $age--;
        }
        $age = $this->yearLikeInTable($age);
        return $age;
    }

    /**
     * @param $userId
     * @return Profile|array|null|\yii\db\ActiveRecord
     */
    public function actionGetProfile($userId)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return Profile::find()->where(['user_id' => $userId])->asArray()->one();
    }

    /**
     * Все результаты измерений пользователя
     * @param $id
     * @return Examination[]|array|\yii\db\ActiveRecord[]
     */
    public function actionGetResults($id)
    {

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return Examination::find()->where(['user_id' => $id])->asArray()->all();
    }

}