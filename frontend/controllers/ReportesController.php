<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Transacciones;
use frontend\models\TransaccionesDetalle;

class ReportesController extends \yii\web\Controller
{
    public function actionIndex()
    {
		$from = date("d-m-Y",strtotime(date("d-m-Y")." - 6 month")); 
		// exit;
		$meses = $this->get_meses();
    	$importes['ingresos'] = $this->obtener_ingresos_range(1, $from);
    	$importes['gastos_produccion'] = $this->obtener_ingresos_range(2, $from);
    	$importes['gastos_operativos'] = $this->obtener_ingresos_range(3, $from);
        $importes_ganancias = $this->get_ganancias();
        $data = $this->get_informes_totales();
    	// print_r($importes);
    	// exit;

    	// exit;
        return $this->render('index',[
            'data' => $data,
        	'meses' => $meses,
            'importes' => $importes,
        	'importes_ganancias' => $importes_ganancias,
        ]);
    }

    function get_informes_totales(){

        $data['ingresos'] = Transacciones::find()->where(['tipo_id' => 1])->sum('total');
        $data['gastos'] = Transacciones::find()->where(['in', 'tipo_id', array(2,3)])->andWhere(['colaborador' => 0])->sum('total');
        $data['colaboradores'] = TransaccionesDetalle::find()->andWhere(['>', 'colaborador_id', 0])->sum('total');
        $data['ganancias'] = $data['ingresos'] - $data['gastos'] - $data['colaboradores'];

        return $data;
    }

    function get_importes_tipos(){

		$from = date("d-m-Y",strtotime(date("d-m-Y")." - 6 month")); 

		$data[1] = 0;
		$data[2] = 0;
		$data[3] = 0;

    	$transacciones = Transacciones::find()->where(['>=', 'MONTH(fecha_pago)', $from])->all();

    	foreach ($transacciones as $trans) {
    		
    		$data[$trans->tipo_id] += $trans->total;
    	}

    	return $data;

    }

    function get_meses(){

		$mesRange= array();
    	$from = date("d-m-Y",strtotime(date("d-m-Y")." - 6 month")); 
		$period = new \DatePeriod(
			new \DateTime($from),
			new \DateInterval('P1M'),
			6
		);

		foreach ($period as $date) {
        	array_push($mesRange, $date->format('m/Y'));
		}
        return $mesRange;

    }
    function get_ganancias(){

        $from = date("d-m-Y",strtotime(date("d-m-Y")." - 6 month")); 
        $period = new \DatePeriod(
            new \DateTime($from),
            new \DateInterval('P1M'),
            6
        );

        $mesRange= array();
        $totalRange= array();

        foreach ($period as $date) {
            

            $from = $date->format('m');
            $gastos = Transacciones::find()->where(['MONTH(fecha_pago)' => $from])->andWhere(['<>', 'tipo_id', 1])->sum('total');
            $ingresos = Transacciones::find()->where(['MONTH(fecha_pago)' => $from, 'tipo_id' => 1])->sum('total');
            $count = $ingresos - $gastos; 
            $count = $count > 0 ? $count : 0;
            array_push($mesRange,$from);
            array_push($totalRange, $count);

        }

        return $tRange = array('total' => $totalRange, 'meses'=>$mesRange);

    }

    function obtener_ingresos_range($tipo, $from){

		$period = new \DatePeriod(
			new \DateTime($from),
			new \DateInterval('P1M'),
			6
		);

		$mesRange= array();
	    $totalRange= array();

		foreach ($period as $date) {
			

			$from = $date->format('m');
        	$count = Transacciones::find()->where(['MONTH(fecha_pago)' => $from, 'tipo_id' => $tipo])->sum('total');
        	$count = $count > 0 ? $count : 0;
        	array_push($mesRange,$from);
           	array_push($totalRange, $count);

		}

	    return $tRange = array('total' => $totalRange, 'meses'=>$mesRange);

    }

    function get_importes($from, $tipo=null){

        $mesRange= array();
        $totalRange= array();

        $db = Yii::$app->getDb();

        if ($tipo) {
        	$created = $db->createCommand("SELECT sum(total) as Total,MONTH(fecha_pago) as Mes,YEAR(fecha_pago) as YEAR from transacciones where fecha_pago >= '$from' and tipo_id = '$tipo' GROUP BY MONTH(fecha_pago) ORDER by fecha_pago ASC")->queryAll();
        }else{
        	$created = $db->createCommand("SELECT sum(total) as Total,MONTH(fecha_pago) as Mes,YEAR(fecha_pago) as YEAR from transacciones where fecha_pago >= '$from' GROUP BY MONTH(fecha_pago) ORDER by fecha_pago ASC")->queryAll();
        }


        foreach ($created as $cr){
                
           $m = date('M', mktime(0, 0, 0, $cr['Mes'], 10)) . ", ".$cr['YEAR'];;
           array_push($mesRange,$m);
           array_push($totalRange,$cr['Total']);
        }

        return $tRange = array('total' => $totalRange, 'meses'=>$mesRange);
    }

}
