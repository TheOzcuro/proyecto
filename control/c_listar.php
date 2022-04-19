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
    if ($campo!="undefined" && $tabla!="pensum" && $tabla!="oferta" && $tabla!="profesor" && $tabla!="materia" && $tabla!="horario_docente") {
        return $ejecutar->GetFindQuery($tabla,$campo,$dato);
    }
    else if ($tabla=="pensum") {
        if ($campo!="undefined") {
            return $ejecutar->GetAllPensum($campo);
        }
        else {
            
            return $ejecutar->GetAllPensum("");
        }
       
    }
    else if ($tabla=="oferta") {
        if ($campo!="undefined") {
            return $ejecutar->GetAllOferta($campo,$dato);
        }
        else {
            
            return $ejecutar->GetAllOferta("","");
        }
       
    }
    else if ($tabla=="materia") {
        if ($campo!="undefined") {
            return $ejecutar->GetMateriasMulti($campo,$dato);
        }
        else {
            return $ejecutar->GetMateriasMulti("","");
        }
       
    }
    else if ($tabla=="horario_docente") {
        if ($campo!="undefined") {
            return $ejecutar->GetHistorialHorario($campo,$dato);
        }
        else {
            return $ejecutar->GetHistorialHorario("","");
        }
       
    }
    else if ($tabla=="profesor") {
        if ($campo!="undefined"){
            return $ejecutar->GetAllProfesor($campo,$dato);
        }
        else {
            return $ejecutar->GetAllProfesor("","");
        }
    }
    //GetAllOferta
    else {
        return $ejecutar->GetAll($tabla);
    }
}
?>