<?php
include_once("modelo/m_ejecutar.php");
$ejecutar=new registry();
function Get()
{
    $ejecutar=new registry();
    return $ejecutar->GetNoticias();
}
?>