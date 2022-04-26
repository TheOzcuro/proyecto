
<?php
ob_start();
include_once("../control/c_listar.php");
$tabla=$_GET["table"] ?? '';
$campo=$_GET["campo"] ?? '';
$dato=$_GET["dato"] ?? '';

function CreateTable($table,$campo,$dato) {
  if (empty($_GET["page"]) && isset($_GET["page"])==false) {
    $page=1;
    
  }

  else {
    if (isset($_SESSION["pagina"])) {
      $page=$_SESSION["pagina"];
    }
    else {
      $page=$_GET["page"];
      
    }
  }
  if ($campo=="") {
    $campo="undefined";
  }
  if ($dato=="") {
    $dato="undefined";
  }
  //Variable con los nombres de la tabla
  $name=GetAll($table);
 
  //Datos de las columnas de las tabla
  $lista=History($table,$campo,$dato);
  //Desde donde empezara a contar
  $index=0;
  //El numero total de columnas mas el boton de modificar y eliminar
  
  //El tamaño de largo que tendra el div
  //se calcula el total de pagina
  if (!empty($lista)) {
    $count_lista=count($lista[0]);
  }
  if ($table=="profesor") {
      $count_lista=14;
  }
  //Si el numero de elementos sobrepasa a 5 se crean las variables
  if (count($lista)>6) {
    $numero_items=6*$page;
    $index=$numero_items-6;
  }

  else {
    $numero_items=count($lista);
  }
    echo "<table class='listar-container' style='width:100%;border-collapse: collapse;'>";
  echo "<tr>";
  //Se crean las columnas con los nombres
  for ($i=0; $i < count($name); $i++) {
    if ($table=="materia" && $i==2) {

    }
    else if ($table=="horario_docente") {
      echo"<th class='title' style='border:1px solid black;'>CEDULA DOCENTE</th>";
      echo"<th class='title' style='border:1px solid black;'>PRIMER NOMBRE</th>";
      echo"<th class='title' style='border:1px solid black;'>SEGUNDO NOMBRE</th>";
      echo"<th class='title' style='border:1px solid black;'>PRIMER APELLIDO</th>";
      echo"<th class='title' style='border:1px solid black;'>SEGUNDO APELLIDO</th>";
      echo"<th class='title' style='border:1px solid black;'>LAPSO ACADEMICO</th>";
      break;
    }
    else if ($table=="profesor" && $i==1) {
      echo"<th class='title' style='border:1px solid black;font-size:18px;background: rgb(73, 87, 214);color:white;'>NOMBRE COMPLETO</th>";
      $i=$i+3;
    }
    else if ($table=="pensum") {
      echo"<th class='title' style='border:1px solid black;font-size:18px;background: rgb(73, 87, 214);color:white;'>PNF</th>";
      echo"<th class='title' style='border:1px solid black;font-size:18px;background: rgb(73, 87, 214);color:white;'>UNIDAD CURRICULAR</th>";
      break;
    }
    else {
        if ($i==14) {
            break;
        }
      echo "<th class='title' style='border:1px solid black;font-size:18px;background: rgb(73, 87, 214);color:white;'>".strtoupper($name[$i]["COLUMN_NAME"])."</th>";
    }
   
  }
  echo "</tr>";
  //Se crean las filas con los datos de la tabla
  while ($index < $numero_items) {
    if (empty($lista[$index])) {
      break;
    }
    else {
      //Se verifica si la tabla es la pensum para decirle que aparezca los datos de una forma especifica
      if($table==="pensum") {
        echo "<tr>";
          echo "<td class='".$name[1]["COLUMN_NAME"]." f-".$index."' value=".$lista[$index][1]." style='border:1px solid black;'>".$lista[$index][2]."</td>";
          echo "<td class='".$name[2]["COLUMN_NAME"]." f-".$index."' style='border:1px solid black;'>";
          $x=4;
          //for donde se agregan todas las materias al mismo div para mas comodidad para el usuario
          for ($i=3; $i < count($lista[$index]); $i=$i+2) { 
            echo "<span id=".$lista[$index][$i].">".$lista[$index][$x].", </span>";
            $x=$x+2;
          }
          echo "</td>";
          echo "</tr>";
    }
      else {
        echo "<tr>";
        //For para ingresar los datos en los div de la fila
        for ($i=0; $i < $count_lista; $i++) { 
          //Transformar los valores de la tabla del profesor en algo mas agradable y entendible para el usuario
          //Transformar los valores de la tabla de materia en algo mas agradable y entendible para el usuario
          if ($table==="materia" && $i===2) {
          }
          else if ($table=="profesor" && $i==1) {
            echo "<td class='".$name[$i]["COLUMN_NAME"]." f-".$index."' value=".$lista[$index][$i]." title='".$lista[$index][$i]."' style='border:1px solid black;'>".$lista[$index][1]." ".$lista[$index][2]." ".$lista[$index][3]." ".$lista[$index][4];
            echo "</td>";
            $i=$i+3;
          }
          else {
            echo "<td class='".$name[$i]["COLUMN_NAME"]." f-".$index."' value=".$lista[$index][$i]." title='".$lista[$index][$i]."' style='border:1px solid black;'>".$lista[$index][$i];
            echo "</td>";
          }
         
        }
        echo "</tr>";
      }
      $index=$index+1;
      }
  }
  echo "</table>";
}
include_once("../libreria/dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf= new Dompdf();
CreateTable($tabla,$campo,$dato);
$html=ob_get_clean();
$option = $dompdf->getOptions();
$option->set(array('isRemoteEnable' => true));
$dompdf->set_option('dpi', 100);
$dompdf->setOptions($option);
$dompdf->loadHtml($html);
if ($tabla=="profesor") {
  $dompdf->setPaper("A3", "landscape");
}
else {
  $dompdf->setPaper("letter");
}

$dompdf->render();
$dompdf->stream($tabla.".pdf", array('Attachment' => false));
echo "<script>window.close();</script>";
?>