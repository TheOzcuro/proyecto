//----------------------------------------EJECUTAR FUNCIONES------------------------------------
function OnLoad(active){
    //Tomo la url de la pagina
    const url=window.location.href;
    //Creo un Regex donde estaran los divs de los formularios cada uno con su respectivo nombre
    var x=/#.*\w+/g;
    //Busco la coicidencias dentro del regex previamente creado
    var container=url.match(x)
    if (container==null) {
        container="";
    }
    else {
      container=container[0].substring(1);
      array=container.split("-")
      
    }
    //Guardo el tipo de display que utiliza el formulario ya sea flex o grid
    //var display=url.slice(-4)
    //Creo el nombre del div correspodiente
    //Muestro el div al usuario
    
    container_url=array[0]+"-"+array[1];
    if (container_url=="disponibilidad-container") {
        setTimeout(() => {
            if (localStorage.getItem('disponibilidad')!=="" && localStorage.getItem('disponibilidad')!==null && localStorage.getItem('disponibilidad')!==undefined) {
                    document.getElementById('cedula_dis').value=localStorage.getItem('disponibilidad');
                    document.getElementById('nombre_dis').value=localStorage.getItem('disponibilidad_n');
                    document.getElementById('contratacion_dis').value=localStorage.getItem('disponibilidad_c');
                    CreateDisponibilidad(localStorage.getItem('disponibilidad'));
                    localStorage.setItem('disponibilidad',"");
                    localStorage.setItem('disponibilidad_n',"");
                    localStorage.setItem('disponibilidad_c',"");
                    LabelInput()
                }
            }, 600);
    }
    if (array[1]=="container" && active!="active" && container_url!="disponibilidad-container" && activehorario!=1) {
        document.getElementById('history_back').style.display="inline";
        setTimeout(() => {
        if (localStorage.getItem('carrera')!=="" && localStorage.getItem('carrera')!==null && localStorage.getItem('carrera')!==undefined && container_url!="") {
                if (container_url=="pensum-container") {
                    carrera=document.getElementById("carreras");
                    carrera.value=localStorage.getItem('carrera');
                    CreateMaterias(localStorage.getItem('carrera'));
                    localStorage.setItem('carrera',"");
                }
                else if(container_url=="materia-container") {
                    carrera=document.getElementById("carreras_unidad");
                    carrera.value=localStorage.getItem('carrera');
                    CreateMaterias(localStorage.getItem('carrera'));
                    localStorage.setItem('carrera',"");
                }
                window.localStorage.removeItem('carrera');
                LabelInput()
            }
        }, 600);
        
    }
    else if (array[1]=="historial" && container_url!='disponibilidad-container' && container_url!='horario-container' && activehorario!=1 && container_url!='profesor-historial' && active!="active") {
        console.log(activehorario);
        document.getElementById('register_back').style.display="inline";
    }
    if (container!="" && active!="active") {
        console.log(container_url);
        AppearsAndDissapear(container_url, "grid")
    }
}


function BackOption(div){
    OnLoad("active")
    array=container_url.split("-")
    container=array[0]
    if (div.id=="history_back") {
        document.getElementById(div.id).style.display="none";
        document.getElementById('register_back').style.display="inline";
        DissapearVarious('.container','none');
        window.location.href="coordinador.php#"+container+"-historial-grid"
        refresh(1,container)
        
    }
    else {
        document.getElementById(div.id).style.display="none";
        document.getElementById('history_back').style.display="inline";
        window.location.href="coordinador.php#"+container+"-container-grid"
        AppearsAndDissapear(container+"-container","grid")
    }
}
document.getElementById("editarHorario").addEventListener("click", function(){
        if (div_edit!="") {
            Close()
        }
        DissapearVarious('.container','none');
        refresh(1,'horario_docente')
        DissapearVarious('.back-option','none');
        })

document.getElementById("disponibilidadProfesor").addEventListener("click", function(){
    if (div_edit!="") {
           Close()
    }
    DissapearVarious('.back-option','none');
    AppearsAndDissapear("disponibilidad-container","grid")})

document.getElementById("registrarNoticia").addEventListener("click", function(){
    if (div_edit!="") {
            Close()
        }
    DissapearVarious('.back-option','none');
    document.getElementById('history_back').style.display='inline';
    AppearsAndDissapear("noticia-container","grid")})

document.getElementById("registrarHorario").addEventListener("click", function(){
        if (div_edit!="") {
            Close()
        }
        DissapearVarious('.back-option','none');
        document.getElementById('history_back').style.display='inline';
        if (activehorario==1) {
            AppearsAndDissapear('horario_agrupar','block');
        }
        else {
            AppearsAndDissapear("horario_docente-container","grid");
        }
        })
document.getElementById("crearLapso").addEventListener("click", function(){
    if (div_edit!="") {
           Close()
    }
    DissapearVarious('.back-option','none');
    document.getElementById('history_back').style.display='inline';
    AppearsAndDissapear("lapso_academico-container","grid")})
 document.getElementById("crearOferta").addEventListener("click", function(){
    if (div_edit!="") {
            Close()
    }
    DissapearVarious('.back-option','none');
    document.getElementById('history_back').style.display='inline';
    AppearsAndDissapear("oferta-container","grid")})
