<form action="../control/c_oficio.php" method="POST" name="oficio_reg" id="oficio_reg">
                <input type="text" class="input-update" id="update" name="update" hidden>
                <input type="text" class="input-delete" id="delete" name="delete" hidden>
                <input type="text" class="input-url" id="url" name="url" hidden>
                <div id="oficio-container" class="container container-flex">
                    <a class="a_img"><img src="css/img/close.png" alt="" class="close-icon" id="close-icon-profesor" onclick="Close()" style='left:-10px;top:-5px;'></a>
                    <h2>Crear Oficio</h2>
                    <div class="input-container">
                        <label for="oficio_registrar" id="labeloficio_registrar">Oficio</label><br>
                        <input type="text" id="oficio_registrar" name="oficio_registrar" onfocus="LabelAnimation('oficio_registrar','labeloficio_registrar')" onblur="LabelOut('oficio_registrar','labeloficio_registrar')" maxlength="30" class="input input-label" style="text-transform:uppercase" autocomplete='off'>
                        <input type="checkbox" class="checkbox-edit checkbox-materia" onclick="CheckboxDisabled('oficio_registrar', this)">
                    </div>
                    <button type="button" onclick="Submit('oficio_reg')" style='grid-column:1/3;'>Registrar</button>
                    <button type="button" onclick="Save('oficio_reg')" class="button-edit button-update">Guardar</button>
                    <button type="button" onclick="DisplayDelete('block','.delete-window','#oficio_reg')" class="button-edit button-delete">Eliminar</button>
                </div>
            </form>

<form action="../control/c_seccion.php" method="POST" name="seccion" id="seccion">
            <input type="text" class="input-update" id="update" name="update" hidden>
            <input type="text" class="input-delete" id="delete" name="delete" hidden>
            <input type="text" class="input-url" id="url" name="url" hidden>
            <div id="seccion-container" class="container container-flex">
            <a class="a_img"><img src="css/img/close.png" alt="" class="close-icon" id="close-icon-profesor" onclick="Close()" style='left:-10px;top:-5px;'></a>
                    <h2>Crear Seccion</h2>
                    <div class="input-container">
                        <label for="seccion_registrar" id="labelseccion_registrar">Codigo</label><br>
                        <input type="text" id="seccion_registrar" name="seccion_registrar" onfocus="LabelAnimation('seccion_registrar','labelseccion_registrar')" onblur="LabelOut('seccion_registrar','labelseccion_registrar')" maxlength="10" class="input input-label" style="text-transform:uppercase" autocomplete='off'>
                        <input type="checkbox" class="checkbox-edit checkbox-materia" onclick="CheckboxDisabled('seccion_registrar', this)">
                    </div>
                    <button type="button" onclick="Submit('seccion')" style='grid-column:1/3;'>Registrar</button>
                    <button type="button" onclick="Save('seccion')" class="button-edit button-update">Guardar</button>
                    <button type="button" onclick="DisplayDelete('block','.delete-window','#seccion')" class="button-edit button-delete">Eliminar</button>
                </div>
        </form>
