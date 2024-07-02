<?php
// index_new.php

require_once("../core/biblioteca.inc.new.php");

//arriba("privada", "", "es", "Zona Privada");

?>

<br />
<br />
<br />
<br />
<br />
<form name="form1" method="post" action="./autentica_new.php" target="_parent">
  <table width="70%" border="3" align="center">
    <tr>
      <td>
        <table width="50%" border="0" align="center">
          <tr>
            <td height="41">
              <p align="center"><span class='fuenteroja'><b>&nbsp;&nbsp;&nbsp;&nbsp;INTRODUCE TU USUARIO Y CONTRASEÑA</b></span></p>
            </td>
          </tr>
          <tr>
            <td height="37">
              <p><span class='fuenteazul'>&nbsp;&nbsp;&nbsp;&nbsp;Usuario:</span>
                <input name="user" type="text" />
              </p>
            </td>
          </tr>
          <tr>
            <td height="44">
              <p>&nbsp;<span class='fuenteazul'>Password:</span>
                <input name="pass" type="password" />
              </p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <p align="center">
    <input type="submit" name="Submit" value="Login" />
  </p>
</form>
<p>&nbsp;</p>

<?php
//abajo();
?>
