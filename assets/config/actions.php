<?php 
	session_start();

    


	if (isset($_GET['action']) && isset($_SESSION['auth'])) {

		$link = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
    	$result = $link->query("SELECT * FROM challenges") or die("could not");

		$level= $_SESSION['level'];
		$user_id = $_SESSION['user_id'];
		if ($_GET['action']=='like') {
			$query = "SELECT * FROM `likes` WHERE `user_id`=$user_id and `challenge_id`=$level";
			$query_run = $link->query($query);
			$query_row = $query_run->fetch_assoc();
  			if (empty($query_row)) {
				$quer = "INSERT INTO `likes`(`user_id`, `challenge_id`) VALUES ($user_id,$level)";
    			$quer_run = $link->query($quer);	
			}
		} else {
			$quer = "UPDATE `challenges` SET shares=shares+1 WHERE id=$level";
    		$quer_run = $link->query($quer);
		}
	}		
?>