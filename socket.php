<?php
require_once('EnviosEmail.php');

$component = $_POST['c'];
$Method = $_POST['m'];
$asunto = $_POST['asunto'];
$texto = $_POST['texto'];
$Type = 'json';

$Component = str_replace(' ', '', ucwords(str_replace('_', ' ', $component)));

$socket = new $Component();
switch ($Method){
	case 'save':
		$socket->save($asunto, $texto);
		break;
	case 'view':
		$socket->view($asunto);
	break;
		
}


