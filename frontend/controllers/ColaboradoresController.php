<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Colaboradores;
use frontend\models\ColaboradoresSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use frontend\models\TransaccionesDetalle;

/**
 * ColaboradoresController implements the CRUD actions for Colaboradores model.
 */
class ColaboradoresController extends Controller
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
     * Lists all Colaboradores models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ColaboradoresSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Colaboradores model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionPerfil($id)
    {
        $pagos = TransaccionesDetalle::find()->where(['colaborador_id' => $id])->orderBy(['fecha_pago' => SORT_DESC, 'tipo_id' => SORT_DESC])->all();
        return $this->render('view', [
            'pagos' => $pagos,
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Colaboradores model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionRegistrar()
    {
        $model = new Colaboradores();

        if ($model->load(Yii::$app->request->post())) {

            $path = "images/colaboradores/";
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            if (UploadedFile::getInstance($model, 'photo_url')) {
                $model->photo_url = UploadedFile::getInstance($model, 'photo_url');
                $imagen = $path . str_replace(' ', '-', trim($model->nombre)) . '-' . str_replace(' ', '-', trim($model->apellido)) .".". $model->photo_url->extension;
                $imagen = strtolower($imagen);
                $model->photo_url->saveAs($imagen);
                $model->photo_url = $imagen;
            }

            $model->date = date("Y-m-d H:i:s");
            if (!$model->save()) {
                print_r($model->errors);
                exit;
            }
            Yii::$app->session->setFlash('success', "Colaborador registrado correctamente");
            return $this->redirect(['perfil', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Colaboradores model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEditar($id)
    {
        $model = $this->findModel($id);

        $old_url = $model->photo_url;
        if ($model->load(Yii::$app->request->post())) {

            $path = "images/colaboradores/";
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            if (!empty(UploadedFile::getInstance($model, 'photo_url'))) {
                $model->photo_url = UploadedFile::getInstance($model, 'photo_url');
                $imagen = $path . str_replace(' ', '-', trim($model->nombre)) . '-' . str_replace(' ', '-', trim($model->apellido)) .".". $model->photo_url->extension;
                $imagen = strtolower($imagen);
                $model->photo_url->saveAs($imagen);
                $model->photo_url = $imagen;
            }else{
                $model->photo_url = $old_url;
            }

             $model->save();

            Yii::$app->session->setFlash('success', "Colaborador registrado correctamente");
            return $this->redirect(['perfil', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Colaboradores model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        Yii::$app->session->setFlash('success', "Colaborador eliminado correctamente");
        return $this->redirect(['index']);
    }

    /**
     * Finds the Colaboradores model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Colaboradores the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Colaboradores::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
