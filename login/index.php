 <?php
require_once("../core/biblioteca.inc.php");
//define( "ROOT_ADDR", "https://".$_SERVER['SERVER_NAME']."/depeca/" );
arriba("privada", "", "es", "Zona Privada");

?>


<br />
<br />
<br />
<br />
<br />
  <form name="form1" method="post" action="./autentica.php" target="_parent">
    <table width="70%" border="3" align="center">
      <tr>
        <td><table width="50%" border="0" align="center">
            <tr> 
              <td height="41"> 
                  <p align="center"><font class='fuenteroja'><b>&nbsp;&nbsp;&nbsp;&nbsp;INTRODUCE TU USUARIO Y CONTRASE&Ntilde;A</b></font></p>
              </td>
            </tr>
            <tr> 
              <td height="37"><p><font class='fuenteazul' >&nbsp;&nbsp;&nbsp;&nbsp;Usuario:</font> 
                  <input name="user" type="text" />
                </p></td>
            </tr>
            <tr> 
              <td height="44"> <p>&nbsp;<font class='fuenteazul'>Password:</font> 
                  <input name="pass" type="password" />
                </p></td>
            </tr>
          </table></td>
      </tr>
    </table>
    <p align="center"> 
      <input type="submit" name="Submit" value="Login" />
    </p>
  </form>
  <p>&nbsp;</p>





<?php
abajo();
?>