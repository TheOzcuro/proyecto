<?php
session_start();
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
$url=$_POST["url"];
if (isset($_POST["buscar_pensum"]) && $_POST["buscar_pensum"]!="") {
    $dato=$ejecutar->GetAllPensum($_POST["buscar_pensum"]);
    if (count($dato)==0) {
       $_SESSION["error"]="El nombre que ingreso no existe";
       header("Location:../vista/administrador.php#$url");
    }
    else {
        $_SESSION["update"]=$dato;
        $_SESSION["container"]="pensum-container";
        header("Location:../vista/administrador.php#$url");
     }
}
else if (isset($_GET["buscar_pensum"]) && $_GET["buscar_pensum"]!="") {
    $dato=$ejecutar->GetAllPensum($_GET["buscar_pensum"]);
    if (count($dato)==0) {
       $_SESSION["error"]="El nombre que ingreso no existe";
       header("Location:../vista/administrador.php#pensum-container-grid");
    }
    else {
        $_SESSION["update"]=$dato;
        $_SESSION["container"]="pensum-container";
        header("Location:../vista/administrador.php#pensum-container-grid");
     }
}
else if (isset($_POST["update"]) && $_POST["update"]!=""){
    $dato=$ejecutar->FindQuery("carrera","codigo",$_POST["update"]);
    if ($dato===2) {
        $_SESSION["error"]="El nombre de carrera que ingreso no existe";
        $_SESSION["container"]="pensum-container";
        header("Location:../vista/administrador.php#$url");
    }
    else {
        $array=explode(",",$_POST["add"]);
        $del=explode(",",$_POST["del"]);
        if ($_POST["del"]!="") {
            for ($i=0; $i < count($del); $i++) { 
                $validate=$ejecutar->DeleteTableTwoWhere("pensum","unidad_curricular",$del[$i], 'pnf',$_POST["update"]);
                $ejecutar->DeleteTable("horario_docente",'unidad_curricular',$del[$i]);
            }
        }
        if ($_POST["add"]!="") {
            for ($i=0; $i < count($array); $i++) { 
                $validate=$ejecutar->registrarPensum($_POST["update"],$array[$i]);
            }
        }
        if ($_POST["del_multi"]!="") {
            $del=explode(",",$_POST["del_multi"]);
            for ($i=0; $i < count($del); $i++) { 
                $validate=$ejecutar->DeleteTableTwoWhere("pensum","unidad_curricular",$del[$i], 'pnf',$_POST["update"]);
                $ejecutar->DeleteTable("materia",'codigo',$del[$i]);
                $ejecutar->DeleteTable("horario_docente",'unidad_curricular',$del[$i]);
            }
        }
        print_r($_POST["add_multi"]);
        if ($_POST["add_multi"]!="") {
            $added=explode(",",$_POST["add_multi"]);
            for ($i=0; $i < count($added);) {
                $ejecutar->registrarMateria($added[$i],$added[$i+1],$added[$i+2]);
                $ejecutar->registrarPensum($_POST["update"],$added[$i],"");
                $i=$i+3;
            }
        }
        $_SESSION["completado"]="Los datos fueron actualizados correctamente";
        $_SESSION["container"]="pensum-container";
        header("Location:../vista/administrador.php#$url");
    }
}
else if (isset($_POST["delete"]) && $_POST["delete"]!=""){
    $delete_array=explode(",",$_POST["delete"]);
    $ejecutar->DeleteTable('horario_docente','carrera', $_POST["delete"]);
    $carrera=$ejecutar->FindQuery("carrera","codigo",$_POST["delete"]);
    if ($carrera!=2) {
        $values=$ejecutar->GetAllPensum($carrera[1]);
        for ($i=3; $i < count($values[0]); $i=$i+2) { 
            $ejecutar->DeleteTableMateriaMulti("materia","codigo",$values[0][$i]);
        }
        $ejecutar->DeleteTable("pensum","pnf",$_POST["delete"]);
    }

    for ($i=0; $i < count($delete_array); $i++) { 
        $ejecutar->DeleteTable("pensum","unidad_curricular",$delete_array[$i]);
    }
    $_SESSION["completado"]="Los datos fueron eliminados correctamente";
    header("Location:../vista/administrador.php#$url");
}

else {
    $dato=$ejecutar->FindQuery("carrera","codigo",$_POST["carreras"]);
    if ($dato===2) {
        header("Location:../vista/administrador.php#$url");
        $_SESSION["error"]="La carrera que ingreso no existe";
    }
    else {
       
        if ($_POST["add"]!="") {
            $array=explode(",",$_POST["add"]);
            print_r($array);
            for ($i=0; $i < count($array); $i++) { 
                $ejecutar->registrarPensum($dato[0],$array[$i],"");
            }
        }
        if ($_POST["materias_add"]!="") {
            $array=explode(",",$_POST["materias_add"]);
            print_r($array);
            for ($i=0; $i < count($array);) { 
                $ejecutar->registrarMateria($array[$i],$array[$i+1],$array[$i+2]);
                $ejecutar->registrarPensum($_POST["carreras"],$array[$i],"");
                $i=$i+3;
            }
        }
        header("Location:../vista/administrador.php#$url");
        $_SESSION["completado"]="La carrera se agrego correctamente";
    }
}
?>