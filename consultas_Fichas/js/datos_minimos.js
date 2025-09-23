// 	//---------------------------------------------------------- DATOS MINIMOS INDIVIDUAL ------------------------------
// 	function datos_minimos(valores)
// 	{

// 		valores.codSector = codSector;
// 		valores.codManzana = codManzana;
// 		valores.codLote = codLote;
// 		valores.codEdifica = codEdifica;
// 		valores.codEntrada = codEntrada;
// 		valores.codPiso = codPiso;
// 		valores.codUnidad = codUnidad;
// 		valores.idEstado = idEstado;
// 		valores.urbanAuthorizationName = urbanAuthorizationName;
// 		valores.grupoHU = grupoHU;
// 		valores.nroEtapa = nroEtapa;
// 		valores.mznaDist = mznaDist;
// 		valores.loteDist = loteDist;
// 		valores.useAuthorizationName = useAuthorizationName;
// 		valores.nroPiso = nroPiso;
// 		valores.codWallandColumns = codWallandColumns;
// 		valores.codCeiling = codCeiling;
// 		valores.codFloors = codFloors;
// 		valores.codDoorandWindow = codDoorandWindow;
// 		valores.codMaterial = codMaterial;
// 		valores.fechaTecnico = fechaTecnico;

// 		/*******************************validaciones ***********************************/
//         /********************* Datos Generales **************************/
//         if(codSector.value == '' || codSector.value.length<2 || (codSector.value == 0))
// 			{ alert('Ingrese codigo de Sector! - 2 digitos diferentes de cero');		sw=1;	codSector.focus();	return;}
// 		if(codManzana.value == '' || codManzana.value.length<3 || (codManzana.value == 0))
// 			{ alert('Ingrese codigo de Manzana! - 3 digitos diferentes de cero'); 		sw=1;	codManzana.focus();	return;}
// 		if(codLote.value == '' || codLote.value.length<3 || (codLote.value == 0))
// 			{ alert('Ingrese codigo de Lote! - 3 digitos diferentes de cero');			sw=1;	codLote.focus();	return;}
// 		if(codEdifica.value == '' || codEdifica.value.length<2 || (codEdifica.value == 0))
// 			{ alert('Ingrese codigo de Edificacion! - 2 digitos diferentes de cero');	sw=1;	codEdifica.focus();	return;}
// 		if(codEntrada.value == '' || codEntrada.value.length<2 || (codEntrada.value == 0))
// 			{ alert('Ingrese codigo de Entrada! - 2 digitos diferentes de cero');		sw=1;	valores.codEntrada.focus();	return;}
// 		if(codPiso.value == '' || codPiso.value.length<2 || (codPiso.value== 0))
// 			{ alert('Ingrese codigo de Piso! - 2 digitos diferentes de cero');			sw=1;	codPiso.focus();	return;}
// 		if(codUnidad.value == '' || codUnidad.value.length<3 || (codUnidad.value == 0))
// 			{ alert('Ingrese codigo de Unidad! - 3 digitos diferentes de cero');		sw=1;	codUnidad.focus();	return;}

//         /************************* Ubicacion del Predio *************************/
//         if(idEstado.value == '' || idEstado.value == 0)
// 		{	alert('Elija un Tipo de estado');					sw=1;	idEstado.focus();	return;	}
// 		if(urbanAuthorizationName.value == '' )
// 		{	alert('Elija el Nombre de la Habilitacion');		sw=1;	urbanAuthorizationName.focus();	return;	}
//         if(grupoHU.value == '' || grupoHU.value == 0)
// 		{	alert('Elija un Grupo de Habilitacion');			sw=1;	grupoHU.focus();	return;	}
//         if(mznaDist.value == '' || mznaDist.value == 0)
// 		{	alert('Ingrese una manzana');						sw=1;	mznaDist.focus();	return;	}
//         if(loteDist.value == '' || loteDist.value == 0)
// 		{	alert('Ingrese un lote');							sw=1;	loteDist.focus();	return;	}

//         /***************************** Descripcion del predio ***********************/
//         if(useAuthorizationName.value == '')
// 		{	alert('Elija el uso para el predio!');					sw=1;	useAuthorizationName.focus();	return;	}
// 		if(useReferencial.value == '' || useReferencial.value == 0)
// 		{	alert('Ingrese una Referencial Uso');						sw=1;	useReferencial.focus();	return;	}

//         /******************************* Construcciones ***************************/
//         if(nroPiso.value == '' || nroPiso.value == 0)
// 		{	alert('Elija un Nùmero de Piso');							sw=1;	nroPiso.focus();	return;	}
//         if(codWallandColumns.value == '' || codWallandColumns.value == 0)
// 		{	alert('Elija un Tipo de categoria para Muros y Columnas');	sw=1;	codWallandColumns.focus();	return;	}
//         if(codCeiling.value == '' || codCeiling.value == 0)
// 		{	alert('Elija un Tipo de categoria para Techos');			sw=1;	codCeiling.focus();	return;	}
//         if(codFloors.value == '' || codFloors.value == 0)
// 		{	alert('Elija un Tipo de categoria para Pisos');				sw=1;	codFloors.focus();	return;	}
//         if(codDoorandWindow.value == '' || codDoorandWindow.value == 0)
// 		{	alert('Elija un Tipo de categoria para Puertas y Ventanas');sw=1;	codDoorandWindow.focus();	return;	}
//         if(codMaterial.value == '' || codMaterial.value == 0)
// 		{	alert('Elija un Tipo de material');							sw=1;	codMaterial.focus();	return;	}

//         /***************************** Informacion Complementaria *************************** */
//         /*(cantMed.value == '' || cantMed.value == 0)
// 		{	alert('Elija la cantidad de medidores');					sw=1;	cantMed.focus();	return false;	}*/
// 		/**************************** Datos tecnicos  *********************************************/
// 		if(fechaTecnico.value == '')
// 		{	alert('Elija la Fecha de Levantamiento');					sw=1;	fechaTecnico.focus();	return;	}

// 		//**********************************************************************************************************

// }
