<?php

define( "ROOT_ADDR", "/depeca/" );
define( "ROOT_ADDRsin", "/depeca" );
define( "ROOT_ADDRchange", "/" );
define( "CORE_ADDR", ROOT_ADDR . "core/" );
define( "CSS_ADDR", ROOT_ADDR . "css/" );
define( "IMG_ADDR", ROOT_ADDR . "img/" );
define( "DOC_ABS_RAIZ","/srv/www/htdocs");

$idioma="en";
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function calculo_curso(){
$anio2=date("Y");
$mes=date("m");
$dia=date("d");
$link=Conectarse();
if ($mes>=7)
{
    $anio3=$anio2."/".($anio2+1);
}
else
{
    $anio3=($anio2-1)."/".($anio2);
}
$sql_fecha="SELECT * FROM curso_academico WHERE curso='$anio3'";
$resul_fecha=mysql_query($sql_fecha,$link);
$row_fecha=mysql_fetch_array($resul_fecha);
$fecha_cambio=explode("-",$row_fecha['inicio']);

if ($mes>$fecha_cambio[1])
{
   $aniop=$anio2."/".($anio2+1);
}
else
{
    if($mes==$fecha_cambio[1])
    {
	if($dia>=$fecha_cambio[0])
	{
	    $aniop=$anio2."/".($anio2+1);
	}
	else
	{
	      $aniop=($anio2-1)."/".$anio2;
	}
    }
    else
    {
	$aniop=($anio2-1)."/".$anio2;
    }
}
return $aniop;
}

function saludo($mayuscula){ //1 para tener mayuscula

if ($mayuscula == 1) {
	$saludo = "B";
}
else{
	$saludo = "b";
}

$hora = date("G");

if (($hora >= 6) && ($hora <= 12)){
$saludo .= "uenos dias";
}
elseif (($hora >= 13) && ($hora <= 19)){
$saludo .= "uenas tardes";
}
else{
  $saludo .= "uenas noches";
}
return $saludo;
} 

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


function cambiaf_a_normal($fecha){ 
    ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha); 
    $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1]; 
    return $lafecha; 
} 

function cambiaf_a_mysql($fecha){ 
    ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha); 
    $lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1]; 
    return $lafecha; 
} 

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

//forma: Martes, 13 de junio de 2006

function fecha($idiomafecha){

if ($idiomafecha == "es"){

// en Castellano

$fecha = "";

switch (date("w"))
{
	case "0" : $fecha .= "Domingo";
			 break;
	case "1" : $fecha .= "Lunes";
			 break;
	case "2" : $fecha .= "Martes";
			 break;
	case "3" : $fecha .= "Mi&eacute;rcoles";
			 break;
	case "4" : $fecha .= "Jueves";
			 break;
	case "5" : $fecha .= "Viernes";
			 break;
	default: $fecha .= "S&aacute;bado";
}

$fecha .= ", " . date("j") . " de ";

	switch (date("n"))
	{
	case "1" : $fecha .= "enero";
			 break;
	case "2" : $fecha .= "febrero";
			 break;
	case "3" : $fecha .= "marzo";
			 break;
	case "4" : $fecha .= "abril";
			 break;
	case "5" : $fecha .= "mayo";
			 break;
	case "6" : $fecha .= "junio";
			 break;
	case "7" : $fecha .= "julio";
			 break;
	case "8" : $fecha .= "agosto";
			 break;
	case "9" : $fecha .= "septiembre";
			 break;
	case "10" : $fecha .= "octubre";
			 break;
	case "11" : $fecha .= "noviembre";
			 break;
	default: $fecha .= "diciembre";
	}
	$fecha .= " de " . date ("Y") . ".";

}


else {

// en Ingles

switch (date("w"))
{
	case "0" : $fecha .= "Sunday";
			 break;
	case "1" : $fecha .= "Monday";
			 break;
	case "2" : $fecha .= "Tuesday";
			 break;
	case "3" : $fecha .= "Wednesday";
			 break;
	case "4" : $fecha .= "Thursday";
			 break;
	case "5" : $fecha .= "Friday";
			 break;
	default: $fecha .= "Saturday";
}

$fecha .= ", the " . date("j") . "<span class=\"superindice\">";
if ((date("j") == "1") || (date("j") == "21") ||  (date("j") == "31") ){
$fecha .= "st";
}
elseif ((date("j") == "2") || (date("j") == "22")){
$fecha .= "nd";
}
else{
$fecha .= "th";
}

$fecha .= "</span> of ";

	switch (date("n"))
	{
	case "1" : $fecha .= "January";
			 break;
	case "2" : $fecha .= "February";
			 break;
	case "3" : $fecha .= "March";
			 break;
	case "4" : $fecha .= "April";
			 break;
	case "5" : $fecha .= "May";
			 break;
	case "6" : $fecha .= "June";
			 break;
	case "7" : $fecha .= "July";
			 break;
	case "8" : $fecha .= "August";
			 break;
	case "9" : $fecha .= "September";
			 break;
	case "10" : $fecha .= "October";
			 break;
	case "11" : $fecha .= "November";
			 break;
	default: $fecha .= "December";
	}
	
	
	$fecha .= " " . date ("Y") . ".";
}

return $fecha;

}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

