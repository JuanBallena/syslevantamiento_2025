<?php 

function mostrar_administrador($i)
{
	switch($i)
	{
		case 1:	?> 
				<!-- MODULO REGISTRO DE USUARIOS -->
				<li><a href="javascript:cambiar('funciones/registrar_usuario')" target='_self'>Registrar nuevo usuario</a></li>
				<li><a href="javascript:cambiar('funciones/administra_usuario')" target='_self'>Control de nuevos usuarios</a></li>
				<?php
				break;
		case 2: ?>
				<!-- MODULO DE MANTENIMINETO -->
				<li class='accessible'><a href='#' class='accessible'>Mantenimiento  &raquo;</a>
					<ul>
						<li><a href="javascript:cambiar('mantenimiento/add_hu')" target='_self'>Habilitaciones Urbanas</a></li>
						<li><a href="javascript:cambiar('mantenimiento/add_notaria')" target='_self'>Notarias</a></li>
						<li><a href="javascript:cambiar('mantenimiento/add_persona')" target='_self'>Personal</a></li>
						<li><a href="javascript:cambiar('mantenimiento/add_sector')" target='_self'>Sectores</a></li>
						<!--
						<li><a href="javascript:cambiar('mantenimiento/add_codigo')" target='_self'>Tabla C&oacute;digos</a></li>
						<li><a href="javascript:cambiar('mantenimiento/add_uso')" target='_self'>Usos</a></li>
						<li><a href="javascript:cambiar('mantenimiento/add_usobc')" target='_self'>Usos BC</a></li> 
						-->
						<li><a href="javascript:cambiar('mantenimiento/add_via')" target='_self'>V&iacute;as</a></li>
					</ul>
				<?php
				break;
		case 3:	?>
				<!-- MODULO DE REPORTES 
				<li><a href="javascript:cambiar('reportes/reporteadmin')" target='_self'>Reporte Administrador</a></li>-->
				<?php
				break;
	}
}

?>