document.getElementById("historialProfesor").addEventListener("click", function(){
if (div_edit!="") {
     Close()
    }
    DissapearVarious('.container','none');
    refresh(1,'profesor');
    DissapearVarious('.back-option','none');
    
})
document.getElementById("editarNoticia").addEventListener("click", function(){
    if (div_edit!="") {
         Close()
        }
        DissapearVarious('.container','none');
        refresh(1,'noticia')
        DissapearVarious('.back-option','none');
        document.getElementById('register_back').style.display='inline';
        
    })
document.getElementById("correo").addEventListener("blur", function(){
    var valor=document.getElementById('correo').value
    if (email.test(valor)==false) {
        document.getElementById('correo').style.borderColor="red";
        Error("El correo es invalido por favor Verifique","msg_error","p_error")
    }
    else {
        userConfirmCorreo();
    }
})
document.getElementById("tipo_materia").addEventListener("click", SelectMateria)

document.getElementById("materias_unidad").addEventListener("click", function(){
    document.querySelector("#materias_drop_unidad").style.display="flex"})


document.getElementById("materias_add").addEventListener("click", function(){
    
    document.querySelector("#materias_add_drop").style.display="flex"})
document.getElementById("materias_add_unidad").addEventListener("click", function(){
    
        document.querySelector("#materias_add_drop_unidad").style.display="flex"})

document.getElementById("carreras").addEventListener("click", function(){
    document.querySelector("#carreras_drop").style.display="flex"})


document.getElementById("carrera_oferta").addEventListener("click", function(){
    document.querySelector("#carreras_oferta_drop").style.display="flex"})

document.getElementById("lapso").addEventListener("click", function(){
        document.querySelector("#lapso_drop").style.display="flex"})

document.getElementById("cedula_dis").addEventListener("click", function(){
        document.querySelector("#disponibilidad_drop").style.display="flex"})

document.getElementById("cedula_horario").addEventListener("click", function(){
        document.querySelector("#horario_drop").style.display="flex"})
        
document.getElementById("lapso_horario").addEventListener("click", function(){
        document.querySelector("#lapso_drop_horario").style.display="flex"})
document.getElementById("oficio").addEventListener("click", function(){
        document.querySelector("#oficio_drop").style.display="flex"})

document.addEventListener('mouseup', function(e) {
    var input = document.getElementById('materias_unidad');
    var input2= document.getElementById('materias_add');
    var input3= document.getElementById('carreras');
    var input5= document.getElementById('carrera_oferta');
    var input6= document.getElementById('lapso');
    var input7= document.getElementById('bloques_1');
    var input8= document.getElementById('bloques_add_1');
    var input9= document.getElementById('cedula_dis');
    var input10= document.getElementById('oficio');
    var input11= document.getElementById('bloques_add_2');
    var input12= document.getElementById('bloques_3');
    var input13= document.getElementById('bloques_add_3');
    var input14= document.getElementById('bloques_4');
    var input15= document.getElementById('bloques_add_4');
    var input16= document.getElementById('bloques_5');
    var input17= document.getElementById('bloques_add_5');
    var input19= document.getElementById('materias_add_unidad');
    var input20= document.getElementById('cedula_horario');
    var input21= document.getElementById('lapso_horario');
    
    
    if (!input.contains(e.target)) {
        document.getElementById("materias_drop_unidad").style.display = 'none';
        input.style.border=""
    }
    if (!input2.contains(e.target)) {
        document.getElementById("materias_add_drop").style.display = 'none';
        input2.style.border=""
    }
    if (!input3.contains(e.target)) {
        document.getElementById("carreras_drop").style.display = 'none';
        input3.style.border=""
    }
    if (!input5.contains(e.target)) {
        document.getElementById("carreras_oferta_drop").style.display = 'none';
        input5.style.border=""
    }
    if (!input6.contains(e.target)) {
        document.getElementById("lapso_drop").style.display = 'none';
        input6.style.border=""
    }
    if (!input9.contains(e.target)) {
        document.getElementById("disponibilidad_drop").style.display = 'none';
        input9.style.border=""
    }
    if (!input10.contains(e.target)) {
        document.getElementById("oficio_drop").style.display = 'none';
        input9.style.border=""
    }
    if (!input20.contains(e.target)) {
        document.getElementById("horario_drop").style.display = 'none';
        input3.style.border=""
    }
    if (!input2.contains(e.target)) {
        document.getElementById("materias_add_drop_unidad").style.display = 'none';
        input2.style.border=""
    }
    
});
ValidateTexto('primer_nombre');
ValidateTexto('segundo_nombre');
ValidateTexto('primer_apellido');
ValidateTexto('segundo_apellido');
ValidateTexto('tipo_materia');
ValidateVarchar('nombre_aula');
ValidateVarchar('codigo_materia_multi');
ValidateVarchar('nombre_materia_multi');
ValidateVarchar('nombre_carrera');
ValidateNumeros('cedula');
ValidateNumeros('cedula_horario');
ValidateNumeros('telefono');
ValidateNumeros('telefono_fijo');
ValidateNumeros('horas_semana');
ValidateNumeros('unidad_credito');
ValidateVarchar('codigo_carrera');
ValidateVarchar('direccion');
ValidateVarchar('descripcion');
ValidateVarchar('codigo_noticia');
ValidateVarchar('codigo_materia');
ValidateVarchar('nombre_materia');
ValidateVarchar('codigo_aula');
ValidateVarchar('trayecto');
ValidateVarchar('titulo');
ValidateVarchar('oficio');
ValidateVarchar('buscar_pensum');
OnLoad();




//----------------------------------------EJECUTAR FUNCIONES------------------------------------
