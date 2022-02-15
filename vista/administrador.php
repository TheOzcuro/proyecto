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
                        <a href="#disprofesor"><li id="disponibilidadProfesor">Disponibilidad</li> <div class="borderline"></div></a>
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
                        <a href="#materia-container-grid"><li id="registrarMateria">Crear/Buscar</li><div class="borderline"></div></a>
                        <a href="#materia-historial-grid"><li id="historialMateria">Historial</li><div class="borderline"></div></a>
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
                        <a href="#lapso-container-grid"><li id="crearLapso">Crear Lapso Academico</li><div class="borderline"></div></a>
                        <a href=""><li>Inserte Texto</li><div class="borderline"></div></a>
                        <a href=""><li>Inserte Texto</li><div class="borderline"></div></a>
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
  
          if (isset($_SESSION["update"]) && $_SESSION["update"]!="") {
              $total=count($_SESSION["update"]);
              $total=$total/2;
              $x=0;
              echo "valores=[";
              while ($x<$total) {
                  if ($x===7) {
                      echo "'".$_SESSION["update"][$x]."'";
                  }
                  else {
                      echo "'".$_SESSION["update"][$x]."'".',';
                  }
                  $x=$x+1;
              }
              echo "];";
                echo "Modificar('".$_SESSION["container"]."','grid', valores);";
              unset($_SESSION["container"]);
              unset($_SESSION["update"]);
             
          }
          ?>
      </script>
</html>
