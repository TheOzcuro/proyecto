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
    else if (array[1]=="historial" && container_url!='disponibilidad-container' && container_url!='horario-container' && activehorario!=1) {
        console.log(activehorario);
        document.getElementById('register_back').style.display="inline";
    }
    if (container!="" && active!="active") {
        console.log(container_url);
        AppearsAndDissapear(container_url, "grid")
    }
}




document.getElementById("disponibilidadProfesor").addEventListener("click", function(){
    if (div_edit!="") {
           Close()
    }
    DissapearVarious('.back-option','none');
    AppearsAndDissapear("disponibilidad-container","grid")
    setTimeout(() => {
        CreateDisponibilidad(document.getElementById('cedula_dis').value);
        LabelInput();
        document.getElementById('delete-button').style.display='none';
    }, 300);
})
document.getElementById("registrarHorario").addEventListener("click", function(){
    if (div_edit!="") {
        Close()
    }
    DissapearVarious('.back-option','none');
    if (activehorario==1) {
        AppearsAndDissapear('horario_agrupar','block');
    }
    else {
        AppearsAndDissapear("horario_docente-container","grid");
    }
})
LabelInput();
setTimeout(() => {
    CreateDisponibilidad(document.getElementById('cedula_dis').value);
    LabelInput();
    document.getElementById('delete-button').style.display='none';
    DissapearVarious('.back-option','none');
}, 600);
document.getElementById("lapso_horario").addEventListener("click", function(){
    document.querySelector("#lapso_drop_horario").style.display="flex"})
OnLoad();
document.addEventListener('mouseup', function(e) {
    var input1= document.getElementById('lapso_horario');
    if (!input1.contains(e.target)) {
        document.getElementById("lapso_drop_horario").style.display = 'none';
        input1.style.border=""
    }
    
});