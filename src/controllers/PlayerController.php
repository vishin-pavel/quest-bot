<?php

namespace app\controllers;

use Yii;
use app\models\Player;
use app\models\search\PlayerSearch;
use app\controllers\BasicController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PlayerController implements the CRUD actions for Player model.
 */
class PlayerController extends BasicController
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
     * Lists all Player models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PlayerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Player model.
     * @param integer $telegram_user_id
     * @param integer $game_id
     * @return mixed
     */
    public function actionView($telegram_user_id, $game_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($telegram_user_id, $game_id),
        ]);
    }

    /**
     * Creates a new Player model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Player();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'telegram_user_id' => $model->telegram_user_id, 'game_id' => $model->game_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Player model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $telegram_user_id
     * @param integer $game_id
     * @return mixed
     */
    public function actionUpdate($telegram_user_id, $game_id)
    {
        $model = $this->findModel($telegram_user_id, $game_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'telegram_user_id' => $model->telegram_user_id, 'game_id' => $model->game_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Player model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $telegram_user_id
     * @param integer $game_id
     * @return mixed
     */
    public function actionDelete($telegram_user_id, $game_id)
    {
        $this->findModel($telegram_user_id, $game_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Player model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $telegram_user_id
     * @param integer $game_id
     * @return Player the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($telegram_user_id, $game_id)
    {
        if (($model = Player::findOne(['telegram_user_id' => $telegram_user_id, 'game_id' => $game_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
