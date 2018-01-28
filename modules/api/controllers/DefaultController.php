<?php

namespace app\modules\api\controllers;

use app\models\Profile;
use dektrium\user\models\User;
use yii\web\Controller;

/**
 * Default controller for the `api` module
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
     * Это просто пиздец!
     * с приложения приходят данные
     * что-то ароде define true false
     * */
    /**
     * fname => фамилия
     * name => pass
     * sname => login
     * sex => 1992-02-22
     * growth => 190
     * b_date => имя
     * login => отчество
     * pass => пол
     * tnumber => 855555555
     * adress => адресс
     * **/
    /**
     * @url http://asthma-care/web/api/default/registration
     * @param $fname
     * @param $name
     * @param $sname
     * @param $sex
     * @param $phone
     * @param $b_date
     * @param $growth
     * @param $login
     * @param $pass
     * @return array
     * @throws \Exception
     * @throws \yii\base\Exception
     */
    public function actionRegistration($fname , $name , $sname , $sex ,$growth , $b_date , $login , $pass = '1',
                                       $tnumber , $adress )
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $user                        = $this->createUser($_REQUEST['name'] , $_REQUEST['sname'] );

        if ($user) {
            $this->createProfile($fname,$b_date,$login,$user,$tnumber,$sex,$pass,$growth,$adress);
            return [
                'code'    => 200,
                'message' => 'access',
                'id'      => $user->id,

            ];
        } else {
            return [
                'code'    => 100,
                'message' => 'error',
            ];
        }

    }

    /**
     * @param $userName
     * @param $password
     * @return User
     * @throws \Exception
     * @throws \yii\base\Exception
     */
    public function createUser($userName, $password)
    {
        $model               = new User();
        $model->username     = $userName;
        $model->email        = $model->username . "@to.change";
        $model->password     = $password;
        $model->auth_key     = \Yii::$app->security->generateRandomString();
        $model->confirmed_at = time();
        $model->updated_at   = time();


        //set role student
        if ($model->save(false)) {
            $this->addRole($model->id);
            return $model;
        }
        return $model;
    }

    /**
     * Устанавливаем по-умолчанию пользоватлю роль "студент"
     * @param $id
     * @throws \Exception
     */
    public function addRole($id)
    {
        $auth = \Yii::$app->authManager;
        $role = $auth->getRole('patient');
        $auth->assign($role, $id);
    }

    /**
     * @param $middlename
     * @param $name
     * @param $surname
     * @param $userModel
     * @param $phone
     * @param $birth_date
     * @param $sex
     * @param $growth
     * @param $location
     */
    public function createProfile($middlename, $name, $surname, $userModel, $phone, $birth_date, $sex, $growth,
                                  $location)
    {
        $profile = Profile::findOne($userModel->id);

        $profile->middlename = $middlename;
        $profile->name       = $name;
        $profile->surname    = $surname;
        $profile->phone      = $phone;
        $profile->birth_date = $birth_date;
        $profile->sex        = $sex;
        $profile->growth     = $growth;
        $profile->location    = $location;

        $profile->save();
    }

    /**
     * API
     * TODO должно быть авторизация по логину и паролю, сейчас только по логину
     * @param $login
     * @param $pass
     * @return array
     */
    public function actionAuthUser($login,$pass)
    {
        $model = User::find()->where(['username'=>$login])->one();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if($model){
                return array('code' => 200, 'message' => "ACCESS", 'result' => true, 'id' => $model->id);
            }else {
                return array('code' => 100, 'message' => "error", 'result' => false, 'id' => $model->id);
            }
    }
}