<form action="../control/c_pensum.php" method="POST" name="materia" id="materia">
                <input type="text" class="input-update" id="update" name="update" hidden>
                <input type="text" class="input-delete" id="delete" name="delete" hidden>
                <input type="text" class="input-url" id="url" name="url" hidden>
                <div class="container container-flex" id="pensum-container">
                <a class="a_img"><img src="css/img/close.png" alt="" class="close-icon" id="close-icon-profesor" onclick="Close()"></a>
                    
                    <h2 style='grid-column:1/5;'>Unidad Curricular</h2>
                    <div class="input-container" id="input-carreras">
                        <label for="carreras" id="labelcarreras">PNF</label><br>
                        <input type="text" id="carreras" name="carreras" onfocus="LabelAnimation('carreras','labelcarreras')" onblur="LabelOut('carreras','labelcarreras')" maxlength="30" class="input-label principal_input" onkeyup="Search('carreras','carreras_drop')" autocomplete="off" style='width:89%;text-transform:uppercase'>
                        <input type="checkbox" class="checkbox-edit"  onclick="CheckboxDisabled('carreras', this)">
                        <div class="dropdown" id="carreras_drop">
                        <?php 
                            include_once("../control/c_function.php");
                            DeleteNoticia();
                            $list=[];
                            $list=GetCarrerasNotPensum();
                            $carrera=GetCarreras();
                            $totalarray=count($list);
                            $totalcarrera=count($carrera);
                            if (isset($carrera)) {
                                for ($i=0; $i < $totalcarrera; $i++) { 
                                echo "<span id=".$carrera[$i][0]." onclick="."AddValueMateria('carreras',this)".">".$carrera[$i][1]." **</span>";
                                }
                            }
                            if (isset($list)) {
                                for ($i=0; $i < $totalarray; $i++) { 
                                    echo "<span id=".$list[$i][0]." onclick="."AddValueMateria('carreras',this)".">".$list[$i][1]."</span>";
                               }
                            }
                            
                            
                        ?>
                        </div>
                    </div>
                    <div class="input-container" style='grid-column:3/5;'>
                        <select name="tipo_materia" id="tipo_materia" onclick="SelectAnimation('rol')" class="input">
                            <option value="">Tipo</option>
                            <option value="0">Disciplinaria</option>
                            <option value="1">Multidisciplinaria</option>
                        </select>
                        
                    </div>
                    <div class="input-container dis">
                        <label for="codigo_materia" id="labelcodigo_materia">Codigo</label><br>
                        <input type="text" id="codigo_materia" name="codigo_materia" onfocus="LabelAnimation('codigo_materia','labelcodigo_materia')" onblur="LabelOut('codigo_materia','labelcodigo_materia')" maxlength="11" class="input input-label" style="text-transform:uppercase" autocomplete='off'>
                        <input type="checkbox" class="checkbox-edit checkbox-materia"   onclick="CheckboxDisabled('codigo_materia', this)">
                    </div>

                    <div class="input-container dis" style='grid-column:3/5;'>
                        <label for="nombre_materia" id="labelnombre_materia">Nombre Materia</label><br>
                        <input type="text" id="nombre_materia" name="nombre_materia" onfocus="LabelAnimation('nombre_materia','labelnombre_materia')" onblur="LabelOut('nombre_materia','labelnombre_materia')" maxlength="30" class="input input-label" style="text-transform:uppercase" autocomplete='off'>
                        <input type="checkbox" class="checkbox-edit checkbox-materia"   onclick="CheckboxDisabled('nombre_materia', this)" style='right:30px;'>
                        <div class='button-add' onclick="AddMateria('add')" class='dis' >
                            <b style='position:relative;top:-10px;left:5px;'>Agregar</b>
                            <img src="css/img/add.png" alt="" style='position:relative;top:0;'>
                        </div>
                        
                    </div>
                    <div class="input-container  dis">
                        <label for="horas_semana_unidad" id="labelhoras_semana_unidad">Horas por semana</label><br>
                    <input type="text" id="horas_semana_unidad" name="horas_semana_unidad" onfocus="LabelAnimation('horas_semana_unidad','labelhoras_semana_unidad')" onblur="LabelOut('horas_semana_unidad','labelhoras_semana_unidad')" maxlength="2" class="input input-label input_add" autocomplete="off">
                    </div>
                    <div class="input-container dis" style='grid-column:3/5;'>
                        <label for="unidad_credito_unidad" id="labelunidad_credito_unidad">Unidad de credito</label><br>
                    <input type="text" id="unidad_credito_unidad" name="unidad_credito_unidad" onfocus="LabelAnimation('unidad_credito_unidad','labelunidad_credito_unidad')" onblur="LabelOut('unidad_credito_unidad','labelunidad_credito_unidad')" maxlength="2" class="input input-label input_add" autocomplete="off">
                    </div>
                    <div class="input-container das" hidden style='grid-column:1/5;'>
                        <label for="materias_unidad" id="labelmaterias_unidad">Materias</label><br>
                        <input type="text" id="materias_unidad" name="materias_unidad" onfocus="LabelAnimation('materias_unidad','labelmaterias_unidad')" onblur="LabelOut('materias_unidad','labelmaterias_unidad')" maxlength="30" class="input-label input_added" onkeyup="Search('materias_unidad','materias_drop_unidad')" autocomplete="off" style='width:93%;'>
                        <img src="css/img/add.png" alt="" onclick="AddAndRemove('materias_drop_unidad','materias_add_drop_unidad','materias_unidad','materias_add_unidad','add','pensum-container')">
                        <input type="checkbox" class="checkbox-edit checkbox-lapso"  onclick="CheckboxDisabled('materias_unidad', this,'active')">
                    <div class="dropdown drop" id="materias_drop_unidad" style='width:96%;font-size:16px;'>
   
                        <?php 
                            $list=[];
                            $list=GetMateriaMulti();
                            $totalarray=count($list);
                            for ($i=0; $i < $totalarray; $i++) { 
                                echo "<span id='".$list[$i][0]."'". "onclick="."AddValueMateria('materias_unidad',this)".">".$list[$i][0].", ".$list[$i][1]." | HS: ".$list[$i][3].", UC: ".$list[$i][4]."</span>";
                            }
                        ?>
                        </div>
                    </div>
                    
                        <div class="input-container input-add das" hidden style='grid-column:1/5;width:100%;'>
                        <label for="materias_add_unidad" id="labelmaterias_add_unidad">Materias Añadidas</label><br>
                        <input type="text" id="materias_add_unidad" name="materias_add_unidad" onfocus="LabelAnimation('materias_add_unidad','labelmaterias_add_unidad')" onblur="LabelOut('materias_add_unidad','labelmaterias_add_unidad')" maxlength="30" class="input-label input_add" onkeyup="Search('materias_add_unidad','materias_add_dropunidad')" style='width:93%;' autocomplete="off">
                        <img src="css/img/menos.png" alt="" onclick="AddAndRemove('materias_add_drop_unidad','materias_drop_unidad','materias_add_unidad','materias_unidad','del','pensum-container')">
                        <input type="checkbox" class="checkbox-edit checkbox-add"  onclick="CheckboxDisabled('materias_add_unidad', this,'active')">
                        <input type="text" id="add" name="add" class='input' hidden>
                        <input type="text" id="del" name="del" class='input' hidden>
                        <div class="dropdown drop_add" id="materias_add_drop_unidad" style='width:96%;font-size:16px;'></div>
                    </div>
                    <div class="input-container input-add dis" style='margin-top:30px;grid-column:1/5;'>
                        <label for="materias_add" id="labelmaterias_add">Materias Añadidas</label><br>
                        <input type="text" id="materias_add" name="materias_add" onfocus="LabelAnimation('materias_add','labelmaterias_add')" onblur="LabelOut('materias_add','labelmaterias_add')" maxlength="30" class="input-label input_add" onkeyup="Search('materias_add','materias_add_drop')" autocomplete="off" style='width:92%;'>
                        <img src="css/img/menos.png" alt="" onclick="AddMateria('del')">
                        <input type="checkbox" class="checkbox-edit checkbox-add"  onclick="CheckboxDisabled('materias_add', this,'active')">
                        <input type="text" id="add_multi" name="add_multi" hidden>
                        <input type="text" id="del_multi" name="del_multi" hidden>
                        <div class="dropdown drop_add" id="materias_add_drop" style='width:96%;font-size:16px;'></div>
                    </div>
                    <button type="button" class='button_main' onclick="SubmitMateria('materia')" style='margin-top:30px;grid-column:2/4;'>Registrar</button>
                    <!--
                        <button type="button" onclick="DisplayDelete('flex','#materia-find','#materia')" style="grid-column:2/3;margin-top:30px;">Buscar</button>
                         <button type="button" onclick="Save('materia')" class="button-edit button-update" style='margin-top:30px;'>Guardar</button>
                          <button type="button" onclick="DisplayDelete('block','.delete-window','#materia')" class="button-edit button-delete" style="grid-column:2/3;margin-top:30px;">Eliminar</button>
                     -->
                    <button type="button" onclick="SaveMaterias()" class="button-edit button-update button_unidad" style='margin-top:30px;grid-column:1/3;'>Guardar</button>
                    <button type="button" onclick="DisplayDelete('block','.delete-window','#materia')" class="button-edit button-delete button_unidad" style="grid-column:3/5;margin-top:30px;">Eliminar</button>
                </div>
            </form>
            <form action="../control/c_materia.php" method="POST" name="unidad" id="unidad">
                <input type="text" class="input-update" id="update" name="update" hidden>
                <input type="text" class="input-delete" id="delete" name="delete" hidden>
                <input type="text" class="input-url" id="url" name="url" hidden>
                <div id="materia-container" class="container container-flex">
                    <a class="a_img"><img src="css/img/close.png" alt="" class="close-icon" id="close-icon-profesor" onclick="Close()" style='left:-10px;top:-5px;'></a>
                    <h2>Materia Multidisciplinaria</h2>
                    <div class="input-container">
                        <label for="codigo_materia_multi" id="labelcodigo_materia_multi">Codigo</label><br>
                        <input type="text" id="codigo_materia_multi" name="codigo_materia_multi" onfocus="LabelAnimation('codigo_materia_multi','labelcodigo_materia_multi')" onblur="LabelOut('codigo_materia_multi','labelcodigo_materia_multi')" maxlength="11" class="input input-label" style="text-transform:uppercase" autocomplete='off'> 
                        <input type="checkbox" class="checkbox-edit checkbox-materia"   onclick="CheckboxDisabled('codigo_materia_multi', this)" style='left:265px;'>
                    </div>
                    <div class="input-container">
                        <label for="nombre_materia_multi" id="labelnombre_materia_multi">Nombre Materia</label><br>
                        <input type="text" id="nombre_materia_multi" name="nombre_materia_multi" onfocus="LabelAnimation('nombre_materia_multi','labelnombre_materia_multi')" onblur="LabelOut('nombre_materia_multi','labelnombre_materia_multi')" maxlength="30" class="input input-label" style="text-transform:uppercase" autocomplete='off'>
                        <input type="checkbox" class="checkbox-edit checkbox-materia"   onclick="CheckboxDisabled('nombre_materia_multi', this)" style='left:265px;'>
                    </div>
                    <div class="input-container  input-add">
                        <label for="horas_semana" id="labelhoras_semana">Horas por semana</label><br>
                    <input type="text" id="horas_semana" name="horas_semana" onfocus="LabelAnimation('horas_semana','labelhoras_semana')" onblur="LabelOut('horas_semana','labelhoras_semana')" maxlength="2" class="input input-label input_add" autocomplete="off">
                        <input type="checkbox" class="checkbox-edit checkbox-add"  onclick="CheckboxDisabled('horas_semana', this)" style='left:265px;'>
                    </div>
                    <div class="input-container  input-add">
                        <label for="unidad_credito" id="labelunidad_credito">Unidad de credito</label><br>
                    <input type="text" id="unidad_credito" name="unidad_credito" onfocus="LabelAnimation('unidad_credito','labelunidad_credito')" onblur="LabelOut('unidad_credito','labelunidad_credito')" maxlength="2" class="input input-label input_add" autocomplete="off">
                        <input type="checkbox" class="checkbox-edit checkbox-add"  onclick="CheckboxDisabled('unidad_credito', this)" style='left:265px;'>
                    </div>
                   
                    <div class="input-container" hidden>
                        <select name="tipo_materia_multi" id="tipo_materia_multi" onclick="SelectAnimation('rol')" class="input">
                            <option value="1">Multidisciplinaria</option>
                        </select>
                    </div>
                    <button type="button" onclick="Submit('unidad')">Registrar</button>
                    <button type="button" onclick="DisplayDelete('flex','#materia-find','#unidad')">Buscar</button>
                    <button type="button" onclick="Save('unidad')" class="button-edit button-update">Guardar</button>
                    <button type="button" onclick="DisplayDelete('block','.delete-window','#unidad')" class="button-edit button-delete">Eliminar</button>
                </div>
            </form>
            <form action="../control/c_profesor.php" method="POST" name="profesor" id="profesor">
                <input type="text" class="input-update" id="update" name="update-profesor" hidden>
                <input type="text" class="input-delete" id="delete" name="delete-profesor" hidden>
                <input type="text" class="input-url" id="url" name="url" hidden>
                <div class="container" id="profesor-container">
                    <a class="a_img"><img src="css/img/close.png" alt="" class="close-icon" id="close-icon-profesor" onclick="Close()"></a>
                    <h2 style="height:30px;">Profesor</h2>

                    <div class="input-container">
                        <label for="cedula" id="labelcedula">Cedula <b style="color:red;">*</b></label><br>
                        <input type="text" id="cedula" name="cedula" onfocus="LabelAnimation('cedula','labelcedula')" onblur="LabelOut('cedula','labelcedula')" maxlength="10" class="input input-label" onfocusout="userConfirm()" autocomplete='off'>
                        <input type="checkbox" class="checkbox-edit checkbox-profesor" onclick="CheckboxDisabled('cedula', this)">
                    </div>

                    <div class="input-container">
                        <label for="primer_nombre" id="labelprimer_nombre">Primer Nombre <b style="color:red;">*</b></label><br>
                        <input type="text" id="primer_nombre" name="primer_nombre" onfocus="LabelAnimation('primer_nombre','labelprimer_nombre')" onblur="LabelOut('primer_nombre','labelprimer_nombre')" maxlength="20" class="input input-label" style="text-transform:uppercase" autocomplete='off'>
                        <input type="checkbox" class="checkbox-edit checkbox-profesor"   onclick="CheckboxDisabled('primer_nombre', this)">
                    </div>

                    <div class="input-container">
                        <label for="segundo_nombre" id="labelsegundo_nombre">Segundo Nombre</label><br>
                        <input type="text" id="segundo_nombre" name="segundo_nombre"
                        onfocus="LabelAnimation('segundo_nombre','labelsegundo_nombre')" onblur="LabelOut('segundo_nombre','labelsegundo_nombre')" maxlength="20" class="input input-label" style="text-transform:uppercase" autocomplete='off'>
                        <input type="checkbox" class="checkbox-edit checkbox-profesor" onclick="CheckboxDisabled('segundo_nombre', this)">
                    </div>

                    <div class="input-container">
                        <label for="primer_apellido" id="labelprimer_apellido">Primer Apellido <b style="color:red;">*</b></label><br>
                        <input type="text" id="primer_apellido" name="primer_apellido"
                        onfocus="LabelAnimation('primer_apellido','labelprimer_apellido')" onblur="LabelOut('primer_apellido','labelprimer_apellido')" maxlength="20" class="input input-label" style="text-transform:uppercase" autocomplete='off'>
                        <input type="checkbox" class="checkbox-edit checkbox-profesor" onclick="CheckboxDisabled('primer_apellido', this)">
                    </div>

                    <div class="input-container">
                        <label for="segundo_apellido" id="labelsegundo_apellido">Segundo Apellido</label><br>
                        <input type="text" id="segundo_apellido" name="segundo_apellido"
                        onfocus="LabelAnimation('segundo_apellido','labelsegundo_apellido')" onblur="LabelOut('segundo_apellido','labelsegundo_apellido')" maxlength="20" class="input input-label" style="text-transform:uppercase" autocomplete='off'>
                        <input type="checkbox" class="checkbox-edit" onclick="CheckboxDisabled('segundo_apellido', this)">
                    </div>
                    <div class="input-container" style='grid-column:1/3;width:100%;grid-row:7;'>
                        <label for="direccion" id="labeldireccion">Direccion <b style="color:red;">*</b></label><br>
                        <textarea type="text" id="direccion" name="direccion"
                        onfocus="LabelAnimation('direccion','labeldireccion')" onblur="LabelOut('direccion','labeldireccion')" maxlength="100" class="input input-label" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' style='width:90%;text-transform:uppercase;' autocomplete='off'></textarea>
                        <input type="checkbox" class="checkbox-edit" onclick="CheckboxDisabled('direccion', this)" style='left:540px;'>
                    </div>

                    <div class="input-container" style='grid-column:2/3;grid-row:4;'>
                        <label for="telefono" id="labeltelefono">Telefono Personal <b style="color:rgb(90,110,200);font-size:12px;">(04)</b></label><br>
                        <input type="text" id="telefono" name="telefono"
                        onfocus="LabelAnimation('telefono','labeltelefono')" onblur="LabelOut('telefono','labeltelefono')" maxlength="11" class="input input-label" autocomplete='off'>
                        <input type="checkbox" class="checkbox-edit" onclick="CheckboxDisabled('telefono', this)" >
                    </div>
                    <div class="input-container">
                        <label for="telefono_fijo" id="labeltelefono_fijo">Telefono Fijo <b style="color:rgb(90,110,200);font-size:12px;">(0255)</b></label><br>
                        <input type="text" id="telefono_fijo" name="telefono_fijo"
                        onfocus="LabelAnimation('telefono_fijo','labeltelefono_fijo')" onblur="LabelOut('telefono_fijo','labeltelefono_fijo')" maxlength="11" class="input input-label" autocomplete='off'>
                        <input type="checkbox" class="checkbox-edit" onclick="CheckboxDisabled('telefono_fijo', this)" >
                    </div>
                    <div class="input-container">
                        <label for="correo" id="labelcorreo">Correo <b style="color:red;">*</b></label><br>
                        <textarea type="text" id="correo" name="correo" onfocus="LabelAnimation('correo','labelcorreo')" onblur="LabelOut('correo','labelcorreo')" maxlength="50" class="input input-label" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' autocomplete='off'></textarea>
                        <input type="checkbox" class="checkbox-edit" onclick="CheckboxDisabled('correo', this)" >
                    </div>
                    <div class="input-container">
                        <label for="titulo" id="labeltitulo">Titulo</label><br>
                        <input type="text" id="titulo" name="titulo"
                        onfocus="LabelAnimation('titulo','labeltitulo')" onblur="LabelOut('titulo','labeltitulo')" maxlength="30" class="input input-label" style='text-transform:uppercase;' autocomplete='off'>
                        <input type="checkbox" class="checkbox-edit" onclick="CheckboxDisabled('titulo', this)" >
                    </div>
                    <div class="input-container">
                        <label for="oficio" id="labeloficio">Oficio <b style="color:red;">*</b></label><br>
                        <input type="text" id="oficio" name="oficio"
                        onfocus="LabelAnimation('oficio','labeloficio')" onblur="LabelOut('oficio','labeloficio')" maxlength="30" class="input input-label" autocomplete='off' style='text-transform:uppercase;' onkeyup="Search('oficio','oficio_drop')">
                        <input type="checkbox" class="checkbox-edit" onclick="CheckboxDisabled('oficio', this)" >
                        <div class="dropdown drop" id="oficio_drop">
                        <?php 
                            $list=[];
                            $list=GetOficio();
                            $totalarray=count($list);
                            for ($i=0; $i < $totalarray; $i++) { 
                                echo "<span id='".$list[$i][0]."'". "onclick="."AddValueMateria('oficio',this)".">".$list[$i][0]."</span>";
                            }
                        ?>
                        </div>
                    </div>
                    <div class="input-container">
                        <select name="rol" id="rol" onclick="SelectAnimation('rol')" class="input">
                            <option value="">Rol<b style="color:red;">*</b></option>
                            <option value="1">Administrador</option>
                            <option value="0">Profesor</option>
                        </select>
                        <input type="checkbox" class="checkbox-edit"  onclick="CheckboxDisabled('rol', this)">
                    </div>
                    <div class="input-container">
                        <select name="tipo_contratacion" id="tipo_contratacion" onclick="SelectAnimation('tipo_contratacion')" class="input">
                            <option value="">Contratacion<b style="color:red;">*</b></option>
                            <option value="1">Tiempo Indeterminado</option>
                            <option value="2">Tiempo Determinado</option>
                            <option value="3">Ordinario</option>
                         </select>
                        <input type="checkbox" class="checkbox-edit"  onclick="CheckboxDisabled('tipo_contratacion', this)">
                     </div>
                    <div class="input-container">
                        <select name="categoria" id="categoria" onclick="SelectAnimation('categoria')" class="input">
                            <option value="">Categoria<b style="color:red;">*</b></option>
                            <option value="1">Auxiliar Docente I</option>
                            <option value="2">Auxiliar Docente II</option>
                            <option value="3">Auxiliar Docente III</option>
                            <option value="4">Instructor</option>
                            <option value="5">Asistente</option>
                            <option value="6">Asesor</option>
                            <option value="7">Agregado</option>
                            <option value="8">Asociado</option>
                            <option value="9">Titular</option>
                        </select>
                        <input type="checkbox" class="checkbox-edit"  onclick="CheckboxDisabled('categoria', this)">
                    </div>
                    <div class="input-container">
                        <select name="dedicacion" id="dedicacion" onclick="SelectAnimation('dedicacion')" class="input">
                            <option value="">Dedicacion<b style="color:red;">*</b></option>
                            <option value="1">Tiempo Convencional</option>
                            <option value="2">Medio Tiempo</option>
                            <option value="3">Tiempo Completo</option>
                            <option value="4">Tiempo Exclusivo</option>
                        </select>
                        <input type="checkbox" class="checkbox-edit"  onclick="CheckboxDisabled('dedicacion', this)">
                    </div>
                    <button type="button" onclick="Submit('profesor')" class>Registrar</button>
                    <button type="button" onclick="DisplayDelete('flex','#profesor-find','#profesor')" class="button-find">Buscar</button>
                    <button type="button" onclick="Save('profesor')" class="button-edit button-update">Guardar</button>
                    <button type="button" onclick="DisplayDelete('block','.delete-window','#profesor')" class="button-edit button-delete">Eliminar</button>
                </div>
            </form>
            <form action="../control/c_aula.php" method="POST" name="aula" id="aula">
            <input type="text" class="input-update" id="update" name="update" hidden>
            <input type="text" class="input-delete" id="delete" name="delete" hidden>
            <input type="text" class="input-url" id="url" name="url" hidden>
            <div class="container container-flex" id="aula-container">
                    <a class="a_img"><img src="css/img/close.png" alt="" class="close-icon" id="close-icon-profesor" onclick="Close()"></a>
                    <h2> Aula</h2>
                    <div class="input-container">
                        <label for="codigo_aula" id="labelcodigo_aula">Codigo</label><br>
                        <input type="text" id="codigo_aula" name="codigo_aula" onfocus="LabelAnimation('codigo_aula','labelcodigo_aula')" onblur="LabelOut('codigo_aula','labelcodigo_aula')" maxlength="11" class="input input-label" style="text-transform:uppercase">
                        <input type="checkbox" class="checkbox-edit checkbox-materia" onclick="CheckboxDisabled('codigo_aula', this)">
                    </div>

                    <div class="input-container">
                        <label for="nombre_aula" id="labelnombre_aula">Nombre Aula</label><br>
                        <input type="text" id="nombre_aula" name="nombre_aula" onfocus="LabelAnimation('nombre_aula','labelnombre_aula')" onblur="LabelOut('nombre_aula','labelnombre_aula')" maxlength="30" class="input input-label" style="text-transform:uppercase">
                        <input type="checkbox" class="checkbox-edit checkbox-materia"  onclick="CheckboxDisabled('nombre_aula', this)">
                    </div>
                    <button type="button" onclick="Submit('aula')">Registrar</button>
                    <button type="button" onclick="DisplayDelete('flex','#aula-find','#aula')">Buscar</button>
                    <button type="button" onclick="Save('aula')" class="button-edit button-update">Guardar</button>
                    <button type="button" onclick="DisplayDelete('block','.delete-window','#aula')" class="button-edit button-delete">Eliminar</button>
            </div>
            </form>
            <form action="../control/c_carrera.php" method="POST" name="carrera" id="carrera">
                <input type="text" class="input-update" id="update" name="update" hidden>
                <input type="text" class="input-delete" id="delete" name="delete" hidden>
                <input type="text" class="input-url" id="url" name="url" hidden>
                <div id="carrera-container" class="container container-flex">
                    <a class="a_img"><img src="css/img/close.png" alt="" class="close-icon" id="close-icon-profesor" onclick="Close()"></a>
                    <h2>PNF</h2>
                    <div class="input-container">
                    
                        <label for="codigo_carrera" id="labelcodigo_carrera">Codigo</label><br>
                        
                        <input type="text" id="codigo_carrera" name="codigo_carrera" onfocus="LabelAnimation('codigo_carrera','labelcodigo_carrera')" onblur="LabelOut('codigo_carrera','labelcodigo_carrera')" maxlength="11" class="input input-label" style="text-transform:uppercase" autocomplete='off'>
                        
                        <input type="checkbox" class="checkbox-edit checkbox-materia"  onclick="CheckboxDisabled('codigo_carrera', this)">
                    </div>
                    <div class="input-container">
                        <label for="nombre_carrera" id="labelnombre_carrera">Nombre</label><br>
                        <input type="text" id="nombre_carrera" name="nombre_carrera" onfocus="LabelAnimation('nombre_carrera','labelnombre_carrera')" onblur="LabelOut('nombre_carrera','labelnombre_carrera')" maxlength="32" class="input input-label" style="text-transform:uppercase"  autocomplete='off'>
                        <input type="checkbox" class="checkbox-edit checkbox-materia"  onclick="CheckboxDisabled('nombre_carrera', this)">
                    </div>
                    <button type="button" onclick="Submit('carrera')">Registrar</button>
                    <button type="button" onclick="DisplayDelete('flex','#carrera-find','#carrera')">Buscar</button>
                    <button type="button" onclick="Save('carrera')" class="button-edit button-update">Guardar</button>
                    <button type="button" onclick="DisplayDelete('block','.delete-window','#carrera')" class="button-edit button-delete">Eliminar</button>
                </div>
            </form>
            <form action="../control/c_oferta.php" method="POST" name="oferta" id="oferta">
                <input type="text" class="input-update" id="update" name="update" hidden>
                <input type="text" class='input-lapso' id="update_lapso" name="update_lapso" hidden>
                <input type="text" class="input-delete" id="delete" name="delete" hidden>
                <input type="text" class="delete-lapso" id="delete_lapso" name="delete_lapso" hidden>
                <input type="text" class="input-url" id="url" name="url" hidden>
                <div id="oferta-container" class="container container-flex">
                    <div style='position:absolute;' class='historial-materias' id='materias-oferta'>
                            <div style='background: rgb(89, 100, 201);color:white;'>CODIGO</div>
                            <div style='background: rgb(89, 100, 201);color:white;'>NOMBRE</div>
                            <div style='background: rgb(89, 100, 201);color:white;'>TIPO</div>
                            <div style='background: rgb(89, 100, 201);color:white;'>HORAS</div>
                            <div style='background: rgb(89, 100, 201);color:white;'>CREDITOS</div>
                            
                    </div>
                    <a class="a_img"><img src="css/img/close.png" alt="" class="close-icon" id="close-icon-profesor" onclick="Close()"></a>
                    <?php 
                            $list=[];
                            $list=GetLapso();
                            $lapso=$list ? $list[0][0] : "";
                        ?>
                    <h2>Oferta Academica</h2>
                    <div class="input-container" id="input-carreras">
                        <label for="lapso" id="labelapso">Periodo Academico Activo</label><br>
                        <input type="text" id="lapso" name="lapso" onfocus="LabelAnimation('lapso','labelapso')" onblur="LabelOut('lapso','labelapso')" maxlength="30" class="input-label principal_input" onkeyup="Search('lapso','lapso_drop')" autocomplete="off" value='<?php echo $lapso ?>' disabled>
                        <div class="dropdown" id="lapso_drop">
                        
                        </div>
                    </div>
                    
                    <div class="input-container">
                        <label for="carrera" id="labelcar">PNF</label><br>
                        <input type="text" id="carrera_oferta" name="carrera_oferta" onfocus="LabelAnimation('carrera_oferta','labelcar')" onblur="LabelOut('carrera_oferta','labelcar')" maxlength="30" class="input input-label input_added" onkeyup="Search('carrera_oferta','carreras_oferta_drop')" autocomplete="off">
                        <div class="dropdown drop" id="carreras_oferta_drop">
   
                        <?php 
                            $list=[];
                            $list=GetCarrerasNotOferta($lapso);
                            $totalarray=count($list);
                            for ($i=0; $i < $totalarray; $i++) { 
                                echo "<span id='".$list[$i][0]."'". "onclick="."AddValueMateria('carrera_oferta',this)".">".$list[$i][1]."</span>";
                            }
                        ?>
                        </div>
                    </div>
                    <!--
                    <div>
                    <img src="css/img/add.png" alt="" onclick="AddAndRemove('carreras_drop','carreras_add_drop','carreras','carreras_add')">

                        -->
                    <button type="button" onclick="Submit('oferta')" style='grid-column:1/3;'>Registrar</button>
                    <button type="button" onclick="DisplayDelete('block','.delete-window','#oferta')" class="button-edit button-delete" style='grid-column:1/3;'>Eliminar</button>
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
                        <input type="text" id="cedula_dis" name="cedula_dis" onfocus="LabelAnimation('cedula_dis','labelcedula_dis')" onblur="LabelOut('cedula_dis','labelcedula_dis')" maxlength="11" class="input input-label" onkeyup="Search('cedula_dis','disponibilidad_drop')" autocomplete='off'>
                        <input type="checkbox" class="checkbox-edit checkbox-materia"  onclick="CheckboxDisabled('codigo_carrera', this)" >
                        <div class="dropdown" id="disponibilidad_drop">
                        <?php 
                            $list=[];
                            $list=GetUserNotDisponibilidad();
                            $profesor_dis=GetUserInDisponibilidad();
                            $totalarray=count($list);
                            $totalprofesor=count($profesor_dis);
                            if (isset($profesor_dis)) {
                                for ($i=0; $i < $totalprofesor; $i++) { 
                                    echo "<span value="."'".$profesor_dis[$i][1]."/".$profesor_dis[$i][2]."/".$profesor_dis[$i][3]."'"." onclick=AddValueMateria('cedula_dis',this)>".$profesor_dis[$i][0]." **</span>";
                                }
                            }
                            if (isset($list)) {
                                for ($i=0; $i <  $totalarray; $i++) {
                                    echo "<span value="."'".$list[$i][1]."/".$list[$i][2]."/".$list[$i][3]."'"." onclick=AddValueMateria('cedula_dis',this)>".$list[$i][0]."</span>";
                               }
                            }
                        ?>
                        </div>
                    </div>
                    <div class="input-container">
                        <label for="nombre_dis" id="labelnombre_dis">Nombre</label><br>
                        <input type="text" id="nombre_dis" name="nombre_dis" onfocus="LabelAnimation('nombre_dis','labelnombre_dis')" onblur="LabelOut('nombre_dis','labelnombre_dis')" maxlength="30" class="input input-label" disabled>
                        <input type="checkbox" class="checkbox-edit checkbox-materia"  onclick="CheckboxDisabled('nombre_dis', this)">
                    </div>
                    <div class="input-container">
                        <label for="contratacion_dis" id="labelcontratacion_dis">Dedicacion</label><br>
                        <input type="text" id="contratacion_dis" name="contratacion_dis" onfocus="LabelAnimation('contratacion_dis','labelcontratacion_dis')" onblur="LabelOut('contratacion_dis','labelcontratacion_dis')" maxlength="30" class="input input-label" disabled>
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
                    <button type="button" onclick="SaveDisponibilidad()" class="button-edit button-update">Guardar</button>
                    <button type="button" onclick="DisplayDelete('block','.delete-window','#disponibilidad')" class="button-edit button-delete" style='grid-column:3/4;'>Eliminar</button>
                </div>
            </form>
            <form action="../control/c_horario.php" method="POST" name="horario" id="horario">
            <input type="text" class="input-update" id="update" name="update" hidden>
                <input type="text" class="input-delete" id="delete" name="delete" hidden>
                <input type="text" class="input-url" id="url" name="url" hidden>
                <div id="horario_docente-container" class="container">
                    <a class="a_img"><img src="css/img/close.png" alt="" class="close-icon" id="close-icon-profesor" onclick="Close()"></a>
                    <h2>Crear</h2>
                    <div class="input-container">
                        <label for="cedula_horario" id="labelcedula_horario">Cedula</label><br>
                        <input type="text" id="cedula_horario" name="cedula_horario" onfocus="LabelAnimation('cedula_horario','labelcedula_horario')" onblur="LabelOut('cedula_horario','labelcedula_horario')" maxlength="11" class="input input-label" maxlength="15"  onkeyup="Search('cedula_horario','horario_drop')" autocomplete='off'>
                        <div class="dropdown drop_main" id="horario_drop">
                            <?php 
                             $list=[];
                             $list=GetUserInHorario();
                             $totalarray=count($list);
                             if (isset($list)) {
                                 for ($i=0; $i < $totalarray; $i++) { 
                                     echo "<span id=".$list[$i][0]." onclick="."AddValueMateria('cedula_horario',this)".">"
                                     .$list[$i][0]."-".$list[$i][1]." ".$list[$i][2]."</span>";
                                }
                             }
                            ?>
                        </div>
                    </div>
                    <div class="input-container">
                        <label for="nombre_horario" id="labelnombre_horario">Nombre</label><br>
                        <input type="text" id="nombre_horario" name="nombre_horario" onfocus="LabelAnimation('nombre_horario','labelnombre_horario')" onblur="LabelOut('nombre_horario','labelnombre_horario')" maxlength="11" class="input input-label" maxlength="70" disabled>
                    </div>
                    <?php 
                            $list=[];
                            $list=GetLapsoHorario();
                            $lapso=$list ? $list[0][0] : "";
                        ?>
                    <div class="input-container" id="input-carreras">
                        <label for="lapso_horario" id="labelapso_horario">Periodo Academico Activo</label><br>
                        <input type="text" id="lapso_horario" name="lapso_horario" onfocus="LabelAnimation('lapso_horario','labelapso_horario')" onblur="LabelOut('lapso_horario','labelapso_horario')" maxlength="30" class="input input-label principal_input" onkeyup="Search('lapso_horario','lapso_drop_horario')" autocomplete="off" value='<?php echo $lapso ?>' disabled>
                    </div>
                    <div class="input-container" id="input-carreras">
                        <select name="tipo_horario" id="tipo_horario" class='input'>
                            <option value="">Tipo</option>
                            <option value="0">Matutino</option>
                            <option value="8">Vespertino</option>
                        </select>
                        
                    </div>
                    <button type="button" onclick="Submit('horario')" style='grid-column:2/4;'>Crear</button>
                </div>
            </form>
            <form action="../control/c_noticia.php" method="POST" name="noticia" id="noticia">
            <input type="text" class="input-update" id="update" name="update" hidden>
                <input type="text" class="input-delete" id="delete" name="delete" hidden>
                <input type="text" class="input-url" id="url" name="url" hidden>
                <div id="noticia-container" class="container container-flex">
                    <a class="a_img"><img src="css/img/close.png" alt="" class="close-icon" id="close-icon-profesor" onclick="Close()"></a>
                    <h2 style='grid-column:1/4;'>Crear</h2>
                    <div class="input-container" style='grid-column:1/2;'>
                        <label for="codigo_noticia" id="labelcodigo_noticia">Codigo</label><br>
                        <input type="text" id="codigo_noticia" name="codigo_noticia" onfocus="LabelAnimation('codigo_noticia','labelcodigo_noticia')" onblur="LabelOut('codigo_noticia','labelcodigo_noticia')" maxlength="20" class="input input-label" autocomplete='off' style='text-transform:uppercase;'>
                        <input type="checkbox" class="checkbox-edit checkbox-add"  onclick="CheckboxDisabled('codigo_noticia', this)" style="left:170px;">
                    </div>
                    <div class="input-container" id="input-carreras"  style='grid-column:3/4;'>
                        <label for="fecha_expiracion" id="labelfecha_expiracion" style='top:-1px;font-size:15px;' title='Ingrese la fecha en la que quiere que la noticia desaparezca'>Fecha de Expiracion</label><br>
                        <input type="date" id="fecha_expiracion" name="fecha_expiracion" maxlength="30" class="input input-label" title='Ingrese la fecha en la que quiere que la noticia desaparezca' onblur='ValueDate()'>
                        <input type="checkbox" class="checkbox-edit checkbox-add"  onclick="CheckboxDisabled('fecha_expiracion', this)" style="left:170px;">
                    </div>
                    <div class="input-container" style='grid-column:1/4;width:100%;'>
                        <label for="descripcion" id="labeldescripcion">Descripcion de Noticia</label><br>
                        <textarea type="text" id="descripcion" name="descripcion"
                        onfocus="LabelAnimation('descripcion','labeldescripcion')" onblur="LabelOut('descripcion','labeldescripcion')" maxlength="150" class="input input-label" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' style='width:90%;text-transform:uppercase;'></textarea>
                        <input type="checkbox" class="checkbox-edit checkbox-add"  onclick="CheckboxDisabled('descripcion', this)" style="left:490px;">
                    </div>

                    <button type="button" onclick="Submit('noticia')" style='grid-column:2/3;'>Crear</button>
                    <button type="button" onclick="Save('noticia')" class="button-edit button-update">Guardar</button><br>
                    <button type="button" onclick="DisplayDelete('block','.delete-window','#noticia')" class="button-edit button-delete">Eliminar</button>
                </div>
            </form>
            <form action="../control/c_lapso_academico.php" method="POST" name="lapso_academico" id="lapso_academico">
            <input type="text" class="input-update" id="update" name="update" hidden>
                <input type="text" class="input-delete" id="delete" name="delete" hidden>
                <input type="text" class="input-url" id="url" name="url" hidden>
                <div id="lapso_academico-container" class="container">
                    <a class="a_img"><img src="css/img/close.png" alt="" class="close-icon" id="close-icon-profesor" onclick="Close()"></a>
                    <h2>Periodo Academico</h2>
                    <div class="input-container">
                        <label for="trayecto" id="labeltrayecto">Codigo</label><br>
                        <input type="text" id="trayecto" name="trayecto" onfocus="LabelAnimation('trayecto','labeltrayecto')" onblur="LabelOut('trayecto','labeltrayecto')" maxlength="11" class="input input-label" maxlength="15" style="text-transform:uppercase">
                        
                        <input type="checkbox" class="checkbox-edit checkbox-materia"  onclick="CheckboxDisabled('trayecto', this)">
                    </div>
                    <div class="input-container">
                    
                        <label for="trayecto" id="labeltrayecto" style='top:-1px;font-size:17px;'>Fecha de Inicio</label><br>
                        <input type="date" id="fecha_inicio" name="fecha_inicio" maxlength="30" class="input" onblur='ValidateDate()'>
                        
                        <input type="checkbox" class="checkbox-edit checkbox-materia"  onclick="CheckboxDisabled('fecha_inicio', this)">
                    </div>
                    <div class="input-container">
                        <label for="lapso" id="labellapso" style='top:-1px;font-size:17px;'>Fecha de Final</label><br>
                        <input type="date" id="fecha_final" name="fecha_final" maxlength="30" class="input" onblur='ValidateDate()'>
                        <input type="checkbox" class="checkbox-edit checkbox-materia"  onclick="CheckboxDisabled('fecha_final', this)">
                    </div>
                    <div class="input-container" id="input-carreras">
                        <select name="lapso_activo" id="lapso_activo" class='input'>
                            <option value="">Estatus</option>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                        <input type="checkbox" class="checkbox-edit checkbox-materia"  onclick="CheckboxDisabled('lapso_activo', this)">
                    </div>
                    <button type="button" onclick="Submit('lapso_academico')" style='grid-column:1/3;'>Crear</button>
                    <button type="button" onclick="DisplayDelete('flex','#lapso-find','#lapso_academico')" style='grid-column:3/5;'>Buscar</button>
                    <button type="button" onclick="Save('lapso_academico')" class="button-edit button-update" style='grid-column:1/3;'>Guardar</button>
                    <button type="button" onclick="DisplayDelete('block','.delete-window','#lapso_academico')" class="button-edit button-delete" style='grid-column:3/5;'>Eliminar</button>
                </div>
            </form>
            
