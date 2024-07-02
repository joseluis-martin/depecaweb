<?php

define("ROOT_ADDR", "/depeca/");
define("ROOT_ADDRsin", "/depeca");
define("ROOT_ADDRchange", "/");
define("CORE_ADDR", ROOT_ADDR . "core/");
define("CSS_ADDR", ROOT_ADDR . "css/");
define("IMG_ADDR", ROOT_ADDR . "img/");
define("DOC_ABS_RAIZ", "/srv/www/htdocs");

$idioma = "en";

// Conexión a la base de datos
function Conectarse() {
    $link = mysqli_connect("localhost", "usuario", "contraseña", "base_de_datos");
    if (!$link) {
        die('Error de Conexión (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
    }
    return $link;
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function calculo_curso() {
    $anio2 = date("Y");
    $mes = date("m");
    $dia = date("d");
    $link = Conectarse();
    if ($mes >= 7) {
        $anio3 = $anio2 . "/" . ($anio2 + 1);
    } else {
        $anio3 = ($anio2 - 1) . "/" . $anio2;
    }
    $sql_fecha = "SELECT * FROM curso_academico WHERE curso='$anio3'";
    $resul_fecha = mysqli_query($link, $sql_fecha);
    $row_fecha = mysqli_fetch_array($resul_fecha);
    $fecha_cambio = explode("-", $row_fecha['inicio']);

    if ($mes > $fecha_cambio[1]) {
        $aniop = $anio2 . "/" . ($anio2 + 1);
    } else {
        if ($mes == $fecha_cambio[1]) {
            if ($dia >= $fecha_cambio[0]) {
                $aniop = $anio2 . "/" . ($anio2 + 1);
            } else {
                $aniop = ($anio2 - 1) . "/" . $anio2;
            }
        } else {
            $aniop = ($anio2 - 1) . "/" . $anio2;
        }
    }
    return $aniop;
}

function saludo($mayuscula) {
    $saludo = $mayuscula ? "B" : "b";
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

function cambiaf_a_normal($fecha) { 
    $mifecha = date_parse_from_format("Y-m-d", $fecha);
    return sprintf('%02d/%02d/%04d', $mifecha['day'], $mifecha['month'], $mifecha['year']);
}

function cambiaf_a_mysql($fecha) { 
    $mifecha = date_parse_from_format("d/m/Y", $fecha);
    return sprintf('%04d-%02d-%02d', $mifecha['year'], $mifecha['month'], $mifecha['day']);
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

function fecha($idiomafecha) {
    $dias_es = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
    $meses_es = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");
    $dias_en = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
    $meses_en = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

    $dia_semana = date("w");
    $dia_mes = date("j");
    $mes = date("n");
    $anio = date("Y");

    if ($idiomafecha == "es") {
        return "{$dias_es[$dia_semana]}, {$dia_mes} de {$meses_es[$mes - 1]} de {$anio}.";
    } else {
        $superindice = ($dia_mes == 1 || $dia_mes == 21 || $dia_mes == 31) ? "st" : (($dia_mes == 2 || $dia_mes == 22) ? "nd" : "th");
        return "{$dias_en[$dia_semana]}, the {$dia_mes}<span class=\"superindice\">{$superindice}</span> of {$meses_en[$mes - 1]} {$anio}.";
    }
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

function arriba($selherr, $selmenu, $lenguaje, $titulo) { 
    global $idioma;
    $idioma = $lenguaje;
    $herritems = ["login"];
    $herrnombres = ["Login"];
    $herrnombres_en = ["Login"];

    echo "<!DOCTYPE html>\n";
    echo "<html lang=\"en\">\n";
    echo "<head>\n";
    echo "<meta charset=\"iso-8859-1\">\n";
    echo "<meta name=\"author\" content=\"Beatriz Heredia\">\n";
    echo "<meta name=\"keywords\" content=\"Departamento de Electrónica, uah, docencia, depeca\">\n";
    echo "<link rel=\"stylesheet\" href=\"" . CSS_ADDR . "beatriz.css\" type=\"text/css\">\n";
    echo "<link rel=\"stylesheet\" href=\"" . CSS_ADDR . "Estilos.css\" type=\"text/css\">\n";
    echo "<link rel=\"stylesheet\" href=\"" . CSS_ADDR . "estilo.css\" type=\"text/css\">\n";
    echo "<link rel=\"stylesheet\" href=\"" . CSS_ADDR . "tema_normal.css\" type=\"text/css\">\n";
    echo "<title>{$titulo}</title>\n";
    echo "<link rel=\"shortcut icon\" href=\"" . IMG_ADDR . "depesc.png\">\n";
    echo "</head>\n";
    echo "<body>\n";
    echo "<div id=\"pagina\">\n";
    echo "<div id=\"top\">\n";
    echo "<div id=\"titulo\"></div><!-- fin de id=titulo -->\n";
    echo "</div><!-- fin de id=top -->\n";
    echo "<div id=\"herramientas\">\n";

    for ($i = 0; $i < count($herritems); $i++) {
        echo "<div class=\"herramientas-item" . ($selherr == $herritems[$i] ? "-sel" : "") . "\">\n";
        if ($i == 3) {
            echo "<a href='mailto:buzonsugerencias@depeca.uah.es'>" . ($idioma == "es" ? "Buzón De Sugerencias" : "Suggestion Mailbox") . "</a></div>";
        } else {
            echo "<a href=\"" . ROOT_ADDR . $herritems[$i] . "/index" . ($idioma == "en" ? "_en.php\">" . $herrnombres_en[$i] : ".php\">" . $herrnombres[$i]) . "</a></div>";
        }
    }

    echo "<div id=\"idiomas\">\n";
    $versioningles = str_replace(".php", "_en.php", $_SERVER["PHP_SELF"]);
    $versioncastellano = str_replace("_en.php", ".php", $_SERVER["PHP_SELF"]);
    $ph = explode('?', $_SERVER['REQUEST_URI']);
    $versioningles .= "?" . $ph[1];
    $versioncastellano .= "?" . $ph[1];

    if ($idioma == "en") {
        echo "<a href=\"" . $versioncastellano . "\"><img src=\"" . IMG_ADDR . "flag-es.gif\" alt=\"Haz Clic aquí para Castellano\"></a>\n";
    } else {
        echo "<img src=\"" . IMG_ADDR . "flag-es.gif\" alt=\"Haz Clic aquí para Castellano\">\n";
    }
    echo "</div>\n";
    echo "</div><!-- fin de id=herramientas -->\n";

    echo "<div id=\"menu-total\">\n";
    echo "<div id=\"menu\">\n";
    echo "<br><br>\n";
    // Aquí deberías definir $menuitems y $menunombres o $menunombres_en como corresponda
    // ...
    echo "<br><br><br>\n";
    echo "</div><!-- fin de id=menu -->\n";

    echo "<div id=\"menu2\">\n";
    if ($idioma == 'es') {
        echo "<p align=\"center\"><b>DEPARTAMENTO DE ELECTRÓNICA<br>Carretera Madrid-Barcelona,<br> Km 33,600. C.P.28871.<br> Alcalá de Henares(Madrid) Tlfno.918856540</b></p>\n";
    } else {
        echo "<p align=\"center\"><b>ELECTRONICS DEPARTMENT<br>Madrid-Barcelona Road,<br> Km 33,600. C.P.28871.<br> Alcalá de Henares(Madrid) Phone 918856540</b></p>\n";
    }
    echo "</div><!-- fin de id=menu2 -->\n";
    echo "</div><!-- fin de id=menu-total -->\n";

    echo "<div id=\"contenido-total\">\n";
    echo "<div id=\"titulo-contenido\">\n";
    echo "<div class=\"floatleft\">.:&nbsp;</div>\n";
    echo "<div class=\"firstletter\">{$titulo}</div>\n";
    echo "<div id=\"fecha\">" . fecha($idioma) . "</div>\n";
    echo "</div>\n";
    echo "<div id=\"contenido\">\n";
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

function arribaseleccion($selherr, $selmenu, $lenguaje, $titulo) { 
    global $idioma;
    global $usuario;
    global $nivel;
    global $ver;
    $idioma = $lenguaje;
    $herritems = ["privada/intranet/inicio", "../login"];
    $herrnombres = ["Intranet", "Logout"];
    $herrnombres_en = ["Intranet", "Logout"];
    $menuitems = ["privada/intranet/inicio", "../login"];
    $menunombres = ["Intranet"];
    $menunombres_en = ["Intranet"];
    $tema_valor = ["rojo", "verde", "normal"];
    $tema = ["Rojo", "Verde", "Azul"];
    $tema_en = ["Red", "Green", "Blue"];

    session_start();

    if (!isset($_SESSION["usuario"]) || !isset($_SESSION["nivel"])) {
        header("Location: " . ROOT_ADDR);
        exit();
    } else {
        $usuario = $_SESSION["usuario"];
        $nivel = $_SESSION["nivel"];
    }

    if (isset($_GET['usuario']) || isset($_GET['nivel'])) {
        $_SESSION["usuario"] = $_GET['usuario'];
        $_SESSION["nivel"] = $_GET['nivel'];
        header("Location: " . $_SERVER["PHP_SELF"]);
        exit();
    }

    echo "<!DOCTYPE html>\n";
    echo "<html lang=\"en\">\n";
    echo "<head>\n";
    echo "<meta charset=\"iso-8859-1\">\n";
    echo "<meta name=\"author\" content=\"Beatriz Heredia\">\n";
    echo "<meta name=\"keywords\" content=\"Cosas\">\n";
    echo "<link rel=\"stylesheet\" href=\"" . CSS_ADDR . "beatriz.css\" type=\"text/css\">\n";
    echo "<link rel=\"stylesheet\" href=\"" . CSS_ADDR . "estilo.css\" type=\"text/css\">\n";
    echo "<link rel=\"stylesheet\" href=\"" . CSS_ADDR . "Estilos.css\" type=\"text/css\">\n";
    echo "<link rel=\"stylesheet\" href=\"" . CSS_ADDR . "tema_rojo.css\" type=\"text/css\">\n";
    echo "<title>{$titulo}</title>\n";
    echo "<link rel=\"shortcut icon\" href=\"" . IMG_ADDR . "depesc.png\">\n";
    echo "</head>\n";
    echo "<body>\n";
    echo "<div id=\"pagina\">\n";
    echo "<div id=\"top\">\n";
    echo "<div id=\"titulo\"></div><!-- fin de id=titulo -->\n";
    echo "</div><!-- fin de id=top -->\n";
    echo "<div id=\"herramientas\">\n";

    for ($i = 0; $i < count($herritems); $i++) {
        echo "<div class=\"herramientas-item" . ($selherr == $herritems[$i] ? "-sel" : "") . "\">\n";
        echo "<a href=\"" . ROOT_ADDR . $herritems[$i] . "/index" . ($idioma == "en" ? "_en.php\">" . $herrnombres_en[$i] : ".php\">" . $herrnombres[$i]) . "</a></div>";
    }

    echo "<div id=\"idiomas\">\n";
    $versioningles = str_replace(".php", "_en.php", ROOT_ADDRchange . $_SERVER["PHP_SELF"]);
    $versioncastellano = str_replace("_en.php", ".php", ROOT_ADDRchange . $_SERVER["PHP_SELF"]);
    $ph = explode('?', $_SERVER['REQUEST_URI']);
    $versioningles .= "?" . $ph[1];
    $versioncastellano .= "?" . $ph[1];

    if ($idioma == "en") {
        echo "<a href=\"" . $versioncastellano . "\"><img src=\"" . IMG_ADDR . "flag-es.gif\" alt=\"Haz Clic aquí para Castellano\"></a>\n";
    } else {
        echo "<img src=\"" . IMG_ADDR . "flag-es.gif\" alt=\"Haz Clic aquí para Castellano\">\n";
    }
    echo "</div>\n";
    echo "</div><!-- fin de id=herramientas -->\n";

    echo "<div id=\"menu-total\">\n";
    echo "<div id=\"menu\">\n";
    echo "<br><br>\n";
    for ($i = 0; $i < count($menuitems); $i++) {
        echo "<div class=\"menu-item" . ($selmenu == $menuitems[$i] ? "-sel" : "") . "\">\n";
        echo "<a href=\"" . ROOT_ADDR . $menuitems[$i] . "/index" . ($idioma == "en" ? "_en.php\">" . $menunombres_en[$i] : ".php\">" . $menunombres[$i]) . "</a></div>\n";
    }
    echo "<br><br><br>\n";
    echo "</div><!-- fin de id=menu -->\n";

    echo "<div id=\"menu2\">\n";
    if ($idioma == 'es') {
        echo "<p align=\"center\"><b>DEPARTAMENTO DE ELECTRÓNICA<br>Carretera Madrid-Barcelona,<br> Km 33,600. C.P.28871.<br> Alcalá de Henares(Madrid) Tlfno.918856540</b></p>\n";
    } else {
        echo "<p align=\"center\"><b>ELECTRONICS DEPARTMENT<br>Madrid-Barcelona Road,<br> Km 33,600. C.P.28871.<br> Alcalá de Henares(Madrid) Phone 918856540</b></p>\n";
    }
    echo "</div><!-- fin de id=menu2 -->\n";
    echo "</div><!-- fin de id=menu-total -->\n";

    echo "<div id=\"contenido-total\">\n";
    echo "<div id=\"titulo-contenido\">\n";
    echo "<div class=\"floatleft\">.:&nbsp;</div>\n";
    echo "<div class=\"firstletter\">{$titulo}</div>\n";
    echo "<div id=\"fecha\">" . fecha($idioma) . "</div>\n";
    echo "</div>\n";
    echo "<div id=\"contenido\">\n";
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

function abajo() {
    echo "</div><!-- fin de id=contenido -->\n";
    echo "</div><!-- fin de id=contenido-total -->\n";
    echo "<div id=\"estado\">\n";
    echo "<div id=\"validar\">\n";
    echo "<a href=\"http://validator.w3.org/check?uri=referer\">\n";
    echo "<img src=\"" . IMG_ADDR . "valid-xhtml10.gif\" alt=\"";
    global $idioma;
    echo ($idioma == "en" ? "Validate the page XHTML 1.0 Strict!" : "Validar la página XHTML 1.0 Strict!") . "\" />\n";
    echo "</a>\n";
    echo "<a href=\"http://jigsaw.w3.org/css-validator/check/referer\" target=\"_blank\">\n";
    echo "<img src=\"" . IMG_ADDR . "vcss.gif\" alt=\"";
    echo ($idioma == "en" ? "Validate the page CSS 2.0!" : "Validar la página CSS 2.0!") . "\" />\n";
    echo "</a>\n";
    echo "</div><!-- fin de id=validar -->\n";
    echo "&copy; Copyright " . ($idioma == "en" ? "Electronics Department" : "Departamento de Electrónica") . " 2005 - " . date("Y") . "\n";
    echo "</div><!-- fin de id=estado -->\n";
    echo "</div><!-- fin de id=pagina -->\n";
    echo "</body>\n";
    echo "</html>\n";
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

function session_started() {
    return session_status() === PHP_SESSION_ACTIVE;
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

function getCodigoClon($codigo) {
    $linka = Conectarse();
    $sqla = "SELECT * FROM clones WHERE codigo='$codigo'";
    $resulta = mysqli_query($linka, $sqla);
    if ($row = mysqli_fetch_array($resulta)) {
        return $row["codigo_clon"];
    }
    return $codigo;
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

function enlacesDoctorado() {
    echo "<table class=\"tabla\">\n";
    echo "<tr valign=\"top\">\n";
    echo "<td>\n";
    echo "<table class=\"fondo2\">\n";
    echo "<tr>\n";
    echo "<td align=\"center\"><font class=\"fuentegris\"><b>ESTUDIOS DE DOCTORADO (RD.1393/2007)</b></font></td>\n";
    echo "</tr>\n";
    echo "</table>\n";
    echo "<br />\n";
    echo "<table class=\"tabla\">\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./presentacion.php'><b>Presentación</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./formativo.php'><b>Período formativo</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./tesis.php'><b>Tesis Doctorales</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./garantia.php'><b>Garantía de Calidad</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./objetivos.php'><b>Objetivos y Competencias</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./investigador.php'><b>Período Investigador</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./enlaces.php'><b>Enlaces de Interés</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./admision.php'><b>Admisión y Matrícula</b></a></font></td></tr>\n";
    echo "<tr><td bgcolor=\"#F8F3E4\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./proyectos.php'><b>Proyectos de Investigación</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./entidades.php'><b>Entidades Colaboradoras</b></a></font></td></tr>\n";
    echo "</table>\n";
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

function enlacesDoctorado_ingles() {
    echo "<table class=\"tabla\">\n";
    echo "<tr valign=\"top\">\n";
    echo "<td>\n";
    echo "<table class=\"fondo2\">\n";
    echo "<tr>\n";
    echo "<td align=\"center\"><font class=\"fuentegris\"><b>PHD (RD.1393/2007)</b></font></td>\n";
    echo "</tr>\n";
    echo "</table>\n";
    echo "<br />\n";
    echo "<table class=\"tabla\">\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./presentacion_en.php'><b>Presentation</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./formativo_en.php'><b>Formative Period</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./tesis_en.php'><b>Doctoral Thesis</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./garantia_en.php'><b>Quality Assurance</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./objetivos_en.php'><b>Goals & Skills</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./investigador_en.php'><b>Research Period</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./enlaces_en.php'><b>Links of Interest</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./admision_en.php'><b>Admission & Registration</b></a></font></td></tr>\n";
    echo "<tr><td bgcolor=\"#F8F3E4\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./proyectos_en.php'><b>Research Projects</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./entidades_en.php'><b>Associates</b></a></font></td></tr>\n";
    echo "</table>\n";
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
/*Funcion que pinta las pestañas de docencia*/
function pintarPestanas($cod, $selec, $titulacion) {
    $textoinfo = "";
    $textoprof = "";
    $textometod = "";
    $textoobj = "";
    $textotema = "";
    $textoeval = "";
    $textobiblio = "";
    $textoenlaces = "";
    $textoalum = "class=\"distinto\"";
    switch ($selec) {
        case "informacion":
            $textoinfo = "class=\"seleccionada\"";
            break;
        case "profesorado":
            $textoprof = "class=\"seleccionada\"";
            break;
        case "objetivos":
            $textoobj = "class=\"seleccionada\"";
            break;
        case "metodologia":
            $textometod = "class=\"seleccionada\"";
            break;
        case "temario":
            $textotema = "class=\"seleccionada\"";
            break;
        case "evaluacion":
            $textoeval = "class=\"seleccionada\"";
            break;
        case "bibliografia":
            $textobiblio = "class=\"seleccionada\"";
            break;
        case "enlaces":
            $textoenlaces = "class=\"seleccionada\"";
            break;
        case "alumnos":
            $textoalum = "class=\"seleccionada\"";
            break;
    }
    echo "<div id=\"tabs1\">\n";
    echo "<img class=\"left\" src=\"../img/docencia_pest.jpg\" alt=\" \" />\n";
    echo "<ul>\n";
    echo "<li><a {$textoinfo} href=\"informacion.php?codigo={$cod}&titulacion={$titulacion}\" title=\"\"><span>Información</span></a></li>\n";
    echo "<li><a {$textoprof} href=\"profesorado.php?codigo={$cod}&titulacion={$titulacion}\" title=\"\"><span>Profesorado</span></a></li>\n";
    echo "<li><a {$textoobj} href=\"objetivos.php?codigo={$cod}&titulacion={$titulacion}\" title=\"\"><span>Objetivos</span></a></li>\n";
    echo "<li><a {$textotema} href=\"temario.php?codigo={$cod}&titulacion={$titulacion}\" title=\"\"><span>Temario</span></a></li>\n";
    echo "<li><a {$textometod} href=\"metodologia.php?codigo={$cod}&titulacion={$titulacion}\" title=\"\"><span>Metodología</span></a></li>\n";
    echo "<li><a {$textoeval} href=\"evaluacion.php?codigo={$cod}&titulacion={$titulacion}\" title=\"\"><span>Evaluación</span></a></li>\n";
    echo "<li><a {$textobiblio} href=\"bibliografia.php?codigo={$cod}&titulacion={$titulacion}\" title=\"\"><span>Bibliografía</span></a></li>\n";
    echo "<li><a {$textoenlaces} href=\"enlaces.php?codigo={$cod}&titulacion={$titulacion}\" title=\"\"><span>Enlaces</span></a></li>\n";
    echo "<li><a {$textoalum} href=\"./alumnos.php?codigo={$cod}&titulacion={$titulacion}\" title=\"\"><span><b>Alumnos</b></span></a></li>\n";
    echo "</ul>\n";
    echo "</div>\n";
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
/*Funcion que pinta las pestañas de docencia en inglés*/
function pintarPestanasE($cod, $selec, $titulacion) {
    $textoinfo = "";
    $textoprof = "";
    $textometod = "";
    $textoobj = "";
    $textotema = "";
    $textoeval = "";
    $textobiblio = "";
    $textoenlaces = "";
    $textoalum = "class=\"distinto\"";
    switch ($selec) {
        case "info":
            $textoinfo = "class=\"seleccionada\"";
            break;
        case "faculty":
            $textoprof = "class=\"seleccionada\"";
            break;
        case "goals":
            $textoobj = "class=\"seleccionada\"";
            break;
        case "methodology":
            $textometod = "class=\"seleccionada\"";
            break;
        case "agenda":
            $textotema = "class=\"seleccionada\"";
            break;
        case "evaluation":
            $textoeval = "class=\"seleccionada\"";
            break;
        case "bibliography":
            $textobiblio = "class=\"seleccionada\"";
            break;
        case "links":
            $textoenlaces = "class=\"seleccionada\"";
            break;
        case "students":
            $textoalum = "class=\"seleccionada\"";
            break;
    }
    echo "<div id=\"tabs1\">\n";
    echo "<img class=\"left\" src=\"../img/docencia_pest.jpg\" alt=\" \" />\n";
    echo "<ul>\n";
    echo "<li><a {$textoinfo} href=\"informacion_en.php?codigo={$cod}&titulacion={$titulacion}\" title=\"\"><span>Info</span></a></li>\n";
    echo "<li><a {$textoprof} href=\"profesorado_en.php?codigo={$cod}&titulacion={$titulacion}\" title=\"\"><span>Staff</span></a></li>\n";
    echo "<li><a {$textoobj} href=\"objetivos_en.php?codigo={$cod}&titulacion={$titulacion}\" title=\"\"><span>Goals</span></a></li>\n";
    echo "<li><a {$textotema} href=\"temario_en.php?codigo={$cod}&titulacion={$titulacion}\" title=\"\"><span>Agenda</span></a></li>\n";
    echo "<li><a {$textometod} href=\"metodologia_en.php?codigo={$cod}&titulacion={$titulacion}\" title=\"\"><span>Methodology</span></a></li>\n";
    echo "<li><a {$textoeval} href=\"evaluacion_en.php?codigo={$cod}&titulacion={$titulacion}\" title=\"\"><span>Evaluation</span></a></li>\n";
    echo "<li><a {$textobiblio} href=\"bibliografia_en.php?codigo={$cod}&titulacion={$titulacion}\" title=\"\"><span>Bibliography</span></a></li>\n";
    echo "<li><a {$textoenlaces} href=\"enlaces_en.php?codigo={$cod}&titulacion={$titulacion}\" title=\"\"><span>Links</span></a></li>\n";
    echo "<li><a {$textoalum} href=\"./alumnos_en.php?codigo={$cod}&titulacion={$titulacion}\" title=\"\"><span><b>Students</b></span></a></li>\n";
    echo "</ul>\n";
    echo "</div>\n";
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
/*Funcion que pinta la tabla con los enlaces del master */
function enlacesMaster($cod) {
    echo "<table class=\"tabla\">\n";
    echo "<tr valign=\"top\">\n";
    echo "<td>\n";
    echo "<table class=\"fondo2\">\n";
    echo "<tr>\n";
    echo "<td align=\"center\"><font class=\"fuentegris\"><b>MÁSTER UNIVERSITARIO EN</b><br /><b>SISTEMAS ELECTRÓNICOS AVANZADOS.SISTEMAS INTELIGENTES<br />Mención de calidad ANECA curso 2010/2011 (MCD2006/00373)</b></font></td>\n";
    echo "</tr>\n";
    echo "</table>\n";
    echo "<br /><br /><br /><br /><br />\n";
    echo "<table class=\"tabla\">\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master11.php?codigo=$cod'><b>Datos Identificativos</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style='text-decoration:none' href='/depeca/repositorio/horarios/acogidanuevoingresomusea11-12.pdf'><b> Descargar documento</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master12.php?codigo=$cod'><b>Créditos</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master13.php?codigo=$cod'><b>Datos Prácticos</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='http://www.uah.es/postgrado/ESTOFPOSTG/docs/precios_publicos.pdf'><b>Precio</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master15.php?codigo=$cod'><b>Público a quién va dirigido</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master16.php?codigo=$cod'><b>Objetivos</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='carrerasm0910.php?codigo=$cod'><b>Plan de Estudios:&nbsp;&nbsp;&nbsp;&nbsp; 12/13</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style='text-decoration:none' href='carrerasm0910.php?codigo=$cod'><b>11/12</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style='text-decoration:none' href='carrerasm0910.php?codigo=$cod'><b>10/11</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='carrerasm0910.php?codigo=$cod'><b>09/10</b></a><a style='text-decoration:none' href='/depeca/repositorio/electronicaasignaturas.pdf'><b>&nbsp;&nbsp;&nbsp;&nbsp; 08/09</b></a>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master18.php?codigo=$cod'><b>Requisitos de Admisión</b></a></font></td></tr>\n";
    echo "<tr><td bgcolor=\"#F8F3E4\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master19.php?codigo=$cod'><b>Criterios de Admisión y Selección</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master110.php?codigo=$cod'><b>Documentación que debe aportarse</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master112.php?codigo=$cod'><b>Reclamaciones</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master111.php?codigo=$cod'><b>Otros datos referentes al programa</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='mailto:buzonsugerencias@depeca.uah.es'><b>Buzón de Sugerencias</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='../repositorio/horarios/Horarios_MUSEA90ECTS_2013_14.pdf'><b>Horario Curso 2013/2014 Semestre 1 </b></a></font></td></tr>\n";
    echo "</table>\n";
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

function enlacesMaster3($cod) {
    $curso = calculo_curso();
    echo "<table class='tabla'>\n";
    echo "<tr valign=\"top\">\n";
    echo "<td>\n";
    echo "<table class=\"fondo2\">\n";
    echo "<tr>\n";
    echo "<td align=\"center\"><font class=\"fuentegris\"><b>MÁSTER UNIVERSITARIO EN</b><br /><b>SISTEMAS ELECTRÓNICOS AVANZADOS.SISTEMAS INTELIGENTES<br />Mención de calidad ANECA curso 2014/2015 (MCD2006/00373)</b></font><font color='red'><b> Nuevo</b></font></td>\n";
    echo "</tr>\n";
    echo "</table>\n";
    echo "<br /><br /><br /><br /><br />\n";
    echo "<table class='tabla'>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master1111.php?codigo=$cod'><b>Datos identificativos</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='/depeca/repositorio/horarios/comisiones_musea.pdf'><b>Comisiones</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master121.php?codigo=$cod'><b>Créditos: &nbsp;&nbsp;&nbsp; 60 ECTS</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master131.php?codigo=$cod'><b>Datos Prácticos</b></a></font></td></tr>\n";
    echo "<tr><td bgcolor=\"#F8F3E4\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='https://portal.uah.es/portal/page/portal/posgrado/masteres_universitarios/documentos/precios_publicos.pdf'><b>Precio</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master151.php?codigo=$cod'><b>Público a quién va dirigido</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master161.php?codigo=$cod'><b>Objetivos</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='carrerasm0910.php?codigo=$cod&curso=2014/2015'><b>Plan de Estudios:&nbsp;&nbsp;&nbsp;&nbsp; 14/15</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style='text-decoration:none' href='carrerasm0910.php?codigo=$cod&curso=2013/2014'><b>13/14</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='https://portal.uah.es/portal/page/portal/posgrado/masteres_universitarios/preinscripcion_admision/requisitos_acceso'><b>Requisitos de Acceso</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master191.php?codigo=$cod'><b>Criterios de Admisión y Selección</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='https://portal.uah.es/portal/page/portal/posgrado/masteres_universitarios/preinscripcion_admision/documentacion_requerida'><b>Documentación requerida</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master1121.php?codigo=$cod'><b>Reclamaciones</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><b>Horarios Curso 14/15</b> <br><a style='text-decoration:none' href='/depeca/repositorio/horarios/Semestre1_MUSEA_2014_2015_vprint.pdf'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Semestre 1  </a><a style='text-decoration:none' href='/depeca/repositorio/horarios/Semestre2_MUSEA_2014_2015_vprint.pdf'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Semestre 2  </a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><b>Reconocimiento de créditos: </b><a style='text-decoration:none' href='http://www.uah.es/archivos_posgrado/MU/Unico/AM128_3_3_1_E_MU%20SIST%20ELECTRONICOS%20AVANZ_TABLA%20RECONOCIMIENTO%20CREDITOS_MODIFCEOP_15_05_14.pdf'><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tabla</b></a>   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a style='text-decoration:none' href='https://portal.uah.es/portal/page/portal/posgrado/documentos/normativa_reconocimiento_creditos.pdf'><b>Normativa</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><b>Calendario de pruebas y exámenes 2014/2015</b> <br>\n";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='/depeca/repositorio/horarios/Actividad_MUSEA_2014_15_1C.pdf'>Semestre 1</a></font>\n";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='/depeca/repositorio/horarios/Actividad_MUSEA_2014_15_2C.pdf'>Semestre 2</a></font>\n";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='/depeca/repositorio/horarios/Actividad_MUSEA_2014_15_Ext.pdf'>Extraordinaria</a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='https://portal.uah.es/portal/page/portal/posgrado/masteres_universitarios/oferta#cod_estudio=M128'><b>Para más información</b></a></font></td></tr>\n";
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

function enlacesMaster4($cod) {
    $curso = calculo_curso();
    echo "<table class='tabla'>\n";
    echo "<tr valign=\"top\">\n";
    echo "<td>\n";
    echo "<table class=\"fondo2\">\n";
    echo "<tr>\n";
    echo "<td align=\"center\"><font class=\"fuentegris\"><b>MÁSTER UNIVERSITARIO DE INGENIERÍA DE TELECOMUNICACIÓN (MUIT)</b><br /><b><br /></b></font><font color='red'></font></td>\n";
    echo "</tr>\n";
    echo "</table>\n";
    echo "<br /><br /><br /><br /><br />\n";
    echo "<table class='tabla'>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./muit1.php?codigo=$cod'><b>Datos Identificativos</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./muit2.php'><b>Créditos</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./muit3.php'><b>Datos Prácticos</b></a></font></td></tr>\n";
    echo "<tr><td bgcolor=\"#F8F3E4\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='http://portal.uah.es/portal/page/portal/posgrado/masteres_universitarios/matricula/pago_matricula'><b>Precio</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./muit4.php'><b>Público a quién va dirigido</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./muit5.php'><b>Objetivos</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='carrerasm0910.php?codigo=$cod&curso=2013/2014'><b>Plan de Estudios:&nbsp;&nbsp;&nbsp;&nbsp; 13/14</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./muit6.php'><b>Requisitos de Admisión</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./muit7.php'><b>Criterios de Admisión y Selección</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./muit8.php'><b>Documentación que debe aportarse</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./muit9.php'><b>Reclamaciones</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./muit10.php'><b>Otros datos referentes al programa</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='mailto:manuel.rosa@uah.es'><b>Buzón de Sugerencias</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\">Horario Curso 13/14 </font></td></tr>\n";
    echo "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='http://portal.uah.es/portal/page/portal/posgrado/masteres_universitarios/repositorio/ing_arq/Ingeniería%20de%20Telecomunicación'><b>Para más información</b></a></font></td></tr>\n";
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
/*Funcion que pinta la tabla con los enlaces del master en inglés*/
function enlacesMaster_ingles($cod) {
    echo "<table class=\"tabla\">\n";
    echo "<tr valign=\"top\">\n";
    echo "<td>\n";
    echo "<table class=\"fondo2\">\n";
    echo "<tr>\n";
    echo "<td align=\"center\"><font class=\"fuentegris\"><b>OFFICIAL MASTERS DEGREE IN</b><br /><b>ADVANCED ELECTRONIC SYSTEMS. INTELLIGENT SYSTEMS<br />ANECA Quality Mention for the year 2010/2011 (MCD2006/00373)</b></font></td>\n";
    echo "</tr>\n";
    echo "</table>\n";
    echo "<br /><br /><br /><br /><br />\n";
    echo "<table class=\"tabla\">\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master11_en.php?codigo=$cod'><b>Identification Details</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style='text-decoration:none' href='/depeca/repositorio/horarios/acogidanuevoingresomusea11-12.pdf'><b> Download</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master12_en.php'><b>Credits</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master13_en.php'><b>Practical Data</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='http://www.uah.es/postgrado/ESTOFPOSTG/docs/precios_publicos.pdf'><b>Price</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master15_en.php'><b>Target Public</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master16_en.php'><b>Objectives</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='carrerasm0910_en.php?codigo=$cod'><b>Master Program:&nbsp;&nbsp;&nbsp;&nbsp; 12/13</b></a></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style='text-decoration:none' href='carrerasm0910_en.php?codigo=$cod'><b>11/12</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style='text-decoration:none' href='carrerasm0910_en.php?codigo=$cod'><b>10/11</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='carrerasm0910_en.php?codigo=$cod'><b>09/10</b></a><a style='text-decoration:none' href='/depeca/repositorio/electronicaasignaturas.pdf'><b>&nbsp;&nbsp;&nbsp;&nbsp; 08/09</b></a>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master18_en.php'><b>Access Requirements</b></a></font></td></tr>\n";
    echo "<tr><td bgcolor=\"#F8F3E4\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master19_en.php'><b>Access and Selection Criteria</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master110_en.php'><b>Documentation to be provided</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master112_en.php'><b>Complaints</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='./master111_en.php'><b>Other Data relevant to the programme</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='mailto:buzonsugerencias@depeca.uah.es'><b>Suggestion Box</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\">Course Timetable 12/13 <a style='text-decoration:none' href='../repositorio/horarios/Semestre1MSEA2012-2013.pdf'><b>Semester 1 </b></a><a style='text-decoration:none' href='../repositorio/horarios/Semestre2MSEA2012-2013.pdf'><b>Semester 2</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='../repositorio/Convalidaciones_master.pdf'><b>Validations Master</b></a></font></td></tr>\n";
    echo "<tr><td class='celdaverde'><font class=\"fuenteazul\">Tests & Exams Calendar\n";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='/depeca/repositorio/horarios/ActividadMUSEA2012-131C.pdf'><b>First Semester</b></a></font>\n";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='/depeca/repositorio/horarios/ActividadMUSEA2012-132C.pdf'><b>Second Semester</b></a></font>\n";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font class=\"fuenteazul\"><a style='text-decoration:none' href='/depeca/repositorio/horarios/ActividadMUSEA2012-13Extraordinaria.pdf'><b>Extraordinary</b></a></font></td></tr>\n";
    echo "</table>\n";
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