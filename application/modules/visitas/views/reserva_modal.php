<script type="text/javascript" src="<?php echo base_url("assets/js/validate/visitas/reserva.js"); ?>"></script>

<script>
$(document).ready(function(){
	var i=1;
	$('#add').click(function()
	{
		i++;
		var CuposRestantes = $('#hddNumeroCuposRestantes').val();
		if(CuposRestantes > 7){
			CuposRestantes = 7;
		} 
		if(i<=CuposRestantes){
			$('#dynamic_field').append('<tr id="row'+i+'">					<td>						<small><b>Nombre Completo</b></small>						<input type="text" name="name[]" placeholder="Nombre Completo" class="form-control input-sm" required />						<small><b>Tipo de documento</b></small>						<select name="tipoDocumento[]"  class="form-control input-sm" required >							<option value="">Seleccione...</option>							<option value=1 >CC (Cédula d ciudadanía)</option>							<option value=2 >TI (Tarjeta de identidad)</option>							<option value=3 >CE (Cédula de extranjería)</option>							<option value=4 >PA (Pasaporte)</option>						</select>						<small><b>EPS</b></small>						<select name="eps[]"  class="form-control input-sm" required >							<option value="">Seleccione...</option>							<option value=1 >Aliansalud</option>							<option value=2 >Capital salud</option>							<option value=3 >Compensar eps</option>							<option value=4 >Coomeva eps </option>							<option value=5 >Coosalud</option>							<option value=6 >Cruz Blanca</option>							<option value=7 >Famisanar</option>							<option value=8 >Mutual Ser</option>							<option value=9 >Nueva EPS</option>							<option value=10 >Salud Total</option>							<option value=11 >Salud Vida</option>							<option value=12 >Sanitas</option>							<option value=13 >Servicio Occidental de Salud</option>							<option value=14 >Sura</option>							<option value=15 >Otra</option>						</select>					</td>					<td>						<small><b>Género</b></small>						<select name="genero[]"  class="form-control input-sm" required >							<option value="">Seleccione...</option>							<option value=1 >Hombre</option>							<option value=2 >Mujer</option>							<option value=3 >Otro</option>						</select>						<small><b>Número de Documento </b></small>						<input type="text" name="numeroDocumento[]" placeholder="Número de Documento" class="form-control input-sm" required />					<small><b>Número Emergencia</b></small>						<input type="number" name="emergencia[]" placeholder="Número Emergencia" class="form-control input-sm" required />					</td>					<td>						<small><b>Grupo Étnico</b></small>						<select name="grupoEtnico[]"  class="form-control input-sm" required >							<option value="">Seleccione...</option>							<option value=1 >Afrodescendiente</option>							<option value=2 >Indígena</option>							<option value=3 >Rrom</option>							<option value=4 >Raizal</option>							<option value=5 >Indígena</option>							<option value=6 >Otro</option>						</select>						<small><b>Ciudad </b></small>						<input type="text" name="ciudad[]" placeholder="Ciudad" class="form-control input-sm" /><small><b>Objetivo de la Visita</b></small>						<select name="objetivoVisita[]"  class="form-control input-sm" required >							<option value="">Seleccione...</option>							<option value=1 >Recreación</option>							<option value=2 >Educación</option>							<option value=3 >Investigación</option>						</select>					</td>					<td>						<small><b>Rango Edad</b></small>						<select name="rangoEdad[]"  class="form-control input-sm" required >							<option value="">Seleccione...</option>							<option value=1 >6 a 12 años</option>							<option value=2 >13 a 17 años</option>							<option value=3 >18 a 26 años</option>							<option value=4 >27 a 59 años</option>							<option value=5 >Mayor de 60 años</option>						</select>						<small><b>Localidad</b></small>						<select name="nivelEducativo[]"  class="form-control input-sm" >							<option value="">Seleccione...</option>							<option value=1 >Usaquén</option>							<option value=2 >Chapinero</option>							<option value=3 >Santa Fe</option>							<option value=4 >San Cristóbal</option>							<option value=5 >Usme</option>							<option value=6 >Tunjuelito</option>							<option value=7 >Bosa</option>							<option value=8 >Kennedy</option>							<option value=9 >Fontibón</option>							<option value=10 >Engativá</option>							<option value=11 >Suba</option>							<option value=12 >Barrios unidos</option>							<option value=13 >Teusaquillo</option>							<option value=14 >Mártires</option>							<option value=15 >Antonio Nariño</option>							<option value=16 >Candelaria</option>							<option value=17 >Rafael Uribe Uribe</option>							<option value=18 >Ciudad Bolívar</option>							<option value=19 >Sumapaz</option>						</select>					</td>					<td>						<small><b>Nivel Educativo</b></small>						<select name="nivelEducativo[]"  class="form-control input-sm" required >							<option value="">Seleccione...</option>							<option value=1 >Primaria</option>							<option value=2 >Bachiller</option>							<option value=3 >Profesional</option>							<option value=4 >Posgrado</option>							<option value=5 >Ninguno</option>							<option value=6 >Otro</option>						</select>						<small><b>Teléfono</b></small>						<input type="number" name="telefono[]" placeholder="Teléfono" class="form-control input-sm" required />					</td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove btn-xs"><i class="fa fa-times"></i></button></td></tr>');
		}else{
			alert('Se completo el limite de cupos permidos');
		}

	});

	$(document).on('click', '.btn_remove', function(){
		var button_id = $(this).attr("id"); 
		$('#row'+button_id+'').remove();
	});


	$(".btn-default").click(function () {	
        $.get('<?php echo base_url().'calendario/refresh'; ?>', function(data){
            $('#captImg').html(data);
        });
    });

});
</script>

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Reservar Visita
	<small>
	<p class="text-danger">
		<span class="glyphicon glyphicon-alert" aria-hidden="true"></span> Cupos disponibles: <?php echo $information[0]['numero_cupos_restantes']; ?>
	</p>
	<div style="color:blue; font-family: verdana, arial;" id="countdown"></div>
	Fecha: 
		<strong><?php echo ucfirst(strftime("%a, %b %d %G, %I:%M %p",strtotime($information[0]['hora_inicial']))); ?></strong>, favor ingresar los siguientes datos: 
	</small>
	</h4>
