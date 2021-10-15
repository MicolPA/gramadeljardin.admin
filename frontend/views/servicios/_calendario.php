<link href='/frontend/web/calendar/css/fullcalendar.css' rel='stylesheet' />
<link href='/frontend/web/calendar/css/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='/frontend/web/calendar/js/jquery-1.10.2.js' type="text/javascript"></script>
<!-- <script src='/frontend/web/calendar/js/jquery-ui.custom.min.js' type="text/javascript"></script> -->
<!-- <script src='/frontend/web/calendar/js/fullcalendar.js' type="text/javascript"></script> -->

<script>

	setTimeout(function(){
		$(document).ready(function() {
		    var date = new Date();
			var d = date.getDate();
			var m = date.getMonth();
			var y = date.getFullYear();

			/*  className colors

			className: default(transparent), important(red), chill(pink), success(green), info(blue)

			*/


			/* initialize the external events
			-----------------------------------------------------------------*/

			$('#external-events div.external-event').each(function() {

				// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
				// it doesn't need to have a start or end
				var eventObject = {
					title: $.trim($(this).text()) // use the element's text as the event title
				};

				// store the Event Object in the DOM element so we can get to it later
				$(this).data('eventObject', eventObject);

				// make the event draggable using jQuery UI
				$(this).draggable({
					zIndex: 999,
					revert: true,      // will cause the event to go back to its
					revertDuration: 0  //  original position after the drag
				});

			});


			/* initialize the calendar
			-----------------------------------------------------------------*/

			var calendar =  $('#calendar').fullCalendar({
				header: {
					left: 'title',
					center: 'agendaDay,agendaWeek,month',
					right: 'prev,next today'
				},
				editable: true,
				firstDay: 1, //  1(Monday) this can be changed to 0(Sunday) for the USA system
				selectable: true,
				defaultView: 'month',

				axisFormat: 'h:mm',
				columnFormat: {
	                month: 'ddd',    // Mon
	                week: 'ddd d', // Mon 7
	                day: 'dddd M/d',  // Monday 9/7
	                agendaDay: 'dddd d'
	            },
	            titleFormat: {
	                month: 'MMMM yyyy', // September 2009
	                week: "MMMM yyyy", // September 2009
	                day: 'MMMM yyyy'  // Tuesday, Sep 8, 2009
	            },
				allDaySlot: false,
				selectHelper: true,
				select: function(start, end, allDay) {
					fecha = end.toString();
					input_time = document.createElement('input');
					$(input_time).attr('type', 'time');
					$(input_time).attr('class', 'form-control');

					select_cliente = document.createElement('select');
					$(select_cliente).attr('class', 'form-control mt-2');
					<?php foreach ($clientes as $c): ?>
						$(select_cliente).prepend('<option value="<?= $c->id ?>" selected><?= $c->empresa ?></option>');
					<?php endforeach ?>
					$(select_cliente).prepend('<option value="" selected>Seleccionar cliente</option>');

					input_name = document.createElement('input');
					$(input_name).attr('type', 'text');
					$(input_name).attr('class', 'form-control mt-2 mb-2 border-primary');
					$(input_name).attr('placeholder', 'Nombre del evento');

					div = document.createElement('div');
					$(div).append($(input_name));
					$(div).append($(input_time));
					$(div).append($(select_cliente));

					swal("Datos del evento", {
						content: div,
					  	buttons: true
					})
					.then((value) => {
					  if (value) {
					  	console.log($(input_time).val());
					  	if ($(input_time).val() && $(input_name).val()) {
					  		console.log($(input_time).val());
							data_event = guardarEvento($(input_name).val(), fecha.substr(0,10), $(input_time).val(), $(select_cliente).val());
							console.log(data_event);
							// if (data_event != undefined) {
								// calendar.fullCalendar('renderEvent',{
					   //              title: $(input_name).val(),
					   //              start: data_event,
								// 	className: 'info rounded',
					   //              allDay: true
					   //            });
								calendar.fullCalendar('renderEvent',{
					                title: $(input_name).val(),
					                start: fecha,
									className: 'info rounded',
					                allDay: true,
					              });
								
								// calendar.fullCalendar('unselect');
							// }

					  	}else{
    						swal("Alerta", 'Favor llenar todos los campos', "warning");

					  	}
					  }
					});
					// var title = prompt('Event Title:');
					// if (title) {
					// 	calendar.fullCalendar('renderEvent',
					// 		{
					// 			title: title,
					// 			start: start,
					// 			end: end,
					// 			allDay: allDay
					// 		},
					// 		true // make the event "stick"
					// 	);
					// }
					// calendar.fullCalendar('unselect');
				},
				droppable: true, // this allows things to be dropped onto the calendar !!!
				drop: function(date, allDay) { // this function is called when something is dropped

					// retrieve the dropped element's stored Event Object
					var originalEventObject = $(this).data('eventObject');

					// we need to copy it, so that multiple events don't have a reference to the same object
					var copiedEventObject = $.extend({}, originalEventObject);

					// assign it the date that was reported
					copiedEventObject.start = date;
					copiedEventObject.allDay = allDay;

					// render the event on the calendar
					// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
					$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

					// is the "remove after drop" checkbox checked?
					if ($('#drop-remove').is(':checked')) {
						// if so, remove the element from the "Draggable Events" list
						$(this).remove();
					}

				},

				events: [
				<?php $url = Yii::getAlias("@web"); ?>
					<?php foreach ($eventos as $e): ?>
						{
							id: 	'<?= $e->id ?>',
							title: 	'<?= $e->nombre ?>',
							start: '<?= $e->event_date ?>',
							allDay: true,
							className: 'info rounded',
							url: 'javascript:borrarEvento(<?= $e->id ?>, "<?= $url ?>")'
						},
					<?php endforeach ?>	
					<?php foreach ($clientes as $c): ?>
						<?php 
						// echo date("Y-m-d");
							$fecha_proxima = date("Y-m-d",strtotime($c->fecha_comienzo."+ $c->tiempo_estimado weeks"));
							if ($c->fecha_finalizacion) {
								$fecha_proxima = $c->fecha_finalizacion;
							}
							// if ($fecha_proxima < date("Y-m-d")) {
							// 	$fecha_proxima = date("Y-m-d");
							// }
							$fecha = date("Y-m-d");
							$colores = array('important' => 'important', 'success' => 'success','chill' => 'chill', 'success' => 'success', 'bg-gray' => 'bg-gray');
							$color = array_rand($colores);
						?>
						{
							// id: 999,
							title: '<?= $c->empresa ?>',
							start: '<?= $c->fecha_comienzo ?>',
							end: '<?= $fecha_proxima ?>',
							allDay: true,
							className: '<?= $color ?> rounded',
							url: '/frontend/web/clientes/perfil?id=<?= $c->id ?>',
						},
					<?php endforeach ?>	
					// {
					// 	title: 'All Day Event',
					// 	start: new Date(y, m, 1)
					// },
					
					// {
					// 	id: 999,
					// 	title: 'Repeating Event',
					// 	start: new Date(y, m, d+4, 16, 0),
					// 	allDay: false,
					// 	className: 'info'
					// },
					// {
					// 	title: 'Meeting',
					// 	start: new Date(y, m, d, 10, 30),
					// 	allDay: false,
					// 	className: 'important'
					// },
					// {
					// 	title: 'Lunch',
					// 	start: new Date(y, m, d, 12, 0),
					// 	end: new Date(y, m, d, 14, 0),
					// 	allDay: false,
					// 	className: 'important'
					// },
					// {
					// 	title: 'Birthday Party',
					// 	start: new Date(y, m, d+1, 19, 0),
					// 	end: new Date(y, m, d+1, 22, 30),
					// 	allDay: false,
					// },
					// {
					// 	title: 'Click for Google',
					// 	start: new Date(y, m, 28),
					// 	end: new Date(y, m, 29),
					// 	url: 'http://google.com/',
					// 	className: 'success'
					// }
				],
			});


		});
	},1000)

</script>

<div id='wrap'>

<div id='calendar'></div>

<div style='clear:both'></div>
</div>
