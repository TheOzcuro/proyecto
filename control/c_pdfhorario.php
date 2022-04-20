<?php 
session_start();
include_once("../modelo/m_ejecutar.php");

function CreateHorario($cedula,$lapso)
{
    $ejecutar= new registry();
    $_SESSION["lista_disponibilidad"]=$ejecutar->GetDisponibilidad($cedula);
    if (count($_SESSION["lista_disponibilidad"])==0) {
        $_SESSION["error"]="La cedula que ingreso no existe";
        unset($_SESSION["lista_disponibilidad"]);
        header("Location:../vista/administrador.php#$url");
    }
    $_SESSION["disponibilidad_profesor"]=$ejecutar->GetAllProfesor($cedula, "cedula");
    $_SESSION["lapso"]=$lapso;
    $_SESSION["carreras_horario"]=$ejecutar->GetCarrerasOferta($lapso);
    $bloques_add=$ejecutar->GetHorario($cedula,$lapso);
    if ($bloques_add!=2) {
        $_SESSION["find_horario"]=$bloques_add;
    }
}
    

?>