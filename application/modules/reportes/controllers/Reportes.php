<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
		$this->load->model("reportes_model");
		$this->load->library('PHPExcel.php');
    }
	
	/**
	 * Generate RESERVAS Report in PDF
	 * @param int $idHorario
     * @since 17/2/2021
     * @author BMOTTAG
	 */
	public function generaReservaPDF($idHorario)
	{
			$this->load->library('Pdf');
			
			// create new PDF document
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			
			$arrParam = array(
				'idHorario' => $idHorario,
				'estadoReserva' => 1
			);			
			$data['horarioInfo'] = $this->reportes_model->get_horario_info($arrParam);

			$data['infoReserva'] = $this->reportes_model->get_reserva_info($arrParam);

			$fecha = ucfirst(strftime("%b %d, %G",strtotime($data['horarioInfo'][0]['hora_inicial']))); 
			$horario = ucfirst(strftime("%I:%M %p",strtotime($data['horarioInfo'][0]['hora_inicial']))) . '-' . ucfirst(strftime("%I:%M %p",strtotime($data['horarioInfo'][0]['hora_final'])));

			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('JBB');
			$pdf->SetTitle('RESERVAS');
			$pdf->SetSubject('TCPDF Tutorial');

			// set default header data
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'RESERVAS', 'Fecha: ' . $fecha . "\nHorario: " . $horario, array(94,164,49), array(147,204,110));			

			// set header and footer fonts
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			
			$pdf->setPrintFooter(false); //no imprime el pie ni la linea 

			// set margins
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
				require_once(dirname(__FILE__).'/lang/eng.php');
				$pdf->setLanguageArray($l);
			}

			// ---------------------------------------------------------

			// set font
			$pdf->SetFont('dejavusans', '', 8);

			// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
			// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
			
			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			// Print a table
				
			// add a page
			//$pdf->AddPage('L', 'A4');
			$pdf->AddPage();

			$html = $this->load->view("reporte_reserva", $data, true);

			// output the HTML content
			$pdf->writeHTML($html, true, false, true, false, '');
			
			// Print some HTML Cells

			// reset pointer to the last page
			$pdf->lastPage();


			//Close and output PDF document
			$pdf->Output('reserva_' . $idHorario . '.pdf', 'I');

			//============================================================+
			// END OF FILE
			//============================================================+
		
	}	

	/**
	 * Generate RESERVAS por fecha Report in PDF
	 * @param var $fecha
     * @since 2/3/2021
     * @author BMOTTAG
	 */
	public function generaReservaFechaPDF()
	{
			$this->load->library('Pdf');
			
			// create new PDF document
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			
			$bandera = $this->input->post('bandera');

			if($bandera == 1 )
			{
				$data['fecha'] = $this->input->post('fecha');
				$fechaEncabezado = 'Fecha: ' . ucfirst(strftime("%b %d, %G",strtotime($data['fecha'])));
				$nombreArchivo = 'listado_visitantes_' . $data['fecha'] . '.pdf';

				$arrParam = array(
					'fecha' => $this->input->post('fecha')
				);
			}else{
				$data['from'] = $this->input->post('from');
				$data['to'] = $this->input->post('to');

				$fechaEncabezado = 'Rango Fechas: ' . ucfirst(strftime("%b %d, %G",strtotime($data['from']))) . ' - ' . ucfirst(strftime("%b %d, %G",strtotime($data['to'])));
				$nombreArchivo = 'listado_visitantes_' . $data['from'] . '-' . $data['to'] . '.pdf';

				$from = formatear_fecha($data['from']);
				//le sumo un dia al dia final para que ingrese ese dia en la consulta
				$to = date('Y-m-d',strtotime ( '+1 day ' , strtotime ( formatear_fecha($data['to']) ) ) );

				$arrParam = array(
					'from' => $from,
					'to' => $to
				);
			}
			$data['listaReservas'] = $this->reportes_model->get_info_reservas($arrParam);

			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('JBB');
			$pdf->SetTitle('RESERVAS');
			$pdf->SetSubject('TCPDF Tutorial');

			// set default header data
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'LISTADO DE VISITANTES', $fechaEncabezado, array(94,164,49), array(147,204,110));			

			// set header and footer fonts
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			
			$pdf->setPrintFooter(false); //no imprime el pie ni la linea 

			// set margins
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
				require_once(dirname(__FILE__).'/lang/eng.php');
				$pdf->setLanguageArray($l);
			}

			// ---------------------------------------------------------

			// set font
			$pdf->SetFont('dejavusans', '', 8);

			// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
			// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
			
			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			// Print a table
				
			// add a page
			//$pdf->AddPage('L', 'A4');
			$pdf->AddPage();

			$html = $this->load->view("reporte_reserva_fecha", $data, true);

			// output the HTML content
			$pdf->writeHTML($html, true, false, true, false, '');
			
			// Print some HTML Cells

			// reset pointer to the last page
			$pdf->lastPage();


			//Close and output PDF document
			$pdf->Output($nombreArchivo, 'I');

			//============================================================+
			// END OF FILE
			//============================================================+
	}	

	/**
	 * Generate Reportes in XLS
     * @since 14/03/2021
     * @author BMOTTAG
	 */
	public function generaReservaFechaXLS()
	{				
			$bandera = $this->input->post('bandera');

			if($bandera == 1 )
			{
				$data['fecha'] = $this->input->post('fecha');
				$fechaEncabezado = 'Fecha: ' . ucfirst(strftime("%b %d, %G",strtotime($data['fecha'])));
				$nombreArchivo = 'listado_visitantes_' . $data['fecha'] . '.xls';

				$arrParam = array(
					'fecha' => $this->input->post('fecha')
				);
			}else{
				$data['from'] = $this->input->post('from');
				$data['to'] = $this->input->post('to');

				$fechaEncabezado = 'Rango Fechas: ' . ucfirst(strftime("%b %d, %G",strtotime($data['from']))) . ' - ' . ucfirst(strftime("%b %d, %G",strtotime($data['to'])));
				$nombreArchivo = 'listado_visitantes_' . $data['from'] . '-' . $data['to'] . '.xls';

				$from = formatear_fecha($data['from']);
				//le sumo un dia al dia final para que ingrese ese dia en la consulta
				$to = date('Y-m-d',strtotime ( '+1 day ' , strtotime ( formatear_fecha($data['to']) ) ) );

				$arrParam = array(
					'from' => $from,
					'to' => $to
				);
			}
			$listaReservas = $this->reportes_model->get_info_reservas($arrParam);

			// Create new PHPExcel object	
			$objPHPExcel = new PHPExcel();

			// Set document properties
			$objPHPExcel->getProperties()->setCreator("JBB APP")
										 ->setLastModifiedBy("JBB APP")
										 ->setTitle("Report")
										 ->setSubject("Report")
										 ->setDescription("JBB Report")
										 ->setKeywords("office 2007 openxml php")
										 ->setCategory("Report");
										 
			// Create a first sheet
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->setCellValue('A1', 'LISTADO DE VISITANTES - ' . $fechaEncabezado);
						
			$objPHPExcel->getActiveSheet()->setCellValue('A3', 'Fecha')
										->setCellValue('B3', 'Horario')
										->setCellValue('C3', 'Correo Electrónico')
										->setCellValue('D3', 'No. Celular de Contacto')
										->setCellValue('E3', 'Nombre');
										
			$j=4;
			$total = 0; 

			if($listaReservas){
				foreach ($listaReservas as $lista):
					
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$j, ucfirst(strftime("%b %d, %G",strtotime($lista['hora_inicial']))))
													  ->setCellValue('B'.$j,  ucfirst(strftime("%I:%M",strtotime($lista['hora_inicial']))) . ' - ' . ucfirst(strftime("%I:%M %p",strtotime($lista['hora_final']))))
													  ->setCellValue('C'.$j, $lista['correo_electronico'])
													  ->setCellValue('D'.$j, $lista['numero_contacto'])
													  ->setCellValue('E'.$j, $lista['nombre_completo']);
						$j++;
				endforeach;
			}

			// Set column widths							  
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(22);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(22);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(50);

			// Add conditional formatting
			$objConditional1 = new PHPExcel_Style_Conditional();
			$objConditional1->setConditionType(PHPExcel_Style_Conditional::CONDITION_CELLIS)
							->setOperatorType(PHPExcel_Style_Conditional::OPERATOR_BETWEEN)
							->addCondition('200')
							->addCondition('400');
			$objConditional1->getStyle()->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_YELLOW);
			$objConditional1->getStyle()->getFont()->setBold(true);
			$objConditional1->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE);

			$objConditional2 = new PHPExcel_Style_Conditional();
			$objConditional2->setConditionType(PHPExcel_Style_Conditional::CONDITION_CELLIS)
							->setOperatorType(PHPExcel_Style_Conditional::OPERATOR_LESSTHAN)
							->addCondition('0');
			$objConditional2->getStyle()->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
			$objConditional2->getStyle()->getFont()->setItalic(true);
			$objConditional2->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE);

			$objConditional3 = new PHPExcel_Style_Conditional();
			$objConditional3->setConditionType(PHPExcel_Style_Conditional::CONDITION_CELLIS)
							->setOperatorType(PHPExcel_Style_Conditional::OPERATOR_GREATERTHANOREQUAL)
							->addCondition('0');
			$objConditional3->getStyle()->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_GREEN);
			$objConditional3->getStyle()->getFont()->setItalic(true);
			$objConditional3->getStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE);

			$conditionalStyles = $objPHPExcel->getActiveSheet()->getStyle('B2')->getConditionalStyles();
			array_push($conditionalStyles, $objConditional1);
			array_push($conditionalStyles, $objConditional2);
			array_push($conditionalStyles, $objConditional3);
			$objPHPExcel->getActiveSheet()->getStyle('B2')->setConditionalStyles($conditionalStyles);

			// Set fonts			  
			$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('A3:Q3')->getFont()->setBold(true);

			// Set header and footer. When no different headers for odd/even are used, odd header is assumed.
			$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&BPersonal cash register&RPrinted on &D');
			$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

			// Set page orientation and size
			$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
			$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Work Order');

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

			// redireccionamos la salida al navegador del cliente (Excel2007)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename=' . $nombreArchivo);
			header('Cache-Control: max-age=0');

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
			  
    }

	
}