<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\BucketList;

/**
 * backend\models\BucketListSearch represents the model behind the search form about `backend\models\BucketList`.
 */
class BucketListSearch extends BucketList
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'tbl_lock'], 'integer'],
            [['name', 'type', 'state', 'created_at', 'updated_at'], 'safe'],
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
        $query = BucketList::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        if (array_key_exists('created_at_range', $params)) {
            $created_at_range = strval($params['created_at_range']);
            //05-Jan-16+to+16-Feb-16
            $created_at_range = explode(" to ", $created_at_range);
            if (count($created_at_range) == 2) {
                $start_date = \DateTime::createFromFormat('d-M-y', $created_at_range[0])->format('Y-m-d');
                $end_date = \DateTime::createFromFormat('d-M-y', $created_at_range[1])->format('Y-m-d');
            }
        }

        $this->load($params);

        if (! $this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'tbl_lock' => $this->tbl_lock,
        ]);
        if (! empty($start_date) && ! empty($end_date)) {
            $query->andFilterWhere(['>=', 'created_at', $start_date])->andFilterWhere(['<=', 'created_at', $end_date]);
        }

        $query->andFilterWhere(['like', 'name', $this->name])
              ->andFilterWhere(['like', 'type', $this->type])
              ->andFilterWhere(['like', 'state', $this->state]);

        return $dataProvider;
    }
}
