<?php

namespace app\controllers;

use Yii;
use app\models\GroupHint;
use app\models\search\GroupHint as GroupHintSearch;
use app\controllers\BasicController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GroupHintController implements the CRUD actions for GroupHint model.
 */
class GroupHintController extends BasicController
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
     * Lists all GroupHint models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GroupHintSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GroupHint model.
     * @param integer $group_id
     * @param integer $hint_id
     * @return mixed
     */
    public function actionView($group_id, $hint_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($group_id, $hint_id),
        ]);
    }

    /**
     * Creates a new GroupHint model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GroupHint();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'group_id' => $model->group_id, 'hint_id' => $model->hint_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing GroupHint model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $group_id
     * @param integer $hint_id
     * @return mixed
     */
    public function actionUpdate($group_id, $hint_id)
    {
        $model = $this->findModel($group_id, $hint_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'group_id' => $model->group_id, 'hint_id' => $model->hint_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing GroupHint model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $group_id
     * @param integer $hint_id
     * @return mixed
     */
    public function actionDelete($group_id, $hint_id)
    {
        $this->findModel($group_id, $hint_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the GroupHint model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $group_id
     * @param integer $hint_id
     * @return GroupHint the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($group_id, $hint_id)
    {
        if (($model = GroupHint::findOne(['group_id' => $group_id, 'hint_id' => $hint_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
