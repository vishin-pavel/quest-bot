<?php

namespace app\controllers;

use Yii;
use app\models\TaskImage;
use app\models\search\TaskImage as TaskImageSearch;
use app\controllers\BasicController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaskImageController implements the CRUD actions for TaskImage model.
 */
class TaskImageController extends BasicController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TaskImage models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaskImageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaskImage model.
     * @param integer $task_id
     * @param integer $image_id
     * @return mixed
     */
    public function actionView($task_id, $image_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($task_id, $image_id),
        ]);
    }

    /**
     * Creates a new TaskImage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaskImage();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'task_id' => $model->task_id, 'image_id' => $model->image_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaskImage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $task_id
     * @param integer $image_id
     * @return mixed
     */
    public function actionUpdate($task_id, $image_id)
    {
        $model = $this->findModel($task_id, $image_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'task_id' => $model->task_id, 'image_id' => $model->image_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaskImage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $task_id
     * @param integer $image_id
     * @return mixed
     */
    public function actionDelete($task_id, $image_id)
    {
        $this->findModel($task_id, $image_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaskImage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $task_id
     * @param integer $image_id
     * @return TaskImage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($task_id, $image_id)
    {
        if (($model = TaskImage::findOne(['task_id' => $task_id, 'image_id' => $image_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
