<?php 
session_start();
if (isset($_SESSION["usuario"])==false) {
   header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/administrador.css">
    <title>Administrador</title>
</head>
<body onload="LabelInput()">
        <div class="blackcover">
        </div>
        <div class="container-flex" id="contratacion-container">
            <h2>Detalles</h2>
            <div style='grid-column:1/3;'>
                <h4>Titulo</h4>
                <div id="div_titulo"  class="div_container"></div>
            </div>
            <div style='grid-column:1/2;'>
                <h4>Oficio</h4>
                <div id="div_oficio"  class="div_container"></div>
            </div>
            <div style='grid-column:2/3;'>
                <h4>Rol</h4>
                <div id="div_rol"  class="div_container"></div>
            </div>
            <div style='grid-column:1/3;'>
                <h4>Correo</h4>
                <div id="div_correo" class="div_container"></div>
            </div>
            <div style='grid-column:1/3;'>
                <h4>Direccion</h4>
                <div id="div_direccion" class="div_container"></div>
            </div>
            <div style='grid-column:1/2;'>
                <h4>Telefono</h4>
                <div id="div_telefono"  class="div_container"></div>
            </div>
            <div style='grid-column:2/3;'>
                <h4>Telefono Fijo</h4>
                <div id="div_telefono_fijo"  class="div_container"></div>
            </div>
           
        </div>
        <?php include_once("edit-form.php");
            ?>
        <div class="delete-window">
            <h4>¿Esta seguro que desea eliminar estos datos?</h4>
            <button class="delete" id="yes-delete">Si
            </button>
            <button class="delete" onclick="DisplayDelete('none','.delete-window')">No</button>
        </div>
        
        
    
    <div class="grid-container">
        <div class="header">
            <h2>Bievenido <?php echo $_SESSION["usuario_nombre"][0]." ";echo $_SESSION["usuario_nombre"][1];?></h2>
        </div>
        <div class="slide-menu">
            <div class="principal-menu" >
            <div class="h4-container" onclick="AnimationPrincipalMenu(0)">
            <h4>Profesor</h4>
            </div>
            <img src="css/img/arrow_down.png" alt="" id="arrow_down" onclick="AnimationPrincipalMenu(0)">
                <div class="submenu">
                    <ul>
                        <a href="#profesor-container-grid"><li id="registrarProfesor">Registrar</li><div class="borderline"></div></a>
                        <a href="#profesor-historial-grid"><li id="historialProfesor">Historial</li><div class="borderline"></div></a>
                        <a href="#disponibilidad-container-grid"><li id="disponibilidadProfesor">Disponibilidad</li> <div class="borderline"></div></a>
                    </ul>
                </div>
            </div>
            <div class="principal-menu">
            <div class="h4-container" onclick="AnimationPrincipalMenu(1)">
                <h4>Unidad Curricular</h4>
            </div>
            <img src="css/img/arrow_down.png" alt="" id="arrow_down" onclick="AnimationPrincipalMenu(1)">
            <div class="submenu">
                    <ul>
                        <a href="#pensum-container-grid"><li id="registrarMateria">Crear/Buscar</li><div class="borderline"></div></a>
                        <a href="#materia-container-grid"><li id="registrarMateriaMulti">Añadir Multidiciplinaria</li><div class="borderline"></div></a>
                        <a href="#pensum-historial-grid"><li id="historialMateria">Historial</li><div class="borderline"></div></a>
                    </ul>
                </div>
            </div>
            <div class="principal-menu">
            <div class="h4-container" onclick="AnimationPrincipalMenu(2)">
                <h4>PNF</h4>
            </div> 
            
            <img src="css/img/arrow_down.png" alt="" id="arrow_down" onclick="AnimationPrincipalMenu(2)">
            <div class="submenu">
                    <ul>
                        <a href="#carrera-container-grid"><li id="registrarCarreras">Crear/Buscar</li><div class="borderline"></div></a>
                        <a href="#carrera-historial-grid"><li id="historialCarreras">Historial</li><div class="borderline"></div></a>
                    </ul>
                </div>
            </div>
            <div class="principal-menu">
            <div class="h4-container" onclick="AnimationPrincipalMenu(3)">
                <h4>Aula</h4>
            </div>
            
            <img src="css/img/arrow_down.png" alt="" id="arrow_down" onclick="AnimationPrincipalMenu(3)">
            <div class="submenu">
                    <ul>
                        <a href="#aula-container-grid"><li id="registrarAulas">Crear/Buscar</li><div class="borderline"></div></a>
                        <a href="#aula-historial-grid"><li id="historialAulas">Historial</li><div class="borderline"></div></a>
                    </ul>
                </div>
            </div>
            <div class="principal-menu">
            
            <div class="h4-container" onclick="AnimationPrincipalMenu(4)">
                <h4>Lapso Academico</h4>
            </div>
            <img src="css/img/arrow_down.png" alt="" id="arrow_down" onclick="AnimationPrincipalMenu(4)">
            <div class="submenu">
                    <ul>
                        <a href="#lapso_academico-container-grid"><li id="crearLapso">Crear</li><div class="borderline"></div></a>
                        <a href="#pensum-container-grid"><li id='crearPensum'>PENSUM</li><div class="borderline"></div></a>
                        <a href="#oferta-container-grid"><li id='crearOferta'>Oferta Academica</li><div class="borderline"></div></a>
                    </ul>
                </div>
            </div>
            <div class="principal-menu">
            <div class="h4-container" onclick="AnimationPrincipalMenu(5)">
                <h4>Horario</h4>
            </div>
            
            <img src="css/img/arrow_down.png" alt="" id="arrow_down" onclick="AnimationPrincipalMenu(5)">
            <div class="submenu">
                    <ul>
                        <a href="#reghorario"><li id="registrarHorario">Crear</li><div class="borderline"></div></a>
                        <a href="#edithorario"><li id="editarHorario">Editar</li><div class="borderline"></div></a>
                        <a href="#imphorario"><li id="ImprimirHorario">Imprimir</li><div class="borderline"></div></a>
                    </ul>
                </div>
            </div>
            <div class="principal-menu" id="cerrar_sesion">
                <div class="h4-container">
                <a href="logout.php"><h4>Cerrar Sesion</h4></a>
                </div>
               
            </div>
        </div>
        
        <div class="contend" id='contend'>
         <div class='back-option' id='register_back' onclick='BackOption(this)'>Ir al Registro</div>
        <div class='back-option' id='history_back' onclick='BackOption(this)'>Ir al Historial</div>
            <?php include_once("msg_error.php");include_once("register-form.php"); 
        
            ?>
            <div id='refresh'></div>
        </div>
    </div>
</body>
<?php 
if (isset($_SESSION["error"]) && $_SESSION["error"]!="") {
    echo "<script>Error('".$_SESSION["error"]."','msg_error','p_error')</script>";
    unset($_SESSION["error"]);
}
if (isset($_SESSION["completado"]) && $_SESSION["completado"]!="") {
    echo "<script>Error('".$_SESSION["completado"]."','msg_check','p_check')</script>";
    unset($_SESSION["completado"]);
        
  }
?>

<script type="text/javascript" src="js/jquery-3.6.0.js"></script>
<script type="text/javascript" src="js/admin.js"></script>
<script type="text/javascript" src="js/admin-edit.js"></script>
<script type="text/javascript" src="js/listar.js"></script>
<script type="text/javascript">
          
          <?php
            include_once("../control/c_function.php");
            $list=GetMaterias();
            $list_dis=GetDisponibilidad();
            if (isset($list)) {
                echo "materiasArray=[";
                for ($i=0; $i < count($list); $i++) { 
                    echo "'".$list[$i][0]."','".$list[$i][1]."','".$list[$i][2]."','".$list[$i][3]."',";
                }
                echo "];";
            }
            if (isset($list_dis)) {
                echo "disponibilidadArray=[";
                for ($i=0; $i < count($list_dis); $i++) { 
                    echo "'".$list_dis[$i][0]."','".$list_dis[$i][1]."','".$list_dis[$i][2]."',";
                }
                echo "];console.log(disponibilidadArray);";
            }
          if (isset($_SESSION["update"]) && $_SESSION["update"]!="") {
              $total=count($_SESSION["update"]);
              $total=$total/2;
              $x=0;
                if ($_SESSION["container"]=="pensum-container") {
                    $x=2;
                    echo "arrayPensum=[";
                    while ($x<count($_SESSION["update"][0])) {
                        echo "'".$_SESSION["update"][0][$x]."'".',';
                        $x=$x+1;
                    }
                    echo "];";
                    echo "ModificarPensum(arrayPensum,`".$_SESSION['container']."`);";
                    
                    }
                else if ($_SESSION["container"]=="oferta-container") {
                        $x=1;
                        echo "valores=[";
                        while ($x<count($_SESSION["update"][0])) {
                            echo "'".$_SESSION["update"][0][$x]."'".',';
                            $x=$x+1;
                        }
                        echo "];";
                        echo "Modificar('".$_SESSION["container"]."','grid', valores);";
                        
                        }
                else if ($_SESSION["container"]=="profesor-container") {
                        echo "valores=[";
                        while ($x<$total) {
                            if ($x==5) {
                                $x=$x+3;
                            }
                            if ($x==14) {
                                echo "'".$_SESSION["update"][14]."'".',';
                                echo "'".$_SESSION["update"][5]."'".',';
                                echo "'".$_SESSION["update"][6]."'".',';
                                echo "'".$_SESSION["update"][7]."'";
                            }
                            else {
                                echo "'".$_SESSION["update"][$x]."'".',';
                            }
                        $x=$x+1;
                        }
                        echo "];";
                    echo "Modificar('".$_SESSION["container"]."','grid', valores);";
                }
              else {
                echo "valores=[";
                while ($x<$total) {
                    if ($x===$total) {
                        echo "'".$_SESSION["update"][$x]."'";
                    }
                    else {
                        echo "'".$_SESSION["update"][$x]."'".',';
                    }
                    $x=$x+1;
                }
                echo "];";
                  echo "Modificar('".$_SESSION["container"]."','grid', valores);";
              }
             unset($_SESSION["container"]);
             unset($_SESSION["update"]);
          }
          ?>
      </script>
</html>
