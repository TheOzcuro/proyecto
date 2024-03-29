<?php 
include_once("conectar.php");
class registry extends mybsd {
    protected $cedula;
	protected $primer_nombre;
    protected $segundo_nombre;
	protected $direccion;
	protected $telefono;
	protected $primer_apellido;
    protected $segundo_apellido;
    protected $rol;
	function setDatos($cedula, $rol, $primer_nombre, $segundo_nombre, $primer_apellido, $segundo_apellido, $direccion, $telefono, $contratacion, $categoria, $dedicacion, $telefono_fijo, $correo, $titulo, $oficio){
		$this->cedula=$cedula;
        $this->rol=$rol;
		$this->primer_nombre=strtoupper($primer_nombre);
        $this->segundo_nombre=strtoupper($segundo_nombre);
        $this->primer_apellido=strtoupper($primer_apellido);
        $this->segundo_apellido=strtoupper($segundo_apellido);
		$this->direccion=strtoupper($direccion);
		$this->telefono=$telefono;
		$this->contratacion=$contratacion;
		$this->categoria=$categoria;
		$this->dedicacion=$dedicacion;
		$this->titulo=strtoupper($titulo);
        $this->oficio=strtoupper($oficio);
        $this->telefono_fijo=$telefono_fijo;
		$this->correo=$correo;
	}
	function GetName($cedula)
	{
		$query="SELECT `primer_nombre`,`primer_apellido` FROM `profesor` WHERE `cedula`=$cedula";
		return $this->list($this->execute($query));
	}
	function GetNoticias() {
		$query="SELECT noticia.noticia, noticia.fecha_de_publicacion FROM `noticia` ORDER BY noticia.fecha_de_publicacion LIMIT 3";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
	}
	function GetAllProfesor($buscar,$campo) 
	{
		if ($buscar=="") {
			$query="SELECT profesor.cedula, profesor.primer_nombre, profesor.segundo_nombre, profesor.primer_apellido,  profesor.segundo_apellido, tcontratacion.tcontratacion, categoria.nombre, dedicacion.nombre,profesor.direccion, profesor.telefono, profesor.telefono_fijo, profesor.correo, profesor.titulo, profesor.oficio,  profesor.rol, tcontratacion.codigo, categoria.codigo, dedicacion.codigo, profesor.disponibilidad FROM `profesor`,`tcontratacion`,`dedicacion`,`categoria` WHERE profesor.contratacion=tcontratacion.codigo AND profesor.categoria=categoria.codigo AND profesor.dedicacion=dedicacion.codigo ORDER BY contratacion DESC";
			return $this->ListAll($this->execute($query), MYSQLI_NUM);
		}
		else {
			$query="SELECT profesor.cedula, profesor.primer_nombre, profesor.segundo_nombre, profesor.primer_apellido,  
			profesor.segundo_apellido, tcontratacion.tcontratacion, categoria.nombre, dedicacion.nombre,profesor.direccion, 
			profesor.telefono, profesor.telefono_fijo, profesor.correo, profesor.titulo, profesor.oficio, profesor.rol, 
			tcontratacion.codigo, categoria.codigo, dedicacion.codigo, profesor.disponibilidad  
			FROM `profesor`,`tcontratacion`,`dedicacion`,`categoria` 
			WHERE profesor.contratacion=tcontratacion.codigo 
			AND profesor.categoria=categoria.codigo 
			AND profesor.dedicacion=dedicacion.codigo 
			AND profesor.$campo LIKE '%$buscar%' ORDER BY contratacion DESC";
			return $this->ListAll($this->execute($query), MYSQLI_NUM);
		}
	}
	function GetAllHorario($buscar,$campo) 
	{
		if ($buscar=="") {
			$query="SELECT profesor.cedula, profesor.primer_nombre, profesor.segundo_nombre, profesor.primer_apellido,  profesor.segundo_apellido, tcontratacion.tcontratacion, categoria.nombre, dedicacion.nombre,profesor.direccion, profesor.telefono, profesor.telefono_fijo, profesor.correo, profesor.titulo, profesor.oficio,  profesor.rol, tcontratacion.codigo, categoria.codigo, dedicacion.codigo, profesor.disponibilidad FROM `profesor`,`tcontratacion`,`dedicacion`,`categoria` WHERE profesor.contratacion=tcontratacion.codigo AND profesor.categoria=categoria.codigo AND profesor.dedicacion=dedicacion.codigo ORDER BY contratacion DESC";
			return $this->ListAll($this->execute($query), MYSQLI_NUM);
		}
		else {
			$query="SELECT profesor.cedula, profesor.primer_nombre, profesor.segundo_nombre, profesor.primer_apellido,  
			profesor.segundo_apellido, tcontratacion.tcontratacion, categoria.nombre, dedicacion.nombre,profesor.direccion, 
			profesor.telefono, profesor.telefono_fijo, profesor.correo, profesor.titulo, profesor.oficio, profesor.rol, 
			tcontratacion.codigo, categoria.codigo, dedicacion.codigo, profesor.disponibilidad  
			FROM `profesor`,`tcontratacion`,`dedicacion`,`categoria` 
			WHERE profesor.contratacion=tcontratacion.codigo 
			AND profesor.categoria=categoria.codigo 
			AND profesor.dedicacion=dedicacion.codigo 
			AND profesor.$campo='$buscar' ORDER BY contratacion DESC";
			return $this->ListAll($this->execute($query), MYSQLI_NUM);
		}
	}
	function GetAll($tabla)
	{		
			$query="SELECT * FROM $tabla";
			return $this->ListAll($this->execute($query), MYSQLI_NUM);
		
	}
	function GetCarrerasPensum() {
		$query="SELECT DISTINCT carrera.codigo, carrera.nombre FROM carrera, materia, pensum WHERE carrera.codigo IN (SELECT pensum.pnf FROM pensum WHERE materia.codigo=pensum.unidad_curricular) ORDER BY carrera.codigo";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
	}
	function GetCarrerasNOTPensum() {
		$query="SELECT carrera.codigo, carrera.nombre FROM carrera
		WHERE carrera.codigo NOT IN (SELECT pensum.pnf FROM pensum, materia WHERE materia.codigo=pensum.unidad_curricular) ORDER BY carrera.codigo";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
	}
	function GetCarrerasMulti() {
		$query="SELECT DISTINCT carrera.codigo, carrera.nombre FROM carrera, pensum, materia
		WHERE carrera.codigo=pensum.pnf AND materia.codigo=pensum.unidad_curricular AND materia.tipo=1";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
	}

