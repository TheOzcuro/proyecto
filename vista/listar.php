<link rel="stylesheet" href="css/listar.css">
<?php
session_start();
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
  if ($table=="aula") {
    $namecount=4;
  }
  if ($table=="materia") {
    $namecount=6;
  }
  if ($table=="horario_docente") {
    $namecount=8;
    $width=$namecount*105;
  }
  if ($table=="pensum") {
    $namecount=4;
    $width=$namecount*105;
  }
    //El div donde estara la tabla
  echo "<div id='$table-historial' class='container historial' style='animation-name=Appear'>";
  //el formulario de busqueda para los datos de la tabla
  echo "<div class='buscar-historial-container' style='display: flex;flex-direction: row;width: 50%;padding: 15px 10px;position: absolute;top: 10px;left: 0;right: 0;margin-left: auto;margin-right: auto;'>
  <div class='input-container' id='input_buscar'>

    <label for='buscar_historial' id='labelbuscar_historial' class='find_inputs'>Buscar...</label><br>

    <input type='text' id='buscar_historial' name='codigo_materia' onfocus='LabelAnimation(`buscar_historial`,`labelbuscar_historial`)' onblur='LabelOut(`buscar_historial`,`labelbuscar_historial`)' maxlength='50' class='input input-label find_inputs' style='width:200px;'>
    <select name='rol_buscar' id='rol_buscar' onclick='SelectAnimation(`rol_buscar`)' style='display:none; margin-bottom: 10px;' class='find_inputs'>
        <option value=''>Rol<b style='color:red;'>*</b></option>
        <option value='1'>Administrador</option>
        <option value='0'>Profesor</option>
    </select>
    <select name='disponibilidad_buscar' id='disponibilidad_buscar' onclick='SelectAnimation(`rol_buscar`)' style='display:none; margin-bottom: 10px;' class='find_inputs'>
        <option value=''>Disponibilidad</b></option>
        <option value='0'>Inactivo</option>
        <option value='1'>Activo</option>
    </select>
    <select name='contratacion_buscar' id='contratacion_buscar' onclick='SelectAnimation(`contratacion_buscar`)' style='display:none; margin-bottom: 30px;' class='find_inputs'>
        <option value=''>Contratacion<b style='color:red;'>*</b></option>
        <option value='1'>Tiempo Inderteminado</option>
        <option value='2'>Tiempo Determinado</option>
        <option value='3'>Ordinario</option>
    </select>
    <select name='categoria_buscar' id='categoria_buscar' onclick='SelectAnimation(`categoria`)' style='display:none;margin-bottom: 10px;' class='find_inputs'>
        <option value=''>Categoria<b style='color:red;'>*</b></option>
        <option value='1'>Auxiliar Docente I</option>
        <option value='2'>Auxiliar Docente II</option>
        <option value='3'>Auxiliar Docente III</option>
        <option value='4'>Instructor</option>
        <option value='5'>Asistente</option>
        <option value='6'>Asesor</option>
        <option value='7'>Agregado</option>
    </select>
    <select name='dedicacion_buscar' id='dedicacion_buscar' onclick='SelectAnimation(`dedicacion_buscar`)' style='display:none;margin-bottom: 10px;' class='find_inputs'>
        <option value=''>Dedicacion<b style='color:red;'>*</b></option>
        <option value='1'>Tiempo Convencional</option>
        <option value='2'>Medio Tiempo</option>
        <option value='3'>Tiempo Completo</option>
    </select>
  </div>
  <select name='campo' id='campo' style='margin-left:20px;margin-top:20px;height:30px;' onclick='SelectValidation()'>";
  //Para crear el select con los nombres de cada columna de la tabla para mas comodidad para buscar
  //Confirmamos si la tabla es pensum para darle un comportamiento diferente a la de las otras tablas para evitar incovenientes
  if ($table=="pensum") {
    echo "<option value=".strtoupper($name[1]["COLUMN_NAME"]).">".strtoupper($name[1]["COLUMN_NAME"]);
    echo "</option>";
  }
  else if ($table=="materia") {
    echo "<option value=".strtoupper($name[0]["COLUMN_NAME"]).">".strtoupper($name[0]["COLUMN_NAME"]);
    echo "</option>";
    echo "<option value=".strtoupper($name[1]["COLUMN_NAME"]).">".strtoupper($name[1]["COLUMN_NAME"]);
    echo "</option>";
  }
  else if ($table=="aula") {
    echo "<option value='CODIGO'>CODIGO";
    echo "</option>";
    echo "<option value='NOMBRE'>NOMBRE";
    echo "</option>";
  }
  else if($table=="horario_docente") {
    echo "<option value=".strtoupper($name[1]["COLUMN_NAME"]).">".strtoupper($name[1]["COLUMN_NAME"]);
    echo "</option>";
    echo "<option value=PRIMER_NOMBRE>PRIMER_NOMBRE";
    echo "</option>";
    echo "<option value=PRIMER_APELLIDO>PRIMER_APELLIDO";
    echo "</option>";
    echo "<option value=".strtoupper($name[3]["COLUMN_NAME"]).">".strtoupper($name[3]["COLUMN_NAME"]);
    echo "</option>";
  }
  else if ($table=="oferta") {
    echo "<option value='PERIODO'>PERIODO";
    echo "</option>";
    echo "<option value='CODIGO_PNF'>CODIGO_PNF";
    echo "</option>";
    echo "<option value='PNF'>PNF";
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
  if (count($lista)>0) {
    if ($campo!="undefined" && $table!="horario_docente") {
      echo "<a href='reportesPDF.php?table=$table&url=$table-historial-grid&campo=$campo&dato=$dato' title='Descargar todos los datos del historial'><img src='css/img/pdf.png' style='width:40xp;height:40px;margin-top:10px;margin-left:60px;'></a>";
    }
    else if ($table=="horario_docente") {
      echo "<a href='reportesHorarioPDF.php?cedula=";
      $a=0;
      while ($a < $numero_items) {
        if ($a==$numero_items) {
          echo $lista[$a][0];
        }
        else {
          echo $lista[$a][0].",";
        }
        $a=$a+1;
      }  
      echo "&lapso=";
      $b=0;
      while ($b < $numero_items) {
        if ($b==$numero_items) {
          echo $lista[$b][5];
        }
        else {
          echo $lista[$b][5].",";
        }
        $b=$b+1;
      }  
      echo "' title='Descargar todos los datos del historial' target='_blank'><img src='css/img/pdf.png' style='width:40xp;height:40px;margin-top:10px;margin-left:60px;'></a>";
    }
    else {
      echo "<a href='reportesPDF.php?table=$table&url=$table-historial-grid' title='Descargar todos los datos del historial' target='_blank'><img src='css/img/pdf.png' style='width:40xp;height:40px;margin-top:10px;margin-left:60px;'></a>";
    }
    
  }
  
 echo "</div>";
  if ($table=="profesor") {
    echo "<div class='listar-container' id='teacher' style='display:none;width:".$width."px;grid-template-columns:repeat(".$namecount.",auto);left:46%;'>";
  }
  else if($table=="pensum"){
    echo "<div class='listar-container' style='display:none;width:".$width."px;grid-template-columns:1fr 350px 1fr 1fr;left:43%;'>";
  }
  else {
    echo "<div class='listar-container' style='display:none;width:".$width."px;grid-template-columns:repeat(".$namecount.",auto);'>";
  }
  //Se crean las columnas con los nombres
  for ($i=0; $i < count($name); $i++) {
    if ($table=="materia" && $i==2) {
    }
    else if ($table=="oferta" && $i==2) {
      echo"<div class='title'>CODIGO_PNF</div>";
      echo"<div class='title'>PNF</div>";
    }
    else if ($table=="oferta" && $i==0) {

    }
    else if ($table=="aula") {
      echo"<div class='title'>CODIGO</div>";
      echo"<div class='title'>NOMBRE</div>";
      break;
    }
    else if ($table=="horario_docente") {
      echo"<div class='title'>CEDULA DOCENTE</div>";
      echo"<div class='title'>PRIMER NOMBRE</div>";
      echo"<div class='title'>SEGUNDO NOMBRE</div>";
      echo"<div class='title'>PRIMER APELLIDO</div>";
      echo"<div class='title'>SEGUNDO APELLIDO</div>";
      echo"<div class='title'>PERIODO ACADEMICO</div>";
      break;
    }
    else if ($table=="pensum") {
      echo"<div class='title' style='width:1000px;'>PNF</div>";
      echo"<div class='title' style='max-width:350px;'>UNIDAD CURRICULAR</div>";
      break;
    }
    else {
      echo "<div class='title'>".strtoupper($name[$i]["COLUMN_NAME"])."</div>";
      if ($i==7) {
        break;
      }
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
          echo "<div class='".$name[1]["COLUMN_NAME"]." f-".$index."' value=".$lista[$index][1].">".$lista[$index][2]."</div>";
          echo "<div class='".$name[2]["COLUMN_NAME"]." f-".$index."' style='overflow:auto;max-width:350px;'>";
          $x=4;
          //for donde se agregan todas las materias al mismo div para mas comodidad para el usuario
          $contador=1;
          for ($i=3; $i < count($lista[$index]); $i=$i+2) { 
            echo "<span id=".$lista[$index][$i].">".$contador.") ".$lista[$index][$x]." </span><br>";
            $x=$x+2;
            $contador=$contador+1;
          }
         
          echo "</div>";
    }
      else {
        //For para ingresar los datos en los div de la fila
        for ($i=0; $i < $count_lista; $i++) { 
          //Transformar los valores de la tabla del profesor en algo mas agradable y entendible para el usuario
          //Transformar los valores de la tabla de materia en algo mas agradable y entendible para el usuario
          if ($table==="materia" && $i===2) {
          }
          else if ($table==="lapso_academico" && $i===3) {
            $resultado=$lista[$index][$i]==1 ? "ACTIVO" : "DESACTIVADO";
            echo "<div class='".$name[$i]["COLUMN_NAME"]." f-".$index."' value=".$lista[$index][$i]." title='".$lista[$index][$i]."'  style='overflow:auto;'>".$resultado;
            echo "</div>";
          }
          else if ($table=="noticia" && $i===1) {
            echo "<div class='".$name[$i]["COLUMN_NAME"]." f-".$index."' value=".$lista[$index][$i]." title='".$lista[$index][$i]."'  style='overflow:auto;'>".$lista[$index][$i];
            echo "</div>";
          }
          else {
            if ($i==9) {
              echo "<div></div>";
            }
            echo "<div class='".$name[$i]["COLUMN_NAME"]." f-".$index."' value=".$lista[$index][$i]." title='".$lista[$index][$i]."'>".$lista[$index][$i];
            
            if ($table=="profesor" && $i==0) {
              if ($lista[$index][18]==0) {
                print_r("<div style='border-radius:50%;background:rgb(220,60,30);position:absolute;width: 25px;height: 25px;left:-30px;z-index:-1;cursor:pointer;margin-top:-10px;'  title='No posee Disponibilidad'  onclick='ActiveDisponibilidad(`".$lista[$index][0]."`,`".$lista[$index][1]."`,`".$lista[$index][3]."`,`".$lista[$index][7]."`,`0`)'></div>");
               }
               else if($lista[$index][18]==1) {
                 print_r("<div style='border-radius:50%;background:rgb(105,180,100);position:absolute;width: 25px;height: 25px;left:-30px;z-index:-1;cursor:pointer;margin-top:-10px;' title='Posee Disponibilidad' 
                 onclick='ActiveDisponibilidad(`".$lista[$index][0]."`,`".$lista[$index][1]."`,`".$lista[$index][3]."`,`".$lista[$index][7]."`,`1`)'></div>");
               }
            }
            echo "</div>";
          }
        }
      }
      if ($_SESSION["usuario"]=="administrador") {
        if ($table=="profesor") {
          echo "<span></span>";
          echo "<span></span>";
          echo "<img class='img-historial' src='css/img/lupa.png' onclick='ShowContratacion(`".$lista[$index][8]."`,`".$lista[$index][9]."`,`".$lista[$index][10]."`,`".$lista[$index][11]."`,`".$lista[$index][12]."`,`".$lista[$index][13]."`,`".$lista[$index][14]."`)' title='Mostrar Datos' style='width:30px;height:30px;cursor:pointer;margin-top:10px;margin-left:10px;'>";
          echo "<input type='hidden' class='f-".$index."' value='".$lista[$index][8]."/".$lista[$index][9]."/".$lista[$index][10]."/".$lista[$index][11]."/".$lista[$index][12]."/".$lista[$index][13]."/".$lista[$index][14]."/".$lista[$index][15]."/".$lista[$index][16]."/".$lista[$index][17]."'>";
        }
        else if ($table=="horario_docente") {
          print_r("<img class='img-historial' src='css/img/edit.png' onclick='ActiveHorario(`".$lista[$index][0]."`,`".$lista[$index][5]."`)' title='Editar Datos' style='width:30px;height:30px;cursor:pointer;margin-top:10px;margin-left:10px;'>");
          echo "<img class='img-historial' src='css/img/borrar.png' onclick='DisplayDelete(`block`,`.delete-window`,`#horario`,`".$lista[$index][0]."`)' title='Borrar Datos' style='width:30px;height:30px;cursor:pointer;margin-top:10px;margin-left:10px;'>";
        }
        else {
          print_r("<img class='img-historial' src='css/img/edit.png' onclick='ActiveModificar(`.f-".$index."`,`$table-container`)' title='Editar Datos' style='width:30px;height:30px;cursor:pointer;margin-top:10px;margin-left:10px;'>");
          echo "<img class='img-historial' src='css/img/borrar.png' onclick='DisplayDelete(`block`,`.delete-window`,`#$table`,`".$lista[$index][0]."`)' title='Borrar Datos' style='width:30px;height:30px;cursor:pointer;margin-top:10px;margin-left:10px;'>";
        }
        $index=$index+1;
      }
      else {
        if ($table=="horario_docente") {
          print_r("<img class='img-historial' src='css/img/edit.png' onclick='ActiveHorario(`".$lista[$index][0]."`,`".$lista[$index][5]."`)' title='Editar Datos' style='width:30px;height:30px;cursor:pointer;margin-top:10px;margin-left:10px;'>");
        }
        else {
          print_r("<img class='img-historial' src='css/img/edit.png' onclick='ActiveModificar(`.f-".$index."`,`$table-container`)' title='Editar Datos' style='width:30px;height:30px;cursor:pointer;margin-top:10px;margin-left:10px;'>");
        }
        if ($table=="pensum") {
          echo "<img class='img-historial' src='css/img/borrar.png' onclick='DisplayDelete(`block`,`.delete-window`,`#materia`,`".$lista[$index][1]."`)'title='Borrar Datos' style='width:30px;height:30px;cursor:pointer;margin-top:10px;margin-left:10px;'>";
        }
        else if ($table=="oferta") {
          echo "<img class='img-historial' src='css/img/borrar.png' onclick='DisplayDelete(`block`,`.delete-window`,`#$table`,`".$lista[$index][2]."`,`".$lista[$index][1]."`)' title='Borrar Datos' style='width:30px;height:30px;cursor:pointer;margin-top:10px;margin-left:10px;'>";
        }
        else if ($table=="materia") {
          echo "<img class='img-historial' src='css/img/borrar.png' onclick='DisplayDelete(`block`,`.delete-window`,`#unidad`,`".$lista[$index][0]."`)' title='Borrar Datos' style='width:30px;height:30px;cursor:pointer;margin-top:10px;margin-left:10px;'>";
        }
        else if ($table=="oficio") {
          echo "<img class='img-historial' src='css/img/borrar.png' onclick='DisplayDelete(`block`,`.delete-window`,`#oficio_reg`,`".$lista[$index][0]."`)' title='Borrar Datos' style='width:30px;height:30px;cursor:pointer;margin-top:10px;margin-left:10px;'>";
        }
        else if ($table=="horario_docente") {
          echo "<img class='img-historial' src='css/img/borrar.png' onclick='DisplayDelete(`block`,`.delete-window`,`#horario`,`".$lista[$index][0]."`)' title='Borrar Datos' style='width:30px;height:30px;cursor:pointer;margin-top:10px;margin-left:10px;'>";
        }
        else {
          echo "<img class='img-historial' src='css/img/borrar.png' onclick='DisplayDelete(`block`,`.delete-window`,`#$table`,`".$lista[$index][0]."`)' title='Borrar Datos' style='width:30px;height:30px;cursor:pointer;margin-top:10px;margin-left:10px;'>";
        }
        if ($table=="profesor") {
          
          echo "<img class='img-historial' src='css/img/lupa.png' onclick='ShowContratacion(`".$lista[$index][8]."`,`".$lista[$index][9]."`,`".$lista[$index][10]."`,`".$lista[$index][11]."`,`".$lista[$index][12]."`,`".$lista[$index][13]."`,`".$lista[$index][14]."`)' title='Mostrar Datos' style='width:30px;height:30px;cursor:pointer;margin-top:10px;margin-left:10px;'>";
          echo "<input type='hidden' class='f-".$index."' value='".$lista[$index][8]."/".$lista[$index][9]."/".$lista[$index][10]."/".$lista[$index][11]."/".$lista[$index][12]."/".$lista[$index][13]."/".$lista[$index][14]."/".$lista[$index][15]."/".$lista[$index][16]."/".$lista[$index][17]."'>";
        }
        $index=$index+1;
        }
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