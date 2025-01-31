<?php

namespace app\controllers;

use app\models\Category;
use app\models\Task;
use Yii;
use yii\data\Pagination;

class TasksController extends \yii\web\Controller
{
    public function actionIndex(): string
    {
        $task = new Task();
        $task->load(Yii::$app->request->post());

        $tasksQuery = $task->getSearchQuery();
        $categories = Category::find()->all();

        $countQuery = clone $tasksQuery;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 5]);
        $models = $tasksQuery->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index', ['models' => $models, 'pages' => $pages, 'task' => $task, 'categories' => $categories]);
    }

}