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
			<div style="width: 55%;display:inline-block;float: left;padding-top: -2rem">
				<!-- <img src="/frontend/web/images/Logo lineal.png" width="180px"> -->
				<p style="font-weight: bold !important;letter-spacing: 10px;font-size:24px;font-family: poppins;"><?= $model->cotizacion ? "COTIZACIÓN" : "FACTURA" ?></p>

				<p style="font-size:10px !important;margin:0px;color:#4f4f4f">
					<?= $servicios->formatDate($model->date, 1) ?> <br>
					<span style="font-weight:bold">Nombre o razón social: </span>
					<?php if (isset($model->cliente->representante_nombre)): ?>
						<?= $model->cliente->representante_nombre .  " (" .$model->cliente->empresa . ")" ?>
					<?php else: ?>
						<?= $model->cliente_nombre ?>
					<?php endif ?>
					<br>
					<?php if ($model->cliente_rnc): ?>
						<span>
							<span style="font-weight:bold">RNC: </span><?= $model->cliente_rnc ?>
						</span>
					<?php endif ?>
				</p>
				
				<p>
					<span style="font-weight:bold">Por concepto de: </span><?= $model->asunto ?> <br>
					
				</p>
			</div>

			<div style="width:45%;display:inline-block;float: left;text-align: right;margin-top: -2rem;margin-bottom: 1rem;">
				<img src="/frontend/web/images/logo-no-word.png" width="100px" style="margin-bottom:2px">
				<p style="font-size:10px;color:#4f4f4f; font-weight: lighter;">
					<br>
					<?= Yii::$app->params['direccion'] ?><br>
					<?= Yii::$app->params['telefono'] ?> <br>
					<span style="font-weight:bold">RNC</span> 402-2048957-5 <br>
					<?php if ($model->comprobante): ?>
							<span style="font-weight:bold">NCF: </span><?= $model->ncf ?> <br>
							<?= $model->comprobante ?> <br>
					<?php endif ?>
					
				</p>
				<!-- <p style="font-weight: 300 !important;letter-spacing: 10px;font-size:20px;">FACTURA</p> -->
			</div>
			<div style="height:1px;background: #f2f2f2 !important;margin-bottom: 1rem;">
			</div>

			<div style="margin-top: 0.2rem;padding: 0px;">
				<table class="table table-striped" style="">
					<thead>
						<tr style="border: 0px !important;background-color: #f2f2f2">
							<th style="border: 0px !important;color:#444;text-align: left;background-color: #f2f2f2">Cant.</th>
							<th style="border: 0px !important;color:#444;background-color: #f2f2f2">Detalle</th>
							<th style="border: 0px !important;color:#444;text-align: right;background-color: #f2f2f2">Precio</th>
							<th style="border: 0px !important;color:#444;text-align: right;background-color: #f2f2f2">Total</th>
						</tr>
					</thead>
					<tbody>
						<?php $color_count = 0; ?>
						<?php foreach ($detalles as $d): ?>
							<?php $monto_total += $d->total; $color_count++ ?>
							<?php if ($color_count == 1): ?>
								<tr>
									<td style='font-size: 12px;padding:20px 10px;text-align: left;width:15%;'><?= $d->cantidad ? $d->cantidad : "N/A" ?></td>
									<td style='font-size: 12px;padding:20px 10px;width:40%;'><?= $d->descripcion ?></td>
									<td style='font-size: 12px;padding:20px 10px;text-align: right;;width:20%;'><?= $d->precio > 0 ? "$". number_format($d->precio,2) : 'N/A' ?></td>
									<td style='font-size: 12px;padding:20px 10px;text-align: right;width:25%;'><?= $d->total > 0 ? "$". number_format($d->total,2) : 'N/A' ?></td>
								</tr>
							<?php else: ?>
								<?php $color_count = 0 ?>
								<tr>
									<td style='font-size: 12px;padding:20px 10px;background-color: #f2f2f2;width:15%;text-align: left;'><?= $d->cantidad ?></td>
									<td style='font-size: 12px;padding:20px 10px;background-color: #f2f2f2;width:40%;'><?= $d->descripcion ?></td>
									<td style='font-size: 12px;padding:20px 10px;background-color: #f2f2f2;text-align: right;;width:20%;'><?= $d->precio > 0 ? "$". number_format($d->precio,2) : 'N/A' ?></td>
									<td style='font-size: 12px;padding:20px 10px;background-color: #f2f2f2;text-align: right;;width:25%;'><?= $d->total > 0 ? "$". number_format($d->total,2) : 'N/A' ?></td>
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
						<div style="padding-top:-2rem;width:30%;float: left;display: inline-block;;color:#fa2f2f;text-align:center;">
							<img src="/frontend/web/images/sello.png" width="150px" style="margin-bottom:1rem">
							<div style='margin-top: 1.5rem;text-align: center;padding:10px;color:#444;border:2px dashed #fa2f2f;width:80%;float: left;display: inline-block;;color:#fa2f2f;transform:  scale(0.5);margin:auto'>
								<p style="font-size: 22px;margin: 0;color:#fa2f2f;font-weight: bold;">PAGADO</p>
								<span style=";color:#fa2f2f;font-size:10px"><?= $servicios->formatDate($model->fecha_pagada) ?></span>
							</div>	
						</div>
					<?php else: ?>
						<div style="padding-top:-2rem;width:30%;float: left;display: inline-block;;color:#fa2f2f;text-align:center;">
							<img src="/frontend/web/images/sello.png" width="180px">
						</div>
					<?php endif ?>
					<div style='padding:0px 10px 10px 10px;color:#000;text-align: right;float: right;display: inline-block;width: 60%;'>
						<br>Monto Total <br> 
						<span style="color:<?= Yii::$app->params['color-total-factura'] ?>;font-size:28px;"><?= $model->moneda ?>$<?= number_format($monto_total,2) ?></span>
						<p style="text-align:right;color:#8b8b8b">Todos los impuestos incluidos.</p>
						<p style="color:<?= Yii::$app->params['color-total-factura'] ?>;font-weight: bold">
							Pago contra entrega, válido por 15 días.
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div style="position: absolute;bottom: 0;background: <?= Yii::$app->params['color-pie-factura'] ?>;height: 20px;width: 100%;color:white; text-align: center;padding:15px 0px">
		<p><?= Yii::$app->params['texto-pie-factura'] ?></p>
	</div>
</html>