function arriba($selherr, $selmenu, $lenguaje, $titulo){     //,$conexion
global $idioma;
$idioma = $lenguaje ;
//$herritems = array("inicio", "enlaces", "login","buzon");
$herritems = array("login");
//$herrnombres= array("Inicio", "Enlaces", "Login");
$herrnombres= array("Login");
$herrnombres_en= array("Login");
//$menuitems = array("inicio", "docencia", "docencia_grado", "docencia_postgrado", "docencia_doctorado", "personal", "investigacion", "tablon", "contacto");
//$menunombres= array("Inicio", "Docencia", "Grados", "M&aacute;steres","Doctorado", "Personal", "Investigaci&oacute;n", "Tabl&oacute;n", "Contacto");
//$menunombres_en= array("Home", "Teaching", "Degrees","Master","Doctorate", "Staff", "Research", "Board", "Contact us");

error_reporting(0);
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">\n";
echo "<head>\n";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />\n";
echo "<meta name=\"Author\" content=\"Beatriz Heredia\" />\n";
echo "<meta name=\"keywords\" content=\"Departamento de Electr�ica,uah,docencia,depeca\" />\n";
echo "<link rel=\"stylesheet\" href=\"". CSS_ADDR . "beatriz.css\" type=\"text/css\" />\n";
echo "<link rel=\"stylesheet\" href=\"". CSS_ADDR . "Estilos.css\" type=\"text/css\" />\n";
echo "<link rel=\"stylesheet\" href=\"". CSS_ADDR . "estilo.css\" type=\"text/css\" />\n";
echo "<link rel=\"stylesheet\" href=\"". CSS_ADDR . "tema_normal.css\" type=\"text/css\" />\n";

 $ph=explode('?',$_SERVER['REQUEST_URI']);
echo "<title>" . $titulo . "</title>\n";
echo "<link rel=\"SHORTCUT ICON\" href=\"". IMG_ADDR ."depesc.png\" />\n";
echo "</head>\n";
echo "<body>\n";
echo "<div id=\"pagina\">\n";
	echo "<div id=\"top\">\n";
	echo "<div id=\"titulo\"></div><!-- fin de id=titulo -->\n";
	
	echo "</div> <!-- fin de id=top -->\n";
	echo "<div id=\"herramientas\">\n";

// herramientas
	
			for($i=0 ; $i<=(count($herritems) - 1) ; $i++){
			echo "<div class=\"herramientas-item";
			if ($selherr == $herritems[$i]){
			echo "-sel";
			}
			echo "\">\n";
			if ($i==3)
			{
			    if($idioma=="es"){
				echo "<a href='mailto:buzonsugerencias@depeca.uah.es'>Buz&oacute;n De Sugerencias";}
			    else  echo "<a href='mailto:buzonsugerencias@depeca.uah.es'>Suggestion Mailbox";
			}
			else
			{
			echo "<a href=\"" . ROOT_ADDR . $herritems[$i] . "/index";
				if ($idioma == "en"){
					echo "_en.php\">" . $herrnombres_en[$i];
				}
				else{
					echo ".php\">" . $herrnombres[$i];
				}
			}
			echo "</a></div>";
			}


echo "<div id=\"idiomas\">\n";

// banderitas			

$versioningles = str_replace (".php","_en.php", $_SERVER["PHP_SELF"]);


$versioncastellano = str_replace ("_en.php", ".php" , $_SERVER["PHP_SELF"]);
 $ph=explode('?',$_SERVER['REQUEST_URI']);
 $versioningles=$versioningles."?".$ph['1'];
 $versioncastellano=$versioncastellano."?".$ph['1'];


			if ($idioma == "en"){
				//echo "<a href=\"../correo/index_en.php\"><img src=\"" . IMG_ADDR . "correo.gif\" alt=\"Click here for Email\" /></a>\n";
				
									echo "<a href=\"" . $versioncastellano . "\"><img src=\"" . IMG_ADDR . "flag-es.gif\" alt=\"Haz Clic aqu&iacute; para Castellano\" /></a>\n";
				//echo "<img src=\"" . IMG_ADDR . "flag-en.gif\" alt=\"Click here for English\" />\n";

		        }
			else{
			//echo "<a href=\"../correo/index.php\"><img src=\"" . IMG_ADDR . "correo.gif\" alt=\"Haz clic aqu&iacute; para ver Correo\" /></a>\n";


			echo "<img src=\"" . IMG_ADDR . "flag-es.gif\" alt=\"Haz Clic aqu&iacute; para Castellano\" />\n";
						//echo "<a href=\"" . $versioningles . "\"><img src=\"" . IMG_ADDR . "flag-en.gif\" alt=\"Click here for English\" /></a>\n";

			}
		echo "</div>\n";
	echo "</div> <!-- fin de id=herramientas -->\n";

// menu

echo "<div id=\"menu-total\">\n";

echo "<div id=\"menu\">\n";

                        echo "<br /> \n";
                        echo "<br /> \n";

			for($i=0 ; $i<=(count($menuitems) - 1) ; $i++){
			echo "<div class=\"menu-item";
			if ($selmenu == $menuitems[$i]){
			echo "-sel";
			}
			echo "\">\n";
			if ($i==1){
			    if ($idioma == "en")
			    {
			echo"".$menunombres_en[$i];
			    }
			    else
			    {
			echo"".$menunombres[$i];
			    }
			echo "</div>";
			}
			else
			{
			echo "<a href=\"" . ROOT_ADDR . $menuitems[$i] . "/index";
				if ($idioma == "en"){
				      if($i==2 || $i==3 || $i==4){echo "_en.php\">" ."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;". $menunombres_en[$i];}
				      else{echo "_en.php\">" . $menunombres_en[$i];}
				}
				else{
				      if($i==2 || $i==3 || $i==4){echo ".php\">" ."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;". $menunombres[$i];}
				    else {echo ".php\">" . $menunombres[$i];}

				}
			echo "</a></div>\n";
			
			}
			}

		
echo "<br /> \n";
echo "<br /> \n";
echo "<br /> \n";

echo "</div> <!-- fin de id=menu -->\n";

 if ($idioma=='es')
 {
echo "<div id=\"menu2\">\n";

echo "<p align=\"center\"><b>DEPARTAMENTO DE ELECTR&Oacute;NICA<br />Carretera Madrid-Barcelona,<br /> Km 33,600. C.P.28871.<br /> Alcal&aacute; de Henares(Madrid) Tlfno.918856540</b></p>\n";

echo "</div> <!-- fin de id=menu2 -->\n";

echo "</div> <!-- fin de id=menu-total -->\n";


echo "<div id=\"contenido-total\">\n";

echo "<div id=\"titulo-contenido\">\n";
	echo "<div class=\"floatleft\">.:&nbsp;</div>\n";
	echo "<div class=\"firstletter\">" . $titulo . "</div>\n";
	echo "<div id=\"fecha\">" . fecha($idioma) . "</div>\n";
	echo "</div>\n";
        echo "<div id=\"contenido\">\n";
 }
 else
 {
echo "<div id=\"menu2\">\n";

echo "<p align=\"center\"><b>ELECTRONICS DEPARTMENT<br />Madrid-Barcelona Road,<br /> Km 33,600. C.P.28871.<br /> Alcal&aacute; de Henares(Madrid) Phone 918856540</b></p>\n";

echo "</div> <!-- fin de id=menu2 -->\n";

echo "</div> <!-- fin de id=menu-total -->\n";


echo "<div id=\"contenido-total\">\n";

echo "<div id=\"titulo-contenido\">\n";
	echo "<div class=\"floatleft\">.:&nbsp;</div>\n";
	echo "<div class=\"firstletter\">" . $titulo . "</div>\n";
	echo "<div id=\"fecha\">" . fecha($idioma) . "</div>\n";
	echo "</div>\n";
        echo "<div id=\"contenido\">\n";

 }
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


function arribaseleccion($selherr, $selmenu, $lenguaje, $titulo){     //,$conexion
global $idioma;
global $usuario;
global $nivel;
global $ver;
$idioma = $lenguaje ;
$herritems = array("privada/intranet/inicio","../login");
$herrnombres= array("Intranet","Logout");
$herrnombres_en= array("Intranet","Logout");
$menuitems = array("privada/intranet/inicio","../login");
$menunombres= array("Intranet");

$tema_valor= array("rojo", "verde", "normal");
$tema= array("Rojo", "Verde", "Azul");
$tema_en= array("Red", "Green", "Blue");

// session_name($usuarios_sesion);
                session_start();
 
                /////SESIÓN USUARIO Y CONTRASEÑA
		if((!isset($_SESSION["usuario"])) ||(!isset($_SESSION["nivel"])) ){
		  //$usuario = "";
		    header("Location: " . ROOT_ADDR . "");		
		}
		else{
		
			$usuario = $_SESSION["usuario"];
			$nivel = $_SESSION["nivel"];
		}
	
		if ( (isset($_GET['usuario'])) || (isset($_GET['nivel']))){
		
		    $_SESSION["usuario"]=($_GET['usuario']);
		    $_SESSION["nivel"]=($_GET['nivel']);
		
		    header("Location: " . $_SERVER["PHP_SELF"]);
		}
		


echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">\n";
echo "<head>\n";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso8859-1\" />\n";
echo "<meta name=\"Author\" content=\"Beatriz Heredia\" />\n";
echo "<meta name=\"keywords\" content=\"Cosas\" />\n";
echo "<link rel=\"stylesheet\" href=\"". CSS_ADDR . "beatriz.css\" type=\"text/css\" />\n";
echo "<link rel=\"stylesheet\" href=\"". CSS_ADDR . "estilo.css\" type=\"text/css\" />\n";
echo "<link rel=\"stylesheet\" href=\"". CSS_ADDR . "Estilos.css\" type=\"text/css\" />\n";
echo "<link rel=\"stylesheet\" href=\"". CSS_ADDR . "tema_rojo.css\" type=\"text/css\" />\n";


echo "<title>" . $titulo . "</title>\n";
echo "<link rel=\"SHORTCUT ICON\" href=\"". IMG_ADDR ."depesc.png\" />\n";
echo "</head>\n";
echo "<body>\n";
echo "<div id=\"pagina\">\n";
	echo "<div id=\"top\">\n";
		echo "<div id=\"titulo\"></div> <!-- fin de id=titulo -->\n";
	echo "</div> <!-- fin de id=top -->\n";
	echo "<div id=\"herramientas\">\n";

// herramientas
	
			for($i=0 ; $i<=(count($herritems) - 1) ; $i++){
			echo "<div class=\"herramientas-item";
			if ($selherr == $herritems[$i]){
			echo "-sel";
			}
			echo "\">\n";
			echo "<a href=\"" . ROOT_ADDR . $herritems[$i] . "/index";
				if ($idioma == "en"){
					echo "_en.php\">" . $herrnombres_en[$i];
				}
				else{
					echo ".php\">" . $herrnombres[$i];
				}
			echo "</a></div>";
			}

echo "<div id=\"idiomas\">\n";

// banderitas			

$versioningles = str_replace (".php","_en.php",ROOT_ADDRchange . $_SERVER["PHP_SELF"]);


$versioncastellano = str_replace ("_en.php", ".php" ,ROOT_ADDRchange . $_SERVER["PHP_SELF"]);
 $ph=explode('?',$_SERVER['REQUEST_URI']);
 $versioningles=$versioningles."?".$ph['1'];
 $versioncastellano=$versioncastellano."?".$ph['1'];



			if ($idioma == "en"){
				//echo "<a href=\"../correo/index.php\"><img src=\"" . IMG_ADDR . "correo.gif\" alt=\"Click here for Email\" /></a>\n";
						echo "<a href=\"" . $versioncastellano . "\"><img src=\"" . IMG_ADDR . "flag-es.gif\" alt=\"Haz Clic aqu&iacute; para Castellano\" /></a>\n";
				//echo "<img src=\"" . IMG_ADDR . "flag-en.gif\" alt=\"Click here for English\" />\n";
			}
			else{
			    //echo "<a href=\"../correo/index.php\"><img src=\"" . IMG_ADDR . "correo.gif\" alt=\"Click aqu&iacute; para ver Correo\" /></a>\n";
			     echo "<img src=\"" . IMG_ADDR . "flag-es.gif\" alt=\"Haz Clic aqu&iacute; para Castellano\" />\n";
			    //echo "<a href=\"" . $versioningles . "\"><img src=\"" . IMG_ADDR . "flag-en.gif\" alt=\"Click here for English\" /></a>\n";
			}
		echo "</div>\n";
	echo "</div> <!-- fin de id=herramientas -->\n";

// menu


echo "<div id=\"menu-total\">\n";
echo "<div id=\"menu\">\n";


                        echo "<br /> \n";
                        echo "<br /> \n";

			for($i=0 ; $i<=(count($menuitems) - 1) ; $i++){
			echo "<div class=\"menu-item";
			if ($selmenu == $menuitems[$i]){
			echo "-sel";
			}
			echo "\">\n";
			echo "<a href=\"" . ROOT_ADDR . $menuitems[$i] . "/index";
				if ($idioma == "en"){
					echo "_en.php\">" . $menunombres_en[$i];
				}
				else{
					echo ".php\">" . $menunombres[$i];
				}
			echo "</a></div>\n";
			}

echo "<br> \n";
echo "<br> \n";
echo "<br> \n";
echo "<br> \n";
echo "<br> \n";
echo "<br> \n";
echo "<br> \n";
echo "<br> \n";
echo "<br> \n";
echo "<br> \n";


echo "</div> <!-- fin de id=menu -->\n";

 if ($idioma=='en')
 {
echo "<div id=\"menu2\">\n";

echo "<p align=\"center\"><b>DEPARTAMENTO DE ELECTR&Oacute;NICA<br />Carretera Madrid-Barcelona,<br /> Km 33,600. C.P.28871.<br /> Alcal&aacute; de Henares(Madrid) Tlfno.918856540</b></p>\n";

echo "</div> <!-- fin de id=menu2 -->\n";

echo "</div> <!-- fin de id=menu-total -->\n";

echo "<div id=\"contenido-total\">\n";

echo "<div id=\"titulo-contenido\">\n";
	echo "<div class=\"floatleft\">.:&nbsp;</div>\n";
	echo "<div class=\"firstletter\">" . $titulo . "</div>\n";
	echo "<div class=\"floatleft\">&nbsp;:.</div>\n";
	echo "<div id=\"fecha\">" . fecha($idioma) . "</div>\n";
echo "</div>\n";
echo "<div id=\"contenido\">\n";
 }
 else
 {
echo "<div id=\"menu2\">\n";

echo "<p align=\"center\"><b>ELECTRONICS DEPARTMENT<br />Madrid-Barcelona Road,<br /> Km 33,600. C.P.28871.<br /> Alcal&aacute; de Henares(Madrid) Phone 918856540</b></p>\n";

echo "</div> <!-- fin de id=menu2 -->\n";

echo "</div> <!-- fin de id=menu-total -->\n";

echo "<div id=\"contenido-total\">\n";

echo "<div id=\"titulo-contenido\">\n";
	echo "<div class=\"floatleft\">.:&nbsp;</div>\n";
	echo "<div class=\"firstletter\">" . $titulo . "</div>\n";
	echo "<div class=\"floatleft\">&nbsp;:.</div>\n";
	echo "<div id=\"fecha\">" . fecha($idioma) . "</div>\n";
echo "</div>\n";
echo "<div id=\"contenido\">\n";
 }

}


// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

function abajo($idioma){
//global $idioma;
echo "</div>  <!-- fin de id=contenido -->\n";
echo "</div> <!-- fin de id=contenido-total -->\n";
echo "<div id=\"estado\">\n";
    echo "<div id=\"validar\">\n";
		echo "<a href=\"http://validator.w3.org/check?uri=referer\">\n";
		echo "<img src=\"" . IMG_ADDR . "valid-xhtml10.gif\" alt=\"";
		if ($idioma == "en"){
		echo "Validate the page XHTML 1.0 Strict!";	

		}
		else{
		echo "Validar la p&aacute;gina XHTML 1.0 Strict!";	
		}
		echo "\" />\n";
		echo "</a>\n";
		echo "<a href=\"http://jigsaw.w3.org/css-validator/check/referer\" target=\"_blank\">\n";
		echo "<img src=\"" . IMG_ADDR . "vcss.gif\" alt=\"";
	    if ($idioma == "en"){
		echo "Validate the page CSS 2.0!";	

		}
		else{
		echo "Validar la p&aacute;gina CSS 2.0!";
		}
		echo "\" />\n";
		echo "</a> \n";
	echo "</div> <!-- fin de id=validar -->\n";
	if ($idioma=="en")
	{
echo "&copy; Copyright Electronics Department 2005 - " . date("Y") . "\n";
	}
	else
	{
echo "&copy; Copyright Departamento de Electr&oacute;nica 2005 - " . date("Y") . "\n";
	}
echo "</div> <!-- fin de id=estado -->\n";
echo "</div> <!-- fin de id=pagina -->\n";
echo "</body>\n";
echo "</html>\n";
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//funcion que devuelve si la sesion ha sido iniciada
function session_started(){
    return isset($_SESSION);
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//Devuelve el codigo de clon en caso de existir, en caso contrario devuelve el codigo de asignatura

function getCodigoClon($codigo){

    $codigo_interno=$codigo;

    $linka = Conectarse();

    $sqla = "SELECT * FROM clones WHERE codigo like '$codigo_interno' ";

    $resulta = mysql_query($sqla, $linka);

    if($row = mysql_fetch_array($resulta)){

	$codigo_interno=$row["codigo_clon"];
    }

 return $codigo_interno;

}


// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
/*Funcion que pinta la tabla con los enlaces del doctorado */
function enlacesDoctorado(){

     echo "<table  class=\"tabla\">";
    echo "<tr valign=\"top\">";
    echo "<td>";

    echo "<table class=\"fondo2\">";
    echo "<tr>";
    echo "<td align=\"center\"><font class=\"fuentegris\"><b>ESTUDIOS DE DOCTORADO (RD.1393/2007)</b></font></td>";
    echo "</tr>";
    echo "</table>";

    echo "<br />";

    echo "<table class=\"tabla\">";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./presentacion.php'><b>Presentaci&oacute;n</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./formativo.php'><b>Per&iacute;odo formativo</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./tesis.php'><b>Tesis Doctorales</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./garantia.php'><b>Garant&iacute;a de Calidad</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./objetivos.php'><b>Objetivos y Competencias</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./investigador.php'><b>Per&iacute;odo Investigador</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./enlaces.php'><b>Enlaces de Inter&eacute;s</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./admision.php'><b>Admisi&oacute;n y Matr&iacute;cula</b></a></font></td></tr>";
    echo "<tr><td bgcolor=\"#F8F3E4\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./proyectos.php'><b>Proyectos de Investigaci&oacute;n</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./entidades.php'><b>Entidades Colaboradoras</b></a></font></td></tr>";

}

function enlacesDoctorado_ingles(){

     echo "<table  class=\"tabla\">";
    echo "<tr valign=\"top\">";
    echo "<td>";

    echo "<table class=\"fondo2\">";
    echo "<tr>";
    echo "<td align=\"center\"><font class=\"fuentegris\"><b>PHD (RD.1393/2007)</b></font></td>";
    echo "</tr>";
    echo "</table>";

    echo "<br />";

    echo "<table class=\"tabla\">";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./presentacion_en.php'><b>Presentation</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./formativo_en.php'><b>Formative Period</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./tesis_en.php'><b>Doctoral Thesis</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./garantia_en.php'><b>Quality Assurance</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./objetivos_en.php'><b>Goals & Skills</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./investigador_en.php'><b>Research Period</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./enlaces_en.php'><b>Links of Interest</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./admision_en.php'><b>Admission & Registration</b></a></font></td></tr>";
    echo "<tr><td bgcolor=\"#F8F3E4\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./proyectos_en.php'><b>Research Projects</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./entidades_en.php'><b>Associates</b></a></font></td></tr>";

}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
/*Funcion que pinta las pestañas de docencia*/
function pintarPestanas($cod,$selec,$titulacion)
{
    $textoinfo="";
    $textoprof="";
    $textometod="";
    $textoobj="";
    $textotema="";
    $textoeval="";
    $textobiblio="";
    $textoenlaces="";
    $textoalum="class=\"distinto\"";
    switch ($selec){
	case "informacion": $textoinfo="class=\"seleccionada\"";
	    break;
	case "profesorado": $textoprof="class=\"seleccionada\"";
	    break;
	case "objetivos": $textoobj="class=\"seleccionada\"";
	    break;
        case "metodologia": $textometod="class=\"seleccionada\"";
	    break;
	case "temario": $textotema="class=\"seleccionada\"";
	    break;
	case "evaluacion": $textoeval="class=\"seleccionada\"";
	    break;
	case "bibliografia": $textobiblio="class=\"seleccionada\"";
	    break;
	case "enlaces": $textoenlaces="class=\"seleccionada\"";
	    break;
	case "alumnos": $textoalum="class=\"seleccionada\"";
	    break;
    }
    echo "<div id=\"tabs1\">";
    echo "<img class=\"left\" src=\"../img/docencia_pest.jpg\" alt=\" \" />";
    echo "<ul>";
       echo "<li><a $textoinfo href=\"informacion.php?codigo=$cod&titulacion=$titulacion\" title=\"\"><span>Informaci&oacute;n</span></a></li>";
       echo "<li><a $textoprof href=\"profesorado.php?codigo=$cod&titulacion=$titulacion\" title=\"\"><span>Profesorado</span></a></li>";
       /* comentado por mocana, los enlaces de los contenidos iran a la web de la uah*/
       //echo "<li><a $textoobj href=\"objetivos.php?codigo=$cod&titulacion=$titulacion\" title=\"\"><span>Objetivos</span></a></li>";
       //echo "<li><a $textotema href=\"temario.php?codigo=$cod&titulacion=$titulacion\" title=\"\"><span>Temario</span></a></li>";
       //echo "<li><a $textometod href=\"metodologia.php?codigo=$cod&titulacion=$titulacion\" title=\"\"><span>Metodolog&iacute;a</span></a></li>";
       //echo "<li><a $textoeval href=\"evaluacion.php?codigo=$cod&titulacion=$titulacion\" title=\"\"><span>Evaluaci&oacute;n</span></a></li>";
       //echo "<li><a $textobiblio href=\"bibliografia.php?codigo=$cod&titulacion=$titulacion\" title=\"\"><span>Bibliograf&iacute;a</span></a></li>";
       //echo "<li><a $textoenlaces href=\"enlaces.php?codigo=$cod&titulacion=$titulacion\" title=\"\"><span>Enlaces</span></a></li>";
       echo "<li><a $textoalum href=\"./alumnos.php?codigo=$cod&titulacion=$titulacion\" title=\"\"><span><b>Alumnos</b></span></a></li>";       
    echo"</ul>";
    echo "</div>";
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
/*Funcion que pinta las pestañas de docencia*/
function pintarPestanasE($cod,$selec,$titulacion)
{
    $textoinfo="";
    $textoprof="";
    $textometod="";
    $textoobj="";
    $textotema="";
    $textoeval="";
    $textobiblio="";
    $textoenlaces="";
    $textoalum="class=\"distinto\"";
    switch ($selec){
	case "info": $textoinfo="class=\"seleccionada\"";
	    break;
	case "faculty": $textoprof="class=\"seleccionada\"";
	    break;
	case "goals": $textoobj="class=\"seleccionada\"";
	    break;
        case "methodology": $textometod="class=\"seleccionada\"";
	    break;
	case "agenda": $textotema="class=\"seleccionada\"";
	    break;
	case "evaluation": $textoeval="class=\"seleccionada\"";
	    break;
	case "bibliography": $textobiblio="class=\"seleccionada\"";
	    break;
	case "links": $textoenlaces="class=\"seleccionada\"";
	    break;
	case "students": $textoalum="class=\"seleccionada\"";
	    break;
    }
    echo "<div id=\"tabs1\">";
    echo "<img class=\"left\" src=\"../img/docencia_pest.jpg\" alt=\" \" />";
    echo "<ul>";
       echo "<li><a $textoinfo href=\"informacion_en.php?codigo=$cod&titulacion=$titulacion\" title=\"\"><span>Info</span></a></li>";
       echo "<li><a $textoprof href=\"profesorado_en.php?codigo=$cod&titulacion=$titulacion\" title=\"\"><span>Staff</span></a></li>";
       echo "<li><a $textoobj href=\"objetivos_en.php?codigo=$cod&titulacion=$titulacion\" title=\"\"><span>Goals</span></a></li>";
       echo "<li><a $textotema href=\"temario_en.php?codigo=$cod&titulacion=$titulacion\" title=\"\"><span>Agenda</span></a></li>";
       echo "<li><a $textometod href=\"metodologia_en.php?codigo=$cod&titulacion=$titulacion\" title=\"\"><span>Methodology</span></a></li>";
       echo "<li><a $textoeval href=\"evaluacion_en.php?codigo=$cod&titulacion=$titulacion\" title=\"\"><span>Evaluation</span></a></li>";
       echo "<li><a $textobiblio href=\"bibliografia_en.php?codigo=$cod&titulacion=$titulacion\" title=\"\"><span>Bibliography</span></a></li>";
       echo "<li><a $textoenlaces href=\"enlaces_en.php?codigo=$cod&titulacion=$titulacion\" title=\"\"><span>Links</span></a></li>";
       echo "<li><a $textoalum href=\"./alumnos_en.php?codigo=$cod&titulacion=$titulacion\" title=\"\"><span><b>Students</b></span></a></li>";       
    echo"</ul>";
    echo "</div>";
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
/*Funcion que pinta la tabla con los enlaces del master */
function enlacesMaster($cod)
{

    echo "<table  class=\"tabla\">";
    echo "<tr valign=\"top\">";
    echo "<td>";

    echo "<table class=\"fondo2\">";
    echo "<tr>";
    echo "<td align=\"center\"><font class=\"fuentegris\"><b>M&Aacute;STER UNIVERSITARIO EN</b><br /><b>SISTEMAS  ELECTR&Oacute;NICOS AVANZADOS.SISTEMAS INTELIGENTES<br />Menci&oacute;n de calidad ANECA curso 2010/2011 (MCD2006/00373)</b></font></td>";
    echo "</tr>";
    echo "</table>";

    echo "<br /><br /><br /><br /><br />";

    echo "<table class=\"tabla\">";
//<a style='text-decoration:none' href=''><b> Descargar documento</b></a>
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master11.php?codigo=$cod'><b>Datos Identificativos</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style='text-decoration:none' href='/depeca/repositorio/horarios/acogidanuevoingresomusea11-12.pdf'><b> Descargar documento</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master12.php?codigo=$cod'><b>Cr&eacute;ditos</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master13.php?codigo=$cod'><b>Datos Pr&aacute;cticos</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='http://www.uah.es/postgrado/ESTOFPOSTG/docs/precios_publicos.pdf'><b>Precio</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master15.php?codigo=$cod'><b>P&uacute;blico a qui&eacute;n va dirigido</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master16.php?codigo=$cod'><b>Objetivos</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='carrerasm0910.php?codigo=$cod'><b>Plan de Estudios:&nbsp;&nbsp;&nbsp;&nbsp; 12/13</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style='text-decoration:none' href='carrerasm0910.php?codigo=$cod'><b>11/12</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style='text-decoration:none' href='carrerasm0910.php?codigo=$cod'><b>10/11</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='carrerasm0910.php?codigo=$cod'><b>09/10</b></a><a style='text-decoration:none' href='/depeca/repositorio/electronicaasignaturas.pdf'><b>&nbsp;&nbsp;&nbsp;&nbsp; 08/09</b></a>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master18.php?codigo=$cod'><b>Requisitos de Admisi&oacute;n</b></a></font></td></tr>";
    echo "<tr><td bgcolor=\"#F8F3E4\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master19.php?codigo=$cod'><b>Criterios de Admisi&oacute;n y Selecci&oacute;n</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master110.php?codigo=$cod'><b>Documentaci&oacute;n que debe aportarse</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master112.php?codigo=$cod'><b>Reclamaciones</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master111.php?codigo=$cod'><b>Otros datos referentes al programa</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='mailto:buzonsugerencias@depeca.uah.es'><b>Buz&oacute;n de Sugerencias</b></a></font></td></tr>";
    //echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\">Horario Curso 12/13 <a style='text-decoration:none' href='../repositorio/horarios/Semestre1MSEA2012-2013.pdf'><b>Semestre 1 </b></a><a style='text-decoration:none' href='../repositorio/horarios/Semestre2MSEA_2012-2013_vprint.pdf'><b>Semestre 2</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='../repositorio/horarios/Horarios_MUSEA90ECTS_2013_14.pdf'><b>Horario Curso 2013/2014 Semestre 1 </b></a></font></td></tr>"; 

//echo "<b>Semestre 2 </b></a><a style='text-decoration:none' href='../repositorio/horarios/HorariosMUSEA90ECTS_2013_14.pdf'> </td></tr>";

//echo "<b>Semestre 2</b></a></font></td></tr>";
//echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='../repositorio/TABLA_RECONOCIMIENTO_DE_CREDITOS.pdf'><b>Reconocimiento de cr&eacute;ditos</b></a></font></td></tr>";
//echo "<tr><td class='celdaverde'><font class=\"fuenteazul\">Calendario de pruebas y ex&aacute;menes";
//echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='/depeca/repositorio/horarios/ActividadMUSEA2012-131C.pdf'><b>1Primer Cuatrimestre</b></a></font>";
//echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='/depeca/repositorio/horarios/ActividadMUSEA2012-132C.pdf'><b>Segundo Cuatrimestre</b></a></font>";
//echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='/depeca/repositorio/horarios/ActividadMUSEA2012-13Extraordinaria.pdf'><b>Extraordinaria</b></a></font></td></tr>";
}
function enlacesMaster3($cod)
{
  
    $curso=calculo_curso();
    echo "<table class='tabla'>";

    echo "<tr valign=\"top\">";
    echo "<td>";


    echo "<table class=\"fondo2\">";
    echo "<tr>";
    echo "<td align=\"center\"><font class=\"fuentegris\"><b>M&Aacute;STER UNIVERSITARIO EN</b><br /><b>SISTEMAS  ELECTR&Oacute;NICOS AVANZADOS.SISTEMAS INTELIGENTES<br />Menci&oacute;n de calidad ANECA curso 2014/2015 (MCD2006/00373)</b></font><font color='red'><b> Nuevo</b></font></td>";
    echo "</tr>";
    echo "</table>";

    echo "<br /><br /><br /><br /><br />";
//<a style='text-decoration:none' href=''><b> Descargar documento</b></a>
    echo "<table class='tabla'>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master1111.php?codigo=$cod'><b>Datos identificativos</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='/depeca/repositorio/horarios/comisiones_musea.pdf'><b>Comisiones</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master121.php?codigo=$cod'><b>Cr&eacute;ditos: &nbsp;&nbsp;&nbsp; 60 ECTS</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master131.php?codigo=$cod'><b>Datos Pr&aacute;cticos</b></a></font></td></tr>";
    echo "<tr><td bgcolor=\"#F8F3E4\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='https://portal.uah.es/portal/page/portal/posgrado/masteres_universitarios/documentos/precios_publicos.pdf'><b>Precio</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master151.php?codigo=$cod'><b>P&uacute;blico a qui&eacute;n va dirigido</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master161.php?codigo=$cod'><b>Objetivos</b></a></font></td></tr>";
 echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='carrerasm0910.php?codigo=$cod&curso=2014/2015'><b>Plan de Estudios:&nbsp;&nbsp;&nbsp;&nbsp; 14/15</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style='text-decoration:none' href='carrerasm0910.php?codigo=$cod&curso=2013/2014'><b>13/14</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='https://portal.uah.es/portal/page/portal/posgrado/masteres_universitarios/preinscripcion_admision/requisitos_acceso'><b>Requisitos de Acceso</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master191.php?codigo=$cod'><b>Criterios de Admisi&oacute;n y Selecci&oacute;n</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='https://portal.uah.es/portal/page/portal/posgrado/masteres_universitarios/preinscripcion_admision/documentacion_requerida'><b>Documentaci&oacute;n requerida</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master1121.php?codigo=$cod'><b>Reclamaciones</b></a></font></td></tr>";
//    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master111.php?codigo=$cod'><b>Otros datos referentes al programa</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><b>Horarios Curso 14/15</b> <br>";
    echo "<a style='text-decoration:none' href='/depeca/repositorio/horarios/Semestre1_MUSEA_2014_2015_vprint.pdf'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Semestre 1  </a>";
    echo "<a style='text-decoration:none' href='/depeca/repositorio/horarios/Semestre2_MUSEA_2014_2015_vprint.pdf'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Semestre 2  </a></font></td></tr>";

    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><b>Reconocimiento de cr&eacute;ditos: </b><a style='text-decoration:none' href='http://www.uah.es/archivos_posgrado/MU/Unico/AM128_3_3_1_E_MU%20SIST%20ELECTRONICOS%20AVANZ_TABLA%20RECONOCIMIENTO%20CREDITOS_MODIFCEOP_15_05_14.pdf'><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tabla</b></a>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a style='text-decoration:none' href='https://portal.uah.es/portal/page/portal/posgrado/documentos/normativa_reconocimiento_creditos.pdf'><b>Normativa</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><b>Calendario de pruebas y ex&aacute;menes 2014/2015</b> <br>\n";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='/depeca/repositorio/horarios/Actividad_MUSEA_2014_15_1C.pdf'>Semestre 1</a></font>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='/depeca/repositorio/horarios/Actividad_MUSEA_2014_15_2C.pdf'>Semestre 2</a></font>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='/depeca/repositorio/horarios/Actividad_MUSEA_2014_15_Ext.pdf'>Extraordinaria</a></font></td></tr>";
echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='https://portal.uah.es/portal/page/portal/posgrado/masteres_universitarios/oferta#cod_estudio=M128'><b>Para m&aacute;s informaci&oacute;n</b></a></font></td></tr>";
}

function enlacesMaster4($cod)
{
  
    $curso=calculo_curso();
    echo "<table class='tabla'>";

    echo "<tr valign=\"top\">";
    echo "<td>";


    echo "<table class=\"fondo2\">";
    echo "<tr>";
    echo "<td align=\"center\"><font class=\"fuentegris\"><b>M&Aacute;STER UNIVERSITARIO DE INGENIER&Iacute;A DE TELECOMUNICACI&Oacute;N (MUIT)</b><br /><b><br /></b></font><font color='red'></font></td>";
    echo "</tr>";
    echo "</table>";

    echo "<br /><br /><br /><br /><br />";
//<a style='text-decoration:none' href=''><b> Descargar documento</b></a>
    echo "<table class='tabla'>";
        echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./muit1.php?codigo=$cod'><b>Datos Identificativos</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./muit2.php'><b>Cr&eacute;ditos</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./muit3.php'><b>Datos Pr&aacute;cticos</b></a></font></td></tr>";
    echo "<tr><td bgcolor=\"#F8F3E4\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='http://portal.uah.es/portal/page/portal/posgrado/masteres_universitarios/matricula/pago_matricula'><b>Precio</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./muit4.php'><b>P&uacute;blico a qui&eacute;n va dirigido</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./muit5.php'><b>Objetivos</b></a></font></td></tr>";
 echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='carrerasm0910.php?codigo=$cod&curso=2013/2014'><b>Plan de Estudios:&nbsp;&nbsp;&nbsp;&nbsp; 13/14</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./muit6.php'><b>Requisitos de Admisi&oacute;n</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./muit7.php'><b>Criterios de Admisi&oacute;n y Selecci&oacute;n</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./muit8.php'><b>Documentaci&oacute;n que debe aportarse</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./muit9.php'><b>Reclamaciones</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./muit10.php'><b>Otros datos referentes al programa</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='mailto:manuel.rosa@uah.es'><b>Buz&oacute;n de Sugerencias</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\">Horario Curso 13/14 </font></td></tr>";
    //echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='../../repositorio/TABLA_RECONOCIMIENTO_DE_CREDITOS.pdf'><b>Reconocimiento de cr&eacute;ditos</b></a></font></td></tr>";
//echo "<tr><td class='celdaverde'><font class=\"fuenteazul\">Calendario de pruebas y ex&aacute;menes";
//echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='/depeca/repositorio/horarios/ActividadMUSEA2012-131C.pdf'><b>Primer Cuatrimestre</b></a></font>";
//echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='/depeca/repositorio/horarios/ActividadMUSEA2012-132C.pdf'><b>Segundo Cuatrimestre</b></a></font>";
//echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='/depeca/repositorio/horarios/ActividadMUSEA2012-13Extraordinaria.pdf'><b>Extraordinaria</b></a></font></td></tr>";
echo "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='http://portal.uah.es/portal/page/portal/posgrado/masteres_universitarios/repositorio/ing_arq/Ingenier%EDa%20de%20Telecomunicaci%F3n'><b>Para m&aacute;s informaci&oacute;n</b></a></font></td></tr>";
}




/*Funcion que pinta la tabla con los enlaces del master */
function enlacesMaster_ingles($cod)
{

    echo "<table  class=\"tabla\">";
    echo "<tr valign=\"top\">";
    echo "<td>";

    echo "<table class=\"fondo2\">";
    echo "<tr>";
    echo "<td align=\"center\"><font class=\"fuentegris\"><b>OFFICIAL MASTERS DEGREE IN</b><br /><b>ADVANCED ELECTRONIC SYSTEMS. INTELLIGENT SYSTEMS<br />ANECA Quality Mention for the year 2010/2011 (MCD2006/00373)</b></font></td>";
    echo "</tr>";
    echo "</table>";

    echo "<br /><br /><br /><br /><br />";

    echo "<table class=\"tabla\">";
echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master11_en.php?codigo=$cod'><b>Identification Details</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style='text-decoration:none' href='/depeca/repositorio/horarios/acogidanuevoingresomusea11-12.pdf'><b> Download</b></a></font></td></tr>";
    
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master12_en.php'><b>Credits</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master13_en.php'><b>Practical Data</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='http://www.uah.es/postgrado/ESTOFPOSTG/docs/precios_publicos.pdf'><b>Price</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master15_en.php'><b>Target Public</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master16_en.php'><b>Objectives</b></a></font></td></tr>";
echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='carrerasm0910_en.php?codigo=$cod'><b>Master Program:&nbsp;&nbsp;&nbsp;&nbsp; 12/13</b></a></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style='text-decoration:none' href='carrerasm0910_en.php?codigo=$cod'><b>11/12</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style='text-decoration:none' href='carrerasm0910_en.php?codigo=$cod'><b>10/11</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='carrerasm0910_en.php?codigo=$cod'><b>09/10</b></a><a style='text-decoration:none' href='/depeca/repositorio/electronicaasignaturas.pdf'><b>&nbsp;&nbsp;&nbsp;&nbsp; 08/09</b></a>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</font></td></tr>";
//    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='carrerasm0910.php?codigo=$cod'><b>Study Plan:&nbsp;&nbsp;&nbsp;&nbsp; 09/10</b></a><a style='text-decoration:none' href='/depeca/repositorio/electronicaasignaturas.pdf'><b>&nbsp;&nbsp;&nbsp;&nbsp; 08/09</b></a>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master18_en.php'><b>Access Requirements</b></a></font></td></tr>";
    echo "<tr><td bgcolor=\"#F8F3E4\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master19_en.php'><b>Access and Selection Criteria</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master110_en.php'><b>Documentation to be provided</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master112_en.php'><b>Complaints</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master111_en.php'><b>Other Data relevant to the programme</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='mailto:buzonsugerencias@depeca.uah.es'><b>Suggestion Box</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\">Course Timetable 12/13 <a style='text-decoration:none' href='../repositorio/horarios/Semestre1MSEA2012-2013.pdf'><b>Semester 1 </b></a><a style='text-decoration:none' href='../repositorio/horarios/Semestre2MSEA2012-2013.pdf'><b>Semester 2</b></a></font></td></tr>";
echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='../repositorio/Convalidaciones_master.pdf'><b>Validations Master</b></a></font></td></tr>";
echo "<tr><td class='celdaverde'><font class=\"fuenteazul\">Tests & Exams Calendar";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='/depeca/repositorio/horarios/ActividadMUSEA2012-131C.pdf'><b>First Semester</b></a></font>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='/depeca/repositorio/horarios/ActividadMUSEA2012-132C.pdf'><b>Second Semester</b></a></font>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='/depeca/repositorio/horarios/ActividadMUSEA2012-13Extraordinaria.pdf'><b>Extraordinary</b></a></font></td></tr>";
    //echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='../repositorio/horarios/HORARIO_MUSEA_10-11.pdf'><b>Course Timetable 09/10</b></a></font></td></tr>";
//echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='../repositorio/Convalidaciones_master.doc'><b>Validations master</b></a></font></td></tr>";
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
/*Funcion que pinta la tabla con los enlaces del master */
function enlacesMaster2($cod)
{

    echo "<table  class=\"tabla\">";
    echo "<tr valign=\"top\">";
    echo "<td>";

    echo "<table class=\"fondo2\">";
    echo "<tr>";
    echo "<td align=\"center\"><font class=\"fuentegris\"><b>M&Aacute;STER UNIVERSITARIO EN</b><br /><b>AUTOMATIZACI&Oacute;N DE PROCESOS INDUSTRIALES<br /</b></font></td>";
    echo "</tr>";
    echo "</table>";

    echo "<br /><br /><br /><br /><br />";

    echo "<table class=\"tabla\">";
//<a style='text-decoration:none' href=''><b> Descargar documento</b></a>
echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master21.php?codigo=$cod'><b>Datos Identificativos</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style='text-decoration:none' href='/depeca/repositorio/horarios/acogidanuevoingresomuapi11-12.pdf'><b> Descargar documento</b></a></font></td></tr>";

    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master22.php?codigo=$cod'><b>Cr&eacute;ditos</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master23.php?codigo=$cod'><b>Datos Pr&aacute;cticos</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='http://www.uah.es/postgrado/ESTOFPOSTG/docs/precios_publicos.pdf'><b>Precio</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master25.php?codigo=$cod'><b>P&uacute;blico a qui&eacute;n va dirigido</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master26.php?codigo=$cod'><b>Objetivos</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./carrerasm0910.php?codigo=$cod'><b>Plan de Estudios:&nbsp;&nbsp;&nbsp;&nbsp; 12/13</b></a><a style='text-decoration:none' href='./carrerasm0910.php?codigo=$cod'>&nbsp;&nbsp;&nbsp;&nbsp;<b>11/12 10/11</b></a></font></td></tr>";
//    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='../../repositorio/horarios/plandeestudios10.doc'><b>Plan de Estudios:&nbsp;&nbsp;&nbsp;&nbsp; 10/11</b></a>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='../repositorio/horarios/2011_12_Horarios_MUAPI.pdf'><b>Horario</b></a>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master28.php?codigo=$cod'><b>Requisitos de Admisi&oacute;n</b></a></font></td></tr>";
    echo "<tr><td bgcolor=\"#F8F3E4\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master29.php?codigo=$cod'><b>Criterios de Admisi&oacute;n y Selecci&oacute;n</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master210.php?codigo=$cod'><b>Documentaci&oacute;n que debe aportarse</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master212.php?codigo=$cod'><b>Reclamaciones</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master211.php?codigo=$cod'><b>Otros datos referentes al programa</b></a></font></td></tr>";
echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='../repositorio/Convalidaciones_master.pdf'><b>Convalidaciones m&aacute;ster</b></a></font></td></tr>";
echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><b>Calendario de pruebas y ex&aacute;menes:</b></a></font>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='/depeca/repositorio/horarios/ActividadMUAPI2011-121C.pdf'><b>Primer Cuatrimestre</b></a></font>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='/depeca/repositorio/horarios/ActividadMUAPI2011-122C.pdf'><b>Segundo Cuatrimestre</b></a></font>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='/depeca/repositorio/horarios/ActividadMUAPI2011-12ex.pdf'><b>Extraordinaria</b></a></font></td></tr>";    
echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='mailto:buzonsugerencias@depeca.uah.es'><b>Buz&oacute;n de Sugerencias</b></a></font></td></tr>";

}
function enlacesMaster2_Ingles($cod)
{

    echo "<table  class=\"tabla\">";
    echo "<tr valign=\"top\">";
    echo "<td>";

    echo "<table class=\"fondo2\">";
    echo "<tr>";
    echo "<td align=\"center\"><font class=\"fuentegris\"><b>UNIVERSITY MASTER IN</b><br /><b>INDUSTRIAL AUTOMATION PROCESS<br /</b></font></td>";
    echo "</tr>";
    echo "</table>";

    echo "<br /><br /><br /><br /><br />";

    echo "<table class=\"tabla\">";
//<a style='text-decoration:none' href=''><b> Descargar documento</b></a>
echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master21_en.php?codigo=$cod'><b>Identifying Data</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style='text-decoration:none' href='/depeca/repositorio/horarios/acogidanuevoingresomuapi11-12.pdf'><b> Download</b></a></font></td></tr>";

    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master22_en.php?codigo=$cod'><b>Credits</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master23_en.php?codigo=$cod'><b>Practical Data</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='http://www.uah.es/postgrado/ESTOFPOSTG/docs/precios_publicos.pdf'><b>Price</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master25_en.php?codigo=$cod'><b>Target public</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master26_en.php?codigo=$cod'><b>Objetives</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./carrerasm0910_en.php?codigo=$cod'><b>Master Program :&nbsp;&nbsp;&nbsp;&nbsp; 12/13 </b></a><a style='text-decoration:none' href='./carrerasm0910_en.php?codigo=$cod'>&nbsp;&nbsp;&nbsp;&nbsp;<b>11/12 10/11</b></a></font></td></tr>";
//    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='../../repositorio/horarios/plandeestudios10.doc'><b>Plan de Estudios:&nbsp;&nbsp;&nbsp;&nbsp; 10/11</b></a>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='../repositorio/horarios/2011_12_Horarios_MUAPI.pdf'><b>Schedules</b></a>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master28_en.php?codigo=$cod'><b>Access and selection criteria</b></a></font></td></tr>";
    echo "<tr><td bgcolor=\"#F8F3E4\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master29_en.php?codigo=$cod'><b>Elegibility & Selection Criteria</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master210_en.php?codigo=$cod'><b>Documentation to be provided</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master212_en.php?codigo=$cod'><b>Complaints</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master211_en.php?codigo=$cod'><b>Other Data relevant to the programme</b></a></font></td></tr>";
echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='../repositorio/Convalidaciones_master.pdf'><b>Master Validations</b></a></font></td></tr>";
echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><b>Tests & examns calendar:</b></a></font>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='/depeca/repositorio/horarios/ActividadMUAPI2011-121C.pdf'><b>First semester</b></a></font>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='/depeca/repositorio/horarios/ActividadMUAPI2011-122C.pdf'><b>Second semester</b></a></font>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='/depeca/repositorio/horarios/ActividadMUAPI2011-12ex.pdf'><b>Extraordinary</b></a></font></td></tr>";    
echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='mailto:buzonsugerencias@depeca.uah.es'><b>Suggestion Mailbox</b></a></font></td></tr>";

}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
/*Funcion que pinta las pestañas de Tablon*/
function pintarPestanasTablon($selec)
{
    $textonoticias="";
    $textocursos="";
    $textobecas="";
    $textotfc="";
    
    switch ($selec){
	case "noticias": $textonoticias="class=\"seleccionada\"";
	    break;
	case "cursos": $textocursos="class=\"seleccionada\"";
	    break;
	case "becas": $textobecas="class=\"seleccionada\"";
	    break;
	case "tfc": $textotfc="class=\"seleccionada\"";
	    break;
	
    }
    echo "<div id=\"tabs1\">";
    echo "<img class=\"left\" src=\"../img/tablon.jpg\" alt=\" \" />";
    echo "<ul>";
    echo "<li><a $textonoticias href=\"./index.php\" title=\"\"><span>Noticias</span></a></li>";
    echo "<li><a $textocursos href=\"./cursos.php\" title=\"\"><span>Cursos</span></a></li>";
    echo "<li><a $textobecas href=\"./becas.php\" title=\"\"><span>Becas</span></a></li>";
    echo "<li><a $textotfc href=\"./tfc.php\" title=\"\"><span>Propuestas TFC</span></a></li>";
    echo "</ul>";
    echo "</div>";

    echo "<div>";
}

function pintarPestanasTablonen($selec)
{
    $textonoticias="";
    $textocursos="";
    $textobecas="";
    $textotfc="";
    
    switch ($selec){
	case "news": $textonoticias="class=\"seleccionada\"";
	    break;
	case "courses": $textocursos="class=\"seleccionada\"";
	    break;
	case "scholarships": $textobecas="class=\"seleccionada\"";
	    break;
	case "tfc": $textotfc="class=\"seleccionada\"";
	    break;
	
    }
    echo "<div id=\"tabs1\">";
    echo "<img class=\"left\" src=\"../img/tablon.jpg\" alt=\" \" />";
    echo "<ul>";
    echo "<li><a $textonoticias href=\"./index_en.php\" title=\"\"><span>News</span></a></li>";
    echo "<li><a $textocursos href=\"./cursos_en.php\" title=\"\"><span>Courses</span></a></li>";
    echo "<li><a $textobecas href=\"./becas_en.php\" title=\"\"><span>Scholarships</span></a></li>";
    echo "<li><a $textotfc href=\"./tfc_en.php\" title=\"\"><span>TFC's Propositions</span></a></li>";
    echo "</ul>";
    echo "</div>";

    echo "<div>";
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
/*Funcion que pinta la tabla con los enlaces de la normativa de TFC */
function enlacesTFC()
{
    echo "<table  class=\"tabla\">";

    echo "<tr valign=\"top\">";
    echo "<td>";
    echo "<table class=\"fondo2\">";
    echo "<tr>";
    echo "<td align=\"center\"><font class=\"fuentegris\"><b>NORMATIVA SOBRE</b></font><br /><font class=\"fuentegris\"><b>TRABAJOS DE FIN DE CARRERA</b></font></td>";
    echo "</tr>";
    echo "</table>";

    echo "<br /><br /><br /><br />";

    echo "<table class=\"tabla\">";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./tfc11.php'><b>1  Introducci&oacute;n</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./tfc12.php'><b>2 Modalidades de los TFCs</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./tfc13.php'><b>3 Recursos empleados en la realizaci&oacute;n de los TFCs</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./tfc14.php'><b>4 Propuestas del tema de trabajo, del director y del tutor</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./tfc15.php'><b>5 Anteproyecto</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./tfc16.php'><b>6 Tribunal Calificador</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./tfc17.php'><b>7 Matr&iacute;cula del TFC</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./tfc18.php'><b>8 Defensa del TFC</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./tfc19.php'><b>9 TFC realizado en el extranjero</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./tfc110.php'><b>10 Normas de presentaci&oacute;n de la memoria del TFC</b></a></font></td></tr>";
    echo "<tr><td align='center' class='celdaverde'><font class=\"fuenteazul\"><a style='text-decoration:none' target='blank_' href='../docs/NormativaProyecto.pdf'><b>DESCARGAR PDF</b></a></font></td></tr>";
}
function enlacesTFC_ingles()
{
    echo "<table  class=\"tabla\">";

    echo "<tr valign=\"top\">";
    echo "<td>";
    echo "<table class=\"fondo2\">";
    echo "<tr>";
    echo "<td align=\"center\"><font class=\"fuentegris\"><b>NORMATIVA SOBRE</b></font><br /><font class=\"fuentegris\"><b>TRABAJOS DE FIN DE CARRERA</b></font></td>";
    echo "</tr>";
    echo "</table>";

    echo "<br /><br /><br /><br />";

    echo "<table class=\"tabla\">";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./tfc11.php'><b>1  Introducci&oacute;n</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./tfc12_en.php'><b>2 Modalidades de los TFCs</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./tfc13_en.php'><b>3 Recursos empleados en la realizaci&oacute;n de los TFCs</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./tfc14_en.php'><b>4 Propuestas del tema de trabajo, del director y del tutor</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./tfc15_en.php'><b>5 Anteproyecto</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./tfc16_en.php'><b>6 Tribunal Calificador</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./tfc17_en.php'><b>7 Matr&iacute;cula del TFC</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./tfc18_en.php'><b>8 Defensa del TFC</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./tfc19_en.php'><b>9 TFC realizado en el extranjero</b></a></font></td></tr>";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./tfc110_en.php'><b>10 Normas de presentaci&oacute;n de la memoria del TFC</b></a></font></td></tr>";
    echo "<tr><td align='center' class='celdaverde'><font class=\"fuenteazul\"><a style='text-decoration:none' target='blank_' href='../docs/NormativaProyecto.pdf'><b>DESCARGAR PDF</b></a></font></td></tr>";
}

?>




