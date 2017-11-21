<?php
//incluimos la clase nusoap.php
require_once('lib/nusoap.php');
require_once('lib/class.wsdlcache.php');
//creamos el objeto de tipo soapclient.
//http://www.mydomain.com/server.php se refiere a la url
//donde se encuentra el servicio SOAP que vamos a utilizar.
$soapclient = new nusoap_client('https://al29c.000webhostapp.com/SWLabMejorado/servicioObtenerPregunta.php?wsdl',true);
//$email = $_POST('email');
//Llamamos la función que habíamos implementado en el Web Service
//e imprimimos lo que nos devuelve
$result = $soapclient->call('obtener', array('x'=>$_POST['email']));
//echo $result;
	echo (
		"<td>" . $result->enunciado . "</td><td>" . $result->correcta . "</td><td>" . $result->complejidad . "</td>"
	);
?>