<?php
$usuarioactivo = S_SESSION['usuario'] ;
if($usuarioactivo = "null")
	echo "<html></html>"
else
	echo "<html>.$usuarioactivo./html>"
?>