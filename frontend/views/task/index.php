<?php

use backend\models\Task;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\TaskSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Task', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
            'options' => ['class' => 'form-inline'],
        ]); ?>

        <?= $form->field($searchModel, 'dateRange')->textInput(['placeholder' => 'Start Date - End Date'])->label(false) ?>

        <?= Html::submitButton('Filter by Date Range', ['class' => 'btn btn-primary', 'name' => 'date-range-button']) ?>

        <?php ActiveForm::end(); ?>

        <br>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'task_id',
            'date',
            // [
            //     'attribute' => 'date',
            //     'filter' => DatePicker::widget([
            //         'model' => $searchModel,
            //         'attribute' => 'date',
            //         'clientOptions' => [
            //             'autoclose' => true,
            //             'format' => 'yyyy-mm-dd', // Date format as needed
            //         ],
            //         'options' => [
            //             'class' => 'form-control', // Adjust classes as needed
            //         ],
            //     ]),
            // ],            
            // [
            //     'attribute' => 'userName',
            //     'label' => 'User Name',
            //     'value' => function ($model) {
            //         return $model->getUserName();
            //     },
            //     'filter' => Html::activeTextInput($searchModel, 'userName', ['class' => 'form-control']),
            // ],
            'title',
            'task_details:ntext',
            'pending_task:ntext',
            
            // [
            //     'class' => ActionColumn::className(),
            //     'urlCreator' => function ($action, Task $model, $key, $index, $column) {
            //         return Url::toRoute([$action, 'task_id' => $model->task_id]);
            //      }
            // ],
        ],
    ]); ?>


</div>
