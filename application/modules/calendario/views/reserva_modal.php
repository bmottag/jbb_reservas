<script type="text/javascript" src="<?php echo base_url("assets/js/validate/calendario/reserva_v3.js"); ?>"></script>

<script>
$(document).ready(function(){
	var i=1;
	$('#add').click(function()
	{
		i++;
		var CuposRestantes = $('#hddNumeroCuposRestantes').val();
		if(i<=CuposRestantes){
			$('#dynamic_field').append('<tr id="row'+i+'"><td><small>'+i+'</small></td><td><input type="text" name="name[]" placeholder="Nombre Completo" class="form-control name_list" required /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="fa fa-times"></i></button></td></tr>');
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
					<td><small>1</small></td>
					<td>
						<input type="text" name="name[]" placeholder="Nombre Completo" class="form-control name_list" required/>
					</td>
					<td>
						<button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus"></i> Agregar Más </button>
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