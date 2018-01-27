<?php
/**
 * Created by PhpStorm.
 * User: Andrei
 * Date: 14.08.2017
 * Time: 0:51
 */
namespace app\models;

use app\modules\backend\models\StudentGroup;
use Yii;

class Profile extends \dektrium\user\models\Profile
{

    /**
     * Make full name of user, lilke Surname Name Middlename
     * @return string
     */
    public function getFullName()
    {
        return $this->surname . " " . $this->name . " " .$this->middlename ;
    }

    /**
     * Extend rules of dectrium/user/Profile model
     * @return array
     */
    public function rules()
    {

        $rules = parent::rules();
        $newRules = [
            'surname' => ['surname', 'string', 'max' => 255],
            'middlename' => ['middlename', 'string', 'max' => 255],
            'phone' => ['phone', 'string', 'max' => 100],
            'birth_date' => ['birth_date', 'safe'],
            'sex' => ['sex','integer'],
            'growth' => ['growth','integer'],



        ];
        return array_merge($rules, $newRules);

    }

    /**
     * Extend attribute labels of dectrium/user/Profile model
     * @return array
     */
    public function attributeLabels()
    {
        $attributeLabels = parent::attributeLabels();
        $newattributeLabels = [
            'surname' => \Yii::t('profile', 'surname'),
            'middlename' => \Yii::t('profile', 'middlename'),
            'birth_date' => \Yii::t('profile', 'birth date'),
            'sex' => \Yii::t('profile', 'sex'),
            'growth' => \Yii::t('profile', 'growth'),
            'phone' => \Yii::t('profile', 'phone'),
        ];
        return array_merge($attributeLabels, $newattributeLabels);
    }


    /**
     * @param $role
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function findAllByRole($role)
    {
        return static::find()
                     ->join('LEFT JOIN','auth_assignment','auth_assignment.user_id = profile.user_id')
                     ->where(['auth_assignment.item_name' => $role])
                     ->all();
    }

}