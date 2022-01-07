<!DOCTYPE html>
<?php 
session_start();
if (isset($_SESSION["usuario_cedula"])==false) {
    header("Location: login.php");
}
?>
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
        <form action="../control/c_administrador.php" method="POST" name="regpass" id="regpass">
        <div class="input-container">
            <label for="contra" id="labelcontra">Contraseña</label><br>
            <input type="password" name="contra" id="contra" onfocus='LabelAnimation("contra","labelcontra")' onblur='LabelOut("contra","labelcontra")'></div><br>
            
        <div class="input-container">
        <div class="input-container">
            <label for="con" id="labelcon">Confirmar Contraseña</label><br>
            <input type="password" name="con" id="con" onfocus='LabelAnimation("con","labelcon")' onblur='LabelOut("con","labelcon")'></div><br>
            <b id="first-pass"></b>
        <div class="input-container">
        <button type="button" id="password-button" onclick="Submit()">Crear Contraseña</button>
        </form>
    </div>
</body>
<script src="js/login.js"></script>
<script src="js/configadmin.js"></script>
</html>