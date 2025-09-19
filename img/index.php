<HTML>
   <HEAD>
      <TITLE>pgtest</TITLE>
   </HEAD>
   <BODY>

   <?php

   /* ********************* */
   /* Conexion a PostgreSQL */
   /* ********************* */

   /* Conexion a la base de datos */
   //$conexion = pg_connect(" host='localhost' dbname='postgres' port='5432' user='postgres' password='postgres' ");
$conexion = mysql_connect(" host='localhost' dbname='postgres' port='5432' user='postgres' password='postgres' ");
   if (!$conexion) {
        echo "<CENTER>
              Problemas de conexion con la base de datos.
              </CENTER>";
        exit;
   }

   $sql="SELECT * FROM usuarios ORDER BY user;";


   /* Ejecuta y almacena el resultado de la orden 
      SQL en $resultado_set */
   $resultado_set = mysql_exec ($conexion, $sql);
   $filas = mysql_numrows($resultado_set);


   /* Presenta la informacion almacenada en $resultado_set */
   for ($j=0; $j < $filas; $j++) {

   echo "Direccion: ".pg_result($resultado_set, $j, 0)." <BR>
         Ciudad: ".pg_result($resultado_set, $j, 1)." <BR>
         Pais: ".pg_result($resultado_set, $j, 2)." <P>";
   }


   /* Cierra la conexion con la base de datos */
   pg_close($conexion);

   ?>

   </BODY>
  </HTML>