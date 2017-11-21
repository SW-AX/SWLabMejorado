<?php
//incluimos la clase nusoap.php
require_once('../lib/nusoap.php');
require_once('../lib/class.wsdlcache.php');
//libreria para php7
require_once("nusoap-0.9.5/src/nusoap.php");
//creamos el objeto de tipo soap_server
$ns="http://localhost/nusoap-0.9.5/samples";
$server = new soap_server;
$server->configureWSDL('comprobar',$ns);
$server->wsdl->schemaTargetNamespace=$ns;
//registramos la función que vamos a implementar
$server->register('comprobar',
array('myfile'=>'xsd:file', 'password'=>'xsd:string'),
array('response'=>'xsd:string'),
$ns);
//implementamos la función
function Comprobar ($myfile, $password){
	$myfile = fopen("toppasswords.txt", "r");
	$encontrado=FALSE;
	$response="VALIDA";
	while(!feof($myfile) and $encontrado==FALSE) {
		$line = fgets($file);
		if ($line == $password){
			$response="INVALIDA";
			$encontrado=TRUE;
		} 
	}
	return $response;

}
//llamamos al método service de la clase nusoap
if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
$server->service($HTTP_RAW_POST_DATA);
?>
