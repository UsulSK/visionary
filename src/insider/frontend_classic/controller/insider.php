<?php
	$controllerDir = __DIR__; 
	require_once($controllerDir . '/../../../common/main_controller.php');
	
	$viewsDir = __DIR__ . '/../views'; 
	handleHttpRequest($controllerDir, $viewsDir, 'start_insider');

?>