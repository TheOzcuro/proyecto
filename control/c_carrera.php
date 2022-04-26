<?php 
session_start();
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
$url=$_POST["url"];
if (isset($_POST["buscar_carrera"]) && $_POST["buscar_carrera"]!="") {
    $validate=$ejecutar->FindQuery("carrera","codigo", $_POST["buscar_carrera"]);
    if ($validate===2) {
       $_SESSION["error"]="El codigo que ingreso no existe";
       header("Location:../vista/administrador.php#$url");
    }
    else {
        $_SESSION["update"]=$validate;
        $_SESSION["container"]="carrera-container";
        header("Location:../vista/administrador.php#$url");
     }
}
else if (isset($_GET["buscar_carrera"]) && $_GET["buscar_carrera"]!="") {
    $validate=$ejecutar->FindQuery("carrera","codigo", $_GET["buscar_carrera"]);
    if ($validate===2) {
       $_SESSION["error"]="El codigo que ingreso no existe";
       header("Location:../vista/administrador.php#carrera-container-grid");
    }
    else {
        $_SESSION["update"]=$validate;
        $_SESSION["container"]="carrera-container";
        header("Location:../vista/administrador.php#carrera-container-grid");
     }
}
else if (isset($_POST["update"]) && $_POST["update"]!=""){
    $dato=$ejecutar->FindQuery("carrera","nombre",$_POST["nombre_carrera"]);
    $dato_origin=$ejecutar->FindQuery("carrera","codigo",$_POST["update"]);
    if ($dato[1]==$dato_origin[1] || $dato===2) {
        $validate=$ejecutar->UpdateTableCarrera($_POST["codigo_carrera"], $_POST["nombre_carrera"], $_POST["update"]);
    }
    if ($dato[1]!=$dato_origin[1] && $dato!==2) {
       $validate=3;
    }
    if ($validate===3) {
        $_SESSION["error"]="El nombre de carrera que ingreso ya existe";
        $_SESSION["container"]="carrera-container";
        $_SESSION["update"]=$ejecutar->FindQuery("carrera","codigo", $_POST["update"]);
        header("Location:../vista/administrador.php#$url");
    }
    else if ($validate===2) {
        $_SESSION["error"]="El codigo de carrera que ingreso ya existe";
        $_SESSION["container"]="carrera-container";
        $_SESSION["update"]=$ejecutar->FindQuery("carrera","codigo", $_POST["update"]);
        header("Location:../vista/administrador.php#$url");
    }
    else {
        $ejecutar->UpdateCampoHorario('carrera',$_POST["codigo_carrera"],$_POST["update"]);
        if ($_POST["codigo_carrera"]!=$_POST["update"]) {
            $ejecutar->UpdateTableCarreraPensum($_POST["update"],$_POST["codigo_carrera"]);
            $ejecutar->UpdateTableCarrerasOferta($_POST["update"],$_POST["codigo_carrera"]);
        }
        $_SESSION["completado"]="Los datos fueron actualizados correctamente";
        $_SESSION["container"]="carrera-container";
        $_SESSION["update"]=$ejecutar->FindQuery("carrera","codigo", $_POST["codigo_carrera"]);
        header("Location:../vista/administrador.php#$url");
    }
}
else if (isset($_POST["delete"]) && $_POST["delete"]!=""){
    $ejecutar->DeleteTable("pensum","pnf",$_POST["delete"]);
    $ejecutar->DeleteTable("oferta","pnf",$_POST["delete"]);
    $ejecutar->DeleteTable("carrera","codigo",$_POST["delete"]);
    $ejecutar->DeleteTable("horario_docente","carrera",$_POST["delete"]);
    $_SESSION["completado"]="Los datos fueron eliminados correctamente";
    header("Location:../vista/administrador.php#$url");
}

else {
    $dato=$ejecutar->FindQuery("carrera","nombre",$_POST["nombre_carrera"]);
    $validate=$ejecutar->registrarCarrera($_POST["codigo_carrera"],$_POST["nombre_carrera"]);
    if ($validate===2) {
        header("Location:../vista/administrador.php#$url");
        $_SESSION["error"]="El codigo de carrera que ingreso ya existe";
    }
    else if ($dato!==2) {
        header("Location:../vista/administrador.php#$url");
        $_SESSION["error"]="El nombre de carrera que ingreso ya existe";
    }
    else {
        header("Location:../vista/administrador.php#$url");
        $_SESSION["completado"]="La carrera se registro correctamente";
        $_SESSION["link"]="../control/c_carrera.php?buscar_carrera=".$_POST["codigo_carrera"];
    }
}

?>