<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\BackendApple;

/**
 * BackendAppleSearch represents the model behind the search form of `backend\models\BackendApple`.
 */
class BackendAppleSearch extends BackendApple
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'create_at', 'drop_at'], 'integer'],
            [['color'], 'safe'],
            [['percent'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = BackendApple::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => false,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'percent' => $this->percent,
            'create_at' => $this->create_at,
            'drop_at' => $this->drop_at,
        ]);

        $query->andFilterWhere(['like', 'color', $this->color]);

        return $dataProvider;
    }
}
