<?php 
	session_start();
	require("./functions.php");
	$login = ['Please sign in first!', 'I can\'t hear you unless you sign in!', 
	'You are saying something <br>I do not understand', 'Please, Login First. I promise We\'ll have fun!'];

	

	$request = isset($_POST['request']) ? $_POST['request'] : false;


	if (isset($_SESSION['auth']) and $_SESSION['auth']) {
		if (isCommand($request)) {
		   	switch (strtolower($request)) {
		   		case '/logout':
		   			logOut();
		   			break;
		   		case '/friends':
		   			listFriends($_SESSION['level']);
		   			break;
		   		case '/top':
		   			getTop();
		   			break;
		   		case '/joke':
		   			joke();
		   			break;
		   		case '/lifehack':
		   			lifehack();
		   			break;
		   		case '/help':
		   			echo "<b>Commands</b>:<br>/top<br>/joke<br>/friends<br>/lifehack<br>/logout";
		   			break;
		   		default:
		   			echo "No such command.<br> Type /help";
		   			break;
		   	}
		}
		else {
			checkAnswer($_SESSION['level'], $request);
		}
	} else {
		echo $login[mt_rand(0, count($login)-1)];
	}
?>