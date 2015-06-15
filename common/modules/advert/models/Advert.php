<?php

namespace common\modules\advert\models;

use Yii;
use common\models\User;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "advert".
 *
 * @property integer $id
 * @property integer $tutorid
 * @property integer $cityid
 * @property integer $tutor_grade_id
 * @property integer $experience
 * @property string $address
 * @property string $description
 *
 * @property User $tutor
 * @property City $city
 * @property TutorGrade $tutorGrade
 * @property AdvertGoals[] $advertGoals
 * @property AdvertPrice $advertPrice
 * @property AdvertAddress $advertAddress
 * @property AdvertSubjects[] $advertSubjects
 */
class Advert extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'advert';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tutorid', 'cityid', 'tutor_grade_id'], 'required'],
            [['tutorid', 'cityid', 'tutor_grade_id', 'experience'], 'integer'],
            [['description'], 'string'],
            [['address'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tutorid' => 'Tutorid',
            'cityid' => 'Cityid',
            'cityName' => Yii::t('app','City'),
            'tutorName' => Yii::t('app','tutorName'),
            'advertGoals' => Yii::t('app', 'Goals'),
            'experience' => Yii::t('app', 'Experience'),
            'address' => Yii::t('app', 'Address'),
            'description' => Yii::t('app', 'Description'),
            'advertSubjects' => Yii::t('app', 'Subjects'),
            'advertPrice' => Yii::t('app', 'AdvertPrice'),
            'advertAddress' => Yii::t('app', 'AdvertAddress'),
            'tutorGrade' => Yii::t('app', 'Tutor Grade'),
            'tutor_grade_id' => Yii::t('app', 'Tutor Grade'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTutor()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'tutorid']);
    }

    public function getTutorName()
    {
        return $this->tutor->username;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'cityid']);
    }
    /**
     * @return string
     */
    public function getCityName()
    {
        return $this->city->name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTutorGrade()
    {
        return $this->hasOne(TutorGrade::className(), ['id' => 'tutor_grade_id']);
    }
    /**
     * @return string
     */
    public function getTutorGradeName()
    {
        return $this->tutorGrade->name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdvertGoals()
    {
        return $this->hasMany(StudyGoal::className(), ['id' => 'goalid'])
            ->viaTable('advert_goals', ['advertid' => 'id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->saveAdvertGoalsRelation();
        $this->saveAdvertSubjectsRelation();

        return parent::afterSave($insert, $changedAttributes);
    }

    protected function saveAdvertGoalsRelation()
    {
        // Saving m2m relation between Advert and StudyGoal
        $oldGoals = ArrayHelper::map($this->advertGoals, 'id', 'id');

        $goals = Yii::$app->request->post('Advert')['advertGoals'];

        if(!is_array($goals))
            $goals = [];

        $idsToInsert = array_diff($goals, $oldGoals);
        $idsToDelete = array_diff($oldGoals, $goals);

        // --- Insert ---
        foreach ($idsToInsert as $id) {
            $mAdvertGoal = new AdvertGoals();
            $mAdvertGoal->advertid = $this->id;
            $mAdvertGoal->goalid = $id;

            $mAdvertGoal->save(false);
        }

        // --- Delete ---
        foreach ($idsToDelete as $id) {
            AdvertGoals::deleteAll(['goalid' => $id, 'advertid' => $this->id]);
        }
    }

    protected function saveAdvertSubjectsRelation()
    {
        // Saving m2m relation between Advert and StudyGoal
        $oldSubjects = ArrayHelper::map($this->advertSubjects, 'id', 'id');

        $subjects = Yii::$app->request->post('Advert')['advertSubjects'];

        if(!is_array($subjects))
            $subjects = [];

        $idsToInsert = array_diff($subjects, $oldSubjects);
        $idsToDelete = array_diff($oldSubjects, $subjects);

        // --- Insert ---
        foreach ($idsToInsert as $id) {
            $mAdvertSubject = new AdvertSubjects();
            $mAdvertSubject->advertid = $this->id;
            $mAdvertSubject->subjectid = $id;

            $mAdvertSubject->save(false);
        }

        // --- Delete ---
        foreach ($idsToDelete as $id) {
            AdvertSubjects::deleteAll(['subjectid' => $id, 'advertid' => $this->id]);
        }
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdvertPrice()
    {
        return $this->hasOne(AdvertPrice::className(), ['advertid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdvertAddress()
    {
        return $this->hasOne(AdvertAddress::className(), ['advertid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdvertSubjects()
    {
        return $this->hasMany(Subject::className(), ['id' => 'subjectid'])
            ->viaTable('advert_subjects', ['advertid' => 'id']);
    }
}
