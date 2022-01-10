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
<body>
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
                        <a href="#disprofesor"><li id="disponibilidadProfesor">Disponibilidad</li> <div class="borderline"></div></a>
                        <a href="#editprofesor"><li id="editarProfesor">Editar Datos</li> <div class="borderline"></div></a>
                    </ul>
                </div>
            </div>
            <div class="principal-menu">
            <div class="h4-container" onclick="AnimationPrincipalMenu(1)">
                <h4>Horario</h4>
            </div>
            
            <img src="css/img/arrow_down.png" alt="" id="arrow_down" onclick="AnimationPrincipalMenu(1)">
            <div class="submenu">
                    <ul>
                        <a href="#reghorario"><li id="registrarHorario">Crear Horario</li><div class="borderline"></div></a>
                        <a href="#edithorario"><li id="editarHorario">Editar Horario</li><div class="borderline"></div></a>
                        <a href="#imphorario"><li id="ImprimirHorario">Imprimir</li><div class="borderline"></div></a>
                    </ul>
                </div>
            </div>
            <div class="principal-menu">
            <div class="h4-container" onclick="AnimationPrincipalMenu(2)">
                <h4>Materias</h4>
            </div>
            <img src="css/img/arrow_down.png" alt="" id="arrow_down" onclick="AnimationPrincipalMenu(2)">
            <div class="submenu">
                    <ul>
                        <a href="#materia-container-flex"><li id="registrarMateria">Crear Materias</li><div class="borderline"></div></a>
                        <a href="#editmateria"><li id="editarMateria">Editar Materias</li><div class="borderline"></div></a>
                    </ul>
                </div>
            </div>
            <div class="principal-menu">
            <div class="h4-container" onclick="AnimationPrincipalMenu(3)">
                <h4>Carreras</h4>
            </div> 
            
            <img src="css/img/arrow_down.png" alt="" id="arrow_down" onclick="AnimationPrincipalMenu(3)">
            <div class="submenu">
                    <ul>
                        <a href="#carrera-container-flex"><li id="registrarCarreras">Crear Carreras</li><div class="borderline"></div></a>
                        <a href="#editcarreras"><li id="editarCarreras">Editar Carreras</li><div class="borderline"></div></a>
                    </ul>
                </div>
            </div>
            <div class="principal-menu">
            <div class="h4-container" onclick="AnimationPrincipalMenu(4)">
                <h4>Control Aulas</h4>
            </div>
            
            <img src="css/img/arrow_down.png" alt="" id="arrow_down" onclick="AnimationPrincipalMenu(4)">
            <div class="submenu">
                    <ul>
                        <a href="#aula-container-flex"><li id="registrarAulas">Crear Aulas</li><div class="borderline"></div></a>
                        <a href="#editaulas"><li id="editarAulas">Editar Aulas</li><div class="borderline"></div></a>
                    </ul>
                </div>
            </div>
            <div class="principal-menu">
            
            <div class="h4-container" onclick="AnimationPrincipalMenu(5)">
                <h4>Lapso Academico</h4>
            </div>
            <img src="css/img/arrow_down.png" alt="" id="arrow_down" onclick="AnimationPrincipalMenu(5)">
            <div class="submenu">
                    <ul>
                        <a href=""><li>Iniciar Lapso Academico</li><div class="borderline"></div></a>
                        <a href=""><li>Inserte Texto</li><div class="borderline"></div></a>
                        <a href=""><li>Inserte Texto</li><div class="borderline"></div></a>
                    </ul>
                </div>
            </div>
            <div class="principal-menu">
                <div class="h4-container">
                <a href="logout.php"><h4>Cerrar Sesion</h4></a>
                </div>
               
            </div>
        </div>
        <div class="contend">
            <?php include_once("msg_error.php");include_once("register-form.php")?>
            
        </div>
    </div>
</body>
<?php 
if (isset($_SESSION["error"]) && $_SESSION["error"]=="profesor_cedula") {
    echo "<script>Error('La cedula que ingreso YA existe','msg_error','p_error')</script>";
    unset($_SESSION["error"]);
}
if (isset($_SESSION["completado"]) && $_SESSION["completado"]=="profesor_registro") {
    echo "<script>Error('El profesor se registro correctamente','msg_check','p_check')</script>";
    unset($_SESSION["completado"]);
    
 }
 if (isset($_SESSION["error"]) && $_SESSION["error"]=="codigo_aula") {
    echo "<script>Error('El codigo de aula que ingreso YA existe','msg_error','p_error')</script>";
    unset($_SESSION["error"]);
 }
 if (isset($_SESSION["completado"]) && $_SESSION["completado"]=="aula_registro") {
    echo "<script>Error('El aula se registro correctamente','msg_check','p_check')</script>";
    unset($_SESSION["completado"]);
     
  }
  if (isset($_SESSION["error"]) && $_SESSION["error"]=="codigo_materia") {
    echo "<script>Error('El codigo de materia que ingreso YA existe','msg_error','p_error')</script>";
    unset($_SESSION["error"]);
 }
 if (isset($_SESSION["completado"]) && $_SESSION["completado"]=="registro_materia") {
    echo "<script>Error('La materia se registro correctamente','msg_check','p_check')</script>";
    unset($_SESSION["completado"]);
     
  }
  if (isset($_SESSION["error"]) && $_SESSION["error"]=="codigo_carrera") {
    echo "<script>Error('El codigo de carrera que ingreso YA existe','msg_error','p_error')</script>";
    unset($_SESSION["error"]);
 }
 if (isset($_SESSION["completado"]) && $_SESSION["completado"]=="registro_carrera") {
    echo "<script>Error('La carrera se registro correctamente','msg_check','p_check')</script>";
    unset($_SESSION["completado"]);
     
  }
?>
<script src="js/admin.js"></script>
</html>