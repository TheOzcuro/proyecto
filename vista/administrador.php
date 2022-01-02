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
        </div>
        <div class="slide-menu">
            <div class="principal-menu" >
            <div class="h4-container" onclick="AnimationPrincipalMenu(0)">
            <h4>Profesor</h4>
            </div>
            <img src="css/img/arrow_down.png" alt="" id="arrow_down" onclick="AnimationPrincipalMenu(0)">
                <div class="submenu">
                    <ul>
                        <a href="#regprofesor"><li id="registrarProfesor">Registrar</li><div class="borderline"></div></a>
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
                        <a href="#regmateria"><li id="registrarMateria">Crear Materias</li><div class="borderline"></div></a>
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
                        <a href="#regcarreras"><li id="registrarCarreras">Crear Carreras</li><div class="borderline"></div></a>
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
                        <a href="#regaulas"><li id="registrarAulas">Crear Aulas</li><div class="borderline"></div></a>
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
            <?php include_once("msg_error.php");?>
            <form action="../control/c_materia.php" method="POST" name="materia">
                <div class="materia-container" id="materia-container">
                    <h2>Registrar Materia</h2>
                    <div class="input-container">
                        <label for="codigo_materia" id="labelcodigo_materia">Codigo</label><br>
                        <input type="text" id="codigo_materia" name="codigo_materia" onfocus="LabelAnimation('codigo_materia','labelcodigo_materia')" onblur="LabelOut('codigo_materia','labelcodigo_materia')" maxlength="11">
                    </div><br>

                    <div class="input-container">
                        <label for="nombre_materia" id="labelnombre_materia">Nombre Materia</label><br>
                        <input type="text" id="nombre_materia" name="nombre_materia" onfocus="LabelAnimation('nombre_materia','labelnombre_materia')" onblur="LabelOut('nombre_materia','labelnombre_materia')" maxlength="30">
                    </div><br>

                    <div class="input-container">
                        <label for="tipo_materia" id="labeltipo_materia">Tipo de Materia</label><br>
                        <input type="text" id="tipo_materia" name="tipo_materia" onfocus="LabelAnimation('tipo_materia','labeltipo_materia')" onblur="LabelOut('tipo_materia','labeltipo_materia')" maxlength="30">
                    </div><br>
                    <button type="button" onclick="Submit()">Registrar</button>
                </div>
            </form>
            <form action="../control/c_profesor.php" method="POST" name="profesor">
                <div class="profesor-container" id="profesor-container">
                    <h2>Registrar Profesor</h2>

                    <div class="input-container">
                        <label for="cedula" id="labelcedula">Cedula</label><br>
                        <input type="text" id="cedula" name="cedula" onfocus="LabelAnimation('cedula','labelcedula')" onblur="LabelOut('cedula','labelcedula')" maxlength="11">
                    </div>

                    <div class="input-container">
                        <select name="rol" id="rol" onclick="SelectAnimation('rol')">
                            <option value="">Seleccione el Rol</option>
                            <option value="1">Administrador</option>
                            <option value="0">Profesor</option>
                        </select>
                    </div>

                    <div class="input-container">
                        <label for="primer_nombre" id="labelprimer_nombre">Primer Nombre</label><br>
                        <input type="text" id="primer_nombre" name="primer_nombre" onfocus="LabelAnimation('primer_nombre','labelprimer_nombre')" onblur="LabelOut('primer_nombre','labelprimer_nombre')" maxlength="30">
                    </div>

                    <div class="input-container">
                        <label for="segundo_nombre" id="labelsegundo_nombre">Segundo Nombre</label><br>
                        <input type="text" id="segundo_nombre" name="segundo_nombre"
                        onfocus="LabelAnimation('segundo_nombre','labelsegundo_nombre')" onblur="LabelOut('segundo_nombre','labelsegundo_nombre')" maxlength="30">
                    </div>

                    <div class="input-container">
                        <label for="primer_apellido" id="labelprimer_apellido">Primer Apellido</label><br>
                        <input type="text" id="primer_apellido" name="primer_apellido"
                        onfocus="LabelAnimation('primer_apellido','labelprimer_apellido')" onblur="LabelOut('primer_apellido','labelprimer_apellido')" maxlength="30">
                    </div>

                    <div class="input-container">
                        <label for="segundo_apellido" id="labelsegundo_apellido">Segundo Apellido</label><br>
                        <input type="text" id="segundo_apellido" name="segundo_apellido"
                        onfocus="LabelAnimation('segundo_apellido','labelsegundo_apellido')" onblur="LabelOut('segundo_apellido','labelsegundo_apellido')" maxlength="30">
                    </div>

                    <div class="input-container">
                        <label for="direccion" id="labeldireccion">Direccion</label><br>
                        <input type="text" id="direccion" name="direccion"
                        onfocus="LabelAnimation('direccion','labeldireccion')" onblur="LabelOut('direccion','labeldireccion')" maxlength="60">
                    </div>

                    <div class="input-container">
                        <label for="telefono" id="labeltelefono">Telefono</label><br>
                        <input type="text" id="telefono" name="telefono"
                        onfocus="LabelAnimation('telefono','labeltelefono')" onblur="LabelOut('telefono','labeltelefono')" maxlength="11">
                    </div>

                    <button type="button" onclick="Submit()">Registrar</button>
                </div>
            </form>
            <form action="../control/c_aula.php" method="POST" name="aula">
            <div class="aula-container" id="aula-container">
                    <h2>Registrar Aula</h2>
                    <div class="input-container">
                        <label for="codigo_aula" id="labelcodigo_aula">Codigo</label><br>
                        <input type="text" id="codigo_aula" name="codigo_aula" onfocus="LabelAnimation('codigo_aula','labelcodigo_aula')" onblur="LabelOut('codigo_aula','labelcodigo_aula')" maxlength="11">
                    </div><br>

                    <div class="input-container">
                        <label for="nombre_aula" id="labelnombre_aula">Nombre Aula</label><br>
                        <input type="text" id="nombre_aula" name="nombre_aula" onfocus="LabelAnimation('nombre_aula','labelnombre_aula')" onblur="LabelOut('nombre_aula','labelnombre_aula')" maxlength="30">
                    </div><br>
                    <button type="button" onclick="Submit()">Registrar</button>
            </div>
            </form>
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
?>
<script src="js/admin.js"></script>
</html>