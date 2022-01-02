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
    if (isset($_SESSION["error"]) && $_SESSION["error"]=="usuario_no_existe") {
       echo "<script>Error('El Usuario NO Existe','msg_error','p_error')</script>";
       unset($_SESSION["error"]);
    }
    if (isset($_SESSION["error"]) && $_SESSION["error"]=="usuario_no_administrador") {
        echo "<script>Error('El Usuario NO es ADMINISTRADOR','msg_error','p_error')</script>";
        unset($_SESSION["error"]);
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
            <a href=""><p>¿Has olvidado tu contraseña?</p></a>
        </div>
    </form>
    
</body>
<script src="js/login.js"></script>
</html>