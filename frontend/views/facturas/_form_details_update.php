<?php 
use yii\helpers\Html;


 ?>

<div class="factura_detalle">
	
	

	<div class="addInvoice">
		<?php $count = 0; ?>
		<?php foreach ($detalles as $detalle): ?>
			<div class="row">
				<div class="col-md-9">
					<div class="form-group descripcion">
						<label>Descripción</label>
						<input type="text" class="form-control" name="factura_descripcion[<?= $count ?>]" value="<?= $detalle->descripcion ?>"> 
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group precio">
						<label>Precio</label>
						<input type="number" class="form-control" name="factura_precio[<?= $count ?>]" placeholder="Dejar vacío si no aplica" value="<?= $detalle->precio ?>">
					</div>
				</div>

				<!-- <div class="col-md-1 pt-5 btn_delete">
					<a href="deleteInvoiceLine(<?//= $count ?>)" class="btn btn-danger btn-sm disabled"><i class="fas fa-trash-alt"></i></a>
				</div>	 -->
			</div>
			<?php $count++ ?>
		<?php endforeach ?>
	</div>
	<div class="invoice">
		<div class="row">
			<div class="col-md-9">
				<div class="form-group descripcion">
					<label>Descripción</label>
					<input type="text" class="form-control" name="factura_descripcion[<?= $count ?>]">
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group precio">
					<label>Precio</label>
					<input type="number" class="form-control" name="factura_precio[<?= $count ?>]" placeholder="Dejar vacío si no aplica">
				</div>
			</div>

			<!-- <div class="col-md-1 pt-5 btn_delete">
				<a href="deleteInvoiceLine(1)" class="btn btn-danger btn-sm disabled"><i class="fas fa-trash-alt"></i></a>
			</div> -->
		</div>
	</div>

	<div class="row mb-4">
		<div class="col-md-12 text-right mt-4 pr-5">
			<a href="javascript:addInvoiceField(<?= $count ?>)" class="btn btn-success btn-sm" id="addInvoiceBtn">Agregar línea</a>
		</div>
	</div>

	<div class="col-md-12 pt-4 pb-4">
        <div class="form-group">
            <?= Html::submitButton('Actualizar Factura', ['class' => 'btn btn-primary pr-5 pl-5 btn-block']) ?>
        </div>
    </div>

</div>