<link rel="stylesheet" href="css/listar.css">
<?php 
include_once("../control/c_listar.php");
$tabla=$_GET["tabla"] ?? '';
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
 
  //Variable con los nombres de la tabla
  $name=GetAll($table);
  //Datos de las columnas de las tabla
  $lista=History($table,$campo,$dato);
  //Desde donde empezara a contar
  $index=0;
  //El numero total de columnas mas el boton de modificar y eliminar
  $namecount=count($name)+2;
  //El tamaño de largo que tendra el div
  $width=$namecount*105;
  //se calcula el total de pagina
  $totalpage=ceil(count($lista)/2);
  //Si el numero de elementos sobrepasa a 5 se crean las variables
  if (count($lista)>2) {
    $numero_items=2*$page;
    $index=$numero_items-2;
  }
  else {
    $numero_items=count($lista);
  }
  echo "<div id='$table-historial' class='container historial' style='animation-name=Appear'>";
  //El div donde estara la tabla
  echo "<div class='buscar-historial-container' style='display: flex;flex-direction: row;width: 50%;padding: 15px 10px;position: absolute;top: 10px;left: 0;right: 0;margin-left: auto;margin-right: auto;'>
  <div class='input-container'>

    <label for='buscar_historial' id='labelbuscar_historial'>Buscar...</label><br>

    <input type='text' id='buscar_historial' name='codigo_materia' onfocus='LabelAnimation(`buscar_historial`,`labelbuscar_historial`)' onblur='LabelOut(`buscar_historial`,`labelbuscar_historial`)' maxlength='50' class='input input-label' style='width:200px;'>

  </div>
  <select name='campo' id='campo' style='margin-left:20px;margin-top:20px;height:30px;' onclick='SelectValidation()'>";
  for ($i=0; $i < count($name); $i++) {
    echo "<option value=".strtoupper($name[$i]["COLUMN_NAME"]).">".strtoupper($name[$i]["COLUMN_NAME"]);
    echo "</option>";
    
  }
  echo "</select>";
  echo "<button id='button_historial' type='button' onclick='findHistorial()' style='width:100px;height: 30px;margin-top: 20px;margin-left: 20px;'>Buscar</button>";
  if ($campo!="undefined") {
    echo "<button id='back' type='button' onclick='refresh(1,``,`undefined`,`undefined`)' style='width:100px;height: 30px;margin-top: 20px;margin-left: 20px;'>Volver</button>";
  }
 echo "</div>";
  echo "<div class='listar-container' style='display:none;width:".$width."px;grid-template-columns:repeat(".$namecount.",auto);' onload='TableName()'>";
  //Se crean las columnas con los nombres
  for ($i=0; $i < count($name); $i++) {
    echo "<div class='title'>".strtoupper($name[$i]["COLUMN_NAME"])."</div>";
  }
  echo "<span></span>";
  echo "<span></span>";
  //Se crean las filas con los datos de la tabla
  while ($index < $numero_items) {
    if (empty($lista[$index])) {
      break;
    }
    else {
      for ($i=0; $i < count($lista[0]); $i++) { 
        echo "<div class='".$name[$i]["COLUMN_NAME"]." f-".$index."' value=".$lista[$index][$i].">".$lista[$index][$i]."</div>";
      }
      print_r("<button onclick='ActiveModificar(`.f-".$index."`,`$table-container`)'>Modificar</button>");
      echo "<button onclick='DisplayDelete(`block`,`.delete-window`,`#$table`,`".$lista[$index][0]."`)'>Eliminar</button>";
      $index=$index+1;
      }
  }
  if (count($lista)==0) {
    $namecount=$namecount-1;
    echo "<div style='grid-column:1/$namecount;max-width:".$width."px;font-size:20px;' id='no_found'>No se encontro resultados</div>";
  }
  echo "</div>";
  //Se crea la paginacion
  if ($totalpage>1) {
    echo "<div class='paginacion'>";
    for ($i=1; $i <= $totalpage; $i++) {
      if ($i==$page) {
        echo "<span class='select'>$i</span>";
      }
      else {
        echo "<span onclick='refresh($i,`$table`,`$campo`,`$dato`)'>$i</span>";
      }
     
    }
    echo "</div>";
  }
  echo "</div>";
}
CreateTable($tabla,$campo,$dato);

?>