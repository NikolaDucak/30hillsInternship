<?php
	include_once("init.php");
	
	$uID = ( isset($_GET['uid']) ? $_GET['uid'] : (isset($_POST['uid']) ? $_POST['uid'] : ''));
	
	$userFacade = new UserStatsFacade();

	$userFacade->run($uID);
