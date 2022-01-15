    <form action="../control/c_profesor" method="POST" name="find_profesor" id="find_profesor">
        <div id="profesor-find" class="container">
        <h4>Introduzca la cedula del profesor que desea editar</h4>
        <div class="input-container">
            <label for="buscar_profesor" id="labelbuscar_profesor">Cedula</label><br>
            <input type="text" id="buscar_profesor" name="buscar_profesor" onfocus="LabelAnimation('buscar_profesor','labelbuscar_profesor')" onblur="LabelOut('buscar_profesor','labelbuscar_profesor')" maxlength="11">
        </div><br>
        <button type="button"  onclick="Submit()">Buscar</button>
        </div>
    </form>
