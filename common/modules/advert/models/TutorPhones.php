<?php

namespace common\modules\advert\models;

use Yii;

/**
 * This is the model class for table "tutor_phones".
 *
 * @property integer $id
 * @property integer $tutorid
 * @property string $phone
 *
 * @property User $tutor
 */
class TutorPhones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tutor_phones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tutorid', 'phone'], 'required'],
            [['tutorid'], 'integer'],
            [['phone'], 'string']//'max' => 12
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tutorid' => Yii::t('app', 'Tutorid'),
            'phone' => Yii::t('app', 'Phone'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTutor()
    {
        return $this->hasOne(User::className(), ['id' => 'tutorid']);
    }
}
