<?php

namespace common\modules\advert\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "subject".
 *
 * @property integer $id
 * @property string $name
 *
 * @property AdvertSubjects[] $advertSubjects
 */
class Subject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subject';
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
            'name' => Yii::t('app','Subject'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdvertSubjects()
    {
        return $this->hasMany(AdvertSubjects::className(), ['subjectid' => 'id']);
    }

    public static function getSubjectsList()
    {
        return ArrayHelper::map(self::find()->orderBy('name')->asArray()->all(), 'id', 'name');
    }
}
