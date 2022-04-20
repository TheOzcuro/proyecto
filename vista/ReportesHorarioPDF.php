<?php 
include_once("../control/c_pdfhorario.php");
ob_start();
$cedula=explode(",",$_GET["cedula"]);
$lapso=explode(",",$_GET["lapso"]);
$c=count($cedula)-1;
$x=0;

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
while($x<$c){
    if ($x==$c) {
        break;
    }
    CreateHorario($cedula[$x],$lapso[$x]);
    $x=$x+1;
    ?>
    <div id='horario_agrupar' class='container'>
        <table class='profesor_datos' style='
        width: 100%;
        padding: 15px 10px;
        font-size: 16px;
        color: rgb(240, 240, 240);
        background: rgb(73, 87, 214);
        text-align: center;'>
            <th class='profesor_cedula'><b>Cedula: </b><?php echo  $_SESSION["disponibilidad_profesor"][0][0];?></th>
            <th class='profesor_nombre'><b>Nombre: </b><?php echo  $_SESSION["disponibilidad_profesor"][0][1]." ".$_SESSION["disponibilidad_profesor"][0][3];?></th>
            <th class='profesor_oficio'><b>Oficio: </b><?php echo  $_SESSION["disponibilidad_profesor"][0][13];?></th>
            <th class='profesor_titulo'><b>Titulo: </b><?php 
            if ($_SESSION["disponibilidad_profesor"][0][12]=="") {
                echo "No tiene";
            }
            else {
                echo  $_SESSION["disponibilidad_profesor"][0][12];
            }
            ?></th>
            <th class='lapso'><b>Lapso: </b><?php echo  $_SESSION["lapso"];?></th>
        </table>
    <table id='horario_list'style='width:100%;border-collapse: collapse;'>
    <tr>
        <td class='title' style='border:1px solid black;font-size:18px;'>HORA</td>
        <td class='title' style='border:1px solid black;font-size:18px;'>LUNES</td>
        <td class='title' style='border:1px solid black;font-size:18px;'>MARTES</td>
        <td class='title' style='border:1px solid black;font-size:18px;'>MIERCOLES</td>
        <td class='title' style='border:1px solid black;font-size:18px;'>JUEVES</div>
        <td class='title' style='border:1px solid black;font-size:18px;'>VIERNES</td>
        </tr>
        <?php
        $hora="07:00";
            $hora2="07:45";
        $dias=1;
        $b=0+1;
        $bloque="";
        $list=$_SESSION["lista_disponibilidad"];
        $list_i=0;
        $bloque_id=0;
        $y=0;
        for ($i=0 ;$i < 15; $i++) {
            $dias=1;
            $bloque="B".$b;
            echo "<tr>"; 
            echo "<td class='hora' style='border:1px solid black;font-size:18px;'>".$hora."-".$hora2."</div>";
            for ($index=0; $index < 5; $index++) {
                $list_i=searchForId($dias,$list);
                $bloque_id=searchForBloque($bloque,$dias,$list);
                if (isset($list[$list_i]) && $dias==$list[$list_i][2] && $bloque==$list[$bloque_id][1]) {
                    echo "<td class='".$dias." B".$b." bloque_add' id='bloque_".$dias."_".$b."'active' style='border:1px solid black;font-size:13px;height:80px;' onclick='DisplayHorario(`block`,`.form-".$dias."_".$b."`,this)'>";
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
                    echo "</td>";
                }
                else {
                    echo "<td class='".$dias." B".$b."' style='border:1px solid black;font-size:13px;height:80px;'>
                    </td>";
                } 
                $dias=$dias+1;
            }
            echo "</tr>";
            $b=$b+1;
            $nuevahora=strtotime($hora)+strtotime("00:45");
            $hora=date('H:i', $nuevahora);
            $nuevahora2=strtotime($hora2)+strtotime("00:45");
            $hora2=date('H:i', $nuevahora2);
        }
        ?>
    </table>
    </div>
    <?php
    
}
unset($_SESSION["disponibilidad_profesor"]);
unset($_SESSION["lista_disponibilidad"]);
unset($_SESSION["lapso"]);
include_once("../libreria/dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf= new Dompdf();
$html=ob_get_clean();
$option = $dompdf->getOptions();
$option->set(array('isRemoteEnable' => true));
$dompdf->set_option('dpi', 100);
$dompdf->setOptions($option);
$dompdf->loadHtml($html);
$dompdf->setPaper("A4", "landscape");
$dompdf->render();
$dompdf->stream("horario.pdf", array('Attachment' => false));
?>
