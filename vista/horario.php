
<div id='horario_agrupar' class='container' style='display:none;'>
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
    </div>
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
    $hora="07:00";
    $hora2="07:45";
    $dias=1;
    $b=1;
    $bloque="";
    $list=$_SESSION["lista_disponibilidad"];
    $list_i=0;
    $bloque_id=0;
    for ($i=0; $i < 7; $i++) {
        $dias=1;
        $bloque="B".$b; 
        
        
        echo "<div class='hora'>".$hora."-".$hora2."</div>";
        for ($index=0; $index < 5; $index++) {
            $list_i=searchForId($dias,$list);
            $bloque_id=searchForBloque($bloque,$dias,$list);
            if (isset($list[$list_i]) && $dias==$list[$list_i][2] && $bloque==$list[$bloque_id][1]) {
                echo "<div class='".$dias." B".$b."' id='bloque_".$dias."_".$b."'active' style='border:3px solid rgb(110,225,80);cursor:pointer;'  onclick='DisplayHorario(`block`,`.form-".$dias."_".$b."`)'></div>";
            }
            else {
                echo "<div class='".$dias." B".$b."'>
                </div>";
            } 
           
            $dias=$dias+1;
        }
        $b=$b+1;
        $nuevahora=strtotime($hora)+strtotime("00:45");
        $hora=date('H:i', $nuevahora);
        $nuevahora2=strtotime($hora2)+strtotime("00:45");
        $hora2=date('H:i', $nuevahora2);
    }
    ?>
</div>
</div>
