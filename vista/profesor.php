<?php 
session_start();
if ($_SESSION["usuario"]!="profesor") {
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
    <link rel="stylesheet" href="css/horario.css">
    <title>Profesor</title>
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
        <div class="horario-window" style="display:none;height:160px;">
            <h4 style='text-align:center;'>Si cambia de horario los datos que no esten guardados se perderan.</h4>
            <h4 style='text-align:center;'>¿Desea continuar?</h4>
            <button class="delete" id="yes-horario">Si
            </button>
            <button class="delete" onclick="DisplayDelete('none','.horario-window')">No</button>
        </div>
        
        
    
    <div class="grid-container">
        <div class="header">
            <h2>Bienvenido <?php echo $_SESSION["usuario_nombre"][0]." ";echo $_SESSION["usuario_nombre"][1];?></h2>
        </div>
        <div class="slide-menu">
            <div class="principal-menu" >
            <div class="h4-container" onclick="AnimationPrincipalMenu(0)">
            <h4>Profesor</h4>
            </div>
            <img src="css/img/arrow_down.png" alt="" id="arrow_down" onclick="AnimationPrincipalMenu(0)">
                <div class="submenu">
                    <ul>
                        <a href="#disponibilidad-container-grid"><li id="disponibilidadProfesor">Disponibilidad</li> <div class="borderline"></div></a>
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
                        <a href="#horario_docente-container-grid"><li id="registrarHorario">Mostrar mi Horario</li><div class="borderline"></div></a>
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
         <div id='register_back'></div>
        <div id='history_back'></div>
        <form action="../control/c_horario.php" method="POST" name="horario" id="horario">
            <input type="text" class="input-update" id="update" name="update" hidden>
                <input type="text" class="input-delete" id="delete" name="delete" hidden>
                <input type="text" class="input-url" id="url" name="url" hidden>
                <div id="horario_docente-container" class="container" style='grid-template-columns:200px 200px;min-width:400px;'>
                    <a class="a_img"><img src="css/img/close.png" alt="" class="close-icon" id="close-icon-profesor" onclick="Close()"></a>
                    <h2 style='grid-column:1/3;'>Seleccione un Lapso</h2>
                    <div class="input-container" hidden>
                        <label for="cedula_horario" id="labelcedula_horario">Cedula</label><br>
                        <input type="text" id="cedula_horario" name="cedula_horario" onfocus="LabelAnimation('cedula_horario','labelcedula_horario')" onblur="LabelOut('cedula_horario','labelcedula_horario')" maxlength="11" class="input input-label" maxlength="15"  onkeyup="Search('cedula_horario','horario_drop')" autocomplete='off'  value='<?php echo $_SESSION["cedula_origin"]?>'>
                    </div>
                    <div class="input-container" id="input-carreras">
                        <label for="lapso_horario" id="labelapso_horario">Lapso Academico</label><br>
                        <input type="text" id="lapso_horario" name="lapso_horario" onfocus="LabelAnimation('lapso_horario','labelapso_horario')" onblur="LabelOut('lapso_horario','labelapso_horario')" maxlength="30" class="input input-label principal_input" onkeyup="Search('lapso_horario','lapso_drop_horario')" autocomplete="off" onclick="OnclickAppear('flex','lapso_drop_horario','lapso_horario')">
                        <div class="dropdown" id="lapso_drop_horario">
                        <?php
                            include_once("../control/c_function.php");
                            $list=[];
                            $list=GetLapso();
                            $totalarray=count($list);
                            for ($i=0; $i < $totalarray; $i++) { 
                                echo "<span value=".$list[$i][0]." onclick="."AddValueMateria('lapso_horario',this)".">".$list[$i][0]."</span>";
                            }
                        ?>
                        </div>
                    </div>
                    <div class="input-container" id="input-carreras">
                        <select name="tipo_horario" id="tipo_horario" class='input'>
                            <option value="">Tipo</option>
                            <option value="0">Matutino</option>
                            <option value="8">Vespertino</option>
                        </select>
                    </div>
                    <button type="button" onclick="Submit('horario','active')" style='grid-column:1/3;'>Mostrar</button>
                </div>
            </form>
        <form action="../control/c_disponibilidad.php" method="POST" name="disponibilidad" id="disponibilidad">
                <input type="text" class="input-update" id="update" name="update" hidden>
                <input type="text" class="input-delete" id="delete" name="delete" hidden>
                <input type="text" class="input-url" id="url" name="url" hidden>
                <div id="disponibilidad-container" class="container" style='display:none;'>
                    <a class="a_img"><img src="css/img/close.png" alt="" class="close-icon" id="close-icon-profesor" onclick="Close()"></a>
                    <h2>Disponibilidad</h2>
                    <div class="input-container">
                        <label for="cedula_dis" id="labelcedula_dis">Cedula</label><br>
                        <input type="text" id="cedula_dis" name="cedula_dis" onfocus="LabelAnimation('cedula_dis','labelcedula_dis')" onblur="LabelOut('cedula_dis','labelcedula_dis')" maxlength="11" class="input input-label" onkeyup="Search('cedula_dis','disponibilidad_drop')" autocomplete='off' value='<?php echo $_SESSION["cedula_usuario"]?>' disabled>
                        <input type="checkbox" class="checkbox-edit checkbox-materia"  onclick="CheckboxDisabled('codigo_carrera', this)" >
                        <div class="dropdown" id="disponibilidad_drop">
                        <?php

                            echo "<span value="."'".$_SESSION["usuario_nombre"][0]."/".$_SESSION["usuario_nombre"][1]."/".$_SESSION["dedicacion"]."'".">".$_SESSION["cedula_usuario"]."</span>";
                        ?>
                        </div>
                    </div>
                    <div class="input-container">
                        <label for="nombre_dis" id="labelnombre_dis">Nombre</label><br>
                        <input type="text" id="nombre_dis" name="nombre_dis" onfocus="LabelAnimation('nombre_dis','labelnombre_dis')" onblur="LabelOut('nombre_dis','labelnombre_dis')" maxlength="30" class="input input-label" disabled value='<?php echo $_SESSION["usuario_nombre"][0]." ";echo $_SESSION["usuario_nombre"][1];?>'>
                        <input type="checkbox" class="checkbox-edit checkbox-materia"  onclick="CheckboxDisabled('nombre_dis', this)">
                    </div>
                    <div class="input-container">
                        <label for="contratacion_dis" id="labelcontratacion_dis">Dedicacion</label><br>
                        <input type="text" id="contratacion_dis" name="contratacion_dis" onfocus="LabelAnimation('contratacion_dis','labelcontratacion_dis')" onblur="LabelOut('contratacion_dis','labelcontratacion_dis')" maxlength="30" class="input input-label" disabled value='<?php echo $_SESSION["dedicacion"]?>'>
                        <input type="checkbox" class="checkbox-edit checkbox-materia"  onclick="CheckboxDisabled('nombre_carrera', this)">
                        <input type="text" id="del" name="del" class='input' hidden>
                    </div>

                    <!-- --------------PRIMER BLOQUE---------- -->
                    <input type="text" id="del" name="del" hidden>
                    <div class="input-container">
                        <select name="dias_1" id="dias_1" class='input-dis' value="bloques_add_drop_1" style='margin-top:25px;'>
                            <option value="1">LUNES</option>
                        </select>
                    </div>
                    <div class="input-container input-bloques" style='margin-bottom:60px;margin-top:0px;'>
                        <label for="bloques_1" id="labebloques_1">Bloques</label><br>
                        <input type="text" id="bloques_1" name="bloques_1" onfocus="LabelAnimation('bloques_1','labebloques_1')" onblur="LabelOut('bloques_1','labebloques_1')" autocomplete="off" maxlength="30" class="input-label" onkeyup="Search('bloques_1','bloques_drop_1')">
                        <input type="checkbox" class="checkbox-edit"  onclick="CheckboxDisabled('bloques_1', this)">
                        <img src="css/img/add.png" alt="" onclick="AddAndRemove('bloques_drop_1','bloques_add_drop_1','bloques_1','bloques_add_1','add', 'disponibilidad-container')">
                        <div class="dropdown drop_main" id="bloques_drop_1">
                        <?php
                             $hora="07:00";
                             $hora2="07:45";
                            for ($i=1; $i <= 20; $i++) { 
                                echo "<span id=B$i onclick=AddValueMateria('bloques_1',this)>BLOQUE ".$i." $hora-$hora2</span>";
                                $nuevahora=strtotime($hora)+strtotime("00:45");
                                $hora=date('H:i', $nuevahora);
                                $nuevahora2=strtotime($hora2)+strtotime("00:45");
                                $hora2=date('H:i', $nuevahora2);
                            }
                        ?>
                        </div>
                        <img src="css/img/arrow-add.png" alt="flecha" style='width:20px;height:20px;position:absolute;right:-30px;top:100px;' title='Añade todos los bloques' onclick='AddAllBloques("bloques_drop_1", "bloques_add_drop_1")'>
                        <img src="css/img/arrow-delete.png" alt="flecha" style='width:20px;height:20px;position:absolute;right:-30px;top:130px;' title='Eliminar todos los bloques' onclick='DeleteAllBloques("bloques_drop_1", "bloques_add_drop_1")'>
                    </div>
                    <div class="input-container input-bloques" style='grid-column: span 3/;margin-top:0px;'>
                        <label for="bloques_add_1" id="labelbloques_add_1">Bloques Añadidos</label><br>
                    <input type="text" id="bloques_add_1" name="bloques_add_1" onfocus="LabelAnimation('bloques_add_1','labelbloques_add_1')" onblur="LabelOut('bloques_add_1','labelbloques_add_1')" maxlength="30" class="input-label input_add" onkeyup="Search('bloques_add_1','bloques_add_drop_1')" autocomplete="off">
                    
                        <img src="css/img/menos.png" alt="" onclick="AddAndRemove('bloques_add_drop_1','bloques_drop_1','bloques_add_1','bloques_1','del', 'disponibilidad-container')">
                        <input type="text" id="add" name="add" class='input' hidden>
                        <input type="checkbox" class="checkbox-edit checkbox-add"  onclick="CheckboxDisabled('bloques_add_1', this, 'active')">
                        
                        <div class="dropdown drop_add" id="bloques_add_drop_1" value="bloques_add_1">
                        </div>
                    </div>
                    <!-- --------------PRIMER BLOQUE---------- -->

                    <!-- --------------SEGUNDO BLOQUE---------- -->
                    <div class="input-container">
                        <select name="dias_2" id="dias_2" class='input-dis' value="bloques_add_drop_2">
                            <option value="2">MARTES</option>
                        </select>
                    </div>
                    <div class="input-container input-bloques" id="input-carreras" style='margin-bottom:60px;'>
                        <label for="bloques_2" id="labebloques_2">Bloques</label><br>
                        <input type="text" id="bloques_2" name="bloques_2" onfocus="LabelAnimation('bloques_2','labebloques_2')" onblur="LabelOut('bloques_2','labebloques_2')" maxlength="30" class="input-label" onkeyup="Search('bloques_2','bloques_drop_2')" autocomplete="off">
                        <input type="checkbox" class="checkbox-edit"  onclick="CheckboxDisabled('bloques_2', this)">
                        <img src="css/img/add.png" alt="" onclick="AddAndRemove('bloques_drop_2','bloques_add_drop_2','bloques_2','bloques_add_2','add', 'disponibilidad-container')">
                        <div class="dropdown drop_main" id="bloques_drop_2">
                        <?php
                             $hora="07:00";
                             $hora2="07:45";
                            for ($i=1; $i <= 20; $i++) { 
                                echo "<span id=B$i onclick=AddValueMateria('bloques_2',this)>BLOQUE ".$i." $hora-$hora2</span>";
                                $nuevahora=strtotime($hora)+strtotime("00:45");
                                $hora=date('H:i', $nuevahora);
                                $nuevahora2=strtotime($hora2)+strtotime("00:45");
                                $hora2=date('H:i', $nuevahora2);
                            }
                        ?>
                        </div>
                        <img src="css/img/arrow-add.png" alt="flecha" style='width:20px;height:20px;position:absolute;right:-30px;top:100px;' title='Añade todos los bloques' onclick='AddAllBloques("bloques_drop_2", "bloques_add_drop_2")'>
                        <img src="css/img/arrow-delete.png" alt="flecha" style='width:20px;height:20px;position:absolute;right:-30px;top:130px;' title='Eliminar todos los bloques' onclick='DeleteAllBloques("bloques_drop_2", "bloques_add_drop_2")'>
                    </div>
                    <div class="input-container input-bloques" style='grid-column: span 3/;'>
                        <label for="bloques_add_2" id="labelbloques_add_2">Bloques Añadidos</label><br>
                    <input type="text" id="bloques_add_2" name="bloques_add_2" onfocus="LabelAnimation('bloques_add_2','labelbloques_add_2')" onblur="LabelOut('bloques_add_2','labelbloques_add_2')" maxlength="30" class="input-label input_add" onkeyup="Search('bloques_add_2','bloques_add_drop_2')" autocomplete="off">
                    
                        <img src="css/img/menos.png" alt="" onclick="AddAndRemove('bloques_add_drop_2','bloques_drop_2','bloques_add_2','bloques_2','del', 'disponibilidad-container')">
                        <input type="text" id="add" name="add" class='input' hidden>
                        <input type="checkbox" class="checkbox-edit checkbox-add"  onclick="CheckboxDisabled('bloques_add_2', this, 'active')">
                        
                        <div class="dropdown drop_add" id="bloques_add_drop_2" value="bloques_add_2">
                        </div>
                    </div>
                    <!-- --------------SEGUNDO BLOQUE---------- -->

                    <!-- --------------TERCER BLOQUE---------- -->
                    <div class="input-container">
                        <select name="dias_3" id="dias_3" class='input-dis' value="bloques_add_drop_3">
                            <option value="3">MIERCOLES</option>
                        </select>
                    </div>
                    <div class="input-container input-bloques" id="input-carreras" style='margin-bottom:60px;'>
                        <label for="bloques_3" id="labebloques_3">Bloques</label><br>
                        <input type="text" id="bloques_3" name="bloques_3" onfocus="LabelAnimation('bloques_3','labebloques_3')" onblur="LabelOut('bloques_3','labebloques_3')" maxlength="30" class="input-label" onkeyup="Search('bloques_3','bloques_drop_3')" autocomplete="off">
                        <input type="checkbox" class="checkbox-edit"  onclick="CheckboxDisabled('bloques_3', this)">
                        <img src="css/img/add.png" alt="" onclick="AddAndRemove('bloques_drop_3','bloques_add_drop_3','bloques_3','bloques_add_3','add', 'disponibilidad-container')">
                        <div class="dropdown drop_main" id="bloques_drop_3">
                        <?php
                             $hora="07:00";
                             $hora2="07:45";
                            for ($i=1; $i <= 20; $i++) { 
                                echo "<span id=B$i onclick=AddValueMateria('bloques_3',this)>BLOQUE ".$i." $hora-$hora2</span>";
                                $nuevahora=strtotime($hora)+strtotime("00:45");
                                $hora=date('H:i', $nuevahora);
                                $nuevahora2=strtotime($hora2)+strtotime("00:45");
                                $hora2=date('H:i', $nuevahora2);
                            }
                        ?>
                        </div>
                        <img src="css/img/arrow-add.png" alt="flecha" style='width:20px;height:20px;position:absolute;right:-30px;top:100px;' title='Añade todos los bloques' onclick='AddAllBloques("bloques_drop_3", "bloques_add_drop_3")'>
                        <img src="css/img/arrow-delete.png" alt="flecha" style='width:20px;height:20px;position:absolute;right:-30px;top:130px;' title='Eliminar todos los bloques' onclick='DeleteAllBloques("bloques_drop_3", "bloques_add_drop_3")'>
                    </div>
                    <div class="input-container input-bloques" style='grid-column: span 3/;'>
                        <label for="bloques_add_3" id="labelbloques_add_3">Bloques Añadidos</label><br>
                    <input type="text" id="bloques_add_3" name="bloques_add_3" onfocus="LabelAnimation('bloques_add_3','labelbloques_add_3')" onblur="LabelOut('bloques_add_3','labelbloques_add_3')" maxlength="30" class="input-label input_add" onkeyup="Search('bloques_add','bloques_add_drop')" autocomplete="off">
                    
                        <img src="css/img/menos.png" alt="" onclick="AddAndRemove('bloques_add_drop_3','bloques_drop_3','bloques_add_3','bloques_3','del', 'disponibilidad-container')">
                        <input type="text" id="add" name="add" class='input' hidden>
                        <input type="checkbox" class="checkbox-edit checkbox-add"  onclick="CheckboxDisabled('bloques_add_3', this, 'active')">
                        
                        <div class="dropdown drop_add" id="bloques_add_drop_3" value="bloques_add_3">
                        </div>
                    </div>
                    <!-- --------------TERCER BLOQUE---------- -->


                    <!-- --------------CUARTO BLOQUE---------- -->
                    <div class="input-container">
                        <select name="dias_4" id="dias_4" class='input-dis' value="bloques_add_drop_4">
                            <option value="4">JUEVES</option>
                        </select>
                    </div>
                    <div class="input-container input-bloques" id="input-carreras" style='margin-bottom:60px;'>
                        <label for="bloques_4" id="labebloques_4">Bloques</label><br>
                        <input type="text" id="bloques_4" name="bloques_4" onfocus="LabelAnimation('bloques_4','labebloques_4')" onblur="LabelOut('bloques_4','labebloques_4')" maxlength="30" class="input-label" onkeyup="Search('bloques_4','bloques_drop_4')" autocomplete="off">
                        <input type="checkbox" class="checkbox-edit"  onclick="CheckboxDisabled('bloques_4', this)">
                        <img src="css/img/add.png" alt="" onclick="AddAndRemove('bloques_drop_4','bloques_add_drop_4','bloques_4','bloques_add_4','add', 'disponibilidad-container')">
                        <div class="dropdown drop_main" id="bloques_drop_4">
                        <?php
                             $hora="07:00";
                             $hora2="07:45";
                            for ($i=1; $i <= 20; $i++) { 
                                echo "<span id=B$i onclick=AddValueMateria('bloques_4',this)>BLOQUE ".$i." $hora-$hora2</span>";
                                $nuevahora=strtotime($hora)+strtotime("00:45");
                                $hora=date('H:i', $nuevahora);
                                $nuevahora2=strtotime($hora2)+strtotime("00:45");
                                $hora2=date('H:i', $nuevahora2);
                            }
                        ?>
                        </div>
                        <img src="css/img/arrow-add.png" alt="flecha" style='width:20px;height:20px;position:absolute;right:-30px;top:100px;' title='Añade todos los bloques' onclick='AddAllBloques("bloques_drop_4", "bloques_add_drop_4")'>
                        <img src="css/img/arrow-delete.png" alt="flecha" style='width:20px;height:20px;position:absolute;right:-30px;top:130px;' title='Eliminar todos los bloques' onclick='DeleteAllBloques("bloques_drop_4", "bloques_add_drop_4")'>
                    </div>
                    <div class="input-container input-bloques" style='grid-column: span 3/;'>
                        <label for="bloques_add_4" id="labelbloques_add_4">Bloques Añadidos</label><br>
                    <input type="text" id="bloques_add_4" name="bloques_add_4" onfocus="LabelAnimation('bloques_add_4','labelbloques_add')" onblur="LabelOut('bloques_add_4','labelbloques_add_4')" maxlength="30" class="input-label input_add" onkeyup="Search('bloques_add_4','labelbloques_add_4')" autocomplete="off">
                    
                        <img src="css/img/menos.png" alt="" onclick="AddAndRemove('bloques_add_drop_4','bloques_drop_4','bloques_add_4','bloques_4','del', 'disponibilidad-container')">
                        <input type="text" id="add" name="add" class='input' hidden>
                        <input type="checkbox" class="checkbox-edit checkbox-add"  onclick="CheckboxDisabled('bloques_add_4', this, 'active')">
                        
                        <div class="dropdown drop_add" id="bloques_add_drop_4" value="bloques_add_4">
                        </div>
                    </div>
                     <!-- --------------CUARTO BLOQUE---------- -->


                    <!-- --------------QUINTO BLOQUE---------- -->
                    <div class="input-container">
                        <select name="dias_5" id="dias_5" class='input-dis' value="bloques_add_drop_5">
                            <option value="5">VIERNES</option>
                        </select>
                    </div>
                    <div class="input-container input-bloques" id="input-carreras" style='margin-bottom:60px;'>
                        <label for="bloques_5" id="labebloques_5">Bloques</label><br>
                        <input type="text" id="bloques_5" name="bloques_5" onfocus="LabelAnimation('bloques_5','labebloques_5')" onblur="LabelOut('bloques_5','labebloques_5')" maxlength="30" class="input-label" onkeyup="Search('bloques_5','bloques_drop_5')" autocomplete="off">
                        <input type="checkbox" class="checkbox-edit"  onclick="CheckboxDisabled('bloques_5', this)">
                        <img src="css/img/add.png" alt="" onclick="AddAndRemove('bloques_drop_5','bloques_add_drop_5','bloques_5','bloques_add_5','add', 'disponibilidad-container')">
                        <div class="dropdown drop_main" id="bloques_drop_5">
                        <?php
                             $hora="07:00";
                             $hora2="07:45";
                            for ($i=1; $i <= 20; $i++) { 
                                echo "<span id=B$i onclick=AddValueMateria('bloques_5',this)>BLOQUE ".$i." $hora-$hora2</span>";
                                $nuevahora=strtotime($hora)+strtotime("00:45");
                                $hora=date('H:i', $nuevahora);
                                $nuevahora2=strtotime($hora2)+strtotime("00:45");
                                $hora2=date('H:i', $nuevahora2);
                            }
                        ?>
                        </div>
                        <img src="css/img/arrow-add.png" alt="flecha" style='width:20px;height:20px;position:absolute;right:-30px;top:100px;' title='Añade todos los bloques' onclick='AddAllBloques("bloques_drop_5", "bloques_add_drop_5")'>
                        <img src="css/img/arrow-delete.png" alt="flecha" style='width:20px;height:20px;position:absolute;right:-30px;top:130px;' title='Eliminar todos los bloques' onclick='DeleteAllBloques("bloques_drop_5", "bloques_add_drop_5")'>
                    </div>
                    <div class="input-container input-bloques" style='grid-column: span 3/;'>
                        <label for="bloques_add_5" id="labelbloques_add_5">Bloques Añadidos</label><br>
                    <input type="text" id="bloques_add_5" name="bloques_add_5" onfocus="LabelAnimation('bloques_add_5','labelbloques_add_5')" onblur="LabelOut('bloques_add_5','labelbloques_add_5')" maxlength="30" class="input-label input_add" onkeyup="Search('bloques_add_5','bloques_add_drop_5')" autocomplete="off">
                    
                        <img src="css/img/menos.png" alt="" onclick="AddAndRemove('bloques_add_drop_5','bloques_drop_5','bloques_add_5','bloques_5','del', 'disponibilidad-container')">
                        <input type="text" id="add" name="add" class='input' hidden>
                        <input type="checkbox" class="checkbox-edit checkbox-add"  onclick="CheckboxDisabled('bloques_add_5', this, 'active')">
                        
                        <div class="dropdown drop_add" id="bloques_add_drop_5" value="bloques_add_5">
                        </div>
                    </div>
                    <!-- --------------QUINTO BLOQUE---------- -->
                    <button type="button" onclick="SubmitDisponibilidad()" style='grid-column:2/3;'>Registrar</button>
                    <button type="button" onclick="SaveDisponibilidad()" class="button-edit button-update" style='grid-column:2/3;'>Guardar</button>
                    <button id='delete-button' type="button" onclick="DisplayDelete('block','.delete-window','#disponibilidad')" class="button-edit button-delete" style='display:none;grid-column:3/4;' hidden>Eliminar</button>
                </div>
            </form>
            <?php include_once("msg_error.php");
                    if (isset($_SESSION["lista_disponibilidad"])) {
                        include_once("horario.php");
                        
                    }
            ?>
            <div id='refresh'></div>
        </div>
        
    </div>
    <?php
        if (isset($_SESSION["lista_disponibilidad"])) {
                $dias=1;
                $b=$_SESSION["tipo_horario"]+1;
                $bloque="";
                $list=$_SESSION["lista_disponibilidad"];
                $list_i=0;
                $bloque_id=0;
                echo "<form id='horario_form' method='POST' name='horario_form' action='../control/c_horario.php'>
                <input type='text' class='input-url' id='url' name='url' hidden>
                <input type='text' id='codigo_cedula_horario' name='input_horario[]' value='".$_SESSION["disponibilidad_profesor"][0][0]."' hidden>
                <input type='text' id='codigo_lapso_horario' name='input_horario[]' value='".$_SESSION["lapso"]."' hidden>";
                echo "</form>";    
            }
        ?>
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
<script type="text/javascript" src="js/ejecutar_profesor.js"></script>
<script type="text/javascript" src="js/user_confirm.js"></script>
<script type="text/javascript" src="js/admin-edit.js"></script>
<script type="text/javascript" src="js/listar.js"></script>
<script type="text/javascript">
          
          <?php
            include_once("../control/c_function.php");
            $list=GetMaterias();
            $list_dis=GetDisponibilidad();
            if (isset($_SESSION["lista_disponibilidad"])) {
                echo "AppearsAndDissapear('horario_agrupar','block');";
                echo "activehorario=1;";
                unset($_SESSION["lista_disponibilidad"]);
                unset($_SESSION["find_horario"]);
            }
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
                echo "];";
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
                else if ($_SESSION["container"]=="noticia-container") {
                        echo "valores=[";
                        echo  "'".$_SESSION["update"][0]."'".',';
                        echo  "'".$_SESSION["update"][3]."'".',';
                        echo  "'".$_SESSION["update"][1]."'".',';
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
                                echo "'".$_SESSION["update"][7]."'".',';
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


