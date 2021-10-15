<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Anotaciones;
use frontend\models\AnotacionesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AnotacionesController implements the CRUD actions for Anotaciones model.
 */
class AnotacionesController extends Controller
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
     * Lists all Anotaciones models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnotacionesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Anotaciones model.
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
     * Creates a new Anotaciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionVer($cliente_id, $id=null)
    {
        if ($id) {
            $model = Anotaciones::findOne($id);
        }else{
            $model = new Anotaciones();
            $model->user_id = Yii::$app->user->identity->id;
        }
        $cliente = \frontend\models\Clientes::findOne($cliente_id);

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->identity->id;
            $model->cliente_id = $cliente_id;
            $model->ultima_modificacion = date("Y-m-d H:i:s");
            if ($id) {$model->date = date("Y-m-d H:i:s");}
            $model->save();
            Yii::$app->session->setFlash('success', "Guardado correctamente");
            return $this->redirect(['/clientes/perfil', 'id' => $cliente_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'cliente' => $cliente,
        ]);
    }

    /**
     * Updates an existing Anotaciones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Anotaciones model.
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
     * Finds the Anotaciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Anotaciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Anotaciones::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
