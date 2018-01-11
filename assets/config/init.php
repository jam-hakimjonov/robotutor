<?php 
	session_start();
	require('./functions.php');

	$link = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
    $result = $link->query("SELECT * FROM challenges") or die("could not");
	//INITIALIZING IF THERE IS EMAIL AND RANDOM ID IN LOCALSTORAGE
	if (isset($_POST['email']) and isset($_POST['random_id'])){
		$email = strtolower($link->real_escape_string($_POST['email']));
		$random_id = $link->real_escape_string($_POST['random_id']);
		$user = 0;
		$query = "SELECT * FROM users WHERE email='$email' and random_id='$random_id'";
	    $query_run = $link->query($query);
	    while ($query_row = $query_run->fetch_assoc()){
	       	$user++;
	       	$_SESSION['auth'] = true;
	       	$_SESSION['name'] = $query_row['username'];
	       	$_SESSION['user_id'] = $query_row['id'];
	        $_SESSION['level'] = $query_row['level'];
	        $name = $_SESSION['name'];
	        init($query_row['level']);
	        echo "<script>resetChat();insertChat('you','Welcome back, $name!',1000)</script>";
	    } if ($user==0) {
	    	echo "<script>welcome()</script>";
	    }
	}


	//LOGIN and PASSWORD CHECKING FROM DATABASE
	if (isset($_POST['email']) and isset($_POST['password'])){
		$user = 0;
		$email = strtolower($link->real_escape_string($_POST['email']));
		$password = $link->real_escape_string($_POST['password']);

		$query = "SELECT * FROM users WHERE email='$email' and password='$password'";
	    $query_run = $link->query($query);
	    while ($query_row = $query_run->fetch_assoc()){
	        $email = $query_row['email'];
	        $random_id = $query_row['random_id'];
	        $_SESSION['auth'] = true;
	       	$_SESSION['name'] = $query_row['username'];
	       	$_SESSION['user_id'] = $query_row['id'];
	        $_SESSION['level'] = $query_row['level'];
	        $name = $_SESSION['name'];
	        $user++;
	       	init($query_row['level']);
	        echo "<script>".
	       		 "localStorage.setItem('random_id', '$random_id');".
	       		 "localStorage.setItem('email', '$email');resetChat();insertChat('you','Welcome $name!',1000)".
	        	 "</script>";
	    }
	    if ($user==0) {
	    	echo "<script>document.getElementById('wrong').style.display = 'block';</script>";
	    }
	}
?>