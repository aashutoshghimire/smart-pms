<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Task;
use yii\db\ActiveQuery;

/**
 * TaskSearch represents the model behind the search form of `backend\models\Task`.
 */
class TaskSearch extends Task
{
    /**
     * {@inheritdoc}
     */

     public $userName;
     public $dateRange;

    public function rules()
    {
        return [
            [['task_id', 'user_id'], 'integer'],
            [['title', 'task_details', 'pending_task', 'userName', 'date', 'dateRange'], 'safe'],
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

        $query = Task::find()->where(['user_id' => Yii::$app->user->identity->id])->orderBy(['date' => SORT_DESC]);

        // add conditions that should always apply here
        $query->joinWith(['user' => function (ActiveQuery $query) {
            $query->from(['user' => 'user']);
        }]);

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
            'task_id' => $this->task_id,
            'date' => $this->date,
            // 'user_id' => $this->user_id,
        ]);

         // Filter by related user name
        $query->andFilterWhere(['like', 'user.name', $this->userName]);


        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'task_details', $this->task_details])
            ->andFilterWhere(['like', 'pending_task', $this->pending_task]);
        // Filter by date range
        if (!empty($this->dateRange)) {
            
            list($start_date, $end_date) = explode(' - ', $this->dateRange);
            $query->andFilterWhere(['between', 'date', $start_date, $end_date]);
        }
        // Filter by date
        // $query->andFilterWhere(['date' => $this->date]);

        return $dataProvider;
    }
}
