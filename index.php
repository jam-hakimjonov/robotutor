<?php 
if(! isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
{
header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    
    <title>RoboTutor | Your Robot Tutor for Programming</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <link href="assets/css/font.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/media.css">
</head>
<body>
<!DOCTYPE html>
<html>
    <body>
        <div class="frame">
            <div class="topBar"><!-- Top Bar -->
                <img src="assets/images/you.png" class="teacherBot">
                <div class="info">
                    <h3>RoboTutor</h3>
                    <p>online</p>
                </div>
                <span id="closeFrame">&#9665;</span>
            </div>

            <ul></ul><!-- Messages -->

            <div>   <!-- Control -->
                <div class="macro smooth" style="margin:auto;background: white !important">                        
                    <div class="text text-w" style="background:white !important">
                        <input class="mytext" placeholder="Type a message"/>
                    </div> 
                </div>
                <input type="button" value=" " class="macro2" />
            </div>
        </div>


        <div class="facebook">
            <div class="header">
                <span id="left">&#9655;</span>
                <span>The RoboTutor</span>
                <span id="right">&#9665;</span>
            </div>
            <div class="main">

                <div class="wrapper" id="loginnow">
                    <div class="login">Log in to Robotutor</div>
                    <p id="wrong">Password/Login incorrect</p>
                    <div class="loginForm">
                        <input type="email" placeholder="Email address" id="email">
                        <input type="password" placeholder="Password" id="password">
                        <button id="login">Login</button>
                        <div class="more">
                            <a>Forgotten password</a>
                             · 
                            <a id="signup">Sign up</a>
                        </div>
                    </div>
                </div>

                <div class="wrapper" id="signupnow">
                    <div class="login">Sign up to Robotutor</div>
                    <p id="wrong2">Something Missing</p>
                    <form class="loginForm" method="POST" action="assets/config/cuser.php">
				        <input type='text' name='name' placeholder='Name' required="">
				        <input type='email' placeholder='Email address' name='email' required="">
				        <input type='text' name='fav_lang' placeholder='Favourite programming language' required="">
				        <input type='password' placeholder='Password' name='password' required="">
				        <button type="submit">Sign Up</button>
				        <div class='more'>
				            <a>Coded by Spider</a>
				             · 
				            <a>Tashkent 2018</a>
				        </div>
                    </form>
                </div>

            </div>
        </div>

        <audio id="sound_in" src="assets/sounds/sound_in.wav" style="display: none;visibility: hidden;"></audio>  
        <audio id="sound_out" src="assets/sounds/sound_out.wav" style="display: none;visibility: hidden;"></audio>   
        <script type="text/javascript" src="assets/js/main.js"></script>
        <script type="text/javascript" src="assets/js/createNode.js"></script>
        <script type="text/javascript" src="assets/js/init.js"></script>
    </body>
</html>

