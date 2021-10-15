<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Transacciones;
use frontend\models\Tarjetas;
use frontend\models\Clientes;
use frontend\models\TransaccionesDetalle;
use frontend\models\TransaccionesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TransaccionesController implements the CRUD actions for Transacciones model.
 */
class TransaccionesController extends Controller
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
                    // 'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Transacciones models.
     * @return mixed
     */
    public function actionIndex()
    {
        $cuentas = Tarjetas::find()->all();

        $query = Transacciones::find()->orderBy(['fecha_pago' => SORT_DESC, 'tipo_id' => SORT_DESC, 'id' => SORT_DESC]);
        $countQuery = clone $query;
        $pagination = new \yii\data\Pagination(['totalCount' => $countQuery->count()]);
        $model = $query->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();

        return $this->render('index', [
            'cuentas' => $cuentas,
            'model' => $model,
            'pagination' => $pagination,
        ]);
    }

    /**
     * Displays a single Transacciones model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDetalle($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Transacciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionRegistrar($cliente=null, $tipo, $view, $colaborador_id=null)
    {
        $model = new Transacciones();
        $cuentas = Tarjetas::find()->all();
        $cliente_info = Clientes::findOne($cliente);
        $post = Yii::$app->request->post();
        $model->tipo_id = $tipo;
        if ($model->load($post)) {
            $model->cliente_id = $cliente;
            $model->colaborador = $colaborador_id ? 1 : 0;
            $model->date = date("Y-m-d H:i:s");
            $model->user_id = Yii::$app->user->identity->id;
            $model->save();

            $this->registrarDetalle($post, $cuentas, $model, $colaborador_id);
            Yii::$app->session->setFlash('success', "Transacción registrada correctamente");
            $this->redirect([$view]);
            // return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'cuentas' => $cuentas,
            'cliente_info' => $cliente_info,
            'colaborador_id' => $colaborador_id,
        ]);
    }

    function registrarDetalle($post, $cuentas, $model, $colaborador_id=null){

        foreach ($cuentas as $cuenta) {

            if (isset($post['cuenta'][$cuenta->id]) or (isset($post['colaborador_amount']) and $cuenta->id == 3)) {
                if ($post['cuenta'][$cuenta->id] or (isset($post['colaborador_amount']) and $cuenta->id == 3)) {

                    if ($model->tipo_id == 1) {
                        $cuenta->dinero_total = $cuenta->dinero_total + $post['cuenta'][$cuenta->id];
                    }else{
                        $cuenta->dinero_total = $cuenta->dinero_total - $post['cuenta'][$cuenta->id];
                    }
                    if (isset($post['colaborador_amount']) and $cuenta->id == 3) {
                        $cuenta->dinero_total = $cuenta->dinero_total - $post['colaborador_amount'];
                        
                    }

                    $cuenta->dinero_total = (string)$cuenta->dinero_total;
                    $cuenta->save();
                    
                    $transaccion = new TransaccionesDetalle();
                    $transaccion->tarjeta_id = $cuenta->id;
                    $transaccion->transaccion_id = $model->id;
                    $transaccion->fecha_pago = $model->fecha_pago;
                    $transaccion->cliente_id = $model->cliente_id;
                    $transaccion->total = $post['cuenta'][$cuenta->id];
                    $transaccion->tipo_id = $model->tipo_id;
                    $transaccion->user_id = Yii::$app->user->identity->id;
                    $transaccion->date = date("Y-m-d H:i:s");
                    $transaccion->save();

                }
            }

        }
        if (isset($post['colaborador_amount'])) {
            $this->registrarImporteColaborador($colaborador_id, $post['colaborador_amount'], $model);
        }

    }

    function registrarImporteColaborador($colaborador_id, $amount, $model){
        if ($amount) {
            $transaccion = new TransaccionesDetalle();
            $transaccion->tarjeta_id = null;
            $transaccion->transaccion_id = $model->id;
            $transaccion->fecha_pago = $model->fecha_pago;
            $transaccion->total = $amount;
            $transaccion->tipo_id = $model->tipo_id;
            $transaccion->colaborador_id = $colaborador_id;
            $transaccion->user_id = Yii::$app->user->identity->id;
            $transaccion->date = date("Y-m-d H:i:s");
            if (!$transaccion->save()) {
                print_r($transaccion->errors);
                exit;
            }
        }
    }

    /**
     * Updates an existing Transacciones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEditar($id, $cliente=null, $tipo, $view)
    {
        $model = $this->findModel($id);
        $cuentas = Tarjetas::find()->all();
        $cliente_info = Clientes::findOne($cliente);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect([$view]);
        }

        return $this->render('update', [
            'model' => $model,
            'view' => $view,
            'cuentas' => $cuentas,
            'cliente_info' => $cliente_info,
        ]);
    }

    /**
     * Deletes an existing Transacciones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $view){

        $model = $this->findModel($id);
        $detalle_transacciones = TransaccionesDetalle::find()->where(['transaccion_id' => $id])->all();
        foreach ($detalle_transacciones as $d) {
            $cuenta = Tarjetas::findOne($d->tarjeta_id);
            if ($model->tipo_id == 1) {
                $cuenta->dinero_total = $cuenta->dinero_total - $d->total;
            }else{
                $cuenta->dinero_total = $cuenta->dinero_total + $d->total;
            }
            $cuenta->save(false);
        }
        $model->delete();

        Yii::$app->session->setFlash('success', "Transacción eliminada correctamente");
        return $this->redirect([$view]);
    }

    /**
     * Finds the Transacciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Transacciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Transacciones::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
