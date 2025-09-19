<?php include 'configuracion/desabilitar.php'; ?>

<script type="text/javascript">
  <!--
  var platform = window.navigator.platform
  var appVersion = window.navigator.appVersion
  var appCodeName = window.navigator.appCodeName
  var userAgent = window.navigator.userAgent
  var browser=navigator.appName; 
  
  if(browser!='Microsoft Internet Explorer') alert("Te recomendamos utilizar Internet Explorer 8.0 ");
  /*document.write("platform: " + platform + "<br />")
  document.write("appVersion: " + appVersion + "<br />")
  document.write("appCodeName: " + appCodeName + "<br />")
  document.write("userAgent: " + userAgent + "<br />")*/
  // -->
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Inicio</title>
  </head>

  <frameset rows="80,*,40" frameborder="no" border="0" framespacing="0">
    <frame src="superior.html" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" title="topFrame" />
    <frame src="login.php" name="mainFrame" scrolling="No" id="mainFrame" title="mainFrame" width="100%" height="100%" />
    <frame src="footer.html" name="footFrame" id="footFrame" title="footFrame"  width="100%" height="50%"/>
  </frameset>
  <noframes>
    <body></body>
  </noframes>
</html>
