<?php

include("./conexion.inc.php");

define( "ROOT_ADDR", "/depeca/privada/intranet/" );
define( "ROOT_ADDRsin", "/depeca/privada/intranet/" );
define( "ROOT_ADDRchange", "/" );
define( "CORE_ADDR", ROOT_ADDR . "core/" );
define( "CSS_ADDR", ROOT_ADDR . "css/" );
define( "IMG_ADDR", ROOT_ADDR . "img/" );

$idioma="en";
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//added by P Revenga 12-05-2010
function get_puesto($link,$usuario){
$link=Conectarse();
$query="select puesto,usuario from personal where usuario='".$usuario."';";
$result = mysql_query($query);
$row = mysql_fetch_row($result);
return $row[0];
}
//added by P Revenga 12-05-2010
//devuelve true si el nivel y el usuario coinciden en la tabla, si no existen devuelve false
function acceso_nivel($nivel,$usuario){
$link=Conectarse();
$query="select nivel,usuario from acceso_niveles where usuario='".$usuario."' and nivel ='".$nivel."';";
//echo $query."<br>";
$result = mysql_query($query);
$row = mysql_fetch_row($result);
return ($row['0']==$nivel);

}

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

function cambiaf_a_mysql2($date)
{
    list($anio, $mes, $dia ) = split( '[/.-]', $date );
    if(strlen($dia)==1)
	$dia="0".$dia;
    if(strlen($mes)==1)
	$mes="0".$mes;
    $fecha=$anio."-".$mes."-".$dia;
    return $fecha;
}

function formato_hora($hour)
{
    list($hora, $minutos) = split( '[:./,-]', $hour);
    if(strlen($hora)==1)
	$hora="0".$hora;
    if(strlen($minutos)==0)
	$minutos="00";
    $hora_final=$hora.":".$minutos;
    return $hora_final;
}
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


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

