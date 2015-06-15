<?php

namespace common\modules\advert\models;

use Yii;

/**
 * This is the model class for table "advert_address".
 *
 * @property integer $advertid
 * @property string $longitude
 * @property string $latitude
 *
 * @property Advert $advert
 */
class AdvertAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'advert_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['advertid'], 'required'],
            [['advertid'], 'integer'],
            [['longitude', 'latitude'], 'number'],
            [['advertid'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'advertid' => Yii::t('app', 'Advertid'),
            'longitude' => Yii::t('app', 'Longitude'),
            'latitude' => Yii::t('app', 'Latitude'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdvert()
    {
        return $this->hasOne(Advert::className(), ['id' => 'advertid']);
    }
}

