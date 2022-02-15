
<link rel="stylesheet" href="css/msg_error.css">
<div class="hidder" id="hidder">
    <div class="msg_error" id="msg_error">
        <img src="css/img/img_error.png" alt=""><h2>Parece que ocurrio un error!</h2>
        <p id="p_error"></p>
    </div>
    <div class="msg_check" id="msg_check">
        <img src="css/img/img_check.png" alt=""><h2>Operacion Realizada!</h2>
        <p id="p_check"></p>
        <?php 
        if (isset($_SESSION["link"]) && $_SESSION["link"]!="") {
        ?>
        <span>Para ver lo que acaba de registra haga click </span><a href="<?php echo $_SESSION["link"]?>" style="color:red;">AQUI</a>
        <?php
        unset($_SESSION["link"]);
         }
        ?>
    </div>
</div>

<script src="js/msg_error.js">

</script>