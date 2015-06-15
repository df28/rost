<?php

namespace common\modules\advert\models;

use Yii;

/**
 * This is the model class for table "advert_price".
 *
 * @property integer $advertid
 * @property integer $studentplace
 * @property integer $tutorplace
 * @property integer $remote
 *
 * @property Advert $advert
 */
class AdvertPrice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'advert_price';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['advertid'], 'required'],
            [['advertid', 'studentplace', 'tutorplace', 'remote'], 'integer'],
            [['advertid'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            //'advertid' => 'Advertid',
            'studentplace' => Yii::t('app','studentplace'),
            'tutorplace' => Yii::t('app','tutorplace'),
            'remote' => Yii::t('app','remote'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdvert()
    {
        return $this->hasOne(Advert::className(), ['id' => 'advertid']);
    }

    public function getFilledPrices()
    {
        $prices = [];
        if($this->studentplace > 0)
            $prices['studentplace'] = $this->studentplace;
        if($this->tutorplace > 0)
            $prices['tutorplace'] = $this->tutorplace;
        if($this->remote > 0)
            $prices['remote'] = $this->remote;
        return $prices;
    }

    public static function getStudyPlaces()
    {
        return array('studentplace','tutorplace','remote');
    }
}
