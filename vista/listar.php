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
  if (count($lista)>0) {
    $namecount=count($name)+2;
  }
  else {
    $namecount=count($name);
  }
  
  //El tamaño de largo que tendra el div
  $width=$namecount*105;
  //se calcula el total de pagina
  $totalpage=ceil(count($lista)/6);
  if (!empty($lista)) {
    $count_lista=count($lista[0]);
  }
  
  //Si el numero de elementos sobrepasa a 5 se crean las variables
  if (count($lista)>6) {
    $numero_items=6*$page;
    $index=$numero_items-6;
  }

  else {
    $numero_items=count($lista);
  }
  if ($table=="profesor") {
    $namecount=11;
    $count_lista=8;
    $width=$namecount*105;
  }
    //El div donde estara la tabla
  echo "<div id='$table-historial' class='container historial' style='animation-name=Appear'>";
  //el formulario de busqueda para los datos de la tabla
  echo "<div class='buscar-historial-container' style='display: flex;flex-direction: row;width: 50%;padding: 15px 10px;position: absolute;top: 10px;left: 0;right: 0;margin-left: auto;margin-right: auto;'>
  <div class='input-container'>

    <label for='buscar_historial' id='labelbuscar_historial'>Buscar...</label><br>

    <input type='text' id='buscar_historial' name='codigo_materia' onfocus='LabelAnimation(`buscar_historial`,`labelbuscar_historial`)' onblur='LabelOut(`buscar_historial`,`labelbuscar_historial`)' maxlength='50' class='input input-label' style='width:200px;'>

  </div>
  <select name='campo' id='campo' style='margin-left:20px;margin-top:20px;height:30px;' onclick='SelectValidation()'>";
  //Para crear el select con los nombres de cada columna de la tabla para mas comodidad para buscar
  //Confirmamos si la tabla es pensum para darle un comportamiento diferente a la de las otras tablas para evitar incovenientes
  if ($table=="pensum" || $table=="oferta") {
    echo "<option value=".strtoupper($name[1]["COLUMN_NAME"]).">".strtoupper($name[1]["COLUMN_NAME"]);
    echo "</option>";
  }
  //Si no es igual a pensum se ejecuta como normalmente lo haria
  else {
    for ($i=0; $i < count($name); $i++) {
      echo "<option value=".strtoupper($name[$i]["COLUMN_NAME"]).">".strtoupper($name[$i]["COLUMN_NAME"]);
      echo "</option>";
      
    }
  }
  //Se cierra el select
  echo "</select>";
  //Se crea el boton que ejecutara el buscar de la tabla
  echo "<button id='button_historial' type='button' onclick='findHistorial()' style='width:100px;height: 30px;margin-top: 20px;margin-left: 20px;'>Buscar</button>";
  //Si se hizo una busqueda aparecer un boton que pondra la tabla como estaba originalmente
  if ($campo!="undefined") {
    echo "<button id='back' type='button' onclick='refresh(1,``,`undefined`,`undefined`)' style='width:100px;height: 30px;margin-top: 20px;margin-left: 20px;'>Volver</button>";
  }
 echo "</div>";
  if ($table=="profesor") {
    echo "<div class='listar-container' style='display:none;width:".$width."px;grid-template-columns:repeat(".$namecount.",auto);left:45%;'>";
  }
  else {
    echo "<div class='listar-container' style='display:none;width:".$width."px;grid-template-columns:repeat(".$namecount.",auto);'>";
  }
  //Se crean las columnas con los nombres
  for ($i=0; $i < count($name); $i++) {
    echo "<div class='title'>".strtoupper($name[$i]["COLUMN_NAME"])."</div>";
    if ($i==7) {
      break;
    }
  }
  if (count($lista)>0) {
  echo "<span></span>";
  echo "<span></span>";
  if ($table=="profesor") {
    echo "<span></span>";
  }
}
  //Se crean las filas con los datos de la tabla
  while ($index < $numero_items) {
    if (empty($lista[$index])) {
      break;
    }
    else {
      //Se verifica si la tabla es la pensum para decirle que aparezca los datos de una forma especifica
      if($table==="pensum") {
        
          echo "<div class='".$name[0]["COLUMN_NAME"]." f-".$index."' value=".$lista[$index][0].">".$lista[$index][0]."</div>";
          echo "<div class='".$name[1]["COLUMN_NAME"]." f-".$index."' value=".$lista[$index][1].">".$lista[$index][2]."</div>";
          echo "<div class='".$name[2]["COLUMN_NAME"]." f-".$index."' >";
          $x=4;
          //for donde se agregan todas las materias al mismo div para mas comodidad para el usuario
          for ($i=3; $i < count($lista[$index]); $i=$i+2) { 
            echo "<span id=".$lista[$index][$i].">".$lista[$index][$x]."  </span>";
            $x=$x+2;
          }
          echo "</div>";
    }
      else if($table==="oferta") {
      
        echo "<div class='".$name[0]["COLUMN_NAME"]." f-".$index."' value=".$lista[$index][0].">".$lista[$index][0]."</div>";
        echo "<div class='".$name[1]["COLUMN_NAME"]." f-".$index."' value=".$lista[$index][1].">".$lista[$index][1]."</div>";
        echo "<div class='".$name[2]["COLUMN_NAME"]." f-".$index."' >";
        $x=3;
        for ($i=2; $i < count($lista[$index]); $i=$i+2) { 
          echo "<span id=".$lista[$index][$i].">".$lista[$index][$x]."  </span>";
          $x=$x+2;
        }
        echo "</div>";
    }
      else {
        //For para ingresar los datos en los div de la fila
        for ($i=0; $i < $count_lista; $i++) { 
          //Transformar los valores de la tabla del profesor en algo mas agradable y entendible para el usuario
          if ($table==="profesor" && $i===1) {
            if ($lista[$index][$i]==="0") {
              echo "<div class='".$name[$i]["COLUMN_NAME"]." f-".$index."' value=".$lista[$index][$i].">PROFESOR</div>";
            }
            else if($lista[$index][$i]==="1") {
              echo "<div class='".$name[$i]["COLUMN_NAME"]." f-".$index."' value=".$lista[$index][$i].">ADMINISTRADOR</div>";
            }
          }
          //Transformar los valores de la tabla de materia en algo mas agradable y entendible para el usuario
          else if ($table==="materia" && $i===2) {
            if ($lista[$index][$i]==="0") {
              echo "<div class='".$name[$i]["COLUMN_NAME"]." f-".$index."' value=".$lista[$index][$i].">DICIPLINARIA</div>";
            }
            else if($lista[$index][$i]==="1") {
              echo "<div class='".$name[$i]["COLUMN_NAME"]." f-".$index."' value=".$lista[$index][$i].">MULTIDICIPLINARIA</div>";
            }
          }
          
          else {
            if ($i==9) {
              echo "<div></div>";
            }
            echo "<div class='".$name[$i]["COLUMN_NAME"]." f-".$index."' value=".$lista[$index][$i]." title='".$lista[$index][$i]."'>".$lista[$index][$i]."</div>";
          }
         
        }
      }
      
      print_r("<button onclick='ActiveModificar(`.f-".$index."`,`$table-container`)'>Modificar</button>");
      if ($table=="pensum" || $table=="oferta") {
        echo "<button onclick='DisplayDelete(`block`,`.delete-window`,`#$table`,`".$lista[$index][1]."`)'>Eliminar</button>";
      }
      else {
        echo "<button onclick='DisplayDelete(`block`,`.delete-window`,`#$table`,`".$lista[$index][0]."`)'>Eliminar</button>";
      }
      if ($table=="profesor") {
        echo "<button class='f-".$index."' id='".$lista[$index][8]." ".$lista[$index][9]." ".$lista[$index][10]."' onclick='ShowContratacion(`".$lista[$index][8]."`,`".$lista[$index][9]."`,`".$lista[$index][10]."`)'>Mostrar Mas</button>";
      }
      $index=$index+1;
      }
  }
  if (count($lista)==0) {
    $namecount=$namecount+1;
    echo "<div style='grid-column:1/$namecount;max-width:".$width."px;font-size:20px;' id='no_found'>No se encontro resultados</div>";
  }
  echo "</div>";
  //Se crea la paginacion
  if ($totalpage>1) {
    echo "<div class='paginacion' style='position: absolute;
    top: 260%;
    left: 0;
    right: 0;
    margin-left: auto;
    margin-right: auto;
    width: 200px;'>";
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