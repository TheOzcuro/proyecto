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
        $disponibilidad=$ejecutar->GetFindQuery('bloque_disponibilidad',$_POST['update'],'cedula');
        $ejecutar->DeleteTable('bloque_disponibilidad', 'cedula',$_POST["update"]);
        $horario=$ejecutar->GetFindQuery('horario_docente',$_POST["update"],'cedula_docente');
        if ($_POST['bloques_add_1']!="" && $_POST['dias_1']!="") {
            $array=explode(",",$_POST["bloques_add_1"]);
            sort($array, SORT_NATURAL);
            for ($i=0; $i < count($array); $i++) { 
               $ejecutar->registrarDisponibilidad($_POST["update"], $array[$i],$_POST["dias_1"],1);
            }

        }
        if ($_POST['bloques_add_2']!="" && $_POST['dias_2']!="") {
            $array=explode(",",$_POST["bloques_add_2"]);
            sort($array, SORT_NATURAL);
            for ($i=0; $i < count($array); $i++) { 
                $ejecutar->registrarDisponibilidad($_POST["update"], $array[$i],$_POST["dias_2"],1);
             }
        }
        if ($_POST['bloques_add_3']!="" && $_POST['dias_3']!="") {
            $array=explode(",",$_POST["bloques_add_3"]);
            sort($array, SORT_NATURAL);
            for ($i=0; $i < count($array); $i++) { 
                $ejecutar->registrarDisponibilidad($_POST["update"], $array[$i],$_POST["dias_3"],1);
             }
        }
        if ($_POST['bloques_add_4']!="" && $_POST['dias_4']!="") {
            $array=explode(",",$_POST["bloques_add_4"]);
            sort($array, SORT_NATURAL);
            for ($i=0; $i < count($array); $i++) { 
                $ejecutar->registrarDisponibilidad($_POST["update"], $array[$i],$_POST["dias_4"],1);
             }
        }
        if ($_POST['bloques_add_5']!="" && $_POST['dias_5']!="") {
            $array=explode(",",$_POST["bloques_add_5"]);
            sort($array, SORT_NATURAL);
            for ($i=0; $i < count($array); $i++) { 
                $ejecutar->registrarDisponibilidad($_POST["update"], $array[$i],$_POST["dias_5"],1);
             }
        }
        $valida=$ejecutar->FindQuery('bloque_disponibilidad','cedula',$_POST['update']);
        if ($valida==2) {
            $ejecutar->UpdateDisponibilidad($_POST["update"], 0);
        }
        if ($horario!=2) {
            
            for ($i=0; $i < count($disponibilidad); $i++) {
                $verifyhorario=$ejecutar->GetFindHorario($_POST['update'],$disponibilidad[$i][2],$disponibilidad[$i][3]);
                if (count($verifyhorario)==0) {
                    $ejecutar->DeleteTableHorario($_POST['update'],$disponibilidad[$i][2],$disponibilidad[$i][3]);
                }
            }
        }
        $_SESSION["completado"]="Los datos fueron actualizados correctamente";
        if ($_SESSION["usuario"]=="profesor") {
            $validate=$ejecutar->FindQuery('bloque_disponibilidad','cedula',$_POST['cedula_dis']);
            if ($validate==2) {
                $_SESSION["cedula_usuario"]=$_SESSION["cedula_origin"];
            }
            header("Location:../vista/profesor.php#$url");
        }
        else if($_SESSION["usuario"]=="administrador"){
            header("Location:../vista/coordinador.php#$url");
        }
        else {
            header("Location:../vista/administrador.php#$url");
        }
        
    }
}
else if (isset($_POST["delete"]) && $_POST["delete"]!=""){
    $ejecutar->DeleteTable('bloque_disponibilidad', 'cedula',$_POST["delete"]);
    $ejecutar->DeleteTable('horario_docente', 'cedula_docente',$_POST["delete"]);
    $ejecutar->UpdateDisponibilidad($_POST["delete"], 0);
    $_SESSION["completado"]="Los datos fueron eliminados correctamente";
    if ($_SESSION["usuario"]=="profesor") {
        header("Location:../vista/profesor.php#$url");
        $_SESSION["cedula_usuario"]=$_SESSION["cedula_origin"];
    }
    else if($_SESSION["usuario"]=="administrador"){
        header("Location:../vista/coordinador.php#$url");
    }
    else {
        header("Location:../vista/administrador.php#$url");
    }
}
else {
    $valida=$ejecutar->FindQuery('profesor','cedula',$_POST['cedula_dis']);
    $validate=$ejecutar->FindQuery('bloque_disponibilidad','cedula',$_POST['cedula_dis']);
    if ($validate!==2) {
        if ($_SESSION["usuario"]=="profesor") {
            header("Location:../vista/profesor.php#$url");
            $_SESSION["cedula_usuario"]=$_SESSION["cedula_origin"]." **";
        }
        else if($_SESSION["usuario"]=="administrador"){
            header("Location:../vista/coordinador.php#$url");
        }
        else {
            header("Location:../vista/administrador.php#$url");
        }
        $_SESSION["error"]="La cedula que ingreso ya existe";
    }
    else if($valida===2) {
        if ($_SESSION["usuario"]=="profesor") {
            header("Location:../vista/profesor.php#$url");
            $_SESSION["cedula_usuario"]=$_SESSION["cedula_origin"]." **";
        }
        else if($_SESSION["usuario"]=="administrador"){
            header("Location:../vista/coordinador.php#$url");
        }
        else {
            header("Location:../vista/administrador.php#$url");
        }
        $_SESSION["error"]="La cedula que ingreso no existe";
    }
    else {
        if ($_POST['bloques_add_1']!="" && $_POST['dias_1']!="") {
            $array=explode(",",$_POST["bloques_add_1"]);
            sort($array, SORT_NATURAL);
            for ($i=0; $i < count($array); $i++) { 
               $ejecutar->registrarDisponibilidad($_POST["cedula_dis"], $array[$i],$_POST["dias_1"],1);
            }
        }
        if ($_POST['bloques_add_2']!=""  && $_POST['dias_2']!="") {
            $array=explode(",",$_POST["bloques_add_2"]);
            sort($array, SORT_NATURAL);
            for ($i=0; $i < count($array); $i++) { 
                $ejecutar->registrarDisponibilidad($_POST["cedula_dis"], $array[$i],$_POST["dias_2"],1);
             }
        }
        if ($_POST['bloques_add_3']!=""  && $_POST['dias_3']!="") {
            $array=explode(",",$_POST["bloques_add_3"]);
            sort($array, SORT_NATURAL);
            for ($i=0; $i < count($array); $i++) { 
                $ejecutar->registrarDisponibilidad($_POST["cedula_dis"], $array[$i],$_POST["dias_3"],1);
             }
        }
        if ($_POST['bloques_add_4']!=""  && $_POST['dias_4']!="") {
            $array=explode(",",$_POST["bloques_add_4"]);
            sort($array, SORT_NATURAL);
            for ($i=0; $i < count($array); $i++) { 
                $ejecutar->registrarDisponibilidad($_POST["cedula_dis"], $array[$i],$_POST["dias_4"],1);
             }
        }
        echo $_POST['bloques_add_5'];
        if ($_POST['bloques_add_5']!=""  && $_POST['dias_5']!="") {
            $array=explode(",",$_POST["bloques_add_5"]);
            sort($array, SORT_NATURAL);
            for ($i=0; $i < count($array); $i++) { 
                $ejecutar->registrarDisponibilidad($_POST["cedula_dis"], $array[$i],$_POST["dias_5"],1);
             }
        }
        $ejecutar->UpdateDisponibilidad($_POST["cedula_dis"], 1);
        if ($_SESSION["usuario"]=="profesor") {
            header("Location:../vista/profesor.php#$url");
            $_SESSION["cedula_usuario"]=$_SESSION["cedula_origin"]." **";
        }
        else if($_SESSION["usuario"]=="administrador"){
            header("Location:../vista/coordinador.php#$url");
        }
        else {
            header("Location:../vista/administrador.php#$url");
        }
        $_SESSION["completado"]="Se creo correctamente la disponibilidad del profesor ".$valida[1]." ".$valida[3];
    }
}

?>