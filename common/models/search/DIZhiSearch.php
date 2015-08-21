<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\DIZhi;

/**
 * DIZhiSearch represents the model behind the search form about `common\models\DIZhi`.
 */
class DIZhiSearch extends DIZhi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'userid', 'louhao', 'room', 'status'], 'integer'],
            [['mobile'], 'safe'],
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
        $query = DIZhi::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'userid' => $this->userid,
            'louhao' => $this->louhao,
            'room' => $this->room,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'mobile', $this->mobile]);

        return $dataProvider;
    }
}
