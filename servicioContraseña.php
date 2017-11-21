<?php
//incluimos la clase nusoap.php
require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');
//creamos el objeto de tipo soap_server
$ns = "https://al29c.000webhostapp.com/SWLabMejorado/lib";
$server = new soap_server;
$server->configureWSDL('comprobar',$ns);
$server->wsdl->schemaTargetNamespace = $ns;
//registramos la función que vamos a implementar
$server->register('comprobar',
array('x'=>'xsd:string'),
array('z'=>'xsd:string'),
$ns);
//implementamos la función
function comprobar ($x){
	if (strpos(file_get_contents('toppasswords.txt'), $x) == false) {
		return 'VALIDA';
	}
	return 'INVALIDA';
}
//llamamos al método service de la clase nusoap
if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
$server->service($HTTP_RAW_POST_DATA);
?>
