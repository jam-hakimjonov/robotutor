<?php  

header("Content-type: text/json");
require('./functions.php');

if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['fav_lang']) && isset($_POST['password']) && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['fav_lang']) && !empty($_POST['password'])){

    $link = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
    $result = $link->query("SELECT * FROM challenges") or die("could not");

	$name = $link->real_escape_string($_POST['name']);
	$email = $link->real_escape_string($_POST['email']);
	$fav_lang = $link->real_escape_string($_POST['fav_lang']);
	$password = $link->real_escape_string($_POST['password']);
	$random_id = getRandomId();

	if (emailExists($email)) {
		echo "The email you provided already exists :(";
	}
	else if (isEmail($email)) {
		$query = "INSERT INTO `users`(`username`, `email`, `fav_lang`, `password`, `random_id`) VALUES ('$name', '$email', '$fav_lang', '$password', '$random_id')";
		$link->query($query);
		header("Location: /");
	} else {
		echo "Are you sure it was a valid email? ;)";
	}
}
else {
	echo "Error Occured because you did not provide something asked :)";
}

?>