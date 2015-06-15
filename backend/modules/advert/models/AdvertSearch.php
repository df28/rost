<?php

namespace backend\modules\advert\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\advert\models\Advert;

/**
 * AdvertSearch represents the model behind the search form about `common\modules\advert\models\Advert`.
 */
class AdvertSearch extends Advert
{
    public $cityName;
    public $tutorName;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tutorid', 'cityid', 'experience'], 'integer'],
            [['address', 'description', 'tutorName', 'cityName'], 'safe'],
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
        $query = Advert::find()->with('city', 'tutor');

//        file_put_contents('debug.txt',VarDumper::dumpAsString($params));
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'experience' => $this->experience,
        ]);

        $query->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'description', $this->description]);

        if(!empty($this->tutorName)) {
            $query->joinWith(['tutor' => function ($q) {
                $q->where('user.username LIKE "%' . $this->tutorName . '%"');
            }]);
        }

        if(!empty($this->cityName)) {
            $query->joinWith(['city' => function ($q) {
                $q->where('city.name LIKE "%' . $this->cityName . '%"');
            }]);
        }

        return $dataProvider;
    }
}
