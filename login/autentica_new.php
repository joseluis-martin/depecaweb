<?php
// autentica_new.php

require_once("../core/biblioteca.inc.new.php");
include("../core/conexion.inc.new.php"); // Conexión con la base de datos
arriba("privada", "", "es", "Zona Privada");

session_start();

$user = $_POST['user'];
$pass = $_POST['pass'];

$login = $user; // user
$password = $pass; // password
$imap_server_address = "localhost"; // euler server a través del stunnel seguro P. Revenga
$imap_port = 143; // port

// Descriptor
$imap_stream = @fsockopen($imap_server_address, $imap_port, $error_number, $error_string, 15);
if (!$imap_stream) {
    echo "Could not start IMAP connection";
}
$server_info = fgets($imap_stream, 1024);

// Connection identifier
$prefixquery = uniqid("aa");
$query = $prefixquery . " LOGIN " . $login . " " . $password . " \r\n";

fputs($imap_stream, $query);
$read = fgets($imap_stream, 4096);
$results = explode(" ", $read);

// Check user
if (($results[0] == $prefixquery) && (strcasecmp($results[1], "OK") == 0) && (strcasecmp($results[2], "login") == 0)) {
    $user2 = $user . "@depeca.uah.es";

    $link = Conectarse();

    $sql = "SELECT * FROM personal";
    $result = mysqli_query($link, $sql);

    $usuarioEncontrado = false;
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $email = strtolower($row["email"]);
            $puesto = $row["puesto"];
            $usuario_bd = $row["usuario"];

            // Niveles asignados a los usuarios
            if ($usuario_bd == $user) {
                if (($puesto == "Director") || ($user == "revenga") || ($user == "mocana") || ($user == "dori") || ($user == "esteban") || ($user == "jlmartin")) {
                    $nivel = 0;
                } elseif ($puesto == "PAS") {
                    $nivel = 1;
                } else {
                    $nivel = 2;
                }
                $usuarioEncontrado = true;
            } else {
                // Asignación de nivel a los webmasters
                if (($user == "director") || ($user == "subdirector") || ($user == "secretario")) {
                    $nivel = 0;
                    $usuarioEncontrado = true;
                } else {
                    // Nivel -1 identifica a los usuarios sin privilegios
                    $nivel = -1;
                }
            }
            if ($usuarioEncontrado) {
                break;
            }
        }
    }

    if ($nivel != -1) {
        header("Location: " . ROOT_ADDR . "login/seleccion.php?usuario=$user&nivel=$nivel");
    } else {
        header("Location: " . ROOT_ADDR);
    }

    echo "<br />\n";
    echo "<br />\n";
    echo "<br />\n";
    echo "<br />\n";
    echo "<br />\n";
    echo "<table width='70%' border='1' align='center'>\n";
    echo "  <tr>\n";
    echo "    <td><table width='100%' border='0' align='center'>\n";
    echo "      <tr>\n";
    echo "        <td height='41'><div align='center'>\n";
    echo "          <p><span style='font-size:14px; font-family:Arial; color:#CC6900;'><b>USUARIO Y CONTRASEÑA CORRECTOS</b></span></p>\n";
    echo "        </div></td>\n";
    echo "      </tr>\n";
    echo "      <tr>\n";
    echo "        <td height='37' align='center'><span style='font-size:14px; font-family:Arial; color:#0073B4;'><a style='text-decoration:none' href='../privada/inicio/index.php?usuario=$user&nivel=$nivel'>ENTRAR</a></span>\n";
    echo "        </td>\n";
    echo "      </tr>\n";
    echo "    </table></td>\n";
    echo "  </tr>\n";
    echo "</table>\n";

    abajo();

    $_SESSION['user'] = $user;

    echo $user . " <br>";
} else {
    header("Location: " . ROOT_ADDR . "/login/index.php");

    echo "<br />\n";
    echo "<br />\n";
    echo "<br />\n";
    echo "<br />\n";
    echo "<br />\n";
    echo "<table width='70%' border='1' align='center'>\n";
    echo "  <tr>\n";
    echo "    <td><table width='100%' border='0' align='center'>\n";
    echo "      <tr>\n";
    echo "        <td height='41'><div align='center'>\n";
    echo "          <p><span style='font-size:14px; font-family:Arial; color:#CC6900;'><b>USUARIO Y CONTRASEÑA INCORRECTOS</b></span></p>\n";
    echo "        </div></td>\n";
    echo "      </tr>\n";
    echo "      <tr>\n";
    echo "        <td height='37' align='center'><span style='font-size:14px; font-family:Arial; color:#0073B4;'><a style='text-decoration:none' href='./index.php'>VOLVER</a></span>\n";
    echo "        </td>\n";
    echo "      </tr>\n";
    echo "    </table></td>\n";
    echo "  </tr>\n";
    echo "</table>\n";

    abajo();
}

// Logout to the IMAP server
$query = $prefixquery . "2 LOGOUT \r\n";
fputs($imap_stream, $query);
$read = fgets($imap_stream, 4096);
fclose($imap_stream);

