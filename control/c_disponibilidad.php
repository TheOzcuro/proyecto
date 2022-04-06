<?php
session_start();
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
$url=$_POST["url"];
if (isset($_POST["buscar_disponibilidad"]) && $_POST["buscar_disponibilidad"]!="") {
    $validate=$ejecutar->FindQuery("aula","codigo", $_POST["buscar_aula"]);
    if ($validate===2) {
       $_SESSION["error"]="El codigo que ingreso no existe";
       header("Location:../vista/administrador.php#$url");
    }
    else {
        $_SESSION["update"]=$validate;
        $_SESSION["container"]="aula-container";
        header("Location:../vista/administrador.php#aula-container-grid");
     }
}
if (isset($_GET["buscar_disponibilidad"]) && $_GET["buscar_disponibilidad"]!="") {
    $validate=$ejecutar->FindQuery("aula","codigo", $_GET["buscar_aula"]);
    if ($validate===2) {
       $_SESSION["error"]="El codigo que ingreso no existe";
       header("Location:../vista/administrador.php#aula-container-grid");
    }
    else {
        $_SESSION["update"]=$validate;
        $_SESSION["container"]="aula-container";
        header("Location:../vista/administrador.php#aula-container-grid");
     }
}

else if (isset($_POST["update"]) && $_POST["update"]!=""){
    $valida=$ejecutar->FindQuery('profesor','cedula',$_POST['update']);
    if ($valida===2) {
        $_SESSION["error"]="La cedula del profesor que ingreso no existe";
        header("Location:../vista/administrador.php#$url");
    }
    else {
        $ejecutar->DeleteTable('bloque_disponibilidad', 'cedula',$_POST["update"]);
        if ($_POST['bloques_add_1']!="") {
            $array=explode(",",$_POST["bloques_add_1"]);
            sort($array);
            for ($i=0; $i < count($array); $i++) { 
               $ejecutar->registrarDisponibilidad($_POST["cedula_dis"], $array[$i],$_POST["dias_1"],1);
            }
        }
        if ($_POST['bloques_add_2']!="") {
            $array=explode(",",$_POST["bloques_add_2"]);
            sort($array);
            for ($i=0; $i < count($array); $i++) { 
                $ejecutar->registrarDisponibilidad($_POST["cedula_dis"], $array[$i],$_POST["dias_2"],1);
             }
        }
        if ($_POST['bloques_add_3']!="") {
            $array=explode(",",$_POST["bloques_add_3"]);
            sort($array);
            for ($i=0; $i < count($array); $i++) { 
                $ejecutar->registrarDisponibilidad($_POST["cedula_dis"], $array[$i],$_POST["dias_3"],1);
             }
        }
        if ($_POST['bloques_add_4']!="") {
            $array=explode(",",$_POST["bloques_add_4"]);
            sort($array);
            for ($i=0; $i < count($array); $i++) { 
                $ejecutar->registrarDisponibilidad($_POST["cedula_dis"], $array[$i],$_POST["dias_4"],1);
             }
        }
        if ($_POST['bloques_add_5']!="") {
            $array=explode(",",$_POST["bloques_add_5"]);
            sort($array);
            for ($i=0; $i < count($array); $i++) { 
                $ejecutar->registrarDisponibilidad($_POST["cedula_dis"], $array[$i],$_POST["dias_5"],1);
             }
        }
        $valida=$ejecutar->FindQuery('bloque_disponibilidad','cedula',$_POST['update']);
        if ($valida==2) {
            $ejecutar->UpdateDisponibilidad($_POST["cedula_dis"], 0);
        }
        $_SESSION["completado"]="Los datos fueron actualizados correctamente";
        header("Location:../vista/administrador.php#$url");
    }
}
else if (isset($_POST["delete"]) && $_POST["delete"]!=""){
    $ejecutar->DeleteTable('bloque_disponibilidad', 'cedula',$_POST["delete"]);
    $ejecutar->UpdateDisponibilidad($_POST["delete"], 0);
    $_SESSION["completado"]="Los datos fueron eliminados correctamente";
    header("Location:../vista/administrador.php#$url");
}
else {
    $valida=$ejecutar->FindQuery('profesor','cedula',$_POST['cedula_dis']);
    $validate=$ejecutar->FindQuery('bloque_disponibilidad','cedula',$_POST['cedula_dis']);
    if ($validate!==2) {
        header("Location:../vista/administrador.php#$url");
        $_SESSION["error"]="La cedula que ingreso ya existe";
    }
    else if($valida===2) {
        header("Location:../vista/administrador.php#$url");
        $_SESSION["error"]="La cedula que ingreso no existe";
    }
    else {
        if ($_POST['bloques_add_1']!="") {
            $array=explode(",",$_POST["bloques_add_1"]);
            for ($i=0; $i < count($array); $i++) { 
               $ejecutar->registrarDisponibilidad($_POST["cedula_dis"], $array[$i],$_POST["dias_1"],1);
            }
        }
        if ($_POST['bloques_add_2']!="") {
            $array=explode(",",$_POST["bloques_add_2"]);
            for ($i=0; $i < count($array); $i++) { 
                $ejecutar->registrarDisponibilidad($_POST["cedula_dis"], $array[$i],$_POST["dias_2"],1);
             }
        }
        if ($_POST['bloques_add_3']!="") {
            $array=explode(",",$_POST["bloques_add_3"]);
            for ($i=0; $i < count($array); $i++) { 
                $ejecutar->registrarDisponibilidad($_POST["cedula_dis"], $array[$i],$_POST["dias_3"],1);
             }
        }
        if ($_POST['bloques_add_4']!="") {
            $array=explode(",",$_POST["bloques_add_4"]);
            for ($i=0; $i < count($array); $i++) { 
                $ejecutar->registrarDisponibilidad($_POST["cedula_dis"], $array[$i],$_POST["dias_4"],1);
             }
        }
        if ($_POST['bloques_add_5']!="") {
            $array=explode(",",$_POST["bloques_add_5"]);
            for ($i=0; $i < count($array); $i++) { 
                $ejecutar->registrarDisponibilidad($_POST["cedula_dis"], $array[$i],$_POST["dias_5"],1);
             }
        }
        $ejecutar->UpdateDisponibilidad($_POST["cedula_dis"], 1);
        header("Location:../vista/administrador.php#$url");
        $_SESSION["completado"]="Se creo correctamente la disponibilidad del profesor ".$_POST["nombre_dis"];
    }
}

?>