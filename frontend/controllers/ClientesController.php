<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Clientes;
use frontend\models\Transacciones;
use frontend\models\ClientesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ClientesController implements the CRUD actions for Clientes model.
 */
class ClientesController extends Controller
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
     * Lists all Clientes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClientesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Clientes model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionPerfil($id)
    {
        $pagos = Transacciones::find()->where(['cliente_id' => $id])->orderBy(['fecha_pago' => SORT_DESC, 'tipo_id' => SORT_DESC])->all();
        $users = \frontend\models\User::find()->all();
        $facturas = \frontend\models\Facturas::find()
        ->where(['cliente_id' => $id])->orderBy(['date' => SORT_DESC])->all();
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'users' => $users,
            'pagos' => $pagos,
            'facturas' => $facturas,
        ]);
    }

    /**
     * Creates a new Clientes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionRegistrar($client=1)
    {
        $model = new Clientes();

        if ($model->load(Yii::$app->request->post())) {

            $model->dominio = str_replace('https', '', $model->dominio);
            $model->dominio = str_replace('http', '', $model->dominio);
            $model->dominio = str_replace('//', '', $model->dominio);
            $model->dominio = str_replace(':', '', $model->dominio);
            $model->dominio = str_replace('www.', '', $model->dominio);

            $path = "images/clientes/$model->dominio";
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            if (UploadedFile::getInstance($model, 'logo_url')) {
                $model->logo_url = UploadedFile::getInstance($model, 'logo_url');
                $imagen = $path . 'logo-' . str_replace($model->dominio, '.', '-') .".". $model->logo_url->extension;
                $model->logo_url->saveAs($imagen);
                $model->logo_url = $imagen;
            }

            $model->date = date("Y-m-d H:i:s");
            $model->user_id = Yii::$app->user->identity->id;
            if ($model->save()) {
                Yii::$app->session->setFlash('success', "Cliente registrado correctamente");
            }else{
                print_r($model->errors);
                exit;
            }

            return $this->redirect(['perfil', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'client' => $client,
        ]);
    }

    /**
     * Updates an existing Clientes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEditar($id)
    {
        $model = $this->findModel($id);
        $old_picture = $model['logo_url'];
        if ($model->load(Yii::$app->request->post())) {

            $path = "images/clientes/$model->dominio";
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            if (UploadedFile::getInstance($model, 'logo_url')) {
                $model->logo_url = UploadedFile::getInstance($model, 'logo_url');
                $imagen = $path . 'logo-' . str_replace($model->dominio, '.', '-') . "." . $model->logo_url->extension;
                $model->logo_url->saveAs($imagen);
                $model->logo_url = $imagen;
            }else{
                $model->logo_url = $old_picture;
            }

            $model->save();
            Yii::$app->session->setFlash('success', "Cliente modificado correctamente");
            return $this->redirect(['perfil', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Clientes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        Yii::$app->session->setFlash('success', "Cliente eliminado correctamente");
        return $this->redirect(['index']);
    }

    /**
     * Finds the Clientes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Clientes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Clientes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
