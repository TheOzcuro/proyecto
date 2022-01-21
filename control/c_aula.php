<?php
session_start();
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
echo $_POST["update"];
if (isset($_POST["buscar_aula"]) && $_POST["buscar_aula"]!="") {
    $validate=$ejecutar->FindQuery("aula","codigo", $_POST["buscar_aula"]);
    if ($validate===2) {
       $_SESSION["error"]="El codigo que ingreso no existe";
       header("Location: ../vista/administrador.php#aula-find-flex");
    }
    else {
        $_SESSION["update"]=$validate;
        $_SESSION["container"]="aula-container";
        header("Location: ../vista/administrador.php#aula-find-flex");
     }
}

else if (isset($_POST["update"]) && $_POST["update"]!=""){
    $validate=$ejecutar->UpdateTableAula($_POST["codigo_aula"], $_POST["nombre_aula"], $_POST["update"]);
    
    if ($validate===3) {
        $_SESSION["error"]="El nombre de aula que ingreso ya existe";
        $_SESSION["container"]="aula-container";
        $_SESSION["update"]=$ejecutar->FindQuery("aula","codigo", $_POST["update"]);
        header("Location: ../vista/administrador.php#aula-find-flex");

    }
    if ($validate===2) {
        $_SESSION["error"]="El codigo de aula que ingreso ya existe";
        $_SESSION["container"]="aula-container";
        $_SESSION["update"]=$ejecutar->FindQuery("aula","codigo", $_POST["update"]);
        header("Location: ../vista/administrador.php#aula-find-flex");
    }
    else {
        $_SESSION["completado"]="Los datos fueron actualizados correctamente";
        $_SESSION["container"]="aula-container";
        $_SESSION["update"]=$ejecutar->FindQuery("aula","codigo", $_POST["codigo_aula"]);
        header("Location: ../vista/administrador.php#aula-find-flex");
    }
}
else if (isset($_POST["delete"]) && $_POST["delete"]!=""){
    $ejecutar->DeleteTable("aula","codigo",$_POST["delete"]);
    $_SESSION["completado"]="Los datos fueron eliminados correctamente";
    header("Location: ../vista/administrador.php#aula-find-flex");
}
else {
    $validate=$ejecutar->registrarAula($_POST["codigo_aula"],$_POST["nombre_aula"]);
    if ($validate===2) {
        header("Location:../vista/administrador.php#aula-container-flex");
        $_SESSION["error"]="El codigo de aula que ingreso ya existe";
        
    }
    if ($validate===3) {
        header("Location:../vista/administrador.php#aula-container-flex");
        $_SESSION["error"]="El nombre de aula que ingreso ya existe";
    }
    else {
        header("Location:../vista/administrador.php#aula-container-flex");
        $_SESSION["completado"]="El aula se registro correctamente";
    }
}

?>