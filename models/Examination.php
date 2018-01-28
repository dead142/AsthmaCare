<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "examination".
 *
 * @property int $id
 * @property int $user_id
 * @property string $exam_category
 * @property int $result
 * @property int $result_standart
 * @property int $result_percent
 * @property string $create_at
 * @property string $update_at
 *
 * @property ExamStandart $resultStandart
 * @property User $user
 */
class Examination extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'examination';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'exam_category', 'result', 'result_standart', 'result_percent'], 'required'],
            [['user_id', 'result', 'result_standart', 'result_percent'], 'integer'],
            [['exam_category'], 'string'],
            [['create_at', 'update_at'], 'safe'],
            [['result_standart'], 'exist', 'skipOnError' => true, 'targetClass' => ExamStandart::className(), 'targetAttribute' => ['result_standart' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'exam_category' => Yii::t('app', 'Exam Category'),
            'result' => Yii::t('app', 'Result'),
            'result_standart' => Yii::t('app', 'Result Standart'),
            'result_percent' => Yii::t('app', 'Result Percent'),
            'create_at' => Yii::t('app', 'Create At'),
            'update_at' => Yii::t('app', 'Update At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResultStandart()
    {
        return $this->hasOne(ExamStandart::className(), ['id' => 'result_standart']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Автообновленние даты создания и даты обновления
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_at',
                'updatedAtAttribute' => 'update_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }
}
