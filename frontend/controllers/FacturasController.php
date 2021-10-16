<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Facturas;
use frontend\models\FacturasDetalle;
use frontend\models\FacturasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

/**
 * FacturasController implements the CRUD actions for Facturas model.
 */
class FacturasController extends Controller
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
     * Lists all Facturas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FacturasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Facturas model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionVerOld($id)
    {
        $model = $this->findModel($id);
        $detalle = FacturasDetalle::find()->where(['factura_id' => $model->id])->all();
        $content = $this->renderPartial('invoice_template',['model' => $model, 'detalles' => $detalle]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => [150.8, 228.6],
            'marginTop' => 0,
            'marginLeft' => 0,
            'marginRight' => 0,
            'marginBottom' => 0,
            // 'format' => Pdf::FORMAT_LETTER,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Sysgel Reporte'],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader'=>[false],
                'SetFooter'=>[false],
                'SetWatermarkText' => ['DRAFT'],
                'SetWatermarkImage' => ['/frontend/web/images/figuras.png'],
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
    }

    function getPath($model){

        $path  = Yii::getAlias("@frontend"). "/web/facturas-generadas";
        $this->verifyPath($path);

        // echo date("Y", str_replace('-', '/', $model->date));
        $path = "$path/". date('Y', strtotime(str_replace('-','/', $model->date)));

        $this->verifyPath($path);

        $path = "$path/".  date('M', strtotime(str_replace('-','/', $model->date)));
        
        $this->verifyPath($path);

        $path = "$path/$model->factura_code";
        return $path;
    }

    function verifyPath($path){

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    }
    function generarpdf($model, $detalle, $content){

        $path = $this->getPath($model);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            // 'format' => Pdf::FORMAT_A4, 
            'format' => [200.8, 258.6],  
            'marginTop' => 0,
            'marginLeft' => 0,
            'marginRight' => 10,
            'marginBottom' => 10,

            // 'format' => Pdf::FORMAT_LETTER,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_FILE,
            'filename' => "$path.pdf",
            // 'tempPath' => '/web',
            // 'tempPath' => '/frontend/web/facturas-generadas',
            // 'tempPath' => '/frontend/web/facturas',
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Sysgel Reporte'],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader'=>[false],
                'SetFooter'=>[false],
                'SetWatermarkText' => ['DRAFT'],
                'SetWatermarkImage' => ['/frontend/web/images/figuras.png'],
            ]
        ]);

        // return the pdf output as per the destination setting
        $pdf->render();
    }
    public function actionVer($id){

        $model = $this->findModel($id);
        $detalle = FacturasDetalle::find()->where(['factura_id' => $model->id])->all();
        $content = $this->renderPartial('invoice_template-white',['model' => $model, 'detalles' => $detalle]);


        if (!$model->cotizacion) {
            $this->generarpdf($model, $detalle, $content);
        }

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            // 'format' => Pdf::FORMAT_A4, 
            'format' => [200.8, 258.6],  
            'marginTop' => 0,
            'marginLeft' => 0,
            'marginRight' => 10,
            'marginBottom' => 10,
            // 'format' => Pdf::FORMAT_LETTER,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Sysgel Reporte'],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader'=>[false],
                'SetFooter'=>[false],
                'SetWatermarkText' => ['DRAFT'],
                'SetWatermarkImage' => ['/frontend/web/images/figuras.png'],
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
    }

    /**
     * Creates a new Facturas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionRegistrar($cliente_id=null, $w_client=1)
    {
        $model = new Facturas();
        $post = Yii::$app->request->post();
        if ($model->load($post)) {

            // print_r($post);
            $model->pagada = isset($model->pagada[0]) ? $model->pagada[0] : 0;
            // $model->date = date("Y-m-d H:i:s");
            $model->user_id = Yii::$app->user->identity->id;
            if (!$model->save()) {
                print_r($model->errors);
                exit;
            }

            $model->factura_code = Yii::$app->params['codigo-factura']."00000$model->id";
            $model->save();
            $this->registerInvoiceDetail($post, $model);
            return $this->redirect(['ver', 'id' => $model->id]);
        }

        return $this->render('create', [
            'w_client' => $w_client,
            'cliente_id' => $cliente_id,
            'model' => $model,
        ]);
    }

    function registerInvoiceDetail($post, $model){

        for ($i = -1; $i <= count($post['factura_descripcion']); $i++) {
            
            if (isset($post['factura_descripcion'][$i])) {

                if ($post['factura_descripcion'][$i]) {
                    $invoiceDetail = new FacturasDetalle();
                    $invoiceDetail->factura_id = $model->id;
                    $invoiceDetail->descripcion = $post['factura_descripcion'][$i];
                    $invoiceDetail->precio = $post['factura_precio'][$i];
                    $invoiceDetail->date = date("Y-m-d H:i:s");
                    $invoiceDetail->save(false);
                }
            }
        }   

    }

    function actionMarkAsPaid($id){

        $model = Facturas::findOne($id);
        if ($model) {
            $model->pagada = 1;
            $model->fecha_pagada = date("Y-m-d");
            $model->save();
        }
        Yii::$app->session->setFlash('success', "Sello de pago colocado correctamente");
        return $this->redirect(['index']);
    }

    /**
     * Updates an existing Facturas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEditar($id, $w_client)
    {
        $model = $this->findModel($id);
        $post = Yii::$app->request->post();
        $detalles = FacturasDetalle::find()->where(['factura_id' => $id])->all();
        if ($model->load($post)) {
            $model->pagada = isset($model->pagada[0]) ? $model->pagada[0] : 0;
            $model->save();
            $this->deleteRegisterInvoiceDetail($detalles);
            $this->registerInvoiceDetail($post, $model);
            return $this->redirect(['ver', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'detalles' => $detalles,
            'w_client' => $w_client,
        ]);
    }

    function deleteRegisterInvoiceDetail($detalles){

        foreach($detalles as $d){
            $d->delete();
        }

    }

    /**
     * Deletes an existing Facturas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $file = $this->getPath($model);
        if (file_exists($file)) {
            unlink("$file.pdf");
        }
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Facturas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Facturas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Facturas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
