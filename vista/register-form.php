
<form action="../control/c_materia.php" method="POST" name="materia" id="materia">
                <input type="text" class="input-update" id="update" name="update" hidden>
                <input type="text" class="input-delete" id="delete" name="delete" hidden>
                <div class="container" id="materia-container">
                <a href="#materia-find-flex" class="a_img"><img src="css/img/close.png" alt="" class="close-icon" id="close-icon-profesor" onclick="Close()"></a>
                    
                    <h2>Registrar Materia</h2>
                    <div class="input-container">
                        <label for="codigo_materia" id="labelcodigo_materia">Codigo</label><br>
                        <input type="text" id="codigo_materia" name="codigo_materia" onfocus="LabelAnimation('codigo_materia','labelcodigo_materia')" onblur="LabelOut('codigo_materia','labelcodigo_materia')" maxlength="11" class="input input-label">
                        <input type="checkbox" class="checkbox-edit checkbox-materia"   onclick="CheckboxDisabled('codigo_materia', this)">
                    </div><br>

                    <div class="input-container">
                        <label for="nombre_materia" id="labelnombre_materia">Nombre Materia</label><br>
                        <input type="text" id="nombre_materia" name="nombre_materia" onfocus="LabelAnimation('nombre_materia','labelnombre_materia')" onblur="LabelOut('nombre_materia','labelnombre_materia')" maxlength="30" class="input input-label">
                        <input type="checkbox" class="checkbox-edit checkbox-materia"   onclick="CheckboxDisabled('nombre_materia', this)">
                    </div><br>

                    <div class="input-container">
                        <select name="tipo_materia" id="tipo_materia" onclick="SelectAnimation('rol')" class="input">
                            <option value="">Seleccione el Tipo</option>
                            <option value="0">Diciplinaria</option>
                            <option value="1">Multidiciplinaria</option>
                        </select><input type="checkbox" class="checkbox-edit checkbox-materia"   onclick="CheckboxDisabled('tipo_materia', this)">
                    </div><br>
                    <button type="button" onclick="Submit('materia')">Registrar</button>
                    <button type="button" onclick="Save('materia')" class="button-edit button-update">Guardar</button><br>
                    <button type="button" onclick="DisplayDelete('block','#materia')" class="button-edit button-delete">Eliminar</button>
                </div>
            </form>
            <form action="../control/c_profesor.php" method="POST" name="profesor" id="profesor">
                <input type="text" class="input-update" id="update" name="update-profesor" hidden>
                <input type="text" class="input-delete" id="delete" name="delete-profesor" hidden>
                <div class="container" id="profesor-container">
                    <a href="#profesor-find-flex" class="a_img"><img src="css/img/close.png" alt="" class="close-icon" id="close-icon-profesor" onclick="Close()"></a>
                    <h2>Registrar Profesor</h2>

                    <div class="input-container">
                        <label for="cedula" id="labelcedula">Cedula <b style="color:red;">*</b></label><br>
                        <input type="text" id="cedula" name="cedula" onfocus="LabelAnimation('cedula','labelcedula')" onblur="LabelOut('cedula','labelcedula')" maxlength="11" class="input input-label">
                        <input type="checkbox" class="checkbox-edit checkbox-profesor" onclick="CheckboxDisabled('cedula', this)">
                    </div>

                    <div class="input-container">
                        <select name="rol" id="rol" onclick="SelectAnimation('rol')" class="input">
                            <option value="">Seleccione el Rol <b style="color:red;">*</b></option>
                            <option value="1">Administrador</option>
                            <option value="0">Profesor</option>
                        </select>
                        <input type="checkbox" class="checkbox-edit"  onclick="CheckboxDisabled('rol', this)">
                    </div>

                    <div class="input-container">
                        <label for="primer_nombre" id="labelprimer_nombre">Primer Nombre <b style="color:red;">*</b></label><br>
                        <input type="text" id="primer_nombre" name="primer_nombre" onfocus="LabelAnimation('primer_nombre','labelprimer_nombre')" onblur="LabelOut('primer_nombre','labelprimer_nombre')" maxlength="30" class="input input-label">
                        <input type="checkbox" class="checkbox-edit checkbox-profesor"   onclick="CheckboxDisabled('primer_nombre', this)">
                    </div>

                    <div class="input-container">
                        <label for="segundo_nombre" id="labelsegundo_nombre">Segundo Nombre</label><br>
                        <input type="text" id="segundo_nombre" name="segundo_nombre"
                        onfocus="LabelAnimation('segundo_nombre','labelsegundo_nombre')" onblur="LabelOut('segundo_nombre','labelsegundo_nombre')" maxlength="30" class="input input-label">
                        <input type="checkbox" class="checkbox-edit checkbox-profesor" onclick="CheckboxDisabled('segundo_nombre', this)">
                    </div>

                    <div class="input-container">
                        <label for="primer_apellido" id="labelprimer_apellido">Primer Apellido <b style="color:red;">*</b></label><br>
                        <input type="text" id="primer_apellido" name="primer_apellido"
                        onfocus="LabelAnimation('primer_apellido','labelprimer_apellido')" onblur="LabelOut('primer_apellido','labelprimer_apellido')" maxlength="30" class="input input-label">
                        <input type="checkbox" class="checkbox-edit checkbox-profesor" onclick="CheckboxDisabled('primer_apellido', this)">
                    </div>

                    <div class="input-container">
                        <label for="segundo_apellido" id="labelsegundo_apellido">Segundo Apellido</label><br>
                        <input type="text" id="segundo_apellido" name="segundo_apellido"
                        onfocus="LabelAnimation('segundo_apellido','labelsegundo_apellido')" onblur="LabelOut('segundo_apellido','labelsegundo_apellido')" maxlength="30" class="input input-label">
                        <input type="checkbox" class="checkbox-edit" onclick="CheckboxDisabled('segundo_apellido', this)">
                    </div>

                    <div class="input-container">
                        <label for="direccion" id="labeldireccion">Direccion <b style="color:red;">*</b></label><br>
                        <input type="text" id="direccion" name="direccion"
                        onfocus="LabelAnimation('direccion','labeldireccion')" onblur="LabelOut('direccion','labeldireccion')" maxlength="60" class="input input-label">
                        <input type="checkbox" class="checkbox-edit" onclick="CheckboxDisabled('direccion', this)">
                    </div>

                    <div class="input-container">
                        <label for="telefono" id="labeltelefono">Telefono <b style="color:red;">*</b></label><br>
                        <input type="text" id="telefono" name="telefono"
                        onfocus="LabelAnimation('telefono','labeltelefono')" onblur="LabelOut('telefono','labeltelefono')" maxlength="11" class="input input-label">
                        <input type="checkbox" class="checkbox-edit" onclick="CheckboxDisabled('telefono', this)" >
                    </div>

                    <button type="button" onclick="Submit('profesor')">Registrar</button>
                    <button type="button" onclick="Save('profesor')" class="button-edit button-update">Guardar</button>
                    <button type="button" onclick="DisplayDelete('block','#profesor')" class="button-edit button-delete">Eliminar</button>
                </div>
            </form>
            <form action="../control/c_aula.php" method="POST" name="aula" id="aula">
            <input type="text" class="input-update" id="update" name="update" hidden>
            <input type="text" class="input-delete" id="delete" name="delete" hidden>
            <div class="container" id="aula-container">
                    <a href="#profesor-find-flex" class="a_img"><img src="css/img/close.png" alt="" class="close-icon" id="close-icon-profesor" onclick="Close()"></a>
                    <h2>Registrar Aula</h2>
                    <div class="input-container">
                        <label for="codigo_aula" id="labelcodigo_aula">Codigo</label><br>
                        <input type="text" id="codigo_aula" name="codigo_aula" onfocus="LabelAnimation('codigo_aula','labelcodigo_aula')" onblur="LabelOut('codigo_aula','labelcodigo_aula')" maxlength="11" class="input input-label">
                        <input type="checkbox" class="checkbox-edit checkbox-materia" onclick="CheckboxDisabled('codigo_aula', this)">
                    </div><br>

                    <div class="input-container">
                        <label for="nombre_aula" id="labelnombre_aula">Nombre Aula</label><br>
                        <input type="text" id="nombre_aula" name="nombre_aula" onfocus="LabelAnimation('nombre_aula','labelnombre_aula')" onblur="LabelOut('nombre_aula','labelnombre_aula')" maxlength="30" class="input input-label">
                        <input type="checkbox" class="checkbox-edit checkbox-materia"  onclick="CheckboxDisabled('nombre_aula', this)">
                    </div><br>
                    <button type="button" onclick="Submit('aula')">Registrar</button>
                    <button type="button" onclick="Save('aula')" class="button-edit button-update">Guardar</button><br>
                    <button type="button" onclick="DisplayDelete('block','#aula')" class="button-edit button-delete">Eliminar</button>
            </div>
            </form>
            <form action="../control/c_carrera.php" method="POST" name="carrera" id="carrera">
            <input type="text" class="input-update" id="update" name="update" hidden>
                <input type="text" class="input-delete" id="delete" name="delete" hidden>
                <div id="carrera-container" class="container">
                    <a href="#profesor-find-flex" class="a_img"><img src="css/img/close.png" alt="" class="close-icon" id="close-icon-profesor" onclick="Close()"></a>
                    <h2>Registrar Carrera</h2>
                    <div class="input-container">
                    
                        <label for="codigo_carrera" id="labelcodigo_carrera">Codigo</label><br>
                        
                        <input type="text" id="codigo_carrera" name="codigo_carrera" onfocus="LabelAnimation('codigo_carrera','labelcodigo_carrera')" onblur="LabelOut('codigo_carrera','labelcodigo_carrera')" maxlength="11" class="input input-label">
                        
                        <input type="checkbox" class="checkbox-edit checkbox-materia"  onclick="CheckboxDisabled('coduigo_materia', this)">
                    </div><br>
                    <div class="input-container">
                        <label for="nombre_carrera" id="labelnombre_carrera">Nombre</label><br>
                        <input type="text" id="nombre_carrera" name="nombre_carrera" onfocus="LabelAnimation('nombre_carrera','labelnombre_carrera')" onblur="LabelOut('nombre_carrera','labelnombre_carrera')" maxlength="30" class="input input-label">
                        <input type="checkbox" class="checkbox-edit checkbox-materia"  onclick="CheckboxDisabled('nombre_carrera', this)">
                    </div><br>
                    <button type="button" onclick="Submit('carrera')">Registrar</button>
                    <button type="button" onclick="Save('carrera')" class="button-edit button-update">Guardar</button><br>
                    <button type="button" onclick="DisplayDelete('block','#carrera')" class="button-edit button-delete">Eliminar</button>
                </div>
            </form>