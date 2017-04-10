<?php

namespace app\controllers;

use Yii;
use app\models\UserGroup;
use app\models\search\UserGroup as UserGroupSearch;
use app\controllers\BasicController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserGroupController implements the CRUD actions for UserGroup model.
 */
class UserGroupController extends BasicController
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
     * Lists all UserGroup models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserGroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserGroup model.
     * @param integer $telegram_user_id
     * @param integer $group_id
     * @return mixed
     */
    public function actionView($telegram_user_id, $group_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($telegram_user_id, $group_id),
        ]);
    }

    /**
     * Creates a new UserGroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserGroup();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'telegram_user_id' => $model->telegram_user_id, 'group_id' => $model->group_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserGroup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $telegram_user_id
     * @param integer $group_id
     * @return mixed
     */
    public function actionUpdate($telegram_user_id, $group_id)
    {
        $model = $this->findModel($telegram_user_id, $group_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'telegram_user_id' => $model->telegram_user_id, 'group_id' => $model->group_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UserGroup model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $telegram_user_id
     * @param integer $group_id
     * @return mixed
     */
    public function actionDelete($telegram_user_id, $group_id)
    {
        $this->findModel($telegram_user_id, $group_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserGroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $telegram_user_id
     * @param integer $group_id
     * @return UserGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($telegram_user_id, $group_id)
    {
        if (($model = UserGroup::findOne(['telegram_user_id' => $telegram_user_id, 'group_id' => $group_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
