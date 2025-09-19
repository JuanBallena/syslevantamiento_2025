<?php

session_start();

session_destroy();
echo "<meta http-equiv='refresh' content='1;url=http://".$_SERVER['HTTP_HOST']."/syslevantamiento/inicio.php'/>";
