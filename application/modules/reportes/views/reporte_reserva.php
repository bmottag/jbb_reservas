<?php
// create some HTML content	
$html = '
	<style>
	table {
		font-family: arial, sans-serif;
		border-collapse: collapse;
		width: 100%;
	}

	td, th {
		border: 1px solid #dddddd;
		text-align: left;
		padding: 8px;
	}
	</style>';
				
//datos especificos
$html.= '<table border="0" cellspacing="0" cellpadding="4">';
$html.= '<tr>
			<th align="center" width="5%" bgcolor="#5ea431" style="color:white;"><strong>No.</strong></th>
			<th align="center" width="35%" bgcolor="#5ea431" style="color:white;"><strong>Correo Electrónico</strong></th>
			<th align="center" width="25%" bgcolor="#5ea431" style="color:white;"><strong>No. Celular</strong></th>
			<th align="center" width="35%" bgcolor="#5ea431" style="color:white;"><strong>Nombre</strong></th>
		</tr>';

$items = 0;
if($infoReserva)
{ 
	foreach ($infoReserva as $lista):
		$items++;
				
		$html.=	'<tr>
					<th align="center">' . $items . '</th>
					<th>' . $lista['correo_electronico'] . '</th>
					<th align="center">' . $lista['numero_contacto'] . '</th>
					<th>' . $lista['nombre_completo'] . '</th>';
		$html.= '</tr>';
	endforeach;
}


$html.= '</table>';	
			
echo $html;
						
?>