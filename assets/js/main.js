var me = {};
var you = {};


function formatAMPM(date) {
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0'+minutes : minutes;
    var strTime = hours + ':' + minutes + ' ' + ampm;
    return strTime;
}            

//-- No use time. It is a javaScript effect.
function insertChat(who, text, time = 0){
    var control = "";
    var date = formatAMPM(new Date());
    if (who == "me"){
            control = '<li style="width:100%;">' +
                    '<div class="msj-rta macro">' +
                        '<div class="text text-r">' +
                            '<p>'+text+'</p>' +
                            '<p><small>'+date+'</small></p>' +
                        '</div>' +                               
              '</li>';
    }else{
        control = '<li style="width:100%">' +
                        '<div class="msj macro">' +
                            '<div class="text text-l">' +
                                '<p>'+ text +'</p>' +
                                '<p><small>'+date+'</small></p>' +
                            '</div>' +
                        '</div>' +
                    '</li>';                    
    }
    setTimeout(
        function(){                        
            $("ul").append(control);
            if(who == "me"){
                document.getElementById('sound_out').play();
            } else {
                document.getElementById('sound_in').play();
            }
        }, time);
    
}

function resetChat(){
    $("ul").empty();
}

$(".mytext").on("keyup", function(e){
    if (e.which == 13){
        var text = $(this).val();
        if (text !== ""){
            insertChat("me", text);
            answer(text); 
            $(this).val('');
        }
    }
});

$(".macro2").on("click", function(e){
    var text = $('.mytext').val();
    if (text !== ""){
        insertChat("me", text);              
        $('.mytext').val('');
    }
});

//-- Clear Chat
resetChat();
//-- Print Messages
console.log("%c\
▒█▀▀▀█ ▒█▀▀█ ▀█▀ ▒█▀▀▄ ▒█▀▀▀ ▒█▀▀█ \n\
░▀▀▀▄▄ ▒█▄▄█ ▒█░ ▒█░▒█ ▒█▀▀▀ ▒█▄▄▀ \n\
▒█▄▄▄█ ▒█░░░ ▄█▄ ▒█▄▄▀ ▒█▄▄▄ ▒█░▒█ \n\
	", "color:red")

function wrongPassword(){
    document.getElementById('wrong').style.display = 'block';
}

function welcome(){
    insertChat("you", "Welcome to Robotutor!", 1500);
    insertChat("you", "We are glad...", 3000);
    insertChat("you", "to have you here!", 4000);
}
function logOut(){
    localStorage.removeItem("email");
    localStorage.removeItem("random_id");
    insertChat("you", "We look forrward to seeing you again!",500);
    setTimeout(function(){window.location.reload();}, 1700);
}
function isCommand(command){
    commands = ['/logout'];
    return commands.indexOf(command.toLowerCase())>-1;
}

function innerCommand(command){
    commands = ['/clear', '/roll'];
    return commands.indexOf(command.toLowerCase())>-1;
}

function share(){
    window.open("https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Frobotutor.uz%2F&amp;src=sdkpreparse", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
    $.post("assets/config/actions.php?action=share");
}

function answer(request){
    $.post(
        "assets/config/kernel.php", 
        {
            "request": request
        }, 
        function(result){
            if(innerCommand(request)){
                switch (request) {
                    case '/clear':
                        resetChat();
                        break;
                    case '/roll':
                        alert("Doing a barel roll");
                        break;
                }
            }
            else if (isCommand(request)) {
                $('body').append(result);
            } else {
                insertChat("you", result, Math.random()*800); 
            }
        }
    );
}


function like(){
    var str = document.querySelector(".thumb img").src;
    if (str.slice(-9)=="thumb.png") {
        var count = Number(document.querySelector('.likeCount').innerText);
        document.querySelector('.likeCount').innerText = ++count;
    }
    $.post(
        "assets/config/actions.php?action=like", 
        function(e){
            $('.thumb img').attr('src', 'assets/images/thumbup.png');
        }
    );
}

//functions for toggle button
$('#left').click(function(){
    $('.frame').css({'left':'0px'});
    $('.facebook').css({'opacity':'0.3'});
});
$('#closeFrame').click(function(){
    $('.frame').css('left','-1024px');
    $('.facebook').css({'opacity':'1'});
});
(function($) {
        $.fn.clickToggle = function(func1, func2) {
            var funcs = [func1, func2];
            this.data('toggleclicked', 0);
            this.click(function() {
                var data = $(this).data();
                var tc = data.toggleclicked;
                $.proxy(funcs[tc], this)();
                data.toggleclicked = (tc + 1) % 2;
            });
            return this;
        };}(jQuery));
$('#right').clickToggle(
    function(){
        $('.facebook aside').css({'right':'0px'});
        //$('#right').html('&#9932;');
        $('#right').css({'font-size':'30px','top':'10px'});
    },
    function(){
        $('.facebook aside').css({'right':'-600px'});
        //$('#right').html('&#9665;');
        $('#right').css({'font-size':'45px','top':'0px'});
    }
);

$('.loginForm #signup').on("click", function(){
    $('#loginnow').hide();
    $('#signupnow').show();    
});