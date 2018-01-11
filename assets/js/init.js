$(document).ready(function(){
	//Check LOCALSTORAGE for RANDOM ID and EMAIL
	$.post("assets/config/init.php", { "email": localStorage.getItem('email'), "random_id":localStorage.getItem('random_id') }, function(result){ $("body").append(result); });
	//GET USER INPUT WHEN ENTER CLICKED and CHECK FROM DATABASE and INSERT THE JS CODE
	$(".loginForm").on("keyup", function(e){
	    var email = $('#email').val();
	    var password = $('#password').val();

	    if (e.which == 13){
		   $.post("assets/config/init.php", { "email": email, "password":password }, function(result){ $("body").append(result); });
	    }
	    //END OF ENTER CLICKED
	});
	//GET USER INPUT LOGIN BUTTON CLICKED and CHECK FROM DATABASE and INSERT THE JS CODE
	$("#login").on("click", function(){
	    var email = $('#email').val();
	    var password = $('#password').val();

		$.post("assets/config/init.php", { "email": email, "password":password }, function(result){ $("body").append(result); });
	    //END OF BUTTON CLICKED
	});
	//END of ON READY 
});