</div>

<div class="modal-body">
	
<script>
	var end = new Date();
    var sumarsesion = 5;
    var minutes = end.getMinutes();

    end.setMinutes(minutes + sumarsesion);//adiciono 5 min a la fecha actual
    
    var _second = 1000;
    var _minute = _second * 60;
    var _hour = _minute * 60;
    var _day = _hour * 24;
    var timer;

    function showRemaining() {
        var now = new Date();

        var distance = end - now;
        if (distance < 0) 
        {
            clearInterval(timer);
            //habilitar horario
            var idHorario = $('#hddIdHorario').val();
            $.ajax ({
                type: 'POST',
                url: base_url + 'calendario/habilitar',
                data: {'idHorario': idHorario},
                cache: false,
                success: function (data)
                {
                    $('#company').html(data);
                }
            });
            //deshabilitar y limpiar campos
            $('#btnSubmit').attr('disabled','-1');
            $('#email').attr('disabled','-1');
            $('#confirmarEmail').attr('disabled','-1');
            $('#celular').attr('disabled','-1');
			$("#email").val('');
			$("#confirmarEmail").val('');
			$("#celular").val('');
            document.getElementById('countdown').innerHTML = 'Su sesión expiró!';
            alert("Su sesión expiró.");

            return;
        }
        var days = Math.floor(distance / _day);
        var hours = Math.floor((distance % _day) / _hour);
        var minutes = Math.floor((distance % _hour) / _minute);
        var seconds = Math.floor((distance % _minute) / _second);

        seconds = actualizarHora(seconds);    

        //document.getElementById('countdown').innerHTML = days + ' dias, ';
        //document.getElementById('countdown').innerHTML += hours + ' horas, ';
        document.getElementById('countdown').innerHTML = 'Tiempo Restante: ' + minutes + ':' + seconds;
        //document.getElementById('countdown').innerHTML += seconds + ' segundos';
    }

	function actualizarHora(i) {
	    if (i<10) {i = "0" + i};  // Añadir el cero en números menores de 10
	    	return i;
	}

    timer = setInterval(showRemaining, 1000);
