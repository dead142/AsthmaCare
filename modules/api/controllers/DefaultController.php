<?php

namespace app\modules\api\controllers;

use app\models\Profile;
use yii\web\Controller;
use dektrium\user\models\User;

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
    public function actionRegistration($fname, $name, $sname, $sex, $phone, $b_date, $growth, $login, $pass){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $user = $this->createUser($login,$pass);
        if ($user ){

            $this->createProfile($fname,$name,$sname,$user,$phone,$b_date,$sex,$growth);
            return [
                'code'=> 200,
                'message'=> 'success',
                'userId'=> $user->id
            ];
        } else {
            $this->createProfile($fname,$name,$sname,$user,$phone,$b_date,$sex,$growth);
            return [
                'code'=> 200,
                'message'=> $user->errors,
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
    public function createUser( $userName, $password) {
        $model               = new User();
        $model->username     = $userName;
        $model->email        = $model->username . "@to.change";
        $model->password     = $password;
        $model->auth_key     = \Yii::$app->security->generateRandomString();
        $model->confirmed_at = time();
        $model->updated_at   = time();


        //set role student
        if ( $model->save( false )){
            $this->addRole( $model->id );
        }
        return $model;
    }
    /**
     * Устанавливаем по-умолчанию пользоватлю роль "студент"
     * @param $id
     * @throws \Exception
     */
    public function addRole( $id ) {
        $auth = \Yii::$app->authManager;
        $role = $auth->getRole( 'patient' );
        $auth->assign( $role, $id );
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
     */
    public function createProfile( $middlename, $name, $surname, $userModel,$phone,$birth_date,$sex,$growth )
    {
        $profile             = Profile::findOne($userModel->id);

        $profile->middlename = $middlename;
        $profile->name       = $name;
        $profile->surname    = $surname;
        $profile->phone    =   $phone;
        $profile->birth_date = $birth_date;
        $profile->sex = $sex;
        $profile->growth = $growth;

        $profile->save();
    }
}
