<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Tarjetas;
use frontend\models\TarjetasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TarjetasController implements the CRUD actions for Tarjetas model.
 */
class TarjetasController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all Tarjetas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TarjetasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tarjetas model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tarjetas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionRegistrar()
    {
        $model = new Tarjetas();

        if ($model->load(Yii::$app->request->post())) {
            $model->date = date("Y-m-d H:i:s");
            $model->user_id = Yii::$app->user->identity->id;
            $model->save();
            Yii::$app->session->setFlash('success', "Cuenta registrada correctamente");
            return $this->redirect(['registrar']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tarjetas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEditar($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Cuenta modificada correctamente");
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDetalle($id){

        $tarjeta = $this->findModel($id);

        $query = \frontend\models\TransaccionesDetalle::find()->where(['tarjeta_id' => $id])->orderBy(['fecha_pago' => SORT_DESC, 'tipo_id' => SORT_DESC]);
        $countQuery = clone $query;
        $pagination = new \yii\data\Pagination(['totalCount' => $countQuery->count()]);
        $model = $query->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();

        return $this->render('view', [
            'tarjeta' => $tarjeta,
            'model' => $model,
            'pagination' => $pagination,
        ]);
    }

    /**
     * Deletes an existing Tarjetas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tarjetas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tarjetas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tarjetas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
