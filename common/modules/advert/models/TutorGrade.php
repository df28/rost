<?php

namespace common\modules\advert\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tutor_grade".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Advert[] $adverts
 */
class TutorGrade extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tutor_grade';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Tutor Grade'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdverts()
    {
        return $this->hasMany(Advert::className(), ['tutor_grade_id' => 'id']);
    }

    public static function getTutorGradesList()
    {
        return ArrayHelper::map(self::find()->asArray()->all(), 'id', 'name');
    }
}
