<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "exam_standart".
 *
 * @property int $id
 * @property int $growth
 * @property int $sex
 * @property int $5
 * @property int $8
 * @property int $11
 * @property int $15
 * @property int $20
 * @property int $25
 * @property int $30
 * @property int $35
 * @property int $40
 * @property int $45
 * @property int $50
 * @property int $55
 * @property int $60
 * @property int $65
 * @property int $70
 * @property int $75
 * @property int $80
 * @property int $85
 * @property string $updated
 *
 * @property Examination[] $examinations
 */

// TODO переделать таблицу в соответсвии с нормальными формами
class ExamStandart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exam_standart';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['growth', 'sex', '5', '8', '11', '15', '20', '25', '30', '35', '40', '45', '50', '55', '60', '65', '70', '75', '80', '85'], 'required'],
            [['growth', 'sex', '5', '8', '11', '15', '20', '25', '30', '35', '40', '45', '50', '55', '60', '65', '70', '75', '80', '85'], 'integer'],
            [['updated'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'growth' => Yii::t('app', 'Growth'),
            'sex' => Yii::t('app', 'Sex'),
            '5' => Yii::t('app', '5'),
            '8' => Yii::t('app', '8'),
            '11' => Yii::t('app', '11'),
            '15' => Yii::t('app', '15'),
            '20' => Yii::t('app', '20'),
            '25' => Yii::t('app', '25'),
            '30' => Yii::t('app', '30'),
            '35' => Yii::t('app', '35'),
            '40' => Yii::t('app', '40'),
            '45' => Yii::t('app', '45'),
            '50' => Yii::t('app', '50'),
            '55' => Yii::t('app', '55'),
            '60' => Yii::t('app', '60'),
            '65' => Yii::t('app', '65'),
            '70' => Yii::t('app', '70'),
            '75' => Yii::t('app', '75'),
            '80' => Yii::t('app', '80'),
            '85' => Yii::t('app', '85'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExaminations()
    {
        return $this->hasMany(Examination::className(), ['result_standart' => 'id']);
    }
}
