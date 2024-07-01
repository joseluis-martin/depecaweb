<?php
require_once("../core/biblioteca.inc.php");
include("../core/conexion.inc.php"); //Conexión con la base de datos
arriba("privada", "", "es", "Zona Privada");

session_start();

$user=$_POST['user'];
$pass=$_POST['pass'];


$login=$user; //user
$password=$pass; //password
//$imap_server_address="euler.depeca.uah.es"; //euler server
$imap_server_address="localhost"; //euler server a traves del stunnel seguro P. Revenga
$imap_port=143; //port

//descriptor
$imap_stream = @fsockopen ( $imap_server_address, $imap_port, $error_number, $error_string, 15);
if (!$imap_stream)
 {
  echo "Could not start imap connection";
 }
$server_info = fgets ($imap_stream, 1024);

//conection identifier
$prefixquery= uniqid("aa");
$query = $prefixquery." LOGIN ".$login." ".$password." \r\n" ;

fputs ($imap_stream,$query);
$read=fgets($imap_stream,4096);
$results=explode(" ",$read);

//check user
if (($results[0]==$prefixquery)&& (strcasecmp($results[1], "OK") == 0) &&(strcasecmp($results[2], "login")==0))
{

  $user2=$user."@depeca.uah.es";

  //echo"correo: $user2 \n";
  $link= Conectarse();
  
  //$sql = "SELECT * FROM personal WHERE email LIKE '$user2'";

  $sql = "SELECT * FROM personal";
  
  $result = mysql_query($sql, $link);
  
  $usuarioEncontrado = false;
  if ($row = mysql_fetch_array($result)){

    do {
	$email = strtolower($row["email"]);
	

      $puesto = $row["puesto"];
      $usuario_bd=$row["usuario"]; 
     
      //niveles asignados a los usuarios
      if ($usuario_bd==$user) {
	if (($puesto == "Director") || ($user=="revenga") || ($user=="mocana") ||  ($user=="dori")|| ($user=="esteban")|| ($user=="jlmartin")) {
	  $nivel = 0;	  	  
	}elseif ($puesto == "PAS") {
	  $nivel = 1;	  
	}else {
	  $nivel = 2;	  
	}
	$usuarioEncontrado=true;
      }else{
	//asignacion de nivel a los webmasters
	  if(($user=="director") || ($user=="subdirector") || ($user=="secretario")) {
	   $nivel = 0;
	   $usuarioEncontrado=true;
	}else{
	  //nivel = -1 identifica a los usuarios sin privilegios
	  $nivel = -1;
	}  
      }
  } while (($row = mysql_fetch_array($result)) && ($usuarioEncontrado==false));
    
  }
  

   if( $nivel != -1){
      //header("Location: " . ROOT_ADDR  . "/privada/inicio/index.php?usuario=$user&nivel=$nivel");
      header("Location: " . ROOT_ADDR  . "login/seleccion.php?usuario=$user&nivel=$nivel");
  }
  else{
      header("Location: " . ROOT_ADDR);
  } 
  
  
   //echo "<h1>nivel:". $nivel ." \n</h1>";
   //echo "<h1>encontrado? ". $usuarioEncontrado ."</h1>";
  
  
  echo"<br /> \n";
  echo"<br /> \n";
  echo"<br /> \n";
  echo"<br /> \n";
  echo"<br /> \n";
  echo"<table width='70%' border='1' align='center'> \n";
  echo"  <tr> \n";
  echo" <td><table width='100%' border='0' align='center'> \n";
  echo" <tr>  \n";
  echo"  <td height='41'> <div align='center'>  \n";
  echo"    <p><font size='2' face='Arial' color='#CC6900'><b>USUARIO Y CONTRASE&Ntilde;A CORRECTOS</b></font></p> \n";
  echo" </div></td> \n";
  echo" </tr> \n";
  echo"<tr>  \n";
  echo"<td height='37' align='center'><font size='2' face='Arial' color='#0073B4'><a style='text-decoration:none' href='../privada/inicio/index.php?usuario=$user&nivel=$nivel'>ENTRAR</a></font>  \n";
  echo" </td> \n";
  echo"</tr> \n";
  echo"</table></td> \n";
  echo"</tr> \n";
  echo"</table> \n";
  
  abajo();
  
 $_SESSION['user']=$user;
// $_SESSION['pass']=$pass;

//testingi
  
echo $user." <br> ";
}else{

 header("Location: " . ROOT_ADDR . "/login/index.php");
  
  echo"<br /> \n";
  echo"<br /> \n";
  echo"<br /> \n";
  echo"<br /> \n";
  echo"<br /> \n";
  echo"<table width='70%' border='1' align='center'> \n";
  echo"  <tr> \n";
  echo" <td><table width='100%' border='0' align='center'> \n";
  echo" <tr>  \n";
  echo"  <td height='41'> <div align='center'>  \n";
  echo"    <p><font size='2' face='Arial' color='#CC6900'><b>USUARIO Y CONTRASE&Ntilde;A INCORRECTOS</b></font></p> \n";
  echo" </div></td> \n";
  echo" </tr> \n";
  echo"<tr>  \n";
  echo"<td height='37' align='center'><font size='2' face='Arial' color='#0073B4'><a style='text-decoration:none' href='./index.php'>VOLVER</a></font>  \n";
  
  echo" </td> \n";
  echo"</tr> \n"; 
  echo"</table></td> \n";
  echo"</tr> \n";
  echo"</table> \n";
    
  abajo();
}




//logout to the imap server
$query = $prefixquery."2 LOGOUT \r\n" ;
fputs ($imap_stream,$query);
$read=fgets($imap_stream,4096);
fclose($imap_stream);
?>

