<?php
// bibliotecaint.inc.new.php

include("./conexion.inc.new.php");

define("ROOT_ADDR", "/depeca/privada/intranet/");
define("ROOT_ADDRsin", "/depeca/privada/intranet/");
define("ROOT_ADDRchange", "/");
define("CORE_ADDR", ROOT_ADDR . "core/");
define("CSS_ADDR", ROOT_ADDR . "css/");
define("IMG_ADDR", ROOT_ADDR . "img/");

$idioma = "en";

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// added by P Revenga 12-05-2010
function get_puesto($link, $usuario) {
    $link = Conectarse();
    $query = "SELECT puesto, usuario FROM personal WHERE usuario = ?";
    $stmt = $link->prepare($query);
    $stmt->bind_param('s', $usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_row();
    return $row[0];
}

// added by P Revenga 12-05-2010
// devuelve true si el nivel y el usuario coinciden en la tabla, si no existen devuelve false
function acceso_nivel($nivel, $usuario) {
    $link = Conectarse();
    $query = "SELECT nivel, usuario FROM acceso_niveles WHERE usuario = ? AND nivel = ?";
    $stmt = $link->prepare($query);
    $stmt->bind_param('ss', $usuario, $nivel);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_row();
    return ($row[0] == $nivel);
}

function cambiaf_a_normal($fecha) { 
    if (preg_match("/([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})/", $fecha, $mifecha)) {
        $lafecha = $mifecha[3] . "/" . $mifecha[2] . "/" . $mifecha[1];
        return $lafecha; 
    }
    return $fecha;
} 

function cambiaf_a_mysql($fecha) { 
    if (preg_match("/([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})/", $fecha, $mifecha)) {
        $lafecha = $mifecha[3] . "-" . $mifecha[2] . "-" . $mifecha[1];
        return $lafecha; 
    }
    return $fecha;
} 

function cambiaf_a_mysql2($date) {
    $date = str_replace(['/', '.', '-'], '-', $date);
    list($anio, $mes, $dia) = explode('-', $date);
    if (strlen($dia) == 1) $dia = "0" . $dia;
    if (strlen($mes) == 1) $mes = "0" . $mes;
    $fecha = $anio . "-" . $mes . "-" . $dia;
    return $fecha;
}

function formato_hora($hour) {
    list($hora, $minutos) = explode(':', $hour);
    if (strlen($hora) == 1) $hora = "0" . $hora;
    if (strlen($minutos) == 0) $minutos = "00";
    $hora_final = $hora . ":" . $minutos;
    return $hora_final;
}
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

function saludo($mayuscula) { // 1 para tener mayuscula
    $saludo = $mayuscula == 1 ? "B" : "b";
    $hora = date("G");

    if ($hora >= 6 && $hora <= 12) {
        $saludo .= "uenos dias";
    } elseif ($hora >= 13 && $hora <= 19) {
        $saludo .= "uenas tardes";
    } else {
        $saludo .= "uenas noches";
    }
    return $saludo;
} 

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

// forma: Martes, 13 de junio de 2006

function fecha($idiomafecha) {
    $dias = $idiomafecha == "es" ? 
        ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"] : 
        ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    
    $meses = $idiomafecha == "es" ? 
        ["enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"] : 
        ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    
    $fecha = $dias[date("w")] . ", " . date("j") . " de " . $meses[date("n") - 1] . " de " . date("Y") . ".";
    
    return $fecha;
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

function arriba($selherr, $selmenu, $lenguaje, $titulo) {
    global $idioma;
    global $usuario;
    global $nivel;
    global $ver;
    
    $idioma = $lenguaje;
    $herritems = ["inicio", "enlaces", "../../login"];
    $herrnombres = ["Inicio", "Enlaces", "Logout"];
    $herrnombres_en = ["Start", "Links", "Logout"]; // Inicialización correcta
    
    $tema_valor = ["rojo", "verde", "normal"];
    $tema = ["Rojo", "Verde", "Azul"];
    $tema_en = ["Red", "Green", "Blue"];
    
    session_start();
    
    if (!isset($_SESSION["usuario"]) || !isset($_SESSION["nivel"])) {
        header("Location: " . ROOT_ADDR);
    } else {
        $usuario = $_SESSION["usuario"];
        $nivel = $_SESSION["nivel"];
    }
    
    if (isset($_GET['usuario']) || isset($_GET['nivel'])) {
        $_SESSION["usuario"] = $_GET['usuario'];
        $_SESSION["nivel"] = $_GET['nivel'];
        header("Location: " . $_SERVER["PHP_SELF"]);
    }
    
    if ($nivel != -1) {
        $menuitems = ["inicio", "asig_docencia", "doctorado", "consejo", "comision", "reservas_laboratorios", "correo", "listas_distribucion", "tecnicos", "material"];
        $menunombres = ["Inicio", "Asignación de Docencia", "Doctorado", "Consejo de Departamento", "Comisiones de Departamento", "Reservas de Salas y Laboratorios", "Modificar Cuenta Correo", "Listas De Distribucion", "Técnicos de Laboratorio", "Petición de Material"];
        $menunombres_en = ["Start", "Teaching Assignment", "Doctorate", "Department Council", "Department Committees", "Room and Lab Reservations", "Change Email Account", "Distribution Lists", "Lab Technicians", "Material Request"];
    } else {
        $menuitems = ["inicio", "normas"];
        $menunombres = ["Inicio", "Normas"];
        $menunombres_en = ["Start", "Norms"];
    }
    
    echo "<!DOCTYPE html>\n";
    echo "<html lang='en'>\n";
    echo "<head>\n";
    echo "<meta charset='iso8859-1'>\n";
    echo "<meta name='Author' content='Beatriz Heredia'>\n";
    echo "<meta name='keywords' content='Cosas'>\n";
    echo "<link rel='stylesheet' href='" . CSS_ADDR . "beatriz.css' type='text/css'>\n";
    echo "<link rel='stylesheet' href='" . CSS_ADDR . "estilo.css' type='text/css'>\n";
    echo "<link rel='stylesheet' href='" . CSS_ADDR . "Estilos.css' type='text/css'>\n";
    echo "<link rel='stylesheet' href='" . CSS_ADDR . "tema_rojo.css' type='text/css'>\n";
    echo "<title>" . $titulo . "</title>\n";
    echo "<link rel='SHORTCUT ICON' href='" . IMG_ADDR . "depesc.png'>\n";
    echo "</head>\n";
    echo "<body>\n";
    echo "<div id='pagina'>\n";
    echo "<div id='top'>\n";
    echo "<div id='titulo'></div>\n";
    echo "</div>\n";
    echo "<div id='herramientas'>\n";

    for ($i = 0; $i <= (count($herritems) - 1); $i++) {
        echo "<div class='herramientas-item";
        if ($selherr == $herritems[$i]) {
            echo "-sel";
        }
        echo "'>\n";
        echo "<a href='" . ROOT_ADDR . $herritems[$i] . "/index";
        echo ($idioma == "en") ? "_en.php'>" . $herrnombres_en[$i] : ".php'>" . $herrnombres[$i];
        echo "</a></div>";
    }

    echo "<div id='idiomas'>\n";
    $versioningles = str_replace(".php", "_en.php", ROOT_ADDRchange . $_SERVER["PHP_SELF"]);
    $versioncastellano = str_replace("_en.php", ".php", ROOT_ADDRchange . $_SERVER["PHP_SELF"]);

    if ($idioma == "en") {
        echo "<a href='https://euler.depeca.uah.es/webmail/src/login.php' target='_blank'><img src='" . IMG_ADDR . "correo.gif' alt='Click here for Email'></a>\n";
    } else {
        echo "<a href='https://euler.depeca.uah.es/webmail/src/login.php' target='_blank'><img src='" . IMG_ADDR . "correo.gif' alt='Click aquí para ver Correo'></a>\n";
    }
    echo "</div>\n";
    echo "</div>\n";

    echo "<div id='menu-total'>\n";
    echo "<div id='menu'>\n";
    echo "<br>\n";
    echo "<br>\n";

    for ($i = 0; $i <= (count($menuitems) - 1); $i++) {
        if ($i == 5) {
            echo "<div class='menu-item'>\n";
            echo "<a href='https://intranet.uah.es/formulario.asp'> Formularios UAH </a></div>\n";
        }
        echo "<div class='menu-item";
        if ($selmenu == $menuitems[$i]) {
            echo "-sel";
        }
        echo "'>\n";
        if ($i == 15 && ($usuario == 'director')) {
            echo "<a href='" . ROOT_ADDR . $menuitems[$i] . "/director";
            echo ($idioma == "en") ? "_en.php'>" . $menunombres_en[$i] : ".php'>" . $menunombres[$i];
        } else {
            if ($i == 15 && ($usuario == 'sonia.castel' || $usuario == 'm_jose' || $usuario == 'dori' || $usuario == 'esteban' || $usuario == 'javier.munoz')) {
                echo "<a href='" . ROOT_ADDR . $menuitems[$i] . "/secretaria";
                echo ($idioma == "en") ? "_en.php'>" . $menunombres_en[$i] : ".php'>" . $menunombres[$i];
            } else {
                echo "<a href='" . ROOT_ADDR . $menuitems[$i] . "/index";
                echo ($idioma == "en") ? "_en.php'>" . $menunombres_en[$i] : ".php'>" . $menunombres[$i];
            }
        }
        echo "</a></div>\n";

        if ($i == 2) {
            echo "<div class='menu-item'>\n";
            echo "<a href='http://portal.depeca.uah.es:7783/portal/page?_pageid=128,1&_dad=portal&_schema=PORTAL'> Trabajos fin de Grado / Máster </a></div>\n";
            echo "<hr>\n";
        }
        if ($i == 5) {
            echo "<div class='menu-item'>\n";
            echo "<a href='https://euler.depeca.uah.es/webmail/src/login.php'> Correo Webmail </a></div>\n";
        }
        if ($i == 0 || $i == 4 || $i == 7 || $i == 8) {
            echo "<hr>\n";
        }
    }

    echo "<div class='menu-item'>\n";
    echo "<a href='http://euler.depeca.uah.es/gestion/remanentes.php'> Remanente informático por profesor </a></div>\n";
    echo "<hr>\n";
    echo "<br>\n";
    echo "<br>\n";
    echo "<br>\n";
    echo "</div>\n";
    echo "<div id='menu2'>\n";
    echo "<p align='center'><b>DEPARTAMENTO DE ELECTRÓNICA<br>Carretera Madrid-Barcelona,<br> Km 33,600. C.P.28871.<br> Alcalá de Henares(Madrid) Tlfno.918856540</b></p>\n";
    echo "</div>\n";
    echo "</div>\n";
    echo "<div id='contenido-total'>\n";
    echo "<div id='titulo-contenido'>\n";
    echo "<div class='floatleft'>.:&nbsp;</div>\n";
    echo "<div class='firstletter'>" . $titulo . "</div>\n";
    echo "<div class='floatleft'>&nbsp;:.</div>\n";
    echo "<div id='fecha'>" . fecha($idioma) . "</div>\n";
    echo "</div>\n";
    echo "<div id='contenido'>\n";
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

function abajo() {
    global $idioma;
    global $usuario;
    echo "</div>\n";
    echo "</div>\n";
    echo "<div id='estado'>\n";
    echo "<div id='validar'>\n";
    if ($idioma == "es") {
        echo "<font size='4' color='#FFFFFF'><b>BIENVENIDO A LA INTRANET $usuario </b></font>";
    } else {
        echo "<font size='4' color='#FFFFFF'><b>WELCOME TO INTRANET $usuario </b></font>";
    }
    echo "<a href='http://validator.w3.org/check?uri=referer'>\n";
    echo "<img src='" . IMG_ADDR . "valid-xhtml10.gif' alt='";
    if ($idioma == "es") {
        echo "Validar la página XHTML 1.0 Strict!";
    } else {
        echo "Validate the page XHTML 1.0 Strict!";
    }
    echo "'>\n";
    echo "</a>\n";
    echo "<a href='http://jigsaw.w3.org/css-validator/check/referer' target='_blank'>\n";
    echo "<img src='" . IMG_ADDR . "vcss.gif' alt='";
    if ($idioma == "es") {
        echo "Validar la página CSS 2.0!";
    } else {
        echo "Validate the page CSS 2.0!";
    }
    echo "'>\n";
    echo "</a>\n";
    echo "</div>\n";
    echo "&copy; Copyright Departamento de Electrónica 2005 - " . date("Y") . "\n";
    echo "</div>\n";
    echo "</div>\n";
    echo "</body>\n";
    echo "</html>\n";
}

function restringirAcceso($nivelNoPermitido) {
    session_start();
    if (!isset($_SESSION["usuario"]) || !isset($_SESSION["nivel"])) {
        header("Location: " . ROOT_ADDR);
    } else {
        $usuario = $_SESSION["usuario"];
        $nivel = $_SESSION["nivel"];
        if ($nivel == $nivelNoPermitido) {
            header("Location: " . ROOT_ADDR);
        }
    }
}
