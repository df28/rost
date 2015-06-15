<?php

namespace frontend\modules\advert\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\advert\models\Advert;
use yii\helpers\VarDumper;

/**
 * AdvertSearch represents the model behind the search form about `common\modules\advert\models\Advert`.
 */
class AdvertSearch extends Advert
{
    //public $tutorName;
    //public $cityName;
    public $goalId;
    public $subjectId;
    public $studyPlace;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tutorid', 'cityid', 'experience', 'goalId', 'subjectId'], 'integer'],
            [['studyPlace'], 'safe'],
            //[['address', 'description', 'tutorName', 'cityName'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Advert::find()->with('city', 'tutor', 'advertGoals', 'advertSubjects', 'advertPrice', 'advertAddress');

//        file_put_contents('debug.txt',VarDumper::dumpAsString($params));
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => array('pageSize' => 10),
//            'sort' => [
//                'attributes' => ['']
//            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if(!empty($this->experience)) {
            $query->andFilterWhere(['>', 'experience', intval($this->experience)]);
        }


//        if(!empty($this->tutorName)) {
//            $query->joinWith(['tutor' => function ($q) {
//                $q->where('user.username LIKE "%' . $this->tutorName . '%"');
//            }]);
//        }

//        if(!empty($this->cityName)) {
//            $query->joinWith(['city' => function ($q) {
//                $q->where('city.name LIKE "%' . $this->cityName . '%"');
//            }]);
//        }

        if(!empty($this->cityid)) {
            $query->joinWith(['city' => function ($q) {
                $q->where('city.id = "' . $this->cityid . '"');
            }]);
        }

        if(!empty($this->goalId)) {
//            $query->joinWith(['advertGoals' => function ($q) {
//                $q->where('study_goal.id = "' . $this->goalId . '"');
//            }]);

            $query->joinWith('advertGoals');
            $query->andFilterWhere(['=', 'study_goal.id', $this->goalId]);
        }

        if(!empty($this->subjectId)) {
//            $query->joinWith(['advertSubjects' => function ($q) {
//                $q->where('subject.id = "' . $this->subjectId . '"');
//            }]);
            $query->joinWith('advertSubjects');
            $query->andFilterWhere(['=', 'subject.id', $this->subjectId]);
        }

        if(!empty($this->studyPlace)) {
            //TODO: validate available study place!
            $query->joinWith('advertPrice');
            $query->andFilterWhere(['>', 'advert_price.'.$this->studyPlace, '0']);
        }

//        file_put_contents('debug.txt',VarDumper::dumpAsString($query->createCommand()->sql));

        return $dataProvider;
    }
}