	function GetMateriasMulti($busca,$columna) {
		if ($busca=="") {
			$query="SELECT * FROM `materia` WHERE `tipo`=1";
			return $this->ListAll($this->execute($query), MYSQLI_NUM);
		}
		else if ($columna=="nombre" || $columna=="NOMBRE") {
			$query="SELECT * FROM `materia` WHERE `tipo`=1 AND `$columna` LIKE '%$busca%'";
			return $this->ListAll($this->execute($query), MYSQLI_NUM);
		}
		else {
			$query="SELECT * FROM `materia` WHERE `tipo`=1 AND `$columna`='$busca'";
			return $this->ListAll($this->execute($query), MYSQLI_NUM);
		}
		
	}
	function GetHistorialHorario($busca,$columna) {
		if ($busca=="") {
			$query="SELECT DISTINCT profesor.cedula, profesor.primer_nombre, profesor.segundo_nombre, profesor.primer_apellido, profesor.segundo_apellido, horario_docente.periodo_academico FROM horario_docente, profesor WHERE profesor.cedula IN (SELECT horario_docente.cedula_docente FROM horario_docente) AND profesor.cedula=horario_docente.cedula_docente";
			return $this->ListAll($this->execute($query), MYSQLI_NUM);
		}
		else {
			$query="SELECT DISTINCT profesor.cedula, profesor.primer_nombre, profesor.segundo_nombre, profesor.primer_apellido, profesor.segundo_apellido, horario_docente.periodo_academico FROM horario_docente, profesor WHERE profesor.cedula IN (SELECT horario_docente.cedula_docente FROM horario_docente) AND profesor.cedula=horario_docente.cedula_docente AND `$columna` LIKE '%$busca%'";
			return $this->ListAll($this->execute($query), MYSQLI_NUM);
		}
		
	}
	function GetAulasHorario($busca,$dia,$lapso) {
			$query="SELECT DISTINCT aula.codigo, aula.nombre FROM `aula` WHERE aula.codigo NOT IN (SELECT horario_docente.codigo_aula FROM horario_docente) OR aula.codigo NOT IN (SELECT horario_docente.codigo_aula FROM horario_docente WHERE horario_docente.bloque='$busca' AND horario_docente.dia='$dia' AND horario_docente.periodo_academico='$lapso')";
			return $this->ListAll($this->execute($query), MYSQLI_NUM);
	}
	function GetSeccionHorario($busca,$dia,$lapso) {
		$query="SELECT DISTINCT seccion.codigo FROM `seccion` WHERE seccion.codigo NOT IN (SELECT horario_docente.seccion FROM horario_docente) OR seccion.codigo NOT IN (SELECT horario_docente.seccion FROM horario_docente WHERE horario_docente.bloque='$busca' AND horario_docente.dia='$dia' AND horario_docente.periodo_academico='$lapso')";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
}
	function GetMateriasPensum() {
		$query="SELECT DISTINCT materia.codigo, materia.nombre, materia.tipo, materia.horas_semanales, materia.unidad_credito, pensum.pnf FROM materia, pensum WHERE materia.codigo IN (SELECT pensum.unidad_curricular FROM pensum) AND materia.codigo=pensum.unidad_curricular";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
	}
	
