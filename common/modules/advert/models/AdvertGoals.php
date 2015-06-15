<?php

namespace common\modules\advert\models;

use Yii;

/**
 * This is the model class for table "advert_goals".
 *
 * @property integer $advertid
 * @property integer $goalid
 *
 * @property Advert $advert
 * @property StudyGoal $goal
 */
class AdvertGoals extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'advert_goals';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['advertid', 'goalid'], 'required'],
            [['advertid', 'goalid'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'advertid' => 'Advertid',
            'goalid' => 'Goalid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdvert()
    {
        return $this->hasOne(Advert::className(), ['id' => 'advertid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoal()
    {
        return $this->hasOne(StudyGoal::className(), ['id' => 'goalid']);
    }
}
