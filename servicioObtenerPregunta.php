<?php
//incluimos la clase nusoap.php
require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');
//creamos el objeto de tipo soap_server
$ns = "https://al29c.000webhostapp.com/SWLabMejorado/lib";
$server = new soap_server;
$server->configureWSDL('obtener',$ns);
$server->wsdl->schemaTargetNamespace = $ns;

$server->wsdl->addComplexType(
    'Pregunta',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'enunciado' => array('name' => 'enunciado', 'type' => 'xsd:string'),
        'correcta' => array('name' => 'correcta', 'type' => 'xsd:string'),
        'complejidad' => array('name' => 'complejidad', 'type' => 'xsd:int')
    )
);

//registramos la función que vamos a implementar
$server->register('obtener',
array('x'=>'xsd:string'),
array('y'=>'tns:Person'),
$ns);
//implementamos la función
function obtener ($x){
	$preguntas = simplexml_load_file('preguntas.xml');

	$enunciado = $assessmentItem[$x]->itemBody->p;
	$correcta = $assessmentItem[$x]->correctResponse->value;
	$complejidad = $assessmentItem[$x]->attributes()->complexity;

	return array(
			'enunciado' => $enunciado,
			'correcta' => $correcta,
			'complejidad' => $complejidad
	);
}
//llamamos al método service de la clase nusoap
if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
$server->service($HTTP_RAW_POST_DATA);
?>