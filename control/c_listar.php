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
    if ($campo!="undefined" && $tabla!="pensum" && $tabla!="oferta") {
        
        return $ejecutar->GetFindQuery($tabla,$campo,$dato);
    }
    if ($tabla=="pensum") {
        if ($campo!="undefined") {
            return $ejecutar->GetAllPensum($campo);
        }
        else {
            
            return $ejecutar->GetAllPensum("");
        }
       
    }
    if ($tabla=="oferta") {
        if ($campo!="undefined") {
            return $ejecutar->GetAllOferta($campo);
        }
        else {
            
            return $ejecutar->GetAllOferta("");
        }
       
    }
    //GetAllOferta
    else {
        return $ejecutar->GetAll($tabla);
    }
}
?>