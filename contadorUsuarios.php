<?php

$xml = simplexml_load_file('usuarios.xml');
$contador = $xml->contador;
$contador = $contador + 1;

$dom = dom_import_simplexml($xml)->ownerDocument;
$dom->formatOutput = TRUE;

$xml->asXML();
$xml->asXML('usuarios.xml');
echo $contador;
?>