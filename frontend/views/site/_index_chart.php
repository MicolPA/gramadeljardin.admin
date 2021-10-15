<?php 

$fecha_actual = date("d-m-Y");
$mes1 = date("m",strtotime($fecha_actual." - 6 month")); 
$mes2 = date("m",strtotime($fecha_actual." - 5 month")); 
$mes3 = date("m",strtotime($fecha_actual." - 4 month")); 
$mes4 = date("m",strtotime($fecha_actual." - 3 month")); 
$mes5 = date("m",strtotime($fecha_actual." - 2 month")); 
$mes6 = date("m",strtotime($fecha_actual." - 1 month")); 

$meses = array( 1 => "'Enero'", 2 => "'Febrero'", 3 => "'Marzo'", 4 => "'Abril'", 5 => "'Mayo'", 6 => "'Junio'", 7 => "'Jul'", 8 => "'Ago'", 9 => "'Sept'", 10 => "'Oct'", 11 => "'Nov'", 12 => "'Dic'");
echo "meses" . $meses[1];
 ?>

<script>
	setTimeout(function(){
		var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

		var mytotalIncomeChart = new Chart(totalIncomeChart, {
			type: 'bar',
			data: {
				labels: [<?= $meses[(int)$mes1] ?>, <?= $meses[(int)$mes2] ?>, <?= $meses[(int)$mes3] ?>, <?= $meses[(int)$mes4] ?>, <?= $meses[(int)$mes5] ?>, <?= $meses[(int)$mes6] ?>],
				datasets : [{
					label: "Igresos del mes",
					backgroundColor: '#ff9e27',
					borderColor: 'rgb(23, 125, 255)',
					data: [6, 4, 9, 5, 4, 6, 4, 3, 8, 10],
				}],
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				legend: {
					display: false,
				},
				scales: {
					yAxes: [{
						ticks: {
							display: false //this will remove only the label
						},
						gridLines : {
							drawBorder: false,
							display : false
						}
					}],
					xAxes : [ {
						gridLines : {
							drawBorder: false,
							display : false
						}
					}]
				},
			}
		});

		Circles.create({
			id:'circles-1',
			radius:45,
			value:<?= $clientes * 25 ?>,
			maxValue:100,
			width:7,
			text: <?= $clientes ?>,
			colors:['#f1f1f1', '#FF9E27'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		});
		
		Circles.create({
			id:'circles-2',
			radius:45,
			value:70,
			maxValue:100,
			width:7,
			text: 36,
			colors:['#f1f1f1', '#2BB930'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

		Circles.create({
			id:'circles-3',
			radius:45,
			value:40,
			maxValue:100,
			width:7,
			text: 12,
			colors:['#f1f1f1', '#F25961'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

        <?php if (!Yii::$app->user->isGuest): ?>
        	//displayNotification('MicodeRD',"Hola <?//= Yii::$app->user->identity->first_name ?>, Bienvenid@ al dashboard de MicodeRD",'fas fa-check-circle');
	
		<?php endif ?>

	},1000)


</script>