	function GetMateriasPensumWithPNF($busca) {
		$busca=$this->FindQuery("carrera","nombre",$busca);
		$codigo=$busca[0];
		$query="SELECT DISTINCT materia.codigo, materia.nombre FROM materia, pensum WHERE materia.codigo IN (SELECT pensum.unidad_curricular FROM pensum) AND materia.codigo=pensum.unidad_curricular AND pensum.pnf='$codigo'";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
	}
	function GetCarrerasOferta($busca) {
		$query="SELECT carrera.codigo, carrera.nombre FROM carrera
		WHERE carrera.codigo IN (SELECT oferta.pnf FROM oferta WHERE oferta.periodo='$busca')";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
	}
	function GetCarrerasNotInOferta($lapso) {
		$query="SELECT DISTINCT carrera.codigo, carrera.nombre FROM carrera WHERE carrera.codigo IN (SELECT pensum.pnf FROM pensum) AND carrera.codigo NOT IN (SELECT oferta.pnf FROM oferta WHERE oferta.periodo='$lapso')";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
	}
	
	function GetLapsoOferta() {
		$query="SELECT lapso_academico.periodo FROM lapso_academico WHERE estatus='1'";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
	}
	function GetLapsoHorario() {
		$query="SELECT lapso_academico.periodo FROM lapso_academico WHERE estatus='1' AND lapso_academico.periodo IN (SELECT oferta.periodo FROM oferta)";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
	}
	function GetOficio() {
		$query="SELECT * FROM `oficio`";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
	}
	function GetUserInDisponibilidad() {
		$query="SELECT profesor.cedula, profesor.primer_nombre, profesor.primer_apellido, dedicacion.nombre FROM profesor, dedicacion WHERE profesor.cedula IN (SELECT bloque_disponibilidad.cedula FROM bloque_disponibilidad) AND dedicacion.codigo=profesor.dedicacion";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
	}
	function GetUserNotDisponibilidad() {
		$query="SELECT profesor.cedula, profesor.primer_nombre, profesor.primer_apellido, dedicacion.nombre FROM profesor, dedicacion WHERE profesor.cedula NOT IN (SELECT bloque_disponibilidad.cedula FROM bloque_disponibilidad) AND dedicacion.codigo=profesor.dedicacion";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
	}
	function GetUserInHorario() {
		$query="SELECT profesor.cedula, profesor.primer_nombre, profesor.primer_apellido FROM profesor WHERE profesor.cedula IN (SELECT bloque_disponibilidad.cedula FROM bloque_disponibilidad)";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
	}
	function GetHorario($busca,$lapso,$tipo) {
		$query="SELECT horario_docente.cedula_docente, aula.nombre, horario_docente.periodo_academico, horario_docente.bloque, materia.codigo, materia.nombre, carrera.codigo, carrera.nombre, horario_docente.dia, horario_docente.seccion FROM horario_docente, carrera, materia, aula WHERE carrera.codigo=horario_docente.carrera AND materia.codigo=horario_docente.unidad_curricular AND horario_docente.codigo_aula=aula.codigo AND horario_docente.cedula_docente='$busca' AND horario_docente.periodo_academico='$lapso' AND horario_docente.tipo='$tipo' ORDER BY horario_docente.codigo";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
	}
	function GetHorarioPDF($busca,$lapso) {
		$query="SELECT horario_docente.cedula_docente, aula.nombre, horario_docente.periodo_academico, horario_docente.bloque, materia.codigo, materia.nombre, carrera.codigo, carrera.nombre, horario_docente.dia, horario_docente.seccion FROM horario_docente, carrera, materia, aula WHERE carrera.codigo=horario_docente.carrera AND materia.codigo=horario_docente.unidad_curricular AND horario_docente.codigo_aula=aula.codigo AND horario_docente.cedula_docente='$busca' AND horario_docente.periodo_academico='$lapso' ORDER BY horario_docente.tipo, horario_docente.codigo";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
	}
	function GetDisponibilidad($busca) {
		$columna="";
		$dia="";
		$n_array=[];
		$f_array=[];
		$i=0;
		if ($busca=="") {
			$query="SELECT bloque_disponibilidad.cedula, bloque_disponibilidad.bloque, bloque_disponibilidad.dia FROM `bloque_disponibilidad` ORDER BY bloque_disponibilidad.cedula DESC, bloque_disponibilidad.codigo ASC, bloque_disponibilidad.dia ASC, bloque_disponibilidad.bloque ASC";
			return $this->ListAll($this->execute($query), MYSQLI_NUM);
		}
		else {
			$query="SELECT bloque_disponibilidad.cedula, bloque_disponibilidad.bloque, bloque_disponibilidad.dia FROM `bloque_disponibilidad` WHERE bloque_disponibilidad.cedula='$busca' ORDER BY bloque_disponibilidad.cedula DESC, bloque_disponibilidad.codigo ASC, bloque_disponibilidad.dia ASC, bloque_disponibilidad.bloque ASC";
			return $this->ListAll($this->execute($query), MYSQLI_NUM);
		}
		
		/*
		foreach ($lista as $value) {
      
			if ($columna!=$value[0]) {
			  $columna=$value[0];
			  if (count($n_array)>0) {
				array_push($f_array,$n_array);
				$n_array=[];
			  }
			  array_push($n_array,$value[0]);
			}
			if ($dia!=$value[2] || $columna!=$value[0]) {
				array_push($n_array,$value[2]);
				$dia=$value[2];
			}
			if ($columna==$value[0]){
			  array_push($n_array,$value[1]);
			  if (count($lista)-1==$i) {
				array_push($f_array,$n_array);
			  }
			 
			}
		  $i=$i+1;
		  }
	   return $f_array;
	   */
	}
	function GetAllPensumPDF() {
		$query="SELECT carrera.codigo, carrera.nombre, materia.codigo, materia.nombre, materia.tipo, materia.horas_semanales, materia.unidad_credito FROM ((carrera INNER JOIN pensum ON pensum.pnf = carrera.codigo) INNER JOIN materia ON pensum.unidad_curricular = materia.codigo) ORDER BY pensum.pnf DESC";
		return $lista=$this->ListAll($this->execute($query), MYSQLI_NUM);
	}
	function GetAllPensum($busca)
	{
		$columna="";
		$n_array=[];
		$f_array=[];
		$i=0;
		if ($busca=="") {
			$query="SELECT pensum.codigo, carrera.codigo, carrera.nombre, materia.codigo, materia.nombre FROM ((carrera INNER JOIN pensum ON pensum.pnf = carrera.codigo) INNER JOIN materia ON pensum.unidad_curricular = materia.codigo) ORDER BY pensum.pnf DESC";
			$lista=$this->ListAll($this->execute($query), MYSQLI_NUM);
		}
		else {
			$query="SELECT DISTINCT pensum.codigo, carrera.codigo, carrera.nombre, materia.codigo, materia.nombre FROM ((carrera INNER JOIN pensum ON pensum.pnf = carrera.codigo && carrera.nombre LIKE '%$busca%') INNER JOIN materia ON pensum.unidad_curricular = materia.codigo) ORDER BY pensum.pnf DESC";
			$lista=$this->ListAll($this->execute($query), MYSQLI_NUM);
			}
		
		foreach ($lista as $value) {
      
				if ($columna!=$value[2]) {
				  $columna=$value[2];
				  if (count($n_array)>0) {
					array_push($f_array,$n_array);
					$n_array=[];
				  }
				  array_push($n_array,$value[0],$value[1],$value[2]);
				}
				if ($columna==$value[2]){
				  array_push($n_array,$value[3]);
				  array_push($n_array,$value[4]);
				  if (count($lista)-1==$i) {
					array_push($f_array,$n_array);
				  }
				 
				}
			  $i=$i+1;
			  }
		   return $f_array;
		
	}
	function GetAllOferta($dato,$campo)
	{
		if ($dato=="") {
			$query="SELECT oferta.periodo, carrera.codigo, carrera.nombre FROM oferta, carrera WHERE oferta.pnf=carrera.codigo";
			return $this->ListAll($this->execute($query), MYSQLI_NUM);
		}
		else {
			if ($campo=="pnf" || $campo=="PNF") {
				$query="SELECT oferta.periodo, carrera.codigo, carrera.nombre FROM oferta, carrera WHERE oferta.pnf=carrera.codigo AND carrera.nombre LIKE '%$dato%'";
				return $this->ListAll($this->execute($query), MYSQLI_NUM);
			}
			else if($campo=="CODIGO_PNF" || $campo=="codigo_pnf"){
				$query="SELECT oferta.periodo, carrera.codigo, carrera.nombre FROM oferta, carrera WHERE oferta.pnf=carrera.codigo AND oferta.pnf LIKE '%$dato%'";
				return $this->ListAll($this->execute($query), MYSQLI_NUM);
			}
			
			else {
				$query="SELECT oferta.periodo, carrera.codigo, carrera.nombre FROM oferta, carrera WHERE oferta.pnf=carrera.codigo AND `$campo` LIKE '%$dato%'";
				return $this->ListAll($this->execute($query), MYSQLI_NUM);
			}
			
		}
		
	}
function GetFindQuery($tabla,$dato,$campo)
	{
		$query="SELECT * FROM `$tabla` WHERE `$campo` LIKE '%$dato%'";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
		
	}
	function GetFindHorario($cedula,$bloque,$dia)
	{
		$query="SELECT * FROM `horario_docente`, `bloque_disponibilidad` WHERE horario_docente.cedula_docente='$cedula' AND bloque_disponibilidad.cedula='$cedula' AND horario_docente.bloque='$bloque' AND bloque_disponibilidad.bloque='$bloque' AND horario_docente.dia='$dia' AND bloque_disponibilidad.dia='$dia'";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
	}
	function registrarProfesor(){
		$query="INSERT INTO `profesor`(`cedula`, `rol`, `primer_nombre`, 
		`segundo_nombre`, `primer_apellido`, `segundo_apellido`, `direccion`, `telefono`, `telefono_fijo`, `contratacion`, `categoria`, `dedicacion`, `correo`, `titulo`, `oficio`, `disponibilidad`)
		VALUES ('".$this->cedula."','".$this->rol."','".$this->primer_nombre."','".$this->segundo_nombre."','".$this->primer_apellido."','".$this->segundo_apellido."','".$this->direccion."','".$this->telefono."','".$this->telefono_fijo."','".$this->contratacion."','".$this->categoria."','".$this->dedicacion."','".$this->correo."','".$this->titulo."','".$this->oficio."', '0')";
		return $this->execute($query);
	}
	function registrarOficio($oficio){
		$oficio=strtoupper($oficio);
		$query="INSERT INTO `oficio`(`nombre`) VALUES ('$oficio')";
		return $this->execute($query);
	}
	function registrarSeccion($oficio){
		$oficio=strtoupper($oficio);
		$query="INSERT INTO `seccion`(`codigo`) VALUES ('$oficio')";
		return $this->execute($query);
	}
	function registrarHorario($cedula,$aula,$lapso,$bloque,$seccion,$unidad,$carrera,$dia,$tipo){
		$codigo_a=$this->FindQuery('aula','nombre',$aula);
		$array_m=explode("—",$unidad);
		$array_c=explode("—",$carrera);
		$aula=$codigo_a[0];
		$unidad=$array_m[0];
		$carrera=$array_c[0];
		$query="INSERT INTO `horario_docente` (`cedula_docente`,`codigo_aula`,`periodo_academico`,`bloque`, `unidad_curricular`,`carrera`,`dia`,`seccion`,`tipo`) VALUES ('$cedula','$aula','$lapso','$bloque','$unidad','$carrera','$dia','$seccion','$tipo')";
		return $this->execute($query);
	}
	function registrarAdministrador($contrasena){
		$query="INSERT INTO `administrador`(`cedula`,`contrasena`)
		VALUES ('".$this->cedula."','$contrasena')";
		return $this->execute($query);
	}
	function registrarProfesorLogin(){
		$query="INSERT INTO `profesor_pass`(`cedula`,`password`)
		VALUES ('".$this->cedula."','')";
		return $this->execute($query);
	}
	function createPassword($cedula, $contrasena){
		$query="UPDATE `administrador` SET `contrasena`='$contrasena' WHERE `cedula`='$cedula' ";
		return $this->execute($query);
	}
	function createPasswordProfesor($cedula, $contrasena){
		$query="UPDATE `profesor_pass` SET `password`='$contrasena' WHERE `cedula`='$cedula' ";
		return $this->execute($query);
	}
	function registrarMateria($codigo, $nombre, $tipo,$horas,$creditos){
		$nombre=strtoupper($nombre);
		$codigo=strtoupper($codigo);
			$query="INSERT INTO `materia`(`codigo`, `nombre`, `tipo`,`horas_semanales`,`unidad_credito`)
		VALUES ('".$codigo."','".$nombre."','".$tipo."','".$horas."','".$creditos."')";
			return $this->execute($query);
	}
	function registrarAula($codigo, $nombre){
		$nombre=strtoupper($nombre);
		$query="SELECT * FROM `aula` WHERE `nombre`='$nombre'";
		
		$val=$this->CheckResult($this->execute($query));
		if ($val==1) {
			return 3;
		}
		else {
			$query="INSERT INTO `aula`(`codigo`, `nombre`)
			VALUES ('".$codigo."','".strtoupper($nombre)."')";
			return $this->execute($query);
		}
	}
	function registrarDisponibilidad($cedula, $bloque, $dia, $disponibilidad){
		$query="INSERT INTO `bloque_disponibilidad`(`cedula`, `bloque`,`dia`,`disponibilidad`)
		VALUES ('$cedula','$bloque','$dia','$disponibilidad')";
		return $this->execute($query);
	}
	function registrarCarrera($codigo, $nombre){
		$nombre=strtoupper($nombre);
		$query="SELECT * FROM `carrera` WHERE `nombre`='$nombre'";
		
		$val=$this->CheckResult($this->execute($query));
		if ($val==1) {
			return 3;
		}
		else {
			$query="INSERT INTO `carrera`(`codigo`, `nombre`)
			VALUES ('".strtoupper($codigo)."','".strtoupper($nombre)."')";
			return $this->execute($query);
		}
		
	}
	function registrarLapso($trayecto, $fecha_inicio, $fecha_final,$estatus){
			$trayecto=strtoupper($trayecto);
			$query="INSERT INTO `lapso_academico`(`periodo`, `fecha_inicio`, `fecha_final`, `estatus`)
			VALUES ('".strtoupper($trayecto)."','$fecha_inicio','$fecha_final','$estatus')";
			return $this->execute($query);
		
	}
	function registrarPensum($carrera, $unidad){
		/*
		$carrera=strtoupper($carrera);
		$codigo=$this->FindQuery("carrera","nombre",$carrera);
		$codigo1=$codigo[0];
		*/
		$carrera=strtoupper($carrera);
		$unidad=strtoupper($unidad);
		$query="INSERT INTO `pensum`(`pnf`, `unidad_curricular`)
			VALUES ('$carrera','$unidad')";
			
		return $this->execute($query);
		
	}
	function registrarOferta($trayecto, $pnf){
		$trayecto=strtoupper($trayecto);
		$pnf=strtoupper($pnf);
		$carrera=$this->FindQuery("carrera","nombre",$pnf);
		$pnf=$carrera[0];
		if ($carrera!=2) {
			$query="INSERT INTO `oferta`(`periodo`, `pnf`)
			VALUES ('$trayecto','$pnf')";
			return $this->execute($query);
		}
		else {
			return 3;
		}
		
		
	}
	function registraNoticia($codigo, $noticia, $fecha_inicio, $fecha_final){
			$query="INSERT INTO `noticia`(`codigo`, `noticia`, `fecha_de_publicacion`, `fecha_de_expiracion`) VALUES ('$codigo','$noticia','$fecha_inicio','$fecha_final')";
			return $this->execute($query);
	}
    function ValidateLogin($cedula, $pass){
		$query="SELECT `cedula`,`password` FROM `profesor_pass` WHERE `cedula`=$cedula";
		$valido=$this->list($this->execute($query));
		if ($valido[0]==$cedula && $valido[1]==$pass) {
			return true;
			}
		if ($valido[0]==$cedula && $valido[1]=="") {
			return 2;
			}
		if ($valido[0]==$cedula && $pass=="recovery") {
			return 2;
		}
		if ($valido[0]==$cedula && $valido[1]!=$pass) {
			return 3;
		}
		else {
			return false;
			}		
	}
	function ValidateAdministrador($cedula, $contraseña){
		$query="SELECT `cedula`,`contrasena` FROM `administrador` WHERE `cedula`=$cedula";
		$valido=$this->list($this->execute($query));
		if ($valido[0]==$cedula && $valido[1]==$contraseña) {
			return true;
			}
		if ($valido[0]==$cedula && $valido[1]=="") {
			return 2;
			}
		if ($valido[0]==$cedula && $contraseña=="recovery") {
			return 2;
		}
		if ($valido[0]==$cedula && $valido[1]!=$contraseña) {
			return 3;
		}
		else {
			return false;
			}	
	}
	function FindQuery($tabla,$campo,$dato){
		$dato=strtoupper($dato);
		$query="SELECT * FROM `$tabla` WHERE `$campo`='$dato'";
		$list=$this->list($this->execute($query));
		if ($list=="") {
			return 2;
		}
		else {
			return $list;
		}
	}
	function FindQueryOferta($pnf,$lapso){
		$pnf=$this->FindQuery('carrera','nombre',$pnf);
		$codigo=$pnf[0];
		$query="SELECT oferta.codigo, oferta.lapso_academico, carrera.nombre, oferta.horas_semanales, oferta.creditos FROM `oferta`,`carrera` WHERE oferta.pnf='$codigo' AND oferta.lapso_academico='$lapso' AND oferta.pnf=carrera.codigo";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
	}
	function UpdateTableProfesor($cedula) {
		$query="UPDATE `profesor` SET `cedula`='$this->cedula', `rol`='$this->rol', `primer_nombre`='$this->primer_nombre', `segundo_nombre`='$this->segundo_nombre', `primer_apellido`='$this->primer_apellido', `segundo_apellido`='$this->segundo_apellido', `direccion`='$this->direccion', `telefono`='$this->telefono', `telefono_fijo`='$this->telefono_fijo', `correo`='$this->correo', `titulo`='$this->titulo', `oficio`='$this->oficio',`contratacion`='$this->contratacion', `categoria`='$this->categoria', `dedicacion`='$this->dedicacion' WHERE `cedula`=$cedula";
		return $this->execute($query);
	}
	function UpdateTableDisponibilidad($cedula, $origin_cedula) {
		$query="UPDATE `bloque_disponibilidad` SET `cedula`=$cedula WHERE `cedula`=$origin_cedula";
		return $this->execute($query);
	}
	function UpdateCampoHorario($campo,$dato,$origin_dato) {
		$query="UPDATE `horario_docente` SET `$campo`='$dato' WHERE `$campo`='$origin_dato'";
		return $this->execute($query);
	}
	function UpdateDisponibilidad($cedula, $tipo)
	{
		$query="UPDATE `profesor` SET `disponibilidad`='$tipo' WHERE `cedula`='$cedula' ";
		return $this->execute($query);
	}
	function UpdateTableAdmin($cedula, $origin_cedula)
	{
		$query="UPDATE `administrador` SET `cedula`='$cedula' WHERE `cedula`='$origin_cedula' ";
		return $this->execute($query);
	}
	function UpdateTableProfesorPass($cedula, $origin_cedula)
	{
		$query="UPDATE `profesor_pass` SET `cedula`='$cedula' WHERE `cedula`='$origin_cedula' ";
		return $this->execute($query);
	}
	function UpdateTableMateria($codigo,$nombre_origin,$tipo,$horas,$credito,$original_codigo)
	{
		$nombre=strtoupper($nombre_origin);
		$query="UPDATE `materia` SET `codigo`='$codigo', `nombre`='$nombre', `tipo`='$tipo', `horas_semanales`='$horas', `unidad_credito`='$credito' WHERE `codigo`='$original_codigo'";
			return $this->execute($query);
		
	}
	function UpdateTableOficio($nombre,$nombre_origin)
	{
		$query="UPDATE `oficio` SET `nombre`='$nombre' WHERE `nombre`='$nombre_origin'";
		return $this->execute($query);
	}
	function UpdateTableSeccion($nombre,$nombre_origin)
	{
		$query="UPDATE `seccion` SET `codigo`='$nombre' WHERE `codigo`='$nombre_origin'";
		return $this->execute($query);
	}
	function UpdateTableHorarioOferta($nombre,$lapso,$nombre_origin)
	{
		$query="UPDATE `horario_docente` SET `carrera`='$nombre' WHERE `lapso_academico`='$lapso' AND `carrera`='$nombre_origin'";
		return $this->execute($query);
	}
	function UpdateTableProfesorInOficio($nombre,$nombre_origin)
	{
		$query="UPDATE `profesor` SET `oficio`='$nombre' WHERE `oficio`='$nombre_origin'";
		return $this->execute($query);
	}
	function UpdateTableHorarioInSeccion($nombre,$nombre_origin)
	{
		$query="UPDATE `horario_docente` SET `seccion`='$nombre' WHERE `seccion`='$nombre_origin'";
		return $this->execute($query);
	}
	function UpdateTableAula($codigo,$nombre,$original_codigo)
	{
		$nombre=strtoupper($nombre);
			$query="UPDATE `aula` SET 
					`codigo`='$codigo', `nombre`='$nombre' 
					WHERE `codigo`='$original_codigo'";
			return $this->execute($query);
		
	}
	function UpdateTableOferta($trayecto,$pnf,$horas,$unidad,$original_codigo, $original_trayecto)
	{
			$trayecto=strtoupper($trayecto);
			$pnf=strtoupper($pnf);
			$pnf_origin=strtoupper($original_codigo);
			$carrera=$this->FindQuery("carrera","nombre",$pnf);
			$carrera_origin=$this->FindQuery("carrera","nombre",$pnf_origin);
			$pnf=$carrera[0];
			$original_codigo=$carrera_origin[0];
			if ($carrera!=2 && $carrera_origin!=2) {
				$query="UPDATE `oferta` SET `lapso_academico`='$trayecto', `pnf`='$pnf', `horas_semanales`='$horas', `creditos`='$unidad' WHERE `pnf`='$original_codigo' AND `lapso_academico`='$original_trayecto'";
				return $this->execute($query);
			}
			else {
				return 3;
			}
			
			
	
	}
	function UpdateTableCarrera($codigo,$nombre,$original_codigo)
	{
			$nombre=strtoupper($nombre);
			$codigo=strtoupper($codigo);
			$query="UPDATE `carrera` SET `codigo`='$codigo', `nombre`='$nombre' WHERE `codigo`='$original_codigo'";
			return $this->execute($query);
	
	}
	function UpdateTableNoticia($codigo,$noticia,$fecha_publi,$fecha_exp,$original_codigo)
	{
			$nombre=strtoupper($nombre);
			$query="UPDATE `noticia` SET `codigo`='$codigo', `noticia`='$noticia', `fecha_de_publicacion`='$fecha_publi', `fecha_de_expiracion`='$fecha_exp' WHERE `codigo`='$original_codigo'";
			return $this->execute($query);
	
	}
	function UpdateTableCarreraPensum($codigo_origin,$codigo_nuevo)
	{
		$codigo_nuevo=strtoupper($codigo_nuevo);
		$codigo_origin=strtoupper($codigo_origin);
		$query="UPDATE `pensum` SET `pnf`='$codigo_nuevo' WHERE `pnf`='$codigo_origin'";
		return $this->execute($query);
	}
	function UpdateTableMateriasPensum($codigo_origin,$codigo_nuevo)
	{
		$query="UPDATE `pensum` SET `unidad_curricular`='$codigo_nuevo' WHERE `unidad_curricular`='$codigo_origin'";
		return $this->execute($query);
	}
	function UpdateTableLapsoOferta($codigo_origin,$codigo_nuevo)
	{
		$codigo_origin=strtoupper($codigo_origin);
		$codigo_nuevo=strtoupper($codigo_nuevo);
		$query="UPDATE `oferta` SET `periodo`='$codigo_nuevo' WHERE `periodo`='$codigo_origin'";
		return $this->execute($query);
	}
	function UpdateTableCarrerasOferta($codigo_origin,$codigo_nuevo)
	{
		$codigo_nuevo=strtoupper($codigo_nuevo);
		$codigo_origin=strtoupper($codigo_origin);
		$query="UPDATE `oferta` SET `pnf`='$codigo_nuevo' WHERE `pnf`='$codigo_origin'";
		return $this->execute($query);
	}
	function UpdateTableLapso($trayecto,$fecha_inicio,$fecha_final,$estatus, $trayecto_origin)
	{
		$trayecto=strtoupper($trayecto);
			$query="UPDATE `lapso_academico` SET `periodo`='$trayecto',`fecha_inicio`='$fecha_inicio',`fecha_final`='$fecha_final',`estatus`='$estatus' WHERE `periodo`='$trayecto_origin'";
			return $this->execute($query);
		
	}
	function ValidateOferta($carrera,$lapso)
	{
		$pnf=$this->FindQuery('carrera','nombre',$carrera);
		$codigo=$pnf[0];
		$query="SELECT * FROM `oferta` WHERE `pnf`='$codigo' AND `periodo`='$lapso'";
		return $this->ListAll($this->execute($query), MYSQLI_NUM);
		
	}
	function DeleteOfertaHorario($carrera,$lapso)
	{
		$pnf=$this->FindQuery('carrera','nombre',$carrera);
		$lapso_academico=$this->FindQuery('lapso_academico','periodo',$lapso);
		$codigo=$pnf[0];
		$query="DELETE FROM `horario_docente` WHERE `carrera`='$codigo' AND `lapso_academico`='$lapso'";
		return $this->execute($query);
		
	}
	function DeleteTable($tabla, $campo, $dato) {
		$query="DELETE FROM `$tabla` WHERE `$campo`='$dato'";
		return $this->execute($query);
	}
	function DeleteTableMateriaMulti($tabla, $campo, $dato) {
		$query="DELETE FROM `$tabla` WHERE `$campo`='$dato' AND `tipo`<>'1'";
		return $this->execute($query);
	}
	function DeleteTableHorario($cedula, $bloque, $dia) {
		$query="DELETE FROM `horario_docente` WHERE `cedula_docente`='$cedula' AND `bloque`='$bloque' AND `dia`='$dia'";
		return $this->execute($query);
	}
	function DeleteTableTwoWhere($tabla, $campo, $dato, $campo2, $dato2) {
		$query="DELETE FROM `$tabla` WHERE `$campo`='$dato' AND `$campo2`='$dato2'";
		return $this->execute($query);
	}
	function DeleteNoticia() {
		$date = date('y-m-d');
		$query="DELETE FROM `noticia` WHERE `fecha_de_expiracion`='$date'";
		return $this->execute($query);
	}
	function TakeColumnNames($tabla) {
		$query="SELECT `COLUMN_NAME` 
		FROM `INFORMATION_SCHEMA`.`COLUMNS` 
		WHERE `TABLE_NAME`='$tabla' ORDER BY ORDINAL_POSITION";
		return $this->ListAll($this->execute($query), MYSQLI_ASSOC);
	}
}
?>