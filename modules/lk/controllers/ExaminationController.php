<?php

namespace app\modules\lk\controllers;

use app\models\Examination;
use app\models\ExaminationSearch;
use app\models\ExamStandart;
use app\models\Profile;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ExaminationController implements the CRUD actions for Examination model.
 */
class ExaminationController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Examination models.
     * @return mixed
     */
    public function actionIndex()
    {
        $userId       = Yii::$app->user->id;
        $searchModel  = new ExaminationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->AndWhere(['user_id' => $userId]);
        $dataProvider->query->orderBy('create_at DESC');

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Examination model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Examination model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Examination();

        if ($model->load(Yii::$app->request->post())) {
            $userId = \Yii::$app->user->id;
            $this->saveResult($model->result, $userId);
            return $this->redirect('index');
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Examination model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $this->saveResult($model->result, $model->user_id);
            $this->actionDelete($model->id);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Examination model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Examination model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Examination the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Examination::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * @param $result
     * @param $userId
     * @return bool
     */
    public function saveResult($result, $userId)
    {
        $profile        = Profile::find()->where(['user_id' => $userId])->one();
        $ages           = $this->getAgesByBirthDate($profile->birth_date);
        $standartValues = $this->actionStandart($profile->growth, $profile->sex);

        $result_procent = round($result / $standartValues[$ages] * 100);
        if ($result_procent >= 80) {
            $exam_cathegory = 'green';
        } elseif ($result_procent >= 60 AND $result_procent < 80) {
            $exam_cathegory = 'yellow';
        } elseif ($result_procent < 60) {
            $exam_cathegory = 'red';
        }
        $model                  = new Examination();
        $model->exam_category   = $exam_cathegory;
        $model->result          = $result;
        $model->user_id         = $userId;
        $model->result_standart = $standartValues['id']; //норма
        $model->result_percent  = $result_procent;
        if ($model->save()) {

            return true;
        } else {

            return false;
        }

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

}
