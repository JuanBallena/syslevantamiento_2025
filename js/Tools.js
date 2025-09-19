<!--Begin fncWinpopup

function fncWinpopup(mypage, myname, w, h, scroll) 
{

var winl = (screen.width - w) / 2;
var wint = (screen.height - h) / 2;
	winprops = 'height='+h+',width='+w+',top='+wint+',left='+winl+',scrollbars='+scroll+',resizable=no'
	win = window.open(mypage, myname, winprops)	
	if (parseInt(navigator.appVersion) >= 4) { win.window.focus(); }	
}

//  End -->

<!--Begin fncWinpopup

function fncImprimir()
{
	print(document)
}
//  End -->

<!-- Begin Email Validation

function fncEmailCheck (emailStr) {

/* The following variable tells the rest of the function whether or not
to verify that the address ends in a two-letter country or well-known
TLD.  1 means check it, 0 means don't. */

var checkTLD=1;

/* The following is the list of known TLDs that an e-mail address must end with. */

var knownDomsPat=/^(com|net|org|edu|int|mil|gov|arpa|biz|aero|name|coop|info|pro|museum)$/;

/* The following pattern is used to check if the entered e-mail address
fits the user@domain format.  It also is used to separate the username
from the domain. */

var emailPat=/^(.+)@(.+)$/;

/* The following string represents the pattern for matching all special
characters.  We don't want to allow special characters in the address. 
These characters include ( ) < > @ , ; : \ " . [ ] */

var specialChars="\\(\\)><@,;:\\\\\\\"\\.\\[\\]";

/* The following string represents the range of characters allowed in a 
username or domainname.  It really states which chars aren't allowed.*/

var validChars="\[^\\s" + specialChars + "\]";

/* The following pattern applies if the "user" is a quoted string (in
which case, there are no rules about which characters are allowed
and which aren't; anything goes).  E.g. "jiminy cricket"@disney.com
is a legal e-mail address. */

var quotedUser="(\"[^\"]*\")";

/* The following pattern applies for domains that are IP addresses,
rather than symbolic names.  E.g. joe@[123.124.233.4] is a legal
e-mail address. NOTE: The square brackets are required. */

var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/;

/* The following string represents an atom (basically a series of non-special characters.) */

var atom=validChars + '+';

/* The following string represents one word in the typical username.
For example, in john.doe@somewhere.com, john and doe are words.
Basically, a word is either an atom or quoted string. */

var word="(" + atom + "|" + quotedUser + ")";

// The following pattern describes the structure of the user

var userPat=new RegExp("^" + word + "(\\." + word + ")*$");

/* The following pattern describes the structure of a normal symbolic
domain, as opposed to ipDomainPat, shown above. */

var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$");

/* Finally, let's start trying to figure out if the supplied address is valid. */

/* Begin with the coarse pattern to simply break up user@domain into
different pieces that are easy to analyze. */

var matchArray=emailStr.match(emailPat);

if (matchArray==null) {

/* Too many/few @'s or something; basically, this address doesn't
even fit the general mould of a valid e-mail address. */

alert("Direcci�n de email incorrecta (revise '@' y '.')");
return false;
}
var user=matchArray[1];
var domain=matchArray[2];

// Start by checking that only basic ASCII characters are in the strings (0-127).

for (i=0; i<user.length; i++) {
if (user.charCodeAt(i)>127) {
alert("El nombre de usuario contenie caracteres no v�lidos");
return false;
   }
}
for (i=0; i<domain.length; i++) {
if (domain.charCodeAt(i)>127) {
alert("El nombre de dominio contiene caracteres no v�lidos");
return false;
   }
}

// See if "user" is valid 

if (user.match(userPat)==null) {

// user is not valid

alert("El nombre de usuario parace ser incorrecto");
return false;
}

/* if the e-mail address is at an IP address (as opposed to a symbolic
host name) make sure the IP address is valid. */

var IPArray=domain.match(ipDomainPat);
if (IPArray!=null) {

// this is an IP address

for (var i=1;i<=4;i++) {
if (IPArray[i]>255) {
alert("El IP de destino no es v�lido!");
return false;
   }
}
return true;
}

// Domain is symbolic name.  Check if it's valid.
 
var atomPat=new RegExp("^" + atom + "$");
var domArr=domain.split(".");
var len=domArr.length;
for (i=0;i<len;i++) {
if (domArr[i].search(atomPat)==-1) {
alert("El nombre del dominio es incorrecto");
return false;
   }
}

/* domain name seems valid, but now make sure that it ends in a
known top-level domain (like com, edu, gov) or a two-letter word,
representing country (uk, nl), and that there's a hostname preceding 
the domain or country. */

if (checkTLD && domArr[domArr.length-1].length!=2 && 
domArr[domArr.length-1].search(knownDomsPat)==-1) {
alert("La direcci�n debe finalizar en un dominio correcto o las dos letras del pais.");
return false;
}

// Make sure there's a host name preceding the domain.

if (len<2) {
alert("This address is missing a hostname!");
return false;
}

// If we've gotten this far, everything's valid!
return true;
}

//  End -->


function fncSalir()
{
	w_msg="�Esta Ud. seguro de salir del Sistema?";
	if (confirm(w_msg))
	{
	location.href = "selLoginUM.asp?pLogout=1";
	}
}


<!-- Manejo del Men� -->
			isIE=document.all;
			isNN=!document.all&&document.getElementById;
			isN4=document.layers;
			isHot=false;
			
			function ddInit(e){
			  topDog=isIE ? "BODY" : "HTML";
			  whichDog=isIE ? document.all.theLayer : document.getElementById("theLayer");  
			  hotDog=isIE ? event.srcElement : e.target;  
			  while (hotDog.id!="titleBar"&&hotDog.tagName!=topDog){
			    hotDog=isIE ? hotDog.parentElement : hotDog.parentNode;
			  }  
			  if (hotDog.id=="titleBar"){
			    offsetx=isIE ? event.clientX : e.clientX;
			    offsety=isIE ? event.clientY : e.clientY;
			    nowX=parseInt(whichDog.style.left);
			    nowY=parseInt(whichDog.style.top);
			    ddEnabled=true;
			    document.onmousemove=dd;
			  }
			}
			
			function dd(e){
			  if (!ddEnabled) return;
			  whichDog.style.left=isIE ? nowX+event.clientX-offsetx : nowX+e.clientX-offsetx; 
			  whichDog.style.top=isIE ? nowY+event.clientY-offsety : nowY+e.clientY-offsety;
			  return false;  
			}
			
			function ddN4(whatDog){
			  if (!isN4) return;
			  N4=eval(whatDog);
			  N4.captureEvents(Event.MOUSEDOWN|Event.MOUSEUP);
			  N4.onmousedown=function(e){
			    N4.captureEvents(Event.MOUSEMOVE);
			    N4x=e.x;
			    N4y=e.y;
			  }
			  N4.onmousemove=function(e){
			    if (isHot){
			      N4.moveBy(e.x-N4x,e.y-N4y);
			      return false;
			    }
			  }
			  N4.onmouseup=function(){
			    N4.releaseEvents(Event.MOUSEMOVE);
			  }
			}
			
			function hideMe(){
			  if (isIE||isNN) whichDog.style.visibility="hidden";
			  else if (isN4) document.theLayer.visibility="hide";
			}
			
			function showMe(){
			  if (isIE||isNN) whichDog.style.visibility="visible";
			  else if (isN4) document.theLayer.visibility="show";
			}
			
			document.onmousedown=ddInit;
			document.onmouseup=Function("ddEnabled=false");			
