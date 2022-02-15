<?php 
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();

function GetAll($tabla)
{
    $ejecutar= new registry();
    return $ejecutar->TakeColumnNames($tabla);
}
function History($tabla,$campo,$dato)
{
    $ejecutar= new registry();
    if ($campo!="undefined") {
        
        return $ejecutar->GetFindQuery($tabla,$campo,$dato);
    }
    else {
        return $ejecutar->GetAll($tabla);
    }
}
?>