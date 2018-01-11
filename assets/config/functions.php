<?php

function checkAnswer($level, $request){
    $link = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
    $result = $link->query("SELECT * FROM challenges") or die("could not");

    $wrong = ["Wrong!", "You guessed wrong.",
             "It is wrong answer for level $level",
             "$request is wrong!"];

    $right = ["Congrats! You found the solution for Level $level", 
             "Well done! You got one more in your friends list",
             "That's correct!", "Wow, That was a nice try!",
             "Cool, you are a step closer to Victory!"];

    $quer = "SELECT solution FROM challenges WHERE id = $level";
    $quer_run = $link->query($quer);
    while ($quer_row = $quer_run->fetch_assoc()){
       $solution = $link->real_escape_string($quer_row['solution']);
    }

    $user_id = $_SESSION['user_id'];

    if (strtolower($solution)==strtolower($request)) {
        $random = rand(0, count($right)-1); 
        echo $right[$random];
        $_SESSION['level']+=1;
        $qu = "UPDATE `users` SET level=level+1 WHERE id=$user_id";
        $qu_run = $link->query($qu);
        init($_SESSION['level']);
    } else {
        $qu = "SELECT * FROM `tries` WHERE challenge_id = $level and user_id = $user_id";
        $qu_run = $link->query($qu);
        $qu_row = $qu_run->fetch_assoc();
        if (empty($qu_row)) {
            $link->query("INSERT INTO `tries`(`user_id`, `challenge_id`) VALUES ($user_id, $level)");   
        }
        else {
            $link->query("UPDATE `tries` SET `tries_num`=`tries_num`+1 WHERE challenge_id = $level and user_id = $user_id");
        }
        $random = rand(0, count($wrong)-1); 
        echo $wrong[$random]."<br>Try again!";
    }
}
/************************************************************/
function joke(){
    echo "<img src='assets/images/jokes/".mt_rand(1,26).".jpg'>";
}
/************************************************************/
function lifehack(){
    $link = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
    $result = $link->query("SELECT * FROM challenges") or die("could not");

    $random = rand(7, 1004);
    $quer = "SELECT lifehack FROM lifehacks WHERE id=$random";
    $quer_run = $link->query($quer);
    while ($quer_row = $quer_run->fetch_assoc()){
        $lifehack = $quer_row['lifehack'];
    }
    print($lifehack);
}
/************************************************************/
function getTop(){
    $link = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
    $result = $link->query("SELECT * FROM challenges") or die("could not");
    $top = "<b>Top students:</b>";
    $quer = "SELECT username, level FROM users ORDER BY level DESC LIMIT 5";
    $quer_run = $link->query($quer);
     while ($quer_row = $quer_run->fetch_assoc()){
        $level = $quer_row['level'];
        $top .= "<br>".$link->real_escape_string($quer_row['username'])." <i>$level</i>";
    }
    echo $top;
}
/************************************************************/

function listFriends($level){
    $link = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
    $result = $link->query("SELECT * FROM challenges") or die("could not");
    $friends = "<b>You have $level friend(s)</b>";
    $quer = "SELECT name FROM challenges WHERE id<$level";
    $quer_run = $link->query($quer);
     while ($quer_row = $quer_run->fetch_assoc()){
        $friends .= "<br>".$link->real_escape_string($quer_row['name']);
    }
    echo $friends;
}
/************************************************************/
function isCommand($command){
	return strlen($command) >1 and $command[0]=='/';
}
/**************************************************************/
function logOut(){
	session_destroy();
	sendScript("logOut()");
}
/************************************************************/
function sendScript($js){
	echo "<script>".$js."</script>";
}
/************************************************************/
function getRandomId($len=42){
	$string = 'ABCDEFGHJKLMNOPQRSTUVXYZabcdefghjklmnopqrstuvxyz1234567890!@#$%^&*()/[]{}|~';
	$id = '';
	for ($i=0; $i < $len; $i++) {
		$random = rand(0, strlen($string)-1); 
		$id.= $string[$random];
	}
	return $id;
}
/************************************************************/
function init($level){
    $link = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
    $result = $link->query("SELECT * FROM challenges") or die("could not");
	$quer = "SELECT * FROM challenges WHERE id=$level";//replace 10 with $level;
    $quer_run = $link->query($quer);
    while ($quer_row = $quer_run->fetch_assoc()){
    	$id = $link->real_escape_string($quer_row['id']);
       	$name = $link->real_escape_string($quer_row['name']);
        $company = $link->real_escape_string($quer_row['company']);
        $about = $link->real_escape_string($quer_row['about']);
        $problem = $link->real_escape_string($quer_row['problem']);
        $input = $link->real_escape_string($quer_row['input']);
        $shares = $link->real_escape_string($quer_row['shares']);
            $query = "SELECT COUNT(id) as likes FROM `likes` WHERE challenge_id = $level";
            $query_run = $link->query($query);
            while ($query_row = $query_run->fetch_assoc()){
                $likes = $query_row['likes'];
            }
    }
    sendScript("setPost($id, '$name', '$company', '$about', '$problem', '$input',$shares,$likes);
    	insertChat('you', 'What is your answer <br>for level $id?',4100);setAside1($id, '$name');");

    $query = "SELECT * FROM challenges WHERE id>$level LIMIT 6";
    $query_run = $link->query($query);
    while ($query_row = $query_run->fetch_assoc()){
        $id2 = $link->real_escape_string($query_row['id']);
        $name2 = $link->real_escape_string($query_row['name']);
        sendScript("setAside2($id2, '$name2')");
    }

    //CHECKING FOR USER LIKES
    $user_id = $_SESSION['user_id'];
    $qu = "SELECT * FROM `likes` WHERE `user_id`=$user_id and `challenge_id`=$level";
    $qu_run = $link->query($qu);
    $qu_row = $qu_run->fetch_assoc();
    if (!empty($qu_row)) {
        sendScript("like()");
    }
}
/************************************************************/
function isEmail($email){
    return true;
}
/************************************************************/
function emailExists($email){
    $link = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
    $result = $link->query("SELECT * FROM challenges") or die("could not");
    $mail = strtolower($email);
    $qu = "SELECT * FROM `users` WHERE `email`='$mail'";
    $qu_run = $link->query($qu);
    $qu_row = $qu_run->fetch_assoc();
    return !empty($qu_row);
}
/************************************************************/
?>