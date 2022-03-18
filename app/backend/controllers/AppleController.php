<?php

namespace backend\controllers;

use backend\models\BackendApple;
use backend\models\BackendAppleSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * AppleController implements the CRUD actions for BackendApple model.
 */
class AppleController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all BackendApple models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BackendAppleSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $model = new BackendApple();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Creates a new BackendApple model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $cnt = rand(1, 20);
        $model = new BackendApple();

        try {
            $model->generateApples($cnt);
            Yii::$app->session->setFlash('success', 'Сгенерированно ' . $cnt . ' яблок');
            return $this->redirect(['index']);
        } catch (Exception | Throwable $e) {
            Yii::error($e->getMessage(), __METHOD__);

            Yii::$app->session->setFlash('error', 'Что-то пошло не так');
            return $this->redirect(['index']);
        }
    }

    /**
     * Updates an existing BackendApple model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDrop($id)
    {
        $model = $this->findModel($id);
        if (!$model->canDrop()) {
            Yii::$app->session->setFlash('error', 'Яблоко уже упало');
            return $this->redirect(['index']);
        }

        $model->drop_at = time();

        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Яблоко ID ' . $id . ' упало');
            return $this->redirect(['index']);
        }

        Yii::error($model->errors, __METHOD__);
        Yii::$app->session->setFlash('error', 'Что-то пошло не так');
        return $this->redirect(['index']);
    }

    public function actionEat($id)
    {
        $model = $this->findModel($id);
        if (!$model->canEat()) {
            Yii::$app->session->setFlash('error', 'Яблоко нельзя съесть');
            return $this->redirect(['index']);
        }
        $percent = $model->percent;

        if ($model->load(Yii::$app->request->post())) {
            $model->percent += $percent;
            if ($model->percent >= 100) {
                $model->delete();
                Yii::$app->session->setFlash('success', 'Яблоко ID ' . $id . ' съедено на 100% и удалено');
                return $this->redirect(['index']);
            }

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Яблоко ID ' . $id . ' съедено на ' . $model->percent . '%');
                return $this->redirect(['index']);
            }
        }

        Yii::error($model->errors, __METHOD__);
        Yii::$app->session->setFlash('error', 'Что-то пошло не так');
        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing BackendApple model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if (!$model->canDelete()) {
            Yii::$app->session->setFlash('error', 'Это яблоко нельзя удалить');
            return $this->redirect(['index']);
        }
        $model->delete();

        Yii::$app->session->setFlash('success', 'Яблоко ID ' . $id . ' удалено');
        return $this->redirect(['index']);
    }

    /**
     * Finds the BackendApple model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return BackendApple the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BackendApple::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
