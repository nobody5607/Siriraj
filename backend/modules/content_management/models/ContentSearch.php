<?php

namespace backend\modules\content_management\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Contents;

/**
 * ContentSearch represents the model behind the search form about `common\models\Contents`.
 */
class ContentSearch extends Contents
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'section_id', 'rstat', 'public', 'user_create'], 'integer'],
            [['name', 'description', 'content_date', 'create_date', 'thumn_image'], 'safe'],
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
        $query = Contents::find()->where('public =1 AND rstat not in(0,3)');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>[
                'pageSize'=>100
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'section_id' => $this->section_id,
            'rstat' => $this->rstat,
            'public' => $this->public,
            'content_date' => $this->content_date,
            'create_date' => $this->create_date,
            'user_create' => $this->user_create,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'thumn_image', $this->thumn_image]);

        return $dataProvider;
    }
}
