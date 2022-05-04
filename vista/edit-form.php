
    <form action="../control/c_profesor.php" method="POST" name="find_profesor" id="find_profesor">
        <input type="text" class="input-url" id="url" name="url" hidden>
        <div id="profesor-find" class="container container-edit">
        <h4 style="text-align:center;">Introduzca la cedula del profesor</h4>
        <div class="input-container">
            <label for="buscar_profesor" id="labelbuscar_profesor">Cedula</label><br>
            <input type="text" id="buscar_profesor" name="buscar_profesor" onfocus="LabelAnimation('buscar_profesor','labelbuscar_profesor')" onblur="LabelOut('buscar_profesor','labelbuscar_profesor')" maxlength="11" class="input-label input">
        </div><br>
        <button type="button"  onclick="Submit('find_profesor')" style="text-align:center;">Buscar</button>
        </div>
    </form>
    <form action="../control/c_materia.php" method="POST" name="find_materia" id="find_materia">
        <input type="text" class="input-url" id="url" name="url" hidden>
        <div id="materia-find" class="container container-edit">
        <h4 style="text-align:center;">Introduzca el codigo de la materia</h4>
        <div class="input-container">
            <label for="buscar_materia" id="labelbuscar_materia">Codigo</label><br>
            <input type="text" id="buscar_materia" name="buscar_materia" onfocus="LabelAnimation('buscar_materia','labelbuscar_materia')" onblur="LabelOut('buscar_materia','labelbuscar_materia')" maxlength="11" class="input-label input">
        </div><br>
        <button type="button"  onclick="Submit('find_materia')" style="text-align:center;">Buscar</button>
        </div>
    </form>
    <form action="../control/c_aula.php" method="POST" name="find_aula" id="find_aula">
        <input type="text" class="input-url" id="url" name="url" hidden>
        <div id="aula-find" class="container container-edit">
        <h4 style="text-align:center;">Introduzca el codigo del aula</h4>
        <div class="input-container">
            <label for="buscar_aula" id="labelbuscar_aula">Codigo</label><br>
            <input type="text" id="buscar_aula" name="buscar_aula" onfocus="LabelAnimation('buscar_aula','labelbuscar_aula')" onblur="LabelOut('buscar_aula','labelbuscar_aula')" maxlength="11" class="input-label input">
        </div><br>
        <button type="button"  onclick="Submit('find_aula')" style="text-align:center;">Buscar</button>
        </div>
    </form>
    <form action="../control/c_carrera.php" method="POST" name="find_carrera" id="find_carrera">
        <input type="text" class="input-url" id="url" name="url" hidden>
        <div id="carrera-find" class="container container-edit">
        <h4 style="text-align:center;">Introduzca el codigo de la carrera</h4>
        <div class="input-container">
            <label for="buscar_carrera" id="labelbuscar_carrera">Codigo</label><br>
            <input type="text" id="buscar_carrera" name="buscar_carrera" onfocus="LabelAnimation('buscar_carrera','labelbuscar_carrera')" onblur="LabelOut('buscar_carrera','labelbuscar_carrera')" maxlength="11" class="input-label input">
        </div><br>
        <button type="button"  onclick="Submit('find_carrera')" style="text-align:center;">Buscar</button>
        </div>
    </form>
    <form action="../control/c_pensum.php" method="POST" name="find_pensum" id="find_pensum">
        <input type="text" class="input-url" id="url" name="url" hidden>
        <div id="pensum-find" class="container container-edit">
        <h4 style="text-align:center;">Introduzca el nombre de la carrera</h4>
        <div class="input-container">
            <label for="buscar_pensum" id="labelbuscar_pensum">Nombre</label><br>
            <input type="text" id="buscar_pensum" name="buscar_pensum" onfocus="LabelAnimation('buscar_pensum','labelbuscar_pensum')" onblur="LabelOut('buscar_pensum','labelbuscar_pensum')" maxlength="30" class="input-label input">
        </div><br>
        <button type="button"  onclick="Submit('find_pensum')" style="text-align:center;">Buscar</button>
        </div>
    </form>
    <form action="../control/c_lapso_academico.php" method="POST" name="find_lapso" id="find_lapso">
        <input type="text" class="input-url" id="url" name="url" hidden>
        <div id="lapso-find" class="container container-edit">
        <h4 style="text-align:center;">Introduzca el periodo academico</h4>
        <div class="input-container">
            <label for="buscar_lapso" id="labelbuscar_lapso">Periodo Academico</label><br>
            <input type="text" id="buscar_lapso" name="buscar_lapso" onfocus="LabelAnimation('buscar_lapso','labelbuscar_lapso')" onblur="LabelOut('buscar_lapso','labelbuscar_lapso')" maxlength="30" class="input-label input">
        </div><br>
        <button type="button"  onclick="Submit('find_lapso')" style="text-align:center;">Buscar</button>
        </div>
    </form>
    <form action="../control/c_oferta.php" method="POST" name="find_oferta" id="find_oferta">
        <input type="text" class="input-url" id="url" name="url" hidden>
        <div id="oferta-find" class="container container-edit">
        <h4 style="text-align:center;">Introduzca el nombre de la carrera</h4>
        <div class="input-container">
            <label for="buscar_oferta" id="labelbuscar_oferta">Nombre de Carrera</label><br>
            <input type="text" id="buscar_oferta" name="buscar_oferta" onfocus="LabelAnimation('buscar_oferta','labelbuscar_oferta')" onblur="LabelOut('buscar_oferta','labelbuscar_oferta')" maxlength="30" class="input-label input">
        </div><br>
        <button type="button"  onclick="Submit('find_oferta')" style="text-align:center;">Buscar</button>
        </div>
    </form>
