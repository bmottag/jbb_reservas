<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



/**
 * Imprimir arreglos de una forma mas legible
 * @author oagarzond
 * @param mixed $objVar Arreglo o cadena para mostrar por pantalla con formato
 */
if (!function_exists("pr")) {

    function pr($objVar) {
        echo "<div align='left'>";
        if (is_array($objVar) or is_object($objVar)) {
            echo "<pre>";
            print_r($objVar);
            echo "</pre>";
        } else {
            echo str_replace("\n", "<br>", $objVar);
        }
        echo "</div><hr>";
    }

}

/**
 * Funcion para validar si una fecha es valida.
 *
 * Esta funcion se utiliza para validar si la fecha pasada por parametro es valida o no Ej. 2011-02-29 no es una fecha valida.
 * @author javier-sanchez
 * @param string $cadena Arreglo o cadena para mostrar por pantalla con formato.
 * @param array $arrCaracteres Arreglo o cadena para mostrar por pantalla con formato.
 * @return string Retorna la cadena formateada o escapada.
 */
if (!function_exists("es_fecha_valida")) {

    function es_fecha_valida($fecha) {
        if (strstr($fecha, "-")) {
            $data = explode("-", $fecha);
            if (strlen($data[0]) != 4)
                return false;
            return(@checkdate(intval($data[1]), intval($data[2]), intval($data[0])));
        }
        elseif (strstr($fecha, "/")) {
            $data = explode("/", $fecha);
            if (strlen($data[2]) != 4)
                return false;
            return(@checkdate(intval($data[0]), intval($data[1]), intval($data[2])));
        }
    }

}

/**
 * Esta funcion se utiliza para darle formato a la fecha pasada por parametro, 
 * es decir si se pasa el formato YYYY-MM-DD se retorna la fecha en formato DD/MM/YYYY y viceversa.
 * @author oagarzond
 * @param	date	$fecha	Fecha
 * @return	string	Retorna la fecha formateada o vacio si la fecha no es valida
 */
if (!function_exists("formatear_fecha")) {

    function formatear_fecha($fecha) {
        if (es_fecha_valida($fecha)) {
            if (strstr($fecha, "-")) {
                $data = explode("-", $fecha);
                return $data[2] . "/" . $data[1] . "/" . $data[0];
            } elseif (strstr($fecha, "/")) {
                $data = explode("/", $fecha);
                return $data[2] . "-" . $data[0] . "-" . $data[1];
            }
        } else
            return "";
    }

}

/**
 * @author oagarzond
 * @param	String	$ruta_imagen	Ruta relativa con el nombre de la imagen y su extension
 * @return	URL absoluta de la imagen deseada
 */
if (!function_exists("base_url_images")) {
    function base_url_images($ruta_imagen = '') {
        $CI = & get_instance();
        $url_images = $CI->config->base_url() . 'images/';
        if (strlen($ruta_imagen) > 0) {
            $url_images .= $ruta_imagen;
        }
        return $url_images;
    }
}