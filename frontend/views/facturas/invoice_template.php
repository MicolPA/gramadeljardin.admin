<?php 

$servicios = new \common\models\Servicios();
$total = count($detalles);
$faltantes = 4 - $total;
$monto_total = 0;
 ?>
<html style="min-height: 100%; position: relative;">
	<img src="/frontend/web/images/formas-top.png" width="100%">
	<div style="padding: 0px 40px;">
		<div style="width: 50%;display:inline-block;float: left;">
			<!-- <img src="/frontend/web/images/Logo lineal.png" width="180px"> -->
			<br>
			<p style="font-weight: 300 !important;letter-spacing: 10px;font-size:20px;"><?= $model->cotizacion ? "COTIZACIÓN" : "FACTURA" ?></p>
		</div>

		<div style="width:50%;display:inline-block;float: left;text-align: right;margin-top: -4rem">
			<img src="/frontend/web/images/Logo lineal.png" width="180px">
			<p style="font-size:12px;color:#4f4f4f">
				MCD by M&G <br>
				Distrito Nacional, Santo Domingo <br>
				849-217-0808
			</p>
			<br>
			<!-- <p style="font-weight: 300 !important;letter-spacing: 10px;font-size:20px;">FACTURA</p> -->
		</div>

		<div style="width: 40%;background:#56dfe4;float: left;text-align: center;margin-bottom: 0rem;margin-top: -1.8rem">
			<p style="font-weight: 300 !important;margin:5px;color:white;font-weight: bold">Fecha: <?= $servicios->formatDate($model->date) ?></p>
		</div>

		<div style="width: 100%;background: #242335;padding: 6px;margin-top: -0rem">
			<p style="font-weight: 300 !important;margin:5px;color:white;"><span style="font-weight: bold">Dirigida a:</span> <?= $model->cliente->representante_nombre .  " (" .$model->cliente->empresa . ")" ?></p>
			<p style="font-weight: 300 !important;margin:5px;color:white;"><span style="font-weight: bold">Por concepto de:</span> <?= $model->asunto ?></p>
		</div>

		<div style="margin-top: .0rem">
			<table class="table table-striped">
				<thead>
					<tr style="border: 0px !important">
						<th style="background: #56dfe4 !important;border: 0px !important;color:#444">Detalle</th>
						<th style="background: #56dfe4 !important;border: 0px !important;color:#444">Precio</th>
						<th style="background: #56dfe4 !important;border: 0px !important;color:#444">Cantidad</th>
						<th style="background: #56dfe4 !important;border: 0px !important;color:#444">Total</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($detalles as $d): ?>
						<?php $monto_total += $d->precio ?>
						<tr>
							<td style='padding:20px 10px'><?= $d->descripcion ?></td>
							<td style='padding:20px 10px'>$<?= number_format($d->precio,2) ?></td>
							<td style='padding:20px 10px'>$<?= $d->cantidad ?></td>
							<td style='padding:20px 10px'>$<?= number_format($d->total,2) ?></td>
						</tr>
					<?php endforeach ?>
					<?php if ($faltantes > 0): ?>
						<?php for ($i=0;$i<=$faltantes;$i++): ?>
							<tr>
								<td style='padding:20px 10px;color:white'>hola</td>
								<td style='padding:20px 10px;color:white'>hola</td>
								<td style='padding:20px 10px;color:white'>hola</td>
								<td style='padding:20px 10px;color:white'>hola</td>
							</tr>
						<?php endfor ?>
					<?php endif ?>
				</tbody>
				<tr>
					<th style='padding:20px 10px;background:#56dfe4;color:#444'>Total</th>
					<th style='padding:20px 10px;background:#56dfe4;color:#444'><?= $model->moneda ?>$<?= number_format($monto_total,2) ?></th>
				</tr>		


			</table>
		</div>
	</div>
	<div style="position: absolute;
  bottom: 0;">
		<img src="/frontend/web/images/formas-bottom.png" width="100%">
	</div>
</html>
