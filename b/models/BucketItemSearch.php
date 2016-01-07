<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\BucketItem;

/**
 * backend\models\BucketItemSearch represents the model behind the search form about `backend\models\BucketItem`.
 */
class BucketItemSearch extends BucketItem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'bucket_list_id', 'order'], 'integer'],
            [['name'], 'safe'],
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
        $query = BucketItem::find()->orderBy('order ASC');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (! $this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'bucket_list_id' => $this->bucket_list_id,
            'order' => $this->order,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        return array_merge($behaviors,
            [
                'sortable' => [
                    'class' => \kotchuprik\sortable\behaviors\Sortable::className(),
                    'query' => self::find(),
                ],
            ]
        ); // TODO: Change the autogenerated stub
    }
}
