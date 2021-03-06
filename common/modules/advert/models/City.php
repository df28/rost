<?php

namespace common\modules\advert\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "city".
 *
 * @property integer $id
 * @property string $name
 * @property string $longitude
 * @property string $latitude
 *
 * @property Advert[] $adverts
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['longitude', 'latitude'], 'number'],
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
            'name' => Yii::t('app','City'),
            'longitude' => Yii::t('app', 'Longitude'),
            'latitude' => Yii::t('app', 'Latitude'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdverts()
    {
        return $this->hasMany(Advert::className(), ['cityid' => 'id']);
    }


    /**
     * @return array[id=>name]
     */
    public static function getCitiesList()
    {
        return ArrayHelper::map(self::find()->orderBy('name')->asArray()->all(), 'id', 'name');
    }
}
