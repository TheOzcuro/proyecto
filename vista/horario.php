
<div id='horario_agrupar' class='container' style='display:none;position:relative;z-index:500;'>
    <div class='profesor_datos'>
        <div class='profesor_cedula'><b>Cedula: </b><?php echo  $_SESSION["disponibilidad_profesor"][0][0];?></div>
        <div class='profesor_nombre'><b>Nombre: </b><?php echo  $_SESSION["disponibilidad_profesor"][0][1]." ".$_SESSION["disponibilidad_profesor"][0][3];?></div>
        <div class='profesor_oficio'><b>Oficio: </b><?php echo  $_SESSION["disponibilidad_profesor"][0][13];?></div>
        <div class='profesor_titulo'><b>Titulo: </b><?php 
        if ($_SESSION["disponibilidad_profesor"][0][12]=="") {
            echo "No tiene";
        }
        else {
            echo  $_SESSION["disponibilidad_profesor"][0][12];
        }
        ?></div>
        <div class='lapso' style='position:relative;top:5px;left:-25px;'><b>Periodo Academico: </b><?php echo  $_SESSION["lapso"];?></div>
    </div>
<?php 
if (isset($_SESSION["find_horario"])) {
?>
<a href='ReportesHorarioPDF.php?cedula=<?php echo  $_SESSION["disponibilidad_profesor"][0][0]?>,&lapso=<?php echo  $_SESSION["lapso"];?>,' title='Descargar el horario' style='position:absolute;top:150px; left:-80px;' target='_blank'><img src='css/img/pdf.png' style='width:60xp;height:60px;'></a>
<?php 
}
?>
<div id='horario_list'>
    <div class='title'>HORA</div>
    <div class='title'>LUNES</div>
    <div class='title'>MARTES</div>
    <div class='title'>MIERCOLES</div>
    <div class='title'>JUEVES</div>
    <div class='title'>VIERNES</div>
    <?php
    function searchForId($id, $array) {
        foreach ($array as $key => $val) {
            if ($val[2] == $id) {
                return $key;
            }
        }
        return 0;
     }
    function searchForBloque($id, $dia, $array) {
        foreach ($array as $key => $val) {
            if ($val[2] == $dia && $val[1]==$id) {
                return $key;
            }
        }
        return 0;
    }
    if ($_SESSION["tipo_horario"]==0) {
        $hora="07:00";
        $hora2="07:45";
        echo "<button type='button' onclick='DisplayChange(`8`)' style='position:absolute;left:-100px;width:100px;font-size:14px;'>Crear Horario Vespertino</button>";
    }
    else if ($_SESSION["tipo_horario"]==8) {
        echo "<button type='button' onclick='DisplayChange(`0`)' style='position:absolute;left:-100px;width:100px;font-size:14px;'>Crear Horario Matunino</button>";
        $hora="13:00";
        $hora2="13:45";
        
    } 
    $dias=1;
    $b=$_SESSION["tipo_horario"]+1;
    $bloque="";
    $list=$_SESSION["lista_disponibilidad"];
    $list_i=0;
    $bloque_id=0;
    $y=0;
    for ($i=$_SESSION["tipo_horario"]; $i < $_SESSION["tipo_horario"]+7; $i++) {
        $dias=1;
        $bloque="B".$b; 
        echo "<div class='hora'>".$hora."-".$hora2."</div>";
        for ($index=0; $index < 5; $index++) {
            $list_i=searchForId($dias,$list);
            $bloque_id=searchForBloque($bloque,$dias,$list);
            if ($_SESSION["usuario"]=="profesor") {
                if (isset($list[$list_i]) && $dias==$list[$list_i][2] && $bloque==$list[$bloque_id][1]) {
                    echo "<div class='".$dias." B".$b." bloque_add' id='bloque_".$dias."_".$b."'active'>";
                    if (isset($_SESSION["find_horario"]) && $y<count($_SESSION["find_horario"])) {
                        if ($_SESSION["find_horario"][$y][3]==$bloque && $_SESSION["find_horario"][$y][6]==$dias) {
                            echo "<span>Carrera: ".$_SESSION["find_horario"][$y][5]."</span><br>";
                            echo "<span>Materia: ".$_SESSION["find_horario"][$y][4]."</span><br>";
                            echo "<span>Aula: ".$_SESSION["find_horario"][$y][1]."</span>";
                            $y=$y+1;
                        }
                        else {
                        echo "<span></span><br>
                        <span></span><br>
                        <span></span>";
                        }
                    }
                    else {
                        echo "<span></span><br>
                        <span></span><br>
                        <span></span>";
                    }
                    echo "</div>";
                }
                else {
                    echo "<div class='".$dias." B".$b."'>
                    </div>";
                } 
                $dias=$dias+1;
            }
            else {
                if (isset($list[$list_i]) && $dias==$list[$list_i][2] && $bloque==$list[$bloque_id][1]) {
                    echo "<div class='".$dias." B".$b." bloque_add' id='bloque_".$dias."_".$b."'active' style='border:3px solid rgb(110,225,80);cursor:pointer;'  onclick='DisplayHorario(`block`,`.form-".$dias."_".$b."`,this)'>";
                    if (isset($_SESSION["find_horario"]) && $y<count($_SESSION["find_horario"])) {
                        if ($_SESSION["find_horario"][$y][3]==$bloque && $_SESSION["find_horario"][$y][8]==$dias) {
                            echo "<span>Carrera: ".$_SESSION["find_horario"][$y][6]."—".$_SESSION["find_horario"][$y][7]."</span><br>";
                            echo "<span>Materia: ".$_SESSION["find_horario"][$y][4]."—".$_SESSION["find_horario"][$y][5]."</span><br>";
                            echo "<span>Seccion: ".$_SESSION["find_horario"][$y][9]."</span><br>";
                            echo "<span>Aula: ".$_SESSION["find_horario"][$y][1]."</span>";
                            $y=$y+1;
                        }
                        else {
                        echo "<span></span><br>
                        <span></span><br>
                        <span></span>
                        <span></span>";
                        }
                    }
                    else {
                        echo "<span></span><br>
                        <span></span><br>
                        <span></span><br>
                        <span></span>";
                    }
                    echo "</div>";
                }
                else {
                    echo "<div class='".$dias." B".$b."'>
                    </div>";
                } 
                $dias=$dias+1;
            }
          
        }
        
        $b=$b+1;
        $nuevahora=strtotime($hora)+strtotime("00:45");
        $hora=date('H:i', $nuevahora);
        $nuevahora2=strtotime($hora2)+strtotime("00:45");
        $hora2=date('H:i', $nuevahora2);
    }
    echo "";
    echo "";
    ?>
</div>
<?php
    if (isset($_SESSION["find_horario"]) && count($_SESSION["find_horario"])>0 && $_SESSION["usuario"]!="profesor") {
        echo "<img class='img-horario' src='css/img/borrar.png' onclick='DisplayDelete(`block`,`.delete-window`,`#horario`,`".$_SESSION["disponibilidad_profesor"][0][0]."`)'title='Borrar Datos' style='width:60px;height:60px;cursor:pointer;position:absolute;left:450px;top:870px;'>";
    }
    if ($_SESSION["usuario"]!="profesor") {
?>
<button type="button" class='button_horario' onclick='SubmitHorario()'>Guardar</button>
<button onClick='window.location.reload();' class='button_horario cancel_horario' style='left:717px;'>Volver</button>
<?php 
    }
?>
</div>