// en Inglés

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
global $usuario;
global $nivel;
global $ver;
$idioma = $lenguaje ;
$herritems = array("inicio", "enlaces", "../../login");
$herrnombres= array("Inicio", "Enlaces", "Logout");
$herrnombres_en= array(  "");


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
		//se restringe el acceso a la academia a aquellas personas que no tengan permisos
		if($nivel != -1){
		   
		    //$menuitems = array("inicio", "normas", "formularios","dia_a_dia", "docencia","investigacion","reservas_laboratorios","academia","vigilancias","asig_docencia","listas_distribucion","correo","consejo","comision","tecnicos","material","inventario","proyectos");
		    //$menunombres= array("Inicio", "Normas", "Formularios", "D&iacute;a a d&iacute;a", "Docencia","Investigaci&oacute;n","Reservas de Salas y Laboratorios","Academia","Vigilancias","Asignaci&oacute;n de Docencia", "Listas De Distribucion", "Modificar Cuenta Correo","Consejo de Departamento","Comisiones de Departamento","T&eacute;cnicos de Laboratorio","Petici&oacute;n de Material","Inventario","Proyectos");                     $menunombres_en= array(      "");
		    
/*		    $menuitems = array("inicio", "formularios","investigacion","reservas_laboratorios","asig_docencia","listas_distribucion","correo","consejo","comision","tecnicos","material","doctorado");
		    $menunombres= array("Inicio", "Formularios","Investigaci&oacute;n","Reservas de Salas y Laboratorios", "Asignaci&oacute;n de Docencia", "Listas De Distribucion", "Modificar Cuenta Correo","Consejo de Departamento","Comisiones de Departamento","T&eacute;cnicos de Laboratorio","Petici&oacute;n de Material","Doctorado");            
*/            
            $menuitems = array("inicio","asig_docencia","doctorado","consejo","comision","reservas_laboratorios","correo","listas_distribucion","tecnicos","material");
		    $menunombres= array("Inicio", "Asignaci&oacute;n de Docencia","Doctorado","Consejo de Departamento","Comisiones de Departamento", "Reservas de Salas y Laboratorios", "Modificar Cuenta Correo", "Listas De Distribucion","T&eacute;cnicos de Laboratorio","Petici&oacute;n de Material");
            $menunombres_en= array(      "");
		}else{
		    $menuitems = array("inicio", "normas");
		    $menunombres= array("Inicio", "Normas");
		    $menunombres_en= array(     "");
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
			if ($i==4)
			{
			    echo "<a href='mailto:buzonsugerencias@depeca.uah.es'>Buz&oacute;n De Sugerencias";
			}
			else{
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

$versioningles = str_replace (".php","_en.php",ROOT_ADDRchange . $_SERVER["PHP_SELF"]);


$versioncastellano = str_replace ("_en.php", ".php" ,ROOT_ADDRchange . $_SERVER["PHP_SELF"]);


			if ($idioma == "en"){
				echo "<a href='https://euler.depeca.uah.es/webmail/src/login.php' target='_blank'><img src=\"" . IMG_ADDR . "correo.gif\" alt=\"Click here for Email\" /></a>\n";
				//echo "<a href=\"" . $versioncastellano . "\"><img src=\"" . IMG_ADDR . "flag-es.gif\" alt=\"Haz Clic aqu&iacute; para Castellano\" /></a>\n";
				//echo "<img src=\"" . IMG_ADDR . "flag-en.gif\" alt=\"Click here for English\" />\n";
			}
			else{
			    echo "<a href='https://euler.depeca.uah.es/webmail/src/login.php' target='_blank'><img src=\"" . IMG_ADDR . "correo.gif\" alt=\"Click aqu&iacute; para ver Correo\" /></a>\n";
			    //echo "<img src=\"" . IMG_ADDR . "flag-es.gif\" alt=\"Haz Clic aqu&iacute; para Castellano\" />\n";
			    //echo "<a href=\"" . $versioningles . "\"><img src=\"" . IMG_ADDR . "flag-en.gif\" alt=\"Click here for English\" /></a>\n";
			}
		echo "</div>\n";
	echo "</div> <!-- fin de id=herramientas -->\n";

// menu


echo "<div id=\"menu-total\">\n";
echo "<div id=\"menu\">\n";

                        
                        echo "<br> \n";
                        echo "<br> \n";

			for($i=0 ; $i<=(count($menuitems) - 1) ; $i++){
                if ($i==5){
                    echo "<div class=\"menu-item\">\n";
                    echo "<a href=\"https://intranet.uah.es/formulario.asp\"> Formularios UAH </a></div>\n";
                } 
			echo "<div class=\"menu-item";
			if ($selmenu == $menuitems[$i]){
			echo "-sel";
			}
			echo "\">\n";
			if ($i==15 && ($usuario=='director'))
			{
			    echo "<a href=\"" . ROOT_ADDR . $menuitems[$i] . "/director";
				if ($idioma == "en"){
					echo "_en.php\">" . $menunombres_en[$i];
				}
				else{
					echo ".php\">" . $menunombres[$i];
				}


			}
			    else
			    {
				if ($i==15 && ($usuario=='sonia.castel' || $usuario=='m_jose'|| $usuario=='dori' || $usuario=='esteban'||$usuario=='javier.munoz'))
				{
				    echo "<a href=\"" . ROOT_ADDR . $menuitems[$i] . "/secretaria";
				    if ($idioma == "en"){
					echo "_en.php\">" . $menunombres_en[$i];
				    }
				    else{
					echo ".php\">" . $menunombres[$i];
				    }


				}
				else
				{
       
			echo "<a href=\"" . ROOT_ADDR . $menuitems[$i] . "/index";
				if ($idioma == "en"){
					echo "_en.php\">" . $menunombres_en[$i];
				}
				else{
					echo ".php\">" . $menunombres[$i];
				}
			    }
			    }
			echo "</a></div>\n";
                
                if ($i==2){
                    echo "<div class=\"menu-item\">\n";
                    echo "<a href=\"http://portal.depeca.uah.es:7783/portal/page?_pageid=128,1&_dad=portal&_schema=PORTAL\"> Trabajos fin de Grado / M&aacute;ster </a></div>\n";
                    echo "<hr /> \n";
                }
                if ($i==5){
                    echo "<div class=\"menu-item\">\n";
                    echo "<a href=\"https://euler.depeca.uah.es/webmail/src/login.php\"> Correo Webmail </a></div>\n";
                }
                if ($i==0||$i==4||$i==7||$i==8){
                    echo "<hr /> \n";
                }
			}
    
echo "<div class=\"menu-item\">\n";
echo "<a href=\"http://euler.depeca.uah.es/gestion/remanentes.php\"> Remanente inform&aacute;tico por profesor </a></div>\n";
echo "<hr /> \n";
echo "<br> \n";
echo "<br> \n";
echo "<br> \n";

echo "</div> <!-- fin de id=menu -->\n";

echo "<div id=\"menu2\">\n";

echo "<p align=\"center\"><b>DEPARTAMENTO DE ELECTRÓNICA<br />Carretera Madrid-Barcelona,<br /> Km 33,600. C.P.28871.<br /> Alcal&aacute; de Henares(Madrid) Tlfno.918856540</b></p>\n";

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

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


function abajo(){
global $idioma;
global $usuario;
echo "</div>  <!-- fin de id=contenido -->\n";
echo "</div> <!-- fin de id=contenido-total -->\n";
echo "<div id=\"estado\">\n";
    echo "<div id=\"validar\">\n";
    if ($idioma == "es"){
      echo "<font size='4' color='#FFFFFF'><b>BIENVENIDO A LA INTRANET $usuario </b></font>";
    }
    else{
      echo "<font size='4' color='#FFFFFF'><b>WELCOME TO INTRANET $usuario </b></font>";	
    }
    echo "<a href=\"http://validator.w3.org/check?uri=referer\">\n";
    echo "<img src=\"" . IMG_ADDR . "valid-xhtml10.gif\" alt=\"";
    
    if ($idioma == "es"){
      echo "Validar la p&aacute;gina XHTML 1.0 Strict!";	
    }
    else{
      echo "Validate the page XHTML 1.0 Strict!";	
    }
    echo "\" />\n";
    echo "</a>\n";
    echo "<a href=\"http://jigsaw.w3.org/css-validator/check/referer\" target=\"_blank\">\n";
    echo "<img src=\"" . IMG_ADDR . "vcss.gif\" alt=\"";
    if ($idioma == "es"){
      echo "Validar la p&aacute;gina CSS 2.0!";
    }
    else{
      echo "Validate the page CSS 2.0!";	
    }
    echo "\" />\n";
    echo "</a> \n";
    echo "</div> <!-- fin de id=validar -->\n";
    echo "&copy; Copyright Departamento de Electr&oacute;nica 2005 - " . date("Y") . "\n";
    echo "</div> <!-- fin de id=estado -->\n";
    echo "</div> <!-- fin de id=pagina -->\n";
    echo "</body>\n";
    echo "</html>\n";
}

function restringirAcceso($nivelNoPermitido){
  /////SESIÓN USUARIO Y CONTRASEÑA
    session_start();
    if((!isset($_SESSION["usuario"])) ||(!isset($_SESSION["nivel"])) ){
	header("Location: " . ROOT_ADDR . "");		
    }
    else{
		
	$usuario = $_SESSION["usuario"];
	$nivel = $_SESSION["nivel"];
	if($nivel == $nivelNoPermitido){
	    header("Location: " . ROOT_ADDR . "");
	}
//	else{
	//    header("Location: " . $_SERVER["PHP_SELF"]);
	//}
    }

}
