function extCreate(tag,className,Text='',attrType,attrName) {
	var element=document.createElement(tag);
	if(className!='') element.setAttribute('class',className);
	if(attrType!=undefined && attrName!=undefined) element.setAttribute(attrType,attrName);
	element.innerHTML=Text;
	return element;
}

function extAppend(x) {
	for (var i = 1; i < arguments.length; i++) {
		x.append(arguments[i]);
	}
}

function openText() {
	var page = open("getinput","_blank", "toolbar=yes,scrollbars=yes,resizable=yes,width=500,height=500");
}

function setPost(id, name, company, about, problem, input='No Input', shares=0, likes=0){
	$('.main').empty();
	extAppend($('.main'),extCreate('div','post'),extCreate('div','comments'));
	extAppend($('.post'),extCreate('div','user'),extCreate('div','details',about),extCreate('div','container'),extCreate('div','like'),extCreate('div','likes'));
	extAppend($('.user'),extCreate('img','image','','src','assets/images/challenges/'+id+'.id.jpg'),extCreate('div','info'));
	extAppend($('.user .info'),extCreate('b','',name),extCreate('span','middle',' created '),extCreate('span','company',company),extCreate('p','hour','2 hrs &#183;'));
	$('.hour').append(extCreate('img','','','src', 'assets/images/world.png'));
	extAppend($('.container'),extCreate('img','','','src','assets/images/challenges/'+id+'.jpg'),extCreate('div','info'));
	extAppend($('.container .info'),extCreate('p','big','Level '+id),extCreate('p','more',problem),extCreate('span','','Robotutor.Uz'),extCreate('a','button','Get Input', 'onclick', 'openText()'));
	extAppend($('.like'),extCreate('img','','','src','assets/images/like.png'),extCreate('span','likeCount',' '+likes),extCreate('span','commentCount', ' 1 Comment '+shares+' Shares'));
	extAppend($('.likes'),extCreate('div','thumb','','onclick','like()'),extCreate('div','comment',''),extCreate('div','share','','onclick', 'share()'));
	extAppend($('.thumb'), extCreate('img','','','src','assets/images/thumb.png'),extCreate('span','','Like'));
	extAppend($('.likes .comment'), extCreate('img','','','src','assets/images/comment.png'),extCreate('span','','Comment'));
	extAppend($('.share'), extCreate('img','','','src','assets/images/share.png'),extCreate('span','','Share'));
	extAppend($('.comments'),extCreate('div','comment'),extCreate('div','commented'));

	extAppend($('.comments .commented'), extCreate('img','image','','src', 'assets/images/user2.jpg'),extCreate('b', '', 'Azimjon'),extCreate('p', '', 'Type /help to the text box to learn more.'));
	$('.facebook').append('<aside/>');
}

function setAside1(id ,name){
	$('.facebook aside').empty();
	extAppend($('.facebook aside'),extCreate('div', 'list'),extCreate('div', 'lists'));
	extAppend($('aside .list'),extCreate('div', 'friends', 'Friend request sent'), extCreate('div', 'add'));
	$('.list .add').append(extCreate('div', 'friend'));
	extAppend($('.list .add .friend'), extCreate('img','image','','src','assets/images/challenges/'+id+'.id.jpg'),extCreate('div','info'));
	extAppend($('.list .add .friend .info'), extCreate('b','',name), extCreate('button', 'requestSent', 'Request Sent'));
	extAppend($('aside .lists'),extCreate('div', 'friends', 'People you may know'), extCreate('div', 'add'));
}

function setAside2(id, name){
	$('.lists .add').append(extCreate('div', 'friend'));
	extAppend($('.lists .add .friend').slice(-1)[0], extCreate('img','image','','src','assets/images/challenges/'+id+'.id.jpg'),extCreate('div','info'));
	extAppend($('.lists .add .friend .info').slice(-1)[0], extCreate('b','',name), extCreate('button', 'request'));
	extAppend($('.lists .add .friend .info .request').slice(-1)[0], extCreate('img','','','src','assets/images/addFriend.png'), extCreate('span','','Add friend'));
}