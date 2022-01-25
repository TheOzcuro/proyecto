    <form action="../control/c_profesor.php" method="POST" name="find_profesor" id="find_profesor">
        <div id="profesor-find" class="container">
        <h4 style="text-align:center;">Introduzca la cedula del profesor que desea editar</h4>
        <div class="input-container">
            <label for="buscar_profesor" id="labelbuscar_profesor">Cedula</label><br>
            <input type="text" id="buscar_profesor" name="buscar_profesor" onfocus="LabelAnimation('buscar_profesor','labelbuscar_profesor')" onblur="LabelOut('buscar_profesor','labelbuscar_profesor')" maxlength="11">
        </div><br>
        <button type="button"  onclick="Submit('find_profesor')">Buscar</button>
        </div>
    </form>
    <form action="../control/c_materia.php" method="POST" name="find_materia" id="find_materia">
        <div id="materia-find" class="container">
        <h4 style="text-align:center;">Introduzca el codigo de la materia que desea editar</h4>
        <div class="input-container">
            <label for="buscar_materia" id="labelbuscar_materia">Codigo</label><br>
            <input type="text" id="buscar_materia" name="buscar_materia" onfocus="LabelAnimation('buscar_materia','labelbuscar_materia')" onblur="LabelOut('buscar_materia','labelbuscar_materia')" maxlength="11">
        </div><br>
        <button type="button"  onclick="Submit('find_materia')">Buscar</button>
        </div>
    </form>
    <form action="../control/c_aula.php" method="POST" name="find_aula" id="find_aula">
        <div id="aula-find" class="container">
        <h4 style="text-align:center;">Introduzca el codigo del aula que desea editar</h4>
        <div class="input-container">
            <label for="buscar_aula" id="labelbuscar_aula">Codigo</label><br>
            <input type="text" id="buscar_aula" name="buscar_aula" onfocus="LabelAnimation('buscar_aula','labelbuscar_aula')" onblur="LabelOut('buscar_aula','labelbuscar_aula')" maxlength="11">
        </div><br>
        <button type="button"  onclick="Submit('find_aula')">Buscar</button>
        </div>
    </form>
    <form action="../control/c_carrera.php" method="POST" name="find_carrera" id="find_carrera">
        <div id="carrera-find" class="container">
        <h4 style="text-align:center;">Introduzca el codigo de la carrera que desea editar</h4>
        <div class="input-container">
            <label for="buscar_carrera" id="labelbuscar_carrera">Codigo</label><br>
            <input type="text" id="buscar_carrera" name="buscar_carrera" onfocus="LabelAnimation('buscar_carrera','labelbuscar_carrera')" onblur="LabelOut('buscar_carrera','labelbuscar_carrera')" maxlength="11">
        </div><br>
        <button type="button"  onclick="Submit('find_carrera')">Buscar</button>
        </div>
    </form>
