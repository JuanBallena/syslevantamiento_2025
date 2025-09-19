<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Login</title>
    <link href="css/botones.css" rel="stylesheet" type="text/css">
  </head>
  <!--<div id="login" height="100%" align="center">-->
  <div height="100%" align="center">
    <body>
      <br />
      <p>
        <form action="valida/valida.php"  method="post" style="text-align:center">
          <div id="lblUser" align="center"></div> 
          <table width="27%" border="0" align="center">
            <tr>
              <td width="24%">Usuario    &nbsp;&nbsp;   :</td>
              <td width="76%"><input  name="login" type="text" size="22" align="center" value="admin"/></td>
            </tr>
            <tr>
              <td>Password :</td>
              <td><input  name="password" type="password" size="22" align="center" value="123"/></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input type="Submit" class="booton" name="btnIngresar" value="Ingresar" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>
        </form>
      </p>
    </body>
  </div>
</html>