</script>

	<form name="add_reserva" id="add_reserva" role="form" method="post" >
		<input type="hidden" id="hddIdHorario" name="hddIdHorario" value="<?php echo $idHorario; ?>"/>
		<input type="hidden" id="hddNumeroCuposRestantes" name="hddNumeroCuposRestantes" value="<?php echo $information[0]['numero_cupos_restantes']; ?>"/>
		
		<div class="row">	
			<div class="col-sm-4">
				<div class="form-group text-left">
					<label class="control-label" for="email">Correo Electrónico: *</label>
					<input type="email" class="form-control" id="email" name="email" placeholder="Correo Electrónico" required />
				</div>
			</div>
			
			<div class="col-sm-4">		
				<div class="form-group text-left">
					<label class="control-label" for="confirmarEmail">Confirmar correo: *</label>
					<input type="email" id="confirmarEmail" name="confirmarEmail" class="form-control" placeholder="Confirmar correo" required >
				</div>
			</div>

			<div class="col-sm-4">		
				<div class="form-group text-left">
					<label class="control-label" for="celular">Celular de Contacto: *</label>
					<input type="number" class="form-control" id="celular" name="celular" placeholder="Celular de Contacto" required />
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-6">		
				<div class="form-group text-left">
					<label class="control-label" for="captcha">Captcha 
					<button type="button" name="refreshCaptcha" id="refreshCaptcha" class="btn btn-default btn-xs"><i class="fa fa-refresh"></i></button>
					</label>
					<p id="captImg"><?php echo $captchaImg; ?></p>
				</div>
			</div>
			<div class="col-sm-4">		
				<div class="form-group text-left">
					<label class="control-label" for="captcha">Ingresar Captcha: *</label>
					<input type="text" class="form-control" id="captcha" name="captcha" placeholder="Captcha" required />
				</div>
			</div>
		</div>

		<div class="table-responsive">
			<table class="table table-bordered" id="dynamic_field" border="0">

				<tr>
					<td>
						<small><b>Nombre Completo</b></small>
						<input type="text" name="name[]" placeholder="Nombre Completo" class="form-control input-sm" required />

						<small><b>Tipo de documento</b></small>
						<select name="tipoDocumento[]"  class="form-control input-sm" required >
							<option value="">Seleccione...</option>
							<option value=1 >CC (Cédula d ciudadanía)</option>
							<option value=2 >TI (Tarjeta de identidad)</option>
							<option value=3 >CE (Cédula de extranjería)</option>
							<option value=4 >PA (Pasaporte)</option>
						</select>

						<small><b>EPS</b></small>
						<select name="eps[]"  class="form-control input-sm" required >
							<option value="">Seleccione...</option>
							<option value=1 >Aliansalud</option>
							<option value=2 >Capital salud</option>
							<option value=3 >Compensar eps</option>
							<option value=4 >Coomeva eps </option>
							<option value=5 >Coosalud</option>
							<option value=6 >Cruz Blanca</option>
							<option value=7 >Famisanar</option>
							<option value=8 >Mutual Ser</option>
							<option value=9 >Nueva EPS</option>
							<option value=10 >Salud Total</option>
							<option value=11 >Salud Vida</option>
							<option value=12 >Sanitas</option>
							<option value=13 >Servicio Occidental de Salud</option>
							<option value=14 >Sura</option>
							<option value=15 >Otra</option>
						</select>
					</td>
					<td>
						<small><b>Género</b></small>
						<select name="genero[]"  class="form-control input-sm" required >
							<option value="">Seleccione...</option>
							<option value=1 >Hombre</option>
							<option value=2 >Mujer</option>
							<option value=3 >Otro</option>
						</select>
						<small><b>Número de Documento </b></small>
						<input type="text" name="numeroDocumento[]" placeholder="Número de Documento" class="form-control input-sm" required />

						<small><b>Número Emergencia</b></small>
						<input type="number" name="emergencia[]" placeholder="Número Emergencia" class="form-control input-sm" required />
					</td>
					<td>
						<small><b>Grupo Étnico</b></small>
						<select name="grupoEtnico[]"  class="form-control input-sm" required >
							<option value="">Seleccione...</option>
							<option value=1 >Afrodescendiente</option>
							<option value=2 >Indígena</option>
							<option value=3 >Rrom</option>
							<option value=4 >Raizal</option>
							<option value=5 >Indígena</option>
							<option value=6 >Otro</option>
						</select>
						<small><b>Ciudad </b></small>
						<input type="text" name="ciudad[]" placeholder="Ciudad" class="form-control input-sm" />

						<small><b>Objetivo de la Visita</b></small>
						<select name="objetivoVisita[]"  class="form-control input-sm" required >
							<option value="">Seleccione...</option>
							<option value=1 >Recreación</option>
							<option value=2 >Educación</option>
							<option value=3 >Investigación</option>
						</select>
					</td>
					<td>
						<small><b>Rango Edad</b></small>
						<select name="rangoEdad[]"  class="form-control input-sm" required >
							<option value="">Seleccione...</option>
							<option value=1 >6 a 12 años</option>
							<option value=2 >13 a 17 años</option>
							<option value=3 >18 a 26 años</option>
							<option value=4 >27 a 59 años</option>
							<option value=5 >Mayor de 60 años</option>
						</select>
						<small><b>Localidad</b></small>
						<select name="nivelEducativo[]"  class="form-control input-sm" >
							<option value="">Seleccione...</option>
							<option value=1 >Usaquén</option>
							<option value=2 >Chapinero</option>
							<option value=3 >Santa Fe</option>
							<option value=4 >San Cristóbal</option>
							<option value=5 >Usme</option>
							<option value=6 >Tunjuelito</option>
							<option value=7 >Bosa</option>
							<option value=8 >Kennedy</option>
							<option value=9 >Fontibón</option>
							<option value=10 >Engativá</option>
							<option value=11 >Suba</option>
							<option value=12 >Barrios unidos</option>
							<option value=13 >Teusaquillo</option>
							<option value=14 >Mártires</option>
							<option value=15 >Antonio Nariño</option>
							<option value=16 >Candelaria</option>
							<option value=17 >Rafael Uribe Uribe</option>
							<option value=18 >Ciudad Bolívar</option>
							<option value=19 >Sumapaz</option>
						</select>
					</td>
					<td>
						<small><b>Nivel Educativo</b></small>
						<select name="nivelEducativo[]"  class="form-control input-sm" required >
							<option value="">Seleccione...</option>
							<option value=1 >Primaria</option>
							<option value=2 >Bachiller</option>
							<option value=3 >Profesional</option>
							<option value=4 >Posgrado</option>
							<option value=5 >Ninguno</option>
							<option value=6 >Otro</option>
						</select>
						<small><b>Teléfono</b></small>
						<input type="number" name="telefono[]" placeholder="Teléfono" class="form-control input-sm" required />
					</td>

					<td>
						<button type="button" name="add" id="add" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> </button>
					</td>
				</tr>
				</table>
		</div>

				
		<div class="form-group">
			<div id="div_load" style="display:none">		
				<div class="progress progress-striped active">
					<div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
						<span class="sr-only">45% completado</span>
					</div>
				</div>
			</div>
			<div id="div_error" style="display:none">			
				<div class="alert alert-danger"><span class="glyphicon glyphicon-remove" id="span_msj">&nbsp;</span></div>
			</div>	
		</div>
		
		<div class="form-group">
			<div class="row" align="center">
				<div style="width:50%;" align="center">
					<button type="button" id="btnSubmit" name="btnSubmit" class="btn btn-primary" >
						Guardar <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
					</button> 
				</div>
			</div>
		</div>
			
	</form>
</div>