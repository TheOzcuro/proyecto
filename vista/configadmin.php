<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/configadmin.css">
    <title>Configurar Administrador</title>
</head>
<body>
    <div class="password-container">
        <h3>Crear Contraseña</h3>
        <form action="" method="POST" name="regpass" id="regpass">
        <div class="input-container">
            <label for="contra" id="labelcontra">Contraseña</label><br>
            <input type="text" name="contra" id="contra" onfocus='LabelAnimation("contra","labelcontra")' onblur='LabelOut("contra","labelcontra")'></div><br>
        <div class="input-container">
        <div class="input-container">
            <label for="con" id="labelcon">Confirmar Contraseña</label><br>
            <input type="text" name="con" id="con" onfocus='LabelAnimation("con","labelcon")' onblur='LabelOut("con","labelcon")'></div><br>
        <div class="input-container">
        <button type="button">Crear Contraseña</button>
        </form>
    </div>
</body>
<script src="js/login.js"></script>
<script src="js/configadmin.js"></script>
</html>