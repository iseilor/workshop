<?php

namespace app\modules\st\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\st\models\Guest;

/**
 * GuestSearch represents the model behind the search form of `app\modules\st\models\Guest`.
 */
class GuestSearch extends Guest
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by', 'curator_id', 'guest_category', 'date', 'weight'], 'integer'],
            [['guest_fio', 'guest_photo', 'title', 'annotation', 'text', 'registration_link', 'webinar_link', 'youtube_link', 'vk_link', 'telegram_link', 'video', 'icon', 'color'], 'safe'],
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
        $query = Guest::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'deleted_at' => $this->deleted_at,
            'deleted_by' => $this->deleted_by,
            'curator_id' => $this->curator_id,
            'guest_category' => $this->guest_category,
            'date' => $this->date,
            'weight' => $this->weight,
        ]);

        $query->andFilterWhere(['like', 'guest_fio', $this->guest_fio])
            ->andFilterWhere(['like', 'guest_photo', $this->guest_photo])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'annotation', $this->annotation])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'registration_link', $this->registration_link])
            ->andFilterWhere(['like', 'webinar_link', $this->webinar_link])
            ->andFilterWhere(['like', 'youtube_link', $this->youtube_link])
            ->andFilterWhere(['like', 'vk_link', $this->vk_link])
            ->andFilterWhere(['like', 'telegram_link', $this->telegram_link])
            ->andFilterWhere(['like', 'video', $this->video])
            ->andFilterWhere(['like', 'icon', $this->icon])
            ->andFilterWhere(['like', 'color', $this->color]);

        return $dataProvider;
    }
}
