<link href="<?php echo base_url("assets/bootstrap/vendor/fullcalendar/lib/main.css"); ?>" rel="stylesheet">
<script src="<?php echo base_url("assets/bootstrap/vendor/fullcalendar/lib/main.js"); ?>"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
$(document).ready(function () {
    //Disable full page
    $("body").on("contextmenu",function(e){
        return false;
    });

$( document ).ready(function() {
	var popup = $('#hddPopUp').val();
    //alert('Por la seguridad de nuestros visitantes y la de quienes tenemos el gusto de atenderlos informamos que hoy, 12 de mayo de 2021: La atención al público será hasta las 12 M. Los invitamos a registrarse en otros horarios.');
    if(popup!=''){
    	alert(popup);
    }
});
    
    //Disable part of page
    $("#id").on("contextmenu",function(e){
        return false;
    });
});
	
$(function(){ 
	$(".btn-success").click(function () {	
            $.ajax ({
                type: 'POST',
				url: base_url + 'visitas/cargarModalEliminar',
				data: {'variable': 'consultar'},
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
			slotMaxTime: '17:30',
			slotDuration: '00:30:00',
			slotLabelInterval: '00:30', 
			events: {
				url: 'visitas/consulta',
				method: 'POST',
				extraParams: {
					custom_param1: 'something',
					custom_param2: 'somethingelse'
				},
				failure: function() {
					alert('Error al cargar los eventos!');
				},
				color: 'green',   // a non-ajax option
				textColor: 'black' // a non-ajax option
			},
			eventClick: function(arg) {

				var oID = arg.event.id;
			    $.ajax ({
			        type: 'POST',
					url: base_url + 'visitas/cargarModalVisitasCerro',
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
<input type="hidden" id="hddPopUp" name="hddPopUp" value="<?php echo $infoPopup?$infoPopup[0]['parametro_valor']:""; ?>" />                
                <div class="panel-body">
                	<div class="row">
                		<div class="col-lg-6">	
                			<p class="lead">CAMINO SAN FRANCISCO VICACHÁ</p>
                		</div>
                		<div class="col-lg-6">	
                			<p class="text-right text-success">
                				<small>Para consultar información de su visita haga click en el siguiente botón</small>
								<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal" id="x" >
									Consultar Reserva <span class="glyphicon glyphicon-search" aria-hidden="true">
								</button>
                			</p>
            			</div>
                	</div>
                	<small>
                	
<p>
El camino San Francisco-Vicachá se encuentra en la parte oriental del casco urbano de la ciudad de Bogotá en la Reserva Forestal Protectora Bosque Oriental de Bogotá. En este lugar se localizan los predios Molino del Boquerón, Molino inglés y Cerezos Los Laureles, propiedades de la EAAB-ESP, en las localidades de Santa fe y La Candelaria y limita con el barrio Los Laches y la vereda Fátima. El recorrido inicia, aproximadamente a 200 metros después del acceso al funicular del cerro de Monserrate, por la avenida circunvalar hacia el sur (EAAB, 2021).
<br>
<b>Longitud Aproximada: </b>2.082 metros (Camino empinado y escalonado)
<br>
<b>Altura: </b>desde 2.718 m.s.n.m hasta 2.910 m.s.n.m
<br>
<b>Tiempo de recorrido: </b>1 hora y 30 minutos aproximadamente.
<br>
<b>Costo: </b>El ingreso al camino es gratis
</p>

                    <p>Registre su visita, tenga en cuenta los siguientes pasos:</p>

				    <ol>
				    <li> 
				    	<strong>Seleccione la fecha y hora: </strong>
				    	Verifique que la casilla seleccionada tenga cupo. Si está en verde es que aún no hay nadie inscrito y si está en amarillo (hay cupos). Los horarios que se ven en color rojo no tienen cupo.
				    </li>
				    <li>
				    	<strong>Ingrese sus datos: </strong>
				    	Registre los Nombres de cada uno de los asistentes (máximo 7 personas, incluyendo niños desde los 7 años), un número celular de contacto y el correo electrónico donde recibirá el código QR de verificación. No olvide llenar el campo de comprobación (captcha) que consiste en escribir la palabra que está en colores, en el campo dispuesto para ello.
					</li>
				    <li>
				    	<strong>Los menores de edad: </strong>
				    	(7 años en adelante) deben estar acompañados de un adulto responsable.
				    </li>
				    <li>
				    	<strong>Responsabilidad con los residuos: </strong>
				    	Cada senderista se compromete a “No dejar rastro”, es decir, que los residuos que genere debe llevarlos a casa o a un sitio para disposición final.
				    </li>
				    <li>
						Al realizar la reseva, se aceptan las políticas, restricciones, normas y recomendaciones.
				    </li>
				    <li>
						Lea las recomendaciones del camino en el correo de confirmación.
				    </li>
					</ol>

<p>
Acepto cumplir con las restricciones del sitio - <b>Restricciones del Sitio</b>
<br>
Me comprometo a respetar las siguientes restricciones para ingresar a los predios de la EAAB-ESP donde el Jardín Botánico José Celestino Mutis realiza actividades de educación ambiental:
<br>
<ul>
<li>No se puede producir ruidos o utilizar instrumentos o equipos que perturben el ambiente natural o incomoden a otras personas. • "No dejar rastro", es decir llevarse todos los residuos que genere para su disposición final.</li>
<li>No se permite el ingreso de ningún tipo de animales, plantas, semillas y flores. </li>
<li>No está permitido utilizar productos químicos (esencias, sahumerios), sustancias inflamables (spray) y explosivos (juegos pirotécnicos).</li>
<li>Se prohíbe acampar.</li>
<li>Se prohíbe hacer fogatas o quemas.</li>
<li>No se puede ingresar bebidas embriagantes y sustancias psicoactivas, así como portar cualquier tipo de arma. • No afectar las señales, avisos y mobiliario existente.</li>
<li>No escribir sobre la corteza de los árboles.</li>
<li>Prohibido entrar o sumergirse en las fuentes de agua natural.</li>
<li>No realizar pesca deportiva, ni recolección de cualquier producto de plantas, animales o tierra. • Correr o practicar atletismo.</li>
<li>Absténgase de ingresar al camino en bicicleta, patineta o patines.</li>
<li>Las actividades de aventura no están permitidas en el área protegida.</li>
<li>Utilice únicamente los baños que se encuentren fuera de la reserva.</li>
</ul>
</p>




<p>
Acepto cumplir las normas para la visita - <b>Normas para la Visita</b>
<br>
<ul>
<li>Estar afiliado a un sistema de seguridad social. • Llegar 10 minutos antes de la hora programada para la visita.</li>
<li>Presentar el código QR para poder ingresar. • Si usted lleva algún animal de compañía, no puede ingresar al camino. • No llevar joyas, aparatos electrónicos de alta gama, cámaras fotográficas con trípode, ni equipos audiovisuales. El Jardín Botánico José Celestino Mutis, no se responsabiliza por su pérdida, robo o deterioro. Igual para el caso de las bicicletas. • Participar en la charla de inducción (20 minutos). • Caminar, únicamente, por los caminos permitidos y demarcados.</li>
<li>No haga parte del tráfico ilegal de fauna o flora silvestre.</li>
<li>No se debe generar alteración, remoción o daño de señales, avisos, vallas, cercas, mojones y demás elementos de adecuación en los caminos.</li>
<li>Si el propósito es hacer deporte, se recomienda tener precaución con los caminantes, disminuir la velocidad, no empujar y respetar el ritmo de los otros visitantes durante su permanencia en el camino.</li>
<li>No utilizar envases desechables.</li>
<li>Tomar las medidas de seguridad que sean necesarias.</li>
<li>En caso de emergencia, conservar la calma, siga las instrucciones del personal responsable y manténgase en el punto de encuentro hasta que la situación sea controlada. </li>
<li>Tener en cuenta que, en caso de lluvia, se evaluará la situación y se tomará la decisión de cancelar el recorrido.</li>
<li>Facilitar el control de salida.</li>
<li>No se puede esperar en la puerta de acceso al camino.</li>
<li>Llegar 10 minutos antes de la hora programada para la visita.</li>
<li>Inscribir a todos los participantes, incluidos los menores de edad.</li>
<li>No se debe generar alteración, remoción o daño de señales, avisos, vallas, cercas, mojones y demás elementos de adecuación en los caminos.</li>
</ul>
</p>


<p>
Acepto cumplir las recomendaciones - <b>Recomendaciones</b>
<br>
<ul>
<li>
 Los menores de edad son responsabilidad de los adultos que los inscriben. Se recomienda la participación de niños y niñas de 7 años en adelante. • Llevar ropa de fácil secado y zapatos o botas de buen agarre. • Utilizar protección solar (gafas, gorras y bloqueador) y llevar impermeable en caso de lluvia. • Para mujeres en periodo de gestación, personas con problemas respiratorios o cardiovasculares y mayores de 65 años, se recomienda no realizar caminatas largas o de exigencia física.
</li>
<li>Si tiene alguna enfermedad o consume medicamentos, consulte a su médico, antes de programar la visita.</li>

<li>Si presenta alguna condición física durante el recorrido contacte al apoyo médico.</li>
<li>Realizar actividades de calentamiento y estiramiento para prevenir esguinces, luxaciones y desgarres musculares. • No ingerir alimentos mientras camina, especialmente en ascensos, así evita la obstrucción de las vías aéreas. </li>
<li> En caso de sentir mareo, agotamiento, dolor de cabeza, tos y congestión, realice paradas de descanso, tome agua y respire profundo y despacio 5 veces. </li>
	<li> Si los síntomas continúan consulte al personal del Jardín Botánico José Celestino Mutis.</li>
<li> No hay área para parquear vehículos en el camino de San Francisco Vicachá. Consulte, antes de la visita, los parqueaderos cercanos y calcule el tiempo para llegar puntualmente.</li>

<li>Si identifica situaciones inseguras u observa alguna posibilidad de accidente por favor haga la sugerencia.</li>

<li>Respete los cultos, ritos o manifestaciones religiosas de los visitantes.</li>

<li>Mantenga las condiciones ambientales del camino, disfrute y conserve.</li>


</ul>
</p>








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