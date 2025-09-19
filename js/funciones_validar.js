function validar_numeros(e) { 
    e= (window.event)? event : e;
	tecla= (e.keyCode)? e.keyCode: e.which;
	if (tecla==8 || tecla==9 || tecla==16 || (tecla>=35 && tecla<=40) || tecla==46) return true; 
	patron =/[0-9]/;
	te = String.fromCharCode(tecla);
    return patron.test(te); 
} 

function validar_numeros_coma(e) { 
    e= (window.event)? event : e;
	tecla= (e.keyCode)? e.keyCode: e.which;
	 if (tecla==8 || tecla==9 || tecla==16 || (tecla>=35 && tecla<=40) || tecla==46) return true; 
	patron =/[0-9, ]/;
	te = String.fromCharCode(tecla);
    return patron.test(te); 
} 

function validar_fecha(e) { 
    tecla = (document.all) ? e.keyCode : e.which; 
     if (tecla==8 || tecla==9 || tecla==16 || (tecla>=35 && tecla<=40) || tecla==46) return true; 
		//patron =/\d/; 
		patron = /[0-9\/]/i;
		te = String.fromCharCode(tecla); 
		return patron.test(te); 
} 

// VALIDAR SOLO LETRAS
function letras(e) { 
    e= (window.event)? event : e;
	tecla= (e.keyCode)? e.keyCode: e.which;
     if (tecla==8 || tecla==9 || tecla==16 || tecla==32 || (tecla>=35 && tecla<=40) || tecla==46) return true; 
	      patron =/^[a-zA-Z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+$/; 
	//patron =/[A-Za-zñÑ\s\á,é,í,ó,ú]/; 
    te = String.fromCharCode(tecla); 
    return patron.test(te); 
} 

// VALIDAR INGRESO DE CARACTERES ALFANUMERICOS
function validar_alfanumerico(e) { 
    e= (window.event)? event : e;
  tecla= (e.keyCode)? e.keyCode: e.which;
     if (tecla==8 || tecla==9 || tecla==16 || tecla==32 || (tecla>=35 && tecla<=40) || tecla==46) return true; 
        patron =/^[a-zA-Z0-9/\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+$/; 
  //patron =/[A-Za-zñÑ\s\á,é,í,ó,ú]/; 
    te = String.fromCharCode(tecla); 
    return patron.test(te); 
}

// VALIDAR TECLA ENTER EN LA PANTALLA DE LOGEO
function pulsar_enter(e)
{
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)
  {
  	if(form_acceso.txtclave.value.length <= 15)  // aquí el código que quieras ejecutar
	{
	  form_acceso.btaceptar.focus();
	  return (false);
    }
  }
}

// VALIDAR TODO LETRA MINUSCULAS
function validar_minus(solicitar){
  var index;
  var tmpStr;
  var tmpChar;
  var preString;
  var postString;
  var strlen;
  tmpStr = solicitar.value.toLowerCase();
  strLen = tmpStr.length;
  if (tecla==8 || tecla==9 || tecla==16 || (tecla>=35 && tecla<=40) || tecla==46) return true; 
  if (strLen > 0)
  {
    for (index = 0; index < strLen; index++)
    {
      if (index == 0)
      {
        tmpChar = tmpStr.substring(0,1).toLowerCase();
        postString = tmpStr.substring(1,strLen);
        tmpStr = tmpChar + postString;
      }
      else
      {
        tmpChar = tmpStr.substring(index, index+1);
        if (tmpChar == " " && index < (strLen-1))
        {
          tmpChar = tmpStr.substring(index+1, index+2).toLowerCase();
          preString = tmpStr.substring(0, index+1);
          postString = tmpStr.substring(index+2,strLen);
          tmpStr = preString + tmpChar + postString;
        }
      }
    }
  }
  solicitar.value = tmpStr;
}


// VALIDAR PRIMERA LETRA MAYUSCULA 
function validar_mayus(solicitar){
var index;
var tmpStr;
var tmpChar;
var preString;
var postString;
var strlen;
tmpStr = solicitar.value.toLowerCase();
strLen = tmpStr.length;
if (strLen > 0)
{
for (index = 0; index < strLen; index++)
{
if (index == 0)
{
tmpChar = tmpStr.substring(0,1).toUpperCase();
postString = tmpStr.substring(1,strLen);
tmpStr = tmpChar + postString;
}
else
{
tmpChar = tmpStr.substring(index, index+1);
if (tmpChar == " " && index < (strLen-1))
{
tmpChar = tmpStr.substring(index+1, index+2).toUpperCase();
preString = tmpStr.substring(0, index+1);
postString = tmpStr.substring(index+2,strLen);
tmpStr = preString + tmpChar + postString;
}
}
}
}
solicitar.value = tmpStr;
}


// VALIDAR TODO LETRA MAYUSCULAS
function validar_todo_mayus(solicitar){
var index;
var tmpStr;
var tmpChar;
var preString;
var postString;
var strlen;
tmpStr = solicitar.value.toUpperCase();
strLen = tmpStr.length;
if (strLen > 0)
{
for (index = 0; index < strLen; index++)
{
if (index == 0)
{
tmpChar = tmpStr.substring(0,1).toUpperCase();
postString = tmpStr.substring(1,strLen);
tmpStr = tmpChar + postString;
}
else
{
tmpChar = tmpStr.substring(index, index+1);
if (tmpChar == " " && index < (strLen-1))
{
tmpChar = tmpStr.substring(index+1, index+2).toUpperCase();
preString = tmpStr.substring(0, index+1);
postString = tmpStr.substring(index+2,strLen);
tmpStr = preString + tmpChar + postString;
}
}
}
}
solicitar.value = tmpStr;
}


//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& LLENAR CEROS %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
function rellenar_2(quien,que){
cadcero='';
for(i=0;i<(2-que.length);i++){
cadcero+='0';
}
quien.value=cadcero+que;
}

function rellenar_3(quien,que){
cadcero='';
for(i=0;i<(3-que.length);i++){
cadcero+='0';
}
quien.value=cadcero+que;
}

function rellenar_4(quien,que){
cadcero='';
for(i=0;i<(4-que.length);i++){
cadcero+='0';
}
quien.value=cadcero+que;
}

function rellenar_6(quien,que){
cadcero='';
for(i=0;i<(6-que.length);i++){
cadcero+='0';
}
quien.value=cadcero+que;
}

function rellenar_7(quien,que){
cadcero='';
for(i=0;i<(7-que.length);i++){
cadcero+='0';
}
quien.value=cadcero+que;
}

function rellenar_ceros(cadena,limite){
  TAMANO_CADENA = cadena.length;
  //alert("TAMANO DE CADENA ES: "+TAMANO_CADENA);

  for (i = 0; i < (limite-TAMANO_CADENA); i++) {
    cadena = '0' + cadena;
  }

  return cadena;
}

function rellenar_campo(e,limite){
  e.value = rellenar_ceros(e.value,limite);
}

//----------------------------------------------------------------------

function EmailCheck (emailStr) {

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

alert("Dirección de email incorrecta (revise '@' y '.')");
return false;
}
var user=matchArray[1];
var domain=matchArray[2];

// Start by checking that only basic ASCII characters are in the strings (0-127).

for (i=0; i<user.length; i++) {
if (user.charCodeAt(i)>127) {
alert("El nombre de usuario contenie caracteres no válidos");
return false;
   }
}
for (i=0; i<domain.length; i++) {
if (domain.charCodeAt(i)>127) {
alert("El nombre de dominio contiene caracteres no válidos");
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
alert("El IP de destino no es válido!");
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
alert("La dirección debe finalizar en un dominio correcto o las dos letras del pais.");
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