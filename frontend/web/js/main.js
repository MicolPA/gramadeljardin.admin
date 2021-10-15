/* Preload*/
$(window).on('load', function () { // makes sure the whole site is loaded
	$('[data-loader="circle-side"]').fadeOut(); // will first fade out the loading animation
	$('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
	$('body').delay(350).css({
		'overflow': 'visible'
	});
    $('#ajax-loader').hide();
})

console.log('hola');

jQuery('input[type=file]').change(function(){
	console.log('aqui');
 	var filename = jQuery(this).val().split('\\').pop();
 	var idname = jQuery(this).attr('id');
 	console.log(jQuery(this));
 	console.log(filename);
 	console.log(idname);
 	jQuery('div.field-'+idname+' label').html("<span class='text-success'>CARGADA</span>");
 	// jQuery('div.field-'+idname+' label').attr("style", 'padding-left:1rem !important;padding-right: 1rem !important');
});

function displayNotification(title, message, icon, url='#'){
	var placementFrom = "bottom";
	var placementAlign = "right";
	var state = "success";
	var style = "withicon";
	var content = {};

	content.message = message
	content.title = title;
 	content.icon = icon;
	content.url = url;
	content.target = '_blank';

	$.notify(content,{
		type: state,
		placement: {
			from: placementFrom,
			align: placementAlign
		},
		time: 1000,
		delay: 0,
	});

	setTimeout(function(){
		$('.alert-success button').click();
	}, 4000)
}


function addImporte(cliente=null, view, colaborador=null){
	swal("¿Qué tipo de importe desea registrar?",{
	  buttons: {
	  	'ingresos': {
	  		text: 'Ingresos',
	  		value: 1,
	  		color:'red',
	  	},

	  	'gastos': {
	  		text: 'Gastos',
	  		value: 2,
	  		dangerMode: true
	  	},
	  },
	}).then((value) => {
		if (value) {
			if (cliente) {
				window.location = '/frontend/web/transacciones/registrar?cliente='+cliente+'&tipo='+value+'&view='+view;
			}else{
				window.location = '/frontend/web/transacciones/registrar?cliente='+cliente+'&tipo='+value+'&view='+view+'&colaborador_id='+colaborador;

			}
		}
	});
}

$(".cuenta").bind('keyup', function(){
	suma = 0;
	$('.cuenta').each(function(){
		n = $(this).val();
		console.log(n);
		if (! n > 0) {
			n = 0;
		}
		console.log(n);
        suma += parseFloat(n);
        console.log(suma);
        // if (Number.isNaN(suma)) {
        // 	suma = 0;
        // }
		$("#total").val(suma);
	});
})

$( ".submit" ).click(function() {
  $( "#form" ).submit();
});


function addInvoiceField(n){

	n++;
	console.log(n);
	my_function = "javascript:addInvoiceField("+n+")";
    $('.addInvoice').append($('.invoice').html());
    $(".addInvoice .row:last-child .descripcion input:last-child").attr('name', 'factura_descripcion['+n+']');
    $(".addInvoice .row:last-child .precio input:last-child").attr('name', 'factura_precio['+n+']');
    $(".addInvoice .row:last-child .btn_delete a:last-child").removeClass('disabled');
    $("#addInvoiceBtn").attr('href', my_function);
}

$('.field-facturas-pagada input').change(function() {
    if(this.checked) {
    	$(".div_fecha_pago input").prop('required', 'required');
    	$(".div_fecha_pago").show();
    }else{
    	$(".div_fecha_pago").hide();
    	$(".div_fecha_pago input").prop('required', false);

    }
    // alert(this.checked);        
});

$('#colaborador_select').change(function() {
    if($(this).val()) {
    	$(".dolab_amount_div").show();
    }else{
    	$(".dolab_amount_div").hide();

    }
    // alert(this.checked);        
});

function guardarEvento(nombre, fecha, time, cliente_id){
	data_event = '';
	$.ajax({
        url: "/frontend/web/site/guardar-evento",
        type: 'get',
        dataType: 'json',
        data: {
            nombre: nombre,
            fecha: fecha,
            time: time,
            cliente_id: cliente_id,
            _csrf: '<?=Yii::$app->request->getCsrfToken()?>'
        },
        success: function (data) {
            console.log(data);
            
            swal('Correcto','Evento guardado correctamente', 'success');
            data_event = data.event_date;
            // data['fecha'] = fecha;
            // data['nombre'] = nombre;
            // data['time'] = time;
            //$('#circ_id').append('<option value="">Todos</option>');
        }, error: function (xhr, ajaxOptions, thrownError){
        	console.log(thrownError);
        	console.log(xhr);
        	console.log(ajaxOptions);
        	$(".loading").hide();
			$(".btn-validar2").show();
        }
    });
   	return data_event;
}

function borrarEvento(id, url){
	swal({
          title: "¿Está seguro de que desea remover este evento?",
          text: "",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            window.location.href = url+"/site/borrar-evento"+"/?id="+id+"";
          } else {
            //swal("Your imaginary file is safe!");
          }
        });
}

// function verEvento(nombre, )