<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Billing;

/**
 * BillingSearch represents the model behind the search form of `app\models\Billing`.
 */
class BillingSearch extends Billing
{
    public $tgl;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NOP', 'VA', 'EXP_DATE', 'CREATED_DATE', 'TR_DATE'], 'safe'],
            [['TH_PJK', 'STATUS'], 'integer'],
            [['NOMINAL'], 'number'],
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
        $query = Billing::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        // $this->tgl = date("Y-m-d H:i:s");
        // grid filtering conditions
        $query->andFilterWhere([
            'TH_PJK' => $this->TH_PJK,
            'NOMINAL' => $this->NOMINAL,
            'EXP_DATE' => $this->EXP_DATE,
            'CREATED_DATE' => $this->CREATED_DATE,
            'EXP_DATE', $this->EXP_DATE,
            'STATUS' => $this->STATUS,
        ]);

        $query->andFilterWhere(['like', 'NOP', $this->NOP])
            ->andFilterWhere(['like', 'VA', $this->VA])
            ->andFilterWhere(['<', 'EXP_DATE', $this->tgl])
            ->andFilterWhere(['STATUS' => $this->STATUS])
            ->orderBy(['CREATED_DATE' => SORT_DESC]);

        return $dataProvider;
    }
}
