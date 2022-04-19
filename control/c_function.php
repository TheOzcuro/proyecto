<?php 
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
function GetColumns($tabla)
{
    $ejecutar= new registry();
   return $ejecutar->GetAll($tabla);
}
function GetCarreras()
{
    $ejecutar= new registry();
   return $ejecutar->GetCarrerasPensum();
}
function GetCarrerasNotPensum()
{
    $ejecutar= new registry();
   return $ejecutar->GetCarrerasNOTPensum();
}
function GetCarreraMulti()
{
    $ejecutar= new registry();
   return $ejecutar->GetCarrerasMulti();
}
function GetCarreraNotMulti()
{
    $ejecutar= new registry();
   return $ejecutar->GetCarrerasNotMulti();
}
function GetMateriaMulti()
{
    $ejecutar= new registry();
   return $ejecutar->GetMateriasMulti("","");
}

function GetMaterias()
{
    $ejecutar= new registry();
   return $ejecutar->GetMateriasPensum();
}
function GetCarrerasOferta()
{
    $ejecutar=new registry();
    return $ejecutar->GetCarrerasOferta();
}
function GetCarrerasNotOferta()
{
    $ejecutar=new registry();
    return $ejecutar->GetCarrerasNotInOferta();
}
function GetDisponibilidad()
{
    $ejecutar=new registry();
    return $ejecutar->GetDisponibilidad("");
}
function GetUserInDisponibilidad()
{
    $ejecutar=new registry();
    return $ejecutar->GetUserInDisponibilidad();
}
function GetUserNotDisponibilidad()
{
    $ejecutar=new registry();
    return $ejecutar->GetUserNotDisponibilidad();
}
function GetUserInHorario()
{
    $ejecutar=new registry();
    return $ejecutar->GetUserInHorario();
}
function GetProfesor()
{
    $ejecutar=new registry();
    return $ejecutar->GetAllProfesor("","");
}

function GetLapso()
{
    $ejecutar= new registry();
   return $ejecutar->GetLapsoOferta();
}
?>