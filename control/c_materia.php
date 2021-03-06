<?php
session_start();
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
$url=$_POST["url"];
if (isset($_POST["codigo_confirm"]) && $_POST["codigo_confirm"]!="") {
    if ($ejecutar->FindQuery('materia','codigo',$_POST["codigo_confirm"])!=2) {
        echo "si";
    }
    else {
        echo "no";
    }
}
else if (isset($_POST["buscar_materia"]) && $_POST["buscar_materia"]!="") {
    
    $validate=$ejecutar->FindQuery("materia", "codigo", $_POST["buscar_materia"]);
    if ($validate===2) {
        $_SESSION["error"]="El codigo que ingreso no existe";
        header("Location:../vista/administrador.php#$url");
    }
    else {
        $_SESSION["update"]=$validate;
        $_SESSION["container"]="materia-container";
        header("Location:../vista/administrador.php#$url");
    }
}
else if (isset($_GET["buscar_materia"]) && $_GET["buscar_materia"]!="") {
    
    $validate=$ejecutar->FindQuery("materia", "codigo", $_GET["buscar_materia"]);
    if ($validate===2) {
        $_SESSION["error"]="El codigo que ingreso no existe";
        header("Location:../vista/administrador.php#materia-container-grid");
    }
    else {
        $_SESSION["update"]=$validate;
        $_SESSION["container"]="materia-container";
        header("Location:../vista/administrador.php#materia-container-grid");
    }
}
else if (isset($_POST["update"]) && $_POST["update"]!="") {
    if ($_POST["tipo_materia_multi"]==1) {
        $dato=$ejecutar->FindQuery("materia","nombre",$_POST["nombre_materia_multi"]);
        $dato_origin=$ejecutar->FindQuery("materia","codigo",$_POST["update"]);
        if ($dato[1]==$dato_origin[1] || $dato===2) {
            $validate=$ejecutar->UpdateTableMateria($_POST["codigo_materia_multi"],$_POST["nombre_materia_multi"],$_POST["tipo_materia_multi"],$_POST["horas_semana"],$_POST["unidad_credito"],$_POST["update"]);
        }
        if ($dato[1]!=$dato_origin[1] && $dato!==2) {
           $validate=3;
        }
        if ($validate===3) {
            $_SESSION["error"]="El nombre de materia que ingreso ya existe";
            $_SESSION["update"]=$ejecutar->FindQuery("materia", "codigo", $_POST["update"]);
            $_SESSION["container"]="materia-container";
            header("Location:../vista/administrador.php#$url");
        }
        else if ($validate===2) {
            $_SESSION["error"]="El codigo de materia que ingreso ya existe";
            $_SESSION["update"]=$ejecutar->FindQuery("materia", "codigo", $_POST["update"]);
            $_SESSION["container"]="materia-container";
            header("Location:../vista/administrador.php#$url");
        }
        else {
            if ($_POST["codigo_materia"]!=$_POST["update"]) {
                $ejecutar->UpdateTableMateriasPensum($_POST["update"],$_POST["codigo_materia_multi"]);
            }
            $_SESSION["update"]=$ejecutar->FindQuery("materia", "codigo", $_POST["codigo_materia_multi"]);
            print_r($_SESSION["update"]);
            $_SESSION["container"]="materia-container";
            $_SESSION["completado"]="Los datos de la materia han sido actualizados";
            header("Location:../vista/administrador.php#$url");
        }
    }
    else {
        $array=explode(",",$_POST["add"]);
        $del=explode(",",$_POST["del"]);
        $carrera=$ejecutar->FindQuery("carrera","codigo",$_POST["update"]);
        if ($_POST["add"]!="") {
            for ($i=0; $i < count($array); $i=$i+3) { 
                $codigo=$ejecutar->FindQuery("materia","codigo",$array[$i]);
                if ($codigo!=2) {
                    header("Location:../vista/administrador.php#$url");
                    $_SESSION["error"]="El codigo ".$array[$i]." de la materia ".$array[$i+1]." ya existe";
                }
            }
        }
        if ($carrera==2) {
            
            header("Location:../vista/administrador.php#$url");
            $_SESSION["error"]="La carrera que ingreso no existe";
        }
        else {
            echo "aver";
            if ($_POST["add"]!="") {
                for ($i=0; $i < count($array);$i=$i+3) { 
                    $ejecutar->registrarMateria($array[$i],$array[$i+1],$array[$i+2]);
                    $ejecutar->registrarPensum($_POST["update"],$array[$i],"");
                }
            }
            if ($_POST["del"]!="") {
                for ($i=0; $i < count($del); $i++) { 
                    $ejecutar->DeleteTable("pensum","unidad_curricular",$del[$i]);
                    $ejecutar->DeleteTable("materia","codigo",$del[$i]);
                }
            }
            header("Location:../vista/administrador.php#$url");
            $_SESSION["completado"]="Las materias se modificaron correctamente";
        }
    }
}
else if (isset($_POST["delete"]) && $_POST["delete"]!="") {
    $ejecutar->DeleteTable("pensum","unidad_curricular",$_POST["delete"]);
    $ejecutar->DeleteTable("materia","codigo",$_POST["delete"]);
    $_SESSION["completado"]="Los datos fueron eliminados";
    header("Location:../vista/administrador.php#$url");
}
else{
    if ($_POST["tipo_materia_multi"]==1) {
        $validate=$ejecutar->registrarMateria($_POST["codigo_materia_multi"],$_POST["nombre_materia_multi"],$_POST["tipo_materia_multi"],$_POST["horas_semana"],$_POST["unidad_credito"]);
        if ($validate===2) {
            header("Location:../vista/administrador.php#$url");
            $_SESSION["error"]="El codigo de materia que ingreso ya existe";
            
        }
        else {
            header("Location:../vista/administrador.php#$url");
            $_SESSION["completado"]="La materia fue registrada sastifactoriamente";
            $_SESSION["link"]="../control/c_materia.php?buscar_materia=".$_POST["codigo_materia_multi"];
        }
    }
    else {
        $valideMaterias=true;
        echo $_POST["carreras"];
        $dato=$ejecutar->FindQuery("carrera","codigo",$_POST["carreras"]);
        if ($dato===2) {
            header("Location:../vista/administrador.php#$url");
            $_SESSION["error"]="La carrera que ingreso no existe";
        }
        else {
            $array=explode(",",$_POST["materias_add"]);
            for ($i=0; $i < count($array);) {
                if ($ejecutar->FindQuery('materia','codigo',$array[$i])!=2) {
                    $valideMaterias=false;
                    $materia=$array[$i+1];
                    break;
                }
                $i=$i+3;
            }
            if ($valideMaterias==true) {
                for ($i=0; $i < count($array);) { 
                    $ejecutar->registrarMateria($array[$i],$array[$i+1],$array[$i+2]);
                    if ($valideMaterias==2) {
                        
                    }
                    $ejecutar->registrarPensum($_POST["carreras"],$array[$i],"");
                    $i=$i+3;
                }
                header("Location:../vista/administrador.php#$url");
                $_SESSION["completado"]="Las materias se agregaron correctamente";
            }
            else {
                header("Location:../vista/administrador.php#$url");
                $_SESSION["error"]="La materia ".$materia." que intento registrar posee el mismo codigo que otra materia que ya se encuentra registrada";
            }
           
        }
        /*
        $dato=$ejecutar->FindQuery("carrera","codigo",$_POST["carreras"]);
        $validate=$ejecutar->FindQuery("pensum","pnf",$_POST["carreras"]);
        if ($dato===2) {
            header("Location:../vista/administrador.php#$url");
            $_SESSION["error"]="La carrera que ingreso no existe";
        }
        else if (count($validate)>3) {
            header("Location:../vista/administrador.php#$url");
            $_SESSION["error"]="La carrera que ingreso ya existe";
        }
        else {
            $array=explode(",",$_POST["add"]);
            for ($i=0; $i < count($array); $i++) { 
                $ejecutar->registrarPensum($_POST["carreras"],$array[$i],"");
            }
            header("Location:../vista/administrador.php#$url");
            $_SESSION["completado"]="La carrera se agrego correctamente";
        }
        */
    }
   
}

?>