<?php 
session_start();
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
$url=$_POST["url"];
if (isset($_POST["cedula_horario"]) && $_POST["cedula_horario"]!="") {
    $_SESSION["lista_disponibilidad"]=$ejecutar->GetDisponibilidad($_POST["cedula_horario"]);
    
    if (count($_SESSION["lista_disponibilidad"])==0) {
        $_SESSION["error"]="La cedula que ingreso no existe";
        unset($_SESSION["lista_disponibilidad"]);
        if ($_SESSION["usuario"]=="profesor") {
            header("Location:../vista/profesor.php#$url");
        }
        else if($_SESSION["usuario"]=="administrador"){
            header("Location:../vista/coordinador.php#$url");
        }
        else {
            header("Location:../vista/administrador.php#$url");
        }
    }
    $_SESSION["disponibilidad_profesor"]=$ejecutar->GetAllHorario($_POST["cedula_horario"], "cedula");
    
    $_SESSION["tipo_horario"]=$_POST["tipo_horario"];
    $lapso=$ejecutar->GetLapsoHorario();
    $_SESSION["lapso"]=$lapso[0][0];
    $_SESSION["carreras_horario"]=$ejecutar->GetCarrerasOferta($lapso[0][0]);
    $seccion=$ejecutar->GetAll("seccion");
    $aula=$ejecutar->GetAll("aula");
    if (count($_SESSION["carreras_horario"])==0) {
        $_SESSION["error"]="El periodo academico activo no tiene carreras agregadas.";
        unset($_SESSION["lista_disponibilidad"]);
        if ($_SESSION["usuario"]=="profesor") {
            header("Location:../vista/profesor.php#$url");
        }
        else if($_SESSION["usuario"]=="administrador"){
            header("Location:../vista/coordinador.php#$url");
        }
        else {
            header("Location:../vista/administrador.php#$url");
        }
    }
    else if (count($seccion)==0 && count($aula)==0) {
        $_SESSION["error"]="No existe ninguna seccion registrada y no existe ninguna aula registrada.";
        unset($_SESSION["lista_disponibilidad"]);
        if ($_SESSION["usuario"]=="profesor") {
            header("Location:../vista/profesor.php#$url");
        }
        else if($_SESSION["usuario"]=="administrador"){
            header("Location:../vista/coordinador.php#$url");
        }
        else {
            header("Location:../vista/administrador.php#$url");
        }
    }
    else if (count($seccion)==0) {
        $_SESSION["error"]="No existe ninguna seccion registrada.";
        unset($_SESSION["lista_disponibilidad"]);
        if ($_SESSION["usuario"]=="profesor") {
            header("Location:../vista/profesor.php#$url");
        }
        else if($_SESSION["usuario"]=="administrador"){
            header("Location:../vista/coordinador.php#$url");
        }
        else {
            header("Location:../vista/administrador.php#$url");
        }
    }
    else if (count($aula)==0) {
        $_SESSION["error"]="No existe ninguna aula registrada.";
        unset($_SESSION["lista_disponibilidad"]);
        if ($_SESSION["usuario"]=="profesor") {
            header("Location:../vista/profesor.php#$url");
        }
        else if($_SESSION["usuario"]=="administrador"){
            header("Location:../vista/coordinador.php#$url");
        }
        else {
            header("Location:../vista/administrador.php#$url");
        }
    }
    $bloques_add=$ejecutar->GetHorario($_POST["cedula_horario"],$lapso[0][0],$_SESSION["tipo_horario"]);
    if ($bloques_add!=2) {
        $_SESSION["find_horario"]=$bloques_add;
        print_r($_SESSION["find_horario"]);
    }
    if ($_SESSION["usuario"]=="profesor") {
        header("Location:../vista/profesor.php#$url");
    }
    else if($_SESSION["usuario"]=="administrador"){
        header("Location:../vista/coordinador.php#$url");
    }
    else {
        header("Location:../vista/administrador.php#$url");
    }
}
else if (isset($_POST["delete"]) && $_POST["delete"]!=""){
    $ejecutar->DeleteTable('horario_docente', 'cedula_docente',$_POST["delete"]);
    $_SESSION["completado"]="Los datos fueron eliminados correctamente";
    if ($_SESSION["usuario"]=="profesor") {
        header("Location:../vista/profesor.php#$url");
    }
    else if($_SESSION["usuario"]=="administrador"){
        header("Location:../vista/coordinador.php#$url");
    }
    else {
        header("Location:../vista/administrador.php#$url");
    }
}
else if (isset($_POST["carrera_horario"]) && $_POST["carrera_horario"]!="") {
    $carrera=explode("—",$_POST["carrera_horario"]);
   echo json_encode([$ejecutar->GetMateriasPensumWithPNF($carrera[1]),$ejecutar->GetAulasHorario($_POST["bloque"],$_POST['dia'],$_POST['lapso']),$ejecutar->GetSeccionHorario($_POST["bloque"],$_POST['dia'],$_POST['lapso'])]);
}
else if (isset($_POST["input_horario"]) && $_POST["input_horario"]!="") {
    
     $ejecutar->DeleteTableTwoWhere('horario_docente','cedula_docente',$_POST["input_horario"][0],'tipo',$_SESSION["tipo_horario"]);
     for ($i=2; $i < count($_POST["input_horario"]); $i=$i+6) { 
        if ($_POST["input_horario"][$i]!="") {
            print_r($_POST["input_horario"][$i+3]);
            $ejecutar->registrarHorario($_POST["input_horario"][0],$_POST["input_horario"][$i+3],$_POST["input_horario"][1],$_POST["input_horario"][$i+4], $_POST["input_horario"][$i+2],$_POST["input_horario"][$i+1],$_POST["input_horario"][$i],$_POST["input_horario"][$i+5],$_SESSION["tipo_horario"]);
        }
     }
     $_SESSION["completado"]="El horario se creo correctamente";
    $_SESSION["lista_disponibilidad"]=$ejecutar->GetDisponibilidad($_POST["input_horario"][0]);
    $_SESSION["disponibilidad_profesor"]=$ejecutar->GetAllHorario($_POST["input_horario"][0], "cedula");
    $_SESSION["carreras_horario"]=$ejecutar->GetCarrerasOferta($_POST["input_horario"][1]);
    $_SESSION["find_horario"]=$ejecutar->GetHorario($_POST["input_horario"][0],$_POST["input_horario"][1],$_SESSION["tipo_horario"]);
    if ($_SESSION["usuario"]=="profesor") {
        header("Location:../vista/profesor.php#$url");
    }
    else if($_SESSION["usuario"]=="administrador"){
        header("Location:../vista/coordinador.php#$url");
    }
    else {
        header("Location:../vista/administrador.php#$url");
    }
}

?>