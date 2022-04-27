<?php 
session_start();
include_once("../modelo/m_ejecutar.php");

function CreateHorario($cedula,$lapso)
{
    $ejecutar= new registry();
    $_SESSION["lista_disponibilidad_pdf"]=$ejecutar->GetDisponibilidad($cedula);
    if (count($_SESSION["lista_disponibilidad_pdf"])==0) {
        $_SESSION["error"]="La cedula que ingreso no existe";
        unset($_SESSION["lista_disponibilidad_pdf"]);
        header("Location:../vista/administrador.php#$url");
    }
    $_SESSION["disponibilidad_profesor_pdf"]=$ejecutar->GetAllProfesor($cedula, "cedula");
    $_SESSION["lapso"]=$lapso;
    $_SESSION["carreras_horario"]=$ejecutar->GetCarrerasOferta($lapso);
    $bloques_add=$ejecutar->GetHorarioPDF($cedula,$lapso);
    if ($bloques_add!=2) {
        $_SESSION["find_horario"]=$bloques_add;
    }
}
    

?>