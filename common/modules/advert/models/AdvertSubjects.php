<?php

namespace common\modules\advert\models;

use Yii;

/**
 * This is the model class for table "advert_subjects".
 *
 * @property integer $advertid
 * @property integer $subjectid
 *
 * @property Subject $subject
 * @property Advert $advert
 */
class AdvertSubjects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'advert_subjects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['advertid', 'subjectid'], 'required'],
            [['advertid', 'subjectid'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'advertid' => 'Advertid',
            'subjectid' => 'Subjectid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subjectid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdvert()
    {
        return $this->hasOne(Advert::className(), ['id' => 'advertid']);
    }
}
