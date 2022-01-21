<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Iniciar Sesion</title>
</head>
<body>
    <?php 
    include_once("msg_error.php");
    session_start();
    if (isset($_SESSION["error"]) && $_SESSION["error"]!="") {
        echo "<script>Error('".$_SESSION["error"]."','msg_error','p_error')</script>";
        unset($_SESSION["error"]);
    }
    if (isset($_SESSION["completado"]) && $_SESSION["completado"]!="") {
        echo "<script>Error('".$_SESSION["completado"]."','msg_check','p_check')</script>";
        unset($_SESSION["completado"]);
            
      }
    ?>
    
    <form action="../control/c_login.php" method="POST" name="login">
        <div class="login-container">
            <h2>Iniciar Sesion</h2>
            <div class="input-container">
            <label for="usuario" id="labeluser">Usuario</label><br>
            <input type="text" name="usuario" id="usuario" onfocus='LabelAnimation("usuario","labeluser")' onblur='LabelOut("usuario","labeluser")'></div><br>
            <div class="input-container">
            <label for="pass" id="passuser">Contraseña</label><br>
            <input type="password" name="pass" id="pass" onfocus='LabelAnimation("pass","passuser")' onblur='LabelOut("pass","passuser")'></div><br>
            <button onclick="Submit()" type="button">Iniciar Sesion</button>
            <a href="#recover" onclick="AppearRecover()"><p>¿Has olvidado tu contraseña?</p></a>
        </div>
    </form>
    <div class="blackcover">
        <div class="recover">
            <h4>Para recuperar su contraseña ingrese su cedula</h4>
            <div class="input-container">
            <label for="recover_cedula" id="labelrecover">Ingrese su Cedula</label><br>
            <input type="text" name="recover_cedula" id="recover_cedula" onfocus='LabelAnimation("recover_cedula","labelrecover")' onblur='LabelOut("recover_cedula","labelrecover")'></div><br>
            <div class="input-container">
            <button type="button" class="button-rep" onclick="Recover()">Recuperar</button><button type="button" class="button-clo" onclick="DissapearRecover()">Cerrar</button>
        </div>
    </div>
    
</body>
<script src="js/login.js"></script>
</html>