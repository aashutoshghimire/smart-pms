<?php

namespace backend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "tbl_task".
 *
 * @property int $task_id
 * @property string $title
 * @property string|null $task_details
 * @property string|null $pending_task
 * @property string $date
 * @property int $user_id
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'date', 'user_id'], 'required'],
            [['task_details', 'pending_task'], 'string'],
            [['date'], 'safe'],
            [['user_id'], 'integer'],
            [['title'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'task_id' => 'Task ID',
            'title' => 'Title',
            'task_details' => 'Task Details',
            'pending_task' => 'Pending Task',
            'date' => 'Date',
            'user_id' => 'User ID',
        ];
    }

    public function getUserName()
    {
        return $this->user ? $this->user->name : 'Unknown User';
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

}