<?php$queMuestro = isset($_POST['queMuestro']) ? $_POST['queMuestro'] : NULL;switch ($queMuestro) {    case "1"://LOGIN        require_once("clases/AccesoDatos.php");        require_once("clases/Usuario.php");        $usuario = isset($_POST['usuario']) ? json_decode(json_encode($_POST['usuario'])) : NULL;        //$usuario->email;        $usr = Usuario::TraerUsuarioLogueado($usuario);        $obj = new stdClass();        $obj->Exito = TRUE;        $obj->Mensaje = "";        if ($usr === FALSE) {            $obj->Exito = FALSE;            $obj->Mensaje = "Error!!!\nNO coincide email y password!!!";        } else {            $obj->Usuario = $usr;            $obj->Mensaje = "EXITO!!!\n Usuario logueado!!!";            session_start();                        $_SESSION["Usuario"] = json_encode($usr);        }        echo json_encode($obj);        break;    case "2"://LOGOUT        session_destroy();        break;    case "3"://MOSTRAR GRILLA        require_once("grilla.php");        break;    case "4"://MUESTRA FORM ALTA-MODIFICACION USUARIO        $usuario = isset($_POST["usuario"]) ? json_decode(json_encode($_POST["usuario"])) : NULL;        require_once("form.php");        break;    case "5"://SUBIR FOTO AL TMP        require_once("./clases/Archivo.php");        $res = Archivo::Subir();        echo json_encode($res);        break;    case "6"://ALTA USUARIO        $obj = new stdClass();        $obj->Exito = TRUE;        $obj->Mensaje = "";        $usuario = isset($_POST["usuario"]) ? json_decode(json_encode($_POST["usuario"])) : NULL;        require_once("clases/AccesoDatos.php");        require_once("clases/Usuario.php");        require_once("clases/Archivo.php");        $idUsuario = Usuario::Agregar($usuario);//alta en bd; //mover del tmp al final (la foto)//actualizar el campo foto        echo json_encode($obj);        break;    case "7"://ELIMINAR USUARIO        $obj = new stdClass();        $obj->Exito = TRUE;        $obj->Mensaje = "";        $usuario = isset($_POST["usuario"]) ? json_decode(json_encode($_POST["usuario"])) : NULL;        require_once("clases/AccesoDatos.php");        require_once("clases/Usuario.php");        require_once("clases/Archivo.php");//Eliminar de la bd//Eliminar foto del repositorio final        echo json_encode($obj);        break;            case "8"://MODIFICAR USUARIO        $obj = new stdClass();        $obj->Exito = TRUE;        $obj->Mensaje = "";        $usuario = isset($_POST["usuario"]) ? json_decode(json_encode($_POST["usuario"])) : NULL;        require_once("clases/AccesoDatos.php");        require_once("clases/Usuario.php");        require_once("clases/Archivo.php");//Actualizar en la bd y la foto        echo json_encode($obj);        break;    default:        echo ":(";}