<?php 
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
function GetColumns($tabla)
{
    $ejecutar= new registry();
   return $ejecutar->GetAll($tabla);
}
?>