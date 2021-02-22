<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
		$this->load->model("reportes_model");
		$this->load->model("general_model");
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

	
}