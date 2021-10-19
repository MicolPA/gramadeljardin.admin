<?php 

$servicios = new \common\models\Servicios();
$total = count($detalles);
$faltantes = 4 - $total;
$monto_total = 0;
 ?>
<html style="min-height: 100%; position: relative;">

<style>
	
</style>
	<!-- <img src="/frontend/web/images/formas-top.png" width="100%"> -->
	<div style="padding-left:33;">
		<div style="height: 100px"></div>
		<div style="padding: 0px 40px;">
			<div style="width: 50%;display:inline-block;float: left;padding-top: -2rem">
				<!-- <img src="/frontend/web/images/Logo lineal.png" width="180px"> -->
				<p style="font-weight: bold !important;letter-spacing: 10px;font-size:24px;font-family: poppins;"><?= $model->cotizacion ? "COTIZACIÓN" : "FACTURA" ?></p>
				<?php if ($model->comprobante): ?>
					<p>
						<span style="font-weight:bold">NCF: </span>P01001001010 <br>
						<?= $model->comprobante ?>
					</p>
				<?php endif ?>
			</div>

			<div style="width:50%;display:inline-block;float: left;text-align: right;margin-top: -2rem;margin-bottom: 1rem;">
				<img src="/frontend/web/images/logo-no-word.png" width="100px" style="margin-bottom:2px">
				<p style="font-size:10px;color:#4f4f4f; font-weight: lighter;">
					<br>
					<span style="font-weight:bold">RNC</span> 402-2048957-5 <br>
					<?= Yii::$app->params['direccion'] ?><br>
					<?= Yii::$app->params['telefono'] ?>
				</p>
				<!-- <p style="font-weight: 300 !important;letter-spacing: 10px;font-size:20px;">FACTURA</p> -->
			</div>
			<div style="height:1px;background: #f2f2f2 !important;margin-bottom: 1rem;">
			</div>
			<div style="width: 100%;">
				
				<div class="col-md-4 info-invoice" style="width: 48%;display: inline-block;float:left;padding: 0px;">
					<b style="font-size:12px">Dirigida a</b>
					<p style="color:#4f4f4f;font-size:12px;">
						<?php if (isset($model->cliente->representante_nombre)): ?>
						<?= $model->cliente->representante_nombre .  " (" .$model->cliente->empresa . ")" ?>
						<?php else: ?>
							<?= $model->cliente_nombre ?>
						<?php endif ?>
					</p>
				</div>
				<div class="col-md-5 info-invoice" style="width: 22%;display: inline-block;float:left;">
					<b style="font-size:12px">Fecha</b>
					<p style="color:#4f4f4f;font-size:12px;"><?= $servicios->formatDate($model->date, 1) ?></p>
				</div>
				<div class="col-md-3 info-invoice" style="width: 14%;display: inline-block;float:left;">
					<b style="font-size:12px"><?= $model->cotizacion ? "Cotización" : "Factura"?></b>
					<p style="color:#4f4f4f;font-size:12px;">#<?= $model->factura_code ?></p>
				</div>
			</div>

			<div style="margin-top: 0.2rem;padding: 0px;">
				<table class="table table-striped" style="">
					<thead>
						<tr style="border: 0px !important;background-color: #f2f2f2">
							<th style="border: 0px !important;color:#444;background-color: #f2f2f2">Detalle</th>
							<th style="border: 0px !important;color:#444;text-align: right;background-color: #f2f2f2">Precio</th>
							<th style="border: 0px !important;color:#444;text-align: right;background-color: #f2f2f2">Cantidad</th>
							<th style="border: 0px !important;color:#444;text-align: right;background-color: #f2f2f2">Total</th>
						</tr>
					</thead>
					<tbody>
						<?php $color_count = 0; ?>
						<?php foreach ($detalles as $d): ?>
							<?php $monto_total += $d->total; $color_count++ ?>
							<?php if ($color_count == 1): ?>
								<tr>
									<td style='font-size: 12px;padding:20px 10px;width:40%;'><?= $d->descripcion ?></td>
									<td style='font-size: 12px;padding:20px 10px;text-align: right;;width:20%;'><?= $d->precio > 0 ? "$". number_format($d->precio,2) : 'N/A' ?></td>
									<td style='font-size: 12px;padding:20px 10px;text-align: right;width:20%;'><?= $d->cantidad ? $d->cantidad : "N/A" ?></td>
									<td style='font-size: 12px;padding:20px 10px;text-align: right;width:20%;'><?= $d->total > 0 ? "$". number_format($d->total,2) : 'N/A' ?></td>
								</tr>
							<?php else: ?>
								<?php $color_count = 0 ?>
								<tr>
									<td style='font-size: 12px;padding:20px 10px;background-color: #f2f2f2;width:40%;'><?= $d->descripcion ?></td>
									<td style='font-size: 12px;padding:20px 10px;background-color: #f2f2f2;text-align: right;;width:20%;'><?= $d->precio > 0 ? "$". number_format($d->precio,2) : 'N/A' ?></td>
									<td style='font-size: 12px;padding:20px 10px;background-color: #f2f2f2;width:20%;text-align: right;'><?= $d->cantidad ?></td>
									<td style='font-size: 12px;padding:20px 10px;background-color: #f2f2f2;text-align: right;;width:20%;'><?= $d->total > 0 ? "$". number_format($d->total,2) : 'N/A' ?></td>
								</tr>
							<?php endif ?>
						<?php endforeach ?>
						<?php if ($faltantes > 0): ?>
							<?php for ($i=0;$i<=$faltantes;$i++): ?>
								<?php  $color_count++ ?>
								<?php if ($color_count == 1): ?>
								<tr>
									<td style='font-size: 12px;padding:20px 10px;color:white'>-</td>
									<td style='font-size: 12px;padding:20px 10px;color:white'>-</td>
									<td style='font-size: 12px;padding:20px 10px;color:white'>-</td>
									<td style='font-size: 12px;padding:20px 10px;color:white'>-</td>
								</tr>
								<?php else: ?>
								<?php $color_count = 0 ?>
								<tr>
									<td style='padding:20px 10px;background-color: #f2f2f2;color:#f2f2f2'><?= $i ?></td>
									<td style='padding:20px 10px;background-color: #f2f2f2;color:#f2f2f2'>$<?= $i ?></td>
									<td style='padding:20px 10px;background-color: #f2f2f2;color:#f2f2f2'>$<?= $i ?></td>
									<td style='padding:20px 10px;background-color: #f2f2f2;color:#f2f2f2'>$<?= $i ?></td>
									<!-- <td style='padding:20px 10px;color: #000;;background-color: #f2f2f2;'>hola</td> -->
									<!-- <td style='padding:20px 10px;color: #000;;background-color: #f2f2f2;'>-</td> -->
								</tr>
									
								<?php endif ?>
							<?php endfor ?>
						<?php endif ?>
					</tbody>
					<!-- <tr>
						<th style='padding:20px 10px;background:#56dfe4;color:#444'>Total</th>
						<th style='padding:20px 10px;background:#56dfe4;color:#444'>RD$<?//= number_format($monto_total,2) ?></th>
					</tr> -->
				</table>

				<div>
					<?php if ($model->pagada): ?>
					<div style='margin-top: 1rem;text-align: center;padding:10px;color:#444;border:2px dashed #fa2f2f;width:25%;float: left;display: inline-block;;color:#fa2f2f;transform:  scale(0.5);'>
						<p style="font-size: 22px;margin: 0;color:#fa2f2f;font-weight: bold;">PAGADO</p>
						<span style=";color:#fa2f2f;font-size:10px"><?= $servicios->formatDate($model->fecha_pagada) ?></span>
					</div>	
					<?php endif ?>
					<div style='padding:0px 10px 10px 10px;color:#000;text-align: right;float: right;display: inline-block;width: 60%;'>
						<br>Monto Total <br> 
						<span style="color:<?= Yii::$app->params['color-total-factura'] ?>;font-size:28px;"><?= $model->moneda ?>$<?= number_format($monto_total,2) ?></span>
						<p style="text-align:right;color:#8b8b8b">Todos los impuestos incluidos.</p>
					</div>

				</div>
			</div>
		</div>
	</div>
	<div style="position: absolute;bottom: 0;background: <?= Yii::$app->params['color-pie-factura'] ?>;height: 20px;width: 100%;color:white; text-align: center;padding:15px 0px">
		<p><?= Yii::$app->params['texto-pie-factura'] ?></p>
	</div>
</html>
