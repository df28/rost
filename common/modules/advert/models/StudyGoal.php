<?php

namespace common\modules\advert\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "study_goal".
 *
 * @property integer $id
 * @property string $name
 *
 * @property AdvertGoals[] $advertGoals
 */
class StudyGoal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'study_goal';
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
            'id' => 'ID',
            'name' => Yii::t('app','Goal'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdvertGoals()
    {
        return $this->hasMany(AdvertGoals::className(), ['goalid' => 'id']);
    }

    public static function getStudyGoalsList()
    {
        return ArrayHelper::map(self::find()->orderBy('name')->asArray()->all(), 'id', 'name');
    }
}
