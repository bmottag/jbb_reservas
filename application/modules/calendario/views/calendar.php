<link href="<?php echo base_url("assets/bootstrap/vendor/fullcalendar/lib/main.css"); ?>" rel="stylesheet">
<script src="<?php echo base_url("assets/bootstrap/vendor/fullcalendar/lib/main.js"); ?>"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
$(function(){ 
	$(".btn-danger").click(function () {	
            $.ajax ({
                type: 'POST',
				url: base_url + 'calendario/cargarModalEliminar',
                cache: false,
                success: function (data) {
                    $('#tablaDatos').html(data);
                }
            });
	});	
});
</script>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		var calendarEl = document.getElementById('calendar');

		var calendar = new FullCalendar.Calendar(calendarEl, {

			expandRows: true,
			height: 1650,

			//locale: 'esLocale',
			headerToolbar: {
				left: 'prev,next today',
				center: 'title',
				right: 'timeGridWeek,timeGridDay'
				//right: 'listDay,listWeek'
			},

			// customize the button names,
			// otherwise they'd all just say "list"
			views: {
				timeGridDay: { buttonText: 'Día' },
				timeGridWeek: { buttonText: 'Semana' }
			},

			buttonText: { today:    'Hoy' },
			noEventsText: 'No hay registros',
			firstDay: 1, //para iniciar en lunes
			 
			initialView: 'timeGridWeek',
			navLinks: true, // can click day/week names to navigate views
			//businessHours: true, // display business hours
			editable: true,
			dayMaxEvents: true, // allow "more" link when too many events
			allDaySlot: false,
			slotMinTime: '8:00',
			slotMaxTime: '18:00',
			slotDuration: '00:15:00',
			events: {
				url: 'calendario/consulta',
				method: 'POST',
				extraParams: {
					custom_param1: 'something',
					custom_param2: 'somethingelse'
				},
				failure: function() {
					alert('There was an error while fetching events!');
				},
				color: 'green',   // a non-ajax option
				textColor: 'black' // a non-ajax option
			},
			eventClick: function(arg) {

				var oID = arg.event.id;
			    $.ajax ({
			        type: 'POST',
					url: base_url + 'calendario/cargarModalReserva',
			        data: {'idHorario': oID},
			        cache: false,
			        success: function (data) {
			            $('#tablaDatos').html(data);
			            $('#modal').modal('toggle')
			        }
			    });
			}
    	});
    	calendar.render();
  	});
</script>

<div id="page-wrapper">
	<br>	
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">	
            <div class="panel panel-default">
                
                <div class="panel-body">
                	<div class="row">
                		<div class="col-lg-6">	
                			<p class="lead">Visitas Jardín Botánico</p>
                		</div>
                		<div class="col-lg-6">	
                			<p class="text-right text-danger">
                				<small>Para cancelar su visita haga click en el siguiente botón</small>
								<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal" id="x" >
									Cancelar Reserva <span class="glyphicon glyphicon-remove" aria-hidden="true">
								</button>
                			</p>
            			</div>
                	</div>
                	<small>
                	
                    <p>Registre su visita en dos simples pasos:</p>

				    <ol>
				    <li> 
				    	<strong>Seleccione la fecha y hora: </strong>
				    	Verifique que la casilla seleccionada tenga cupo. Si está en verde es que aún no hay nadie inscrito y si está en amarillo (hay cupos). Los horarios que se ven en color rojo no tienen cupo.
				    </li>
				    <li>
				    	<strong>Ingrese sus datos: </strong>
				    	Registre los Nombres de cada uno de los asistentes (máximo 20 personas, incluyendo niños mayores de 3 años), un número celular de contacto y el correo electrónico donde recibirá el código QR de verificación. No olvide llenar el campo de comprobación (captcha) que consiste en escribir la palabra que está en colores, en el campo dispuesto para ello.
					</li>
					</ol>

					<ul>
						<li>
						Si después de tu visita al Jardín Botánico te diagnostican con Covid-19 debes reportarlo de inmediato a las autoridades de salud y al teléfono 4377060. Por tu salud y la de todos, Bogotá se sabe mover.Si después de tu visita al Jardín Botánico te diagnostican con Covid-19 debes reportarlo de inmediato a las autoridades de salud y al teléfono 4377060. Por tu salud y la de todos, Bogotá se sabe mover.
						</li>
					</ul>
					</small>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
	</div>

	<div class="row">
		<div class="col-lg-12">

			<div id='calendar'></div>
			<br>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
</div>
<!-- /#page-wrapper -->

<!--INICIO Modal para RESERVAS -->
<div class="modal fade text-center" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">    
	<div class="modal-dialog" role="document">
		<div class="modal-content" id="tablaDatos">

		</div>
	</div>
</div>                       
<!--FIN Modal para RESERVAS -->