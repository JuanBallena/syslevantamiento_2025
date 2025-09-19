//************************ DEFINE_UBIGEO - TF_UBIGEO ******************

function define_institucion()
{
var nombre=document.getElementById("nombre");
var dep=document.getElementById("departamentos");
var pro=document.getElementById("provincias");
var dis=document.getElementById("distritos");
var sw=0;

if(nombre.value == '') {	sw=1;	alert('Ingrese el nombre de la Institución!');	nombre.focus();	return false;}
if(dep.value == 0){alert('Elija Departamento!'); sw=1; dep.focus(); return false;}
if(pro.value == 0){alert('Elija Provincia!');	sw=1;	pro.focus(); return false;}
if(dis.value == 0){alert('Elija Distrito!');	sw=1;	dis.focus(); return false;}	

if(sw==0)
{	
	document.institucion.action="procesos/grabar_ubigeo.php";
}
else return false;
			
}

//************************ DEFINE_HU - TF_HAB_URBANA ******************

function define_hu()
{
var codhu=document.getElementById("codhu");
var nomhu=document.getElementById("nomhu");
var tipohu=document.getElementById("cmb_tipohu");
var sw=0;

if(codhu.value == '') {	alert('Ingrese un Codigo');	sw=1;	codhu.focus();	return false;}
if(tipohu.value == '' || tipohu.value == 0){alert('Ingrese el Tipo Habilitacion Urbana!'); sw=1; tipohu.focus(); return false;}
if(nomhu.value == ''){alert('Ingrese el nombre de la Habilitacion Urbana!'); sw=1; nomhu.focus(); return false;}

//alert(cadena);
if(sw==1)
{	
	return false;
}
		
}

//************************ DEFINE_NOTARIA - TF_NOTARIAS ******************

function define_notaria()
{

var codnot=document.getElementById("codnot");
var nomnot=document.getElementById("nomnot");
var departamentos=document.getElementById("departamentos");
var provincias=document.getElementById("provincias");
var distritos=document.getElementById("distritos");

var sw=0;

if(codnot.value == '') {alert('Ingrese un Codigo');	sw=1;	codnot.focus();	return false;}
if(nomnot.value == ''){alert('Ingrese el nombre de la Habilitacion Urbana!'); sw=1; nomnot.focus(); return false;}
if(departamentos.value == '' || departamentos.value==0 ){alert('Elija depatamento!'); sw=1; departamentos.focus(); return false;}

//alert(cadena);
if(sw==1)
{	
	return false;
}
		
}

