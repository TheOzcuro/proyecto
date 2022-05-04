// ----------------------------------VARIABLES---------------------------------
//VARIABLES PARA ANIMAR EL MENU LATERAL
var click=0;
var comparechild=0;
var button=[];
var div_edit="";
var container_url="";
var container_add="";
var add_array=[];
var add_disponibilidad=[];
var email=/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
var ant_value="";
var ant_value_dis="";
let dias_main=[];
let activehorario="";
let valideBloque=0;
let ValideAddMateria=0;
let ValideDelMateria=0;
let span_update=0;
// ----------------------------------VARIABLES---------------------------------




//--------------------------------------------FUNCIONES--------------------------------

function OnclickAppear(display,drop, input) {
    input=document.getElementById(input);
    document.getElementById(drop).style.display=display
    document.addEventListener('mouseup', function(e) {
        if (!input.contains(e.target)) {
            document.getElementById(drop).style.display = 'none';
            input.style.border=""
        }
    })
}
function AppearsAndDissapear(appear,display) {
    DissapearVarious(".container","none");
        if (appear=="horario_agrupar") {
            document.getElementById('register_back').style.display='none';
            document.getElementById('history_back').style.display='none';
            setTimeout(() => {
                document.getElementById('horario_docente-historial').style.display='none';
            }, 500);
        }
        document.getElementById(appear).style.display=display;
        document.getElementById(appear).style.animationName="Opacity";
        document.getElementById(appear).style.animationDuration="0.7s";
}
function LabelAnimation(input,label){
        document.getElementById(input).style.borderColor=""
        document.getElementById(label).style.top = "1px";
        document.getElementById(label).style.fontSize = "15px";
       
}
function AnimationPrincipalMenu(child){
    click=click+1;
    div_count=document.querySelectorAll('.principal-menu');
        for (let index = 0; index < div_count.length-1; index++) {
            if (index==child) {
                const div=document.querySelector(".slide-menu").children[child];
                
                if (click>=2 && comparechild==child) {
                    div.children[1].style.transform = "rotate(0)";
                    div.children[2].style.maxHeight = "0";
                    click=0
                }
                else {
                    div.children[1].style.transform = "rotate(180deg)";
                    if (child==0) {
                        div.children[2].style.maxHeight = "150px";
                    }
                    else {
                        div.children[2].style.maxHeight = "120px";
                    }
                   
                    
                }  
            }
            else {
                const div=document.querySelector(".slide-menu").children[index];
                div.children[1].style.transform = "rotate(0)";
                div.children[2].style.maxHeight = "0";
            }
            
        }
    comparechild=child
    
}
function ShowContratacion(direccion,telefono,telefono_fijo,correo,titulo,oficio,rol) {
    /*
    document.getElementById('tipo_contratacion').value=contratacion;
    document.getElementById('categoria').value=categoria;
    document.getElementById('dedicacion').value=dedicacion;
    document.getElementById('div_contratacion').innerHTML=$("#tipo_contratacion option:selected").text();
    document.getElementById('div_categoria').innerHTML=$("#categoria option:selected").text();
    document.getElementById('div_dedicacion').innerHTML=$("#dedicacion option:selected").text();
    */
    document.getElementById('div_direccion').innerText=direccion;
    document.getElementById('div_telefono').innerText=telefono;
    document.getElementById('div_telefono_fijo').innerText=telefono_fijo;
    document.getElementById('div_correo').innerText=correo;
    document.getElementById('div_titulo').innerText=titulo;
    document.getElementById('div_oficio').innerText=oficio;
    if (rol==0) {
        document.getElementById('div_rol').innerText="Profesor";
    }
    if (rol==1) {
        document.getElementById('div_rol').innerText="Administrador";
    }
    document.querySelector(".blackcover").addEventListener("click", function(){
        document.getElementById('contratacion-container').style.display='none';
        document.querySelector('.blackcover').style.display='none';
    })
    document.querySelector(".blackcover").style.display='block';
    document.getElementById('contratacion-container').style.display='grid';
}


function ValidateDate() {
    var date_inicio=document.getElementById('fecha_inicio').value;
    var date_final=document.getElementById('fecha_final').value;
    console.log(date_inicio)
    console.log(date_final)
    array_inicio=date_inicio.split("-");
    array_final=date_final.split("-");
    if (date_final<date_inicio && date_final!="") {
        document.getElementById('fecha_final').value="";
        Error("La fecha final no puede ser menor que la fecha inicial","msg_error","p_error")
    }
}
function LabelInput() {
     //--- y para los inputs
     y=0
     //--- l para los label
     l=0
     var input=document.querySelectorAll(".input-label");
     var label=document.querySelectorAll("label");
     OnLoad('active');
     totalinput=input.length;
     while (y<totalinput) {
         if (input[y].value!="") {
             if (container_url=="horario_docente-container" && activehorario==1 || container_url=="horario_docente-historial" && activehorario==1) {
                LabelAnimation(input[y].id,label[y+2].id)
             }
             else {
                LabelAnimation(input[y].id,label[y].id)
             }
         }
         y=y+1
     }
}
function LabelOut(input,label){
    var inputs = document.getElementById(input).value;
    if (inputs=="") {
        document.getElementById(label).style.top = "20px";
        document.getElementById(label).style.fontSize = "18px";
        document.getElementById(input).style.borderColor="rgb(225, 32, 109)"
    }
    else {
        document.getElementById(input).style.borderColor="rgb(32, 190, 109)"
    }
    
}
function SelectAnimation(select){
    if (document.getElementById(select).value=="") {
        document.getElementById(select).style.borderColor="";
    }
    else {
        document.getElementById(select).style.borderColor="rgb(32, 190, 109)";
    }
    
}
function SubmitDisponibilidad(active) {
    document.getElementById('cedula_dis').disabled=false;
    var div=document.getElementById('disponibilidad-container')
    var drop=div.querySelectorAll(".drop_add");
    var select=div.querySelectorAll('.input-dis')
    var AntSelect=""
    var valide=true;
    var valideSpan=false;
    var valideSelect=true;
    var valideSpanAdd=false;
    cedula=div.querySelector('#cedula_dis');
    drop_dis=div.querySelector('#disponibilidad_drop');
    span_main_mod=drop_dis.querySelectorAll('span');
    for (let index = 0; index < drop.length; index++) {
        span=drop[index].querySelectorAll("span");
        if (span.length>0) {
            valideSpan=true
        }
    }
    if (document.getElementById('cedula_dis').value=="") {
        valide=false
        document.getElementById('cedula_dis').style.borderColor='red';
    }
    console.log(valide);
    console.log(valideSpan);
    console.log(valideSelect);
    console.log(valideSpanAdd);
    if (valide && valideSpan) {
        if (active!="active") {
            for (let index = 0; index < drop.length; index++) {
                span=drop[index].querySelectorAll("span");
                if (span.length>0) {
                    id=drop[index].getAttribute('value');
                    document.getElementById(id).value="";
                    for (let index = 0; index < span.length; index++) {
                        if (document.getElementById(id).value=="") {
                            document.getElementById(id).value=span[index].id;
                        }
                        else {
                            document.getElementById(id).value=document.getElementById(id).value+","+span[index].id;
                        }
                        
                    }
                }
            }
            OnLoad("active")
            for (let index = 0; index < span_main_mod.length; index++) {
                if (cedula.value.toUpperCase()==span_main_mod[index].innerText) {
                    array=span_main_mod[index].getAttribute('value').split('/');
                    localStorage.setItem('disponibilidad',cedula.value+" **");
                    localStorage.setItem('disponibilidad_n',array[0]+" "+array[1])
                    localStorage.setItem('disponibilidad_c',array[2])
                    ValideCarrera=true;
                }
             }
             document.getElementById('disponibilidad').querySelector(".input-url").value=container_url+"-grid";
             document.getElementById('disponibilidad').submit();
        }
        else {
            return true;
        }
    }
    else {
        if (valideSelect==false) {
            Error("Recuerde que no pueden haber dos dias repetidos o vacios","msg_error","p_error")
        }
        else {
            Error("Recuerde añadir los bloques","msg_error","p_error")
        }
     if (active=="active") {
         return false;
     }
    }
}
function Submit(form,active){
   var div=document.getElementById(form).querySelector("div");
   var input=div.querySelectorAll(".input");
   var valide=true;
   if (active=="") {
    ValidateDate();
   }
   for (let index = 0; index < input.length; index++) {
       if (input[index].id=="segundo_nombre" || input[index].id=="segundo_apellido" || input[index].id=="telefono" ||
            input[index].id=="telefono_fijo" || input[index].id=="titulo") {
           
       }
       else {
            if (input[index].value=="") {
            input[index].style.borderColor='red'
            valide=false;
            }
            if (input[index].id=='correo') {
                if (email.test(input[index].value)==false) {
                 document.getElementById('correo').style.borderColor="red";
                 valide=false;
                }
            }
       }
   }
   if (valide) {
        OnLoad("active")
        document.getElementById(form).querySelector(".input-url").value=container_url+"-grid";

        document.getElementById(form).submit();
   }
   else {
    Error("Existen campos vacios se han marcado en rojo por favor verifique","msg_error","p_error");
   }
}
function ValidateOficio() {
    console.log("aver");
    span_oficio=document.getElementById('oficio_drop').querySelectorAll('span');
        valideoficio=false;
        setTimeout(() => {
            for (let index = 0; index < span_oficio.length; index++) {
                if (document.getElementById('oficio').value==span_oficio[index].innerText) {
                    valideoficio=true;
                }
                
            }
            if (valideoficio==false) {
                Error("El oficio '"+document.getElementById('oficio').value.toUpperCase()+"' no corresponde a ningun oficio registrado. Verifique o registre el oficio deseado","msg_error","p_error");
                document.getElementById('oficio').value="";
                document.getElementById('oficio').style.borderColor='red';
                Search('oficio','oficio_drop');
            }
        }, 200);
       
}
function KeyTexto() {
    var x=new RegExp("[A-Za-z-ñ]+")
    if (x.test(event.key)) {
    }
    else {
        event.preventDefault();
    }
}
function KeyEmail() {
    var x=new RegExp("[A-Za-z0-9-ñ-.@_]+")
    if (x.test(event.key)) {
    }
    else {
        event.preventDefault();
    }
}
function KeyNumeros() {
    var x=new RegExp("[0-9]+")
    if (x.test(event.key)) {
    }
    else {
        event.preventDefault();
    }
}
function KeyVarchar() {
    var x=new RegExp("[A-Za-z0-9-ñ ]+")
    if (x.test(event.key)) {
    }
    else {
        event.preventDefault();
    }
}
function ValidateTexto(input){
    var inputs=document.getElementById(input)
    inputs.addEventListener("keypress", KeyTexto)
    
}
function ValidateNumeros(input){
    
    var inputs=document.getElementById(input)
    inputs.addEventListener("keypress", KeyNumeros)
}
function ValidateVarchar(input){
    var inputs=document.getElementById(input)
    inputs.addEventListener("keypress", KeyVarchar)
}

function CountInput(input) {
    input_count=div_edit.querySelectorAll(".input");
    for (let index = 0; index < input_count.length; index++) {
       if (input_count[index].id==input.id) {
            return index
       }
        
    }
}
function DissapearVarious(element,display) {
    x=0
    div=document.querySelectorAll(element)
    totaldiv=div.length;
    while (x<totaldiv) {
        div[x].style.display=display;
        x=x+1
    }
}


function Search(input,div) {
    var input, filter, span, i;
    input = document.getElementById(input);

    filter = input.value.toUpperCase();
    div = document.getElementById(div);
    span = div.querySelectorAll("span");
    for (i = 0; i < span.length; i++) {
      txtValue = span[i].textContent || span[i].innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        span[i].style.display = "";
      } else {
        span[i].style.display = "none";
      }
    }
}
function AddValueMateria(input, span) {
    if (input=="cedula_dis") {
        let value=span.getAttribute('value');
        let array=value.split('/');
        let nombre=array[0]+" "+array[1];
        document.getElementById("nombre_dis").value=nombre;
        document.getElementById("contratacion_dis").value=array[2];
    }
    else if (input=="carrera_oferta") {
        CreateHistorialMateria(span.id)
    }
    span=span.textContent || span.innerText;
    document.getElementById(input).value=span;
    if (input=="cedula_horario") {
        value=span.split("-");
        document.getElementById(input).value=value[0];
        document.getElementById('nombre_horario').value=value[1];
    }
    if (input=="carreras" || input=="carreras_unidad") {
        CreateMaterias(span)
    }
    
    else if (input=="cedula_dis" || input=="cedula_dis") {
        CreateDisponibilidad(span)
    }
    LabelInput();
}
function ActiveDisponibilidad(cedula,nombre,apellido,contratacion,tipo) {
    let div=document.getElementById('disponibilidad-container');
    div_edit=div;
    div.querySelector(".close-icon").style.display='block';
    document.getElementById('nombre_dis').value=nombre+" "+apellido;
    document.getElementById('contratacion_dis').value=contratacion;
    if (tipo==0) {
        document.getElementById('cedula_dis').value=cedula;
    }
    else {
        cedula=cedula+" **";
        CreateDisponibilidad(cedula);
        document.getElementById('cedula_dis').value=cedula;
    }
    AppearsAndDissapear("disponibilidad-container","grid")
    LabelInput();
}
function AddAllBloques(bloques_add, bloques_input) {
    bloques_add=document.getElementById(bloques_add).querySelectorAll("span");
    bloques_input=document.getElementById(bloques_input);
    span_bloques=bloques_input.querySelectorAll('span');
    for (let index = 0; index < span_bloques.length; index++) {
        span_bloques[index].remove();
    }
    input=bloques_input.getAttribute('value');
    for (let index = 0; index < bloques_add.length; index++) {
       let span_add=document.createElement('span');
       span_add.innerHTML=bloques_add[index].innerText;
       span_add.onclick=function () {AddValueMateria(input, this)}
       span_add.id=bloques_add[index].id;
       bloques_input.appendChild(span_add);
       bloques_add[index].hidden=true
    }
}
function DeleteAllBloques(bloques_add, bloques_input) {
    bloques_add=document.getElementById(bloques_add);
    bloques_input=document.getElementById(bloques_input);
    input=bloques_input.getAttribute('value');
    document.getElementById(input).value="";
    bloques_input=bloques_input.querySelectorAll('span');
    for (let index = 0; index < bloques_input.length; index++) {
        bloques_add.querySelector("#"+bloques_input[index].id).hidden=false;
       bloques_input[index].remove();
    }
}
function CreateMaterias(value) {
    OnLoad('active');
    if (container_url=="pensum-container" || container_url=="pensum-historial") {
        ValideDelMateria=0;
        ValideAddMateria=0;
        nombre_add=document.getElementById('materias_add');
        nombre_add_multi=document.getElementById('materias_add_unidad');
        drop_main=document.getElementById('carreras_drop');
        drop=document.getElementById('materias_add_drop');
        nombre_add_multi=document.getElementById('materias_add_unidad');
        drop_main_multi=document.getElementById('carreras_drop_unidad');
        drop_multi=document.getElementById('materias_add_drop_unidad');
    }
    drop_main_unidad=document.getElementById('materias_drop_unidad');
    let span=drop.querySelectorAll('span');
    let span_multi=drop_multi.querySelectorAll('span');
    let span_main=drop_main.querySelectorAll('span');
    let carrera=value.slice(-2)
   
    if (carrera=="**") {
        document.getElementById('materia').querySelector('#add').value="";
        document.getElementById('materia').querySelector('#del').value="";
        document.getElementById('materia').querySelector('#add_multi').value="";
        document.getElementById('materia').querySelector('#del_multi').value="";
        nombre_add.value="";
        nombre_add_multi.value="";
        add_array=[];
        valores=[];
        for (let index = 0; index < span_main.length; index++) {
            if (value==span_main[index].innerText) {
                
                carrera_id=span_main[index].id;
            }
            
        }
        for (let index = 0; index < span.length; index++) {
            span[index].remove();
        }
        for (let index = 0; index < span_multi.length; index++) {
            span_multi[index].remove();
        }
            span_main_unidad=drop_main_unidad.querySelectorAll('span');
            for (let index = 0; index < span_main_unidad.length; index++) {
                span_main_unidad[index].hidden=false;
            }
        
        valores.push(carrera_id);
        var y=0;
        console.log(materiasArray);
        for (let index = 0; index < materiasArray.length; index=index+6) {
                if (carrera_id==materiasArray[index+3] && materiasArray[index+2]==0) {
                    let span_add=document.createElement('span');
                    span_add.innerHTML=materiasArray[index]+", "+materiasArray[index+1]+" | HS: "+materiasArray[index+4]+", UC: "+materiasArray[index+5];
                    span_add.onclick=function () {AddValueMateria(nombre_add.id, this)}
                    span_add.id=materiasArray[index]+"/"+materiasArray[index+1]+"/"+materiasArray[index+2];
                    nombre_add.value=materiasArray[index]+", "+materiasArray[index+1]+" | HS: "+materiasArray[index+4]+", UC: "+materiasArray[index+5];
                    drop.appendChild(span_add);
                }
                if (carrera_id==materiasArray[index+3] && materiasArray[index+2]==1) {
                    let span_add=document.createElement('span');
                    span_add.innerHTML=materiasArray[index]+", "+materiasArray[index+1]+" | HS: "+materiasArray[index+4]+", UC: "+materiasArray[index+5];
                    span_add.onclick=function () {AddValueMateria(nombre_add_multi.id, this)}
                    span_add.id=materiasArray[index];
                    nombre_add_multi.value=materiasArray[index]+", "+materiasArray[index+1]+" | HS: "+materiasArray[index+4]+", UC: "+materiasArray[index+5];
                    drop_main_unidad.querySelector("[id='"+materiasArray[index]+"']").hidden=true;
                    drop_multi.appendChild(span_add);
                }
        }
        span_update=drop.querySelectorAll('span')
        add_array=span_update.length;
        if (container_url=="pensum-container") {
            DissapearVarious('.button_main','none')
            DissapearVarious('.button_unidad','block')
        }
        else if(container_url=='materia-container'){
            var button=document.getElementById('materia-container').querySelectorAll("button");
            button[0].style.display='none';
            button[1].style.display='none';
            button[2].style.display='block';
            button[3].style.display='block';
        }
        
        LabelInput()
        nombre_add.style.borderColor="rgb(32, 190, 109)";
        setTimeout(() => {
            nombre_add.style.borderColor="";
            }, 800);
    }
    else if (ant_value=="**" && carrera!="**"){
        document.getElementById('materia').querySelector('#add').value="";
        document.getElementById('materia').querySelector('#del').value="";
        document.getElementById('materia').querySelector('#add_multi').value="";
        document.getElementById('materia').querySelector('#del_multi').value="";
        for (let index = 0; index < span.length; index++) {
            span[index].remove();
        }
        console.log(span_multi);
        for (let index = 0; index < span_multi.length; index++) {
            span_multi[index].remove();
        }
        if (container_url=="pensum-container") {
            DissapearVarious('.button_main','block')
            DissapearVarious('.button_unidad','none')
            span_main_unidad=drop_main_unidad.querySelectorAll('span');
            for (let index = 0; index < span_main_unidad.length; index++) {
                span_main_unidad[index].hidden=false;
            }
        }
        else if(container_url=='materia-container'){
           
            var button=document.getElementById('materia-container').querySelectorAll("button");
            button[0].style.display='block';
            button[1].style.display='none';
            button[2].style.display='none';
            button[3].style.display='none';
        }
        nombre_add.value="";
        nombre_add_multi.value="";
        LabelInput()
    }
    ant_value=carrera;       
}
function CreateDisponibilidad(value) {
    console.log(value);
    div=document.getElementById('disponibilidad-container');
    dias=div.querySelectorAll('.input-dis');
    bloques_add=div.querySelectorAll('.input_add');
    bloques_add_drop=div.querySelectorAll('.drop_add');
    bloques_drop=div.querySelector("#bloques_drop_1");
    bloques_drop_main=div.querySelectorAll(".drop_main");
    button=div.querySelectorAll('button');
    let profesor=value.slice(-2);
    if (profesor=="**") {
        ant_value_dis=profesor;
        for (let index = 0; index < bloques_add_drop.length; index++) {
            bloques_add[index].value="";
            span_bloques=bloques_add_drop[index].querySelectorAll('span');
            for (let i = 0; i < span_bloques.length; i++) {
                span_bloques[i].remove();
            }
            
        }
        for (let index = 0; index < bloques_drop_main.length; index++) {
            span_main=bloques_drop_main[index].querySelectorAll('span');
            for (let i = 0; i < span_main.length; i++) {
                span_main[i].hidden=false;
            } 
        }
        profesor_administrador=value.split(' **');
        value=profesor_administrador[0];
        valores.push(profesor_administrador[0]);
        antdia="";
        d=0;
        b=-1;
        totalspan=0
        for (let index = 0; index < disponibilidadArray.length; index=index+3) {
            if (value==disponibilidadArray[index]) {
                if (antdia!=disponibilidadArray[index+2]) {
                    dias_main.push(disponibilidadArray[index+2]);
                    antdia=disponibilidadArray[index+2];
                    d=d+1;
                    b=b+1;
                    let inputs=bloques_add[disponibilidadArray[index+2]-1];
                    inputs.style.borderColor="rgb(32, 190, 109)";
                    setTimeout(() => {
                        inputs.style.borderColor="";
                        }, 800);
                }
                bloques_drop_main[disponibilidadArray[index+2]-1].querySelector("#"+disponibilidadArray[index+1]).hidden=true;
                let input_id=bloques_add[disponibilidadArray[index+2]-1].id;
                let span_add=document.createElement('span');
                span_add.innerHTML=bloques_drop.querySelector("#"+disponibilidadArray[index+1]).innerText;
                span_add.onclick=function () {AddValueMateria(input_id, this)}
                span_add.id=disponibilidadArray[index+1];
                bloques_add[disponibilidadArray[index+2]-1].value=bloques_drop.querySelector("#"+disponibilidadArray[index+1]).innerText;
                bloques_add_drop[disponibilidadArray[index+2]-1].appendChild(span_add);
                totalspan=totalspan+1;
                add_disponibilidad=totalspan;
                
            }
        }
        button[0].style.display="none";
        button[1].style.display="block";
        button[2].style.display="block";
    }
    else if(profesor!="**" && ant_value_dis=="**") {
        for (let index = 0; index < bloques_drop_main.length; index++) {
            span_main=bloques_drop_main[index].querySelectorAll('span');
            for (let i = 0; i < span_main.length; i++) {
                span_main[i].hidden=false;
            } 
        }
        for (let index = 0; index < bloques_add_drop.length; index++) {
            bloques_add[index].value="";
            span_bloques=bloques_add_drop[index].querySelectorAll('span');
            for (let i = 0; i < span_bloques.length; i++) {
                span_bloques[i].remove();
            }
        }
        button[0].style.display="block";
        button[1].style.display="none";
        button[2].style.display="none";
        LabelInput();
    }

}
function SubmitBloque(form,bloque) {
    form=document.querySelector(form);
    bloque=document.getElementById(bloque);
    data=bloque.querySelectorAll('span');
    arrayAula=data[3].innerText.split(': ');
    arraySeccion=data[2].innerText.split(': ');
    drop=form.querySelectorAll('.drop_horario');
    input=form.querySelectorAll('.input_horario');
    valide=0;
    valideUpdate=0;
    for (let index = 0; index < drop.length; index++) {
        if (span_data[index]!=input[index].value) {
            valideUpdate=valideUpdate+1;
        }
    }
    for (let index = 0; index < drop.length; index++) {
        span=drop[index].querySelectorAll('span');
        for (let i = 0; i < span.length; i++) {
            
            if (span[i].innerText==input[index].value.toUpperCase()) {
                valide=valide+1;
            }
        }
    }
    if (arrayAula[1]==input[3].value) {
        valide=valide+1;
    }
    if (arraySeccion[1]==input[2].value) {
        valide=valide+1;
    }
    if (valide>=4 && valideUpdate>0) {
        bloques=bloque.querySelectorAll("span");
        bloques[0].innerText='Carrera: '+input[0].value;
        bloques[1].innerText='Materia: '+input[1].value;
        bloques[3].innerText='Aula: '+input[3].value;
        bloques[2].innerText='Seccion: '+input[2].value;
        form.style.display='none';
        valideBloque=valideBloque+1;
        document.querySelector('.blackcover').style.display='none';
    }
    if (valideUpdate==0) {
        Error('Tiene que hacer algun cambio si desea guardar', 'msg_error','p_error');
    }
}
function DeleteBloque(form,bloque) {
    form=document.querySelector(form);
    input=form.querySelectorAll('.input');
    bloque=document.getElementById(bloque);
    bloques=bloque.querySelectorAll("span");
    for (let index = 0; index < bloques.length; index++) {
        bloques[index].innerText='';
        input[index].value='';
    }
    form.style.display='none';
    valideBloque=valideBloque+1;
    document.querySelector('.blackcover').style.display='none';
}
function AddAndRemove(div,div_add,input,input_add, type, container) {
    //VARIABLES
    var input_add=document.getElementById(input_add)
    var input=document.getElementById(input);
    var span_add=document.createElement("span");
    var div=document.getElementById(div);
    var div_add=document.getElementById(div_add);
    var span=div.querySelectorAll("span");
    var span_mod=div_add.querySelectorAll("span")
    var container=document.getElementById(container);
    var valide=true;
    if (container_add!=container && container_add!="") {
        if (container.querySelector('#add').value!="") {
            add_array=container.querySelector('#add').value.split(',');
            input_add.value=input.value.toUpperCase();
            span_add.innerHTML=input.value.toUpperCase();
            span_add.onclick=function () {AddValueMateria(input_add.id, this)}
            span_add.id=span[index].getAttribute('id');
            span[index].remove();
            div_add.appendChild(span_add);
        }
        
    }
    container_add=container;
    if (input!="") {
        if (type=="del") {
            for (let index = 0; index < span.length; index++) {
                if (input.value.toUpperCase()==span[index].innerText) {
                    if (container.querySelector("#del").value!="") {
                        container.querySelector("#del").value=container.querySelector("#del").value+","+span[index].getAttribute('id');
                    }
                    else {
                        container.querySelector("#del").value=span[index].getAttribute('id');
                    }
                    div_add.querySelector("[id='"+span[index].id+"']").hidden=false;
                    span[index].remove();
                    input.value="";                    
                }
                console.log(container.querySelector("#del").value);
                ValideDelMateria=ValideDelMateria+1;
                add_disponibilidad=add_disponibilidad-2;
            }
        }
        else if (type=="add") {
            array_input=input.value.split(', ');
            console.log(array_input);
            for (let index = 0; index < span_mod.length; index++) {
                array_span=span_mod[index].innerText.split(', ');
                if (array_input[0]==array_span[0]) {
                    valide=false
                    break
                }
            }
            if (valide) {
                for (let index = 0; index < span.length; index++) {
                    if (span[index].innerText==input.value.toUpperCase()) {
                        span[index].hidden=true;
                        input_add.value=input.value.toUpperCase();
                        span_add.innerHTML=input.value.toUpperCase();
                        span_add.onclick=function () {AddValueMateria(input_add.id, this)}
                        span_add.id=span[index].getAttribute('id');
                        div_add.appendChild(span_add);
                        input.value="";
                        LabelInput();
                        Search(input.id,div.id)
                        if (container.querySelector("#add").value!="") {
                            container.querySelector("#add").value=container.querySelector("#add").value+","+span[index].getAttribute('id');
                        }
                        else {
                            container.querySelector("#add").value=span[index].getAttribute('id');
                        }
                    }
                ValideAddMateria=ValideAddMateria+1;
            }
        }
        
        
        }    
    }
}
    /*
                        if (type=="add") {
                            console.log(add_array);
                            add_array.push(span[index].getAttribute('id'));
                        }
                        else if (type=="del") {
                            for( var i = 0; i < add_array.length; i++){ 
                                if ( add_array[i] === span[index].getAttribute('id')) { 
                                    add_array.splice(i, 1); 
                                }
                            }
                        }
                        container.querySelector('#add').value="";
                        for (let index = 0; index < add_array.length; index++) {
                            if (container.querySelector("#add").value!="") {
                                container.querySelector("#add").value=container.querySelector("#add").value+","+add_array[index];
                            }
                            else {
                                container.querySelector("#add").value=add_array[index];
                            }
                        }
                        */
function SelectMateria() {
    var tipo=document.getElementById('tipo_materia').value;
    if (tipo==1) {
        DissapearVarious('.dis','none');
        DissapearVarious('.das','block');
        button=document.getElementById("materia").querySelectorAll('button');
    }
    else if (tipo==0){
        button=document.getElementById("materia").querySelectorAll('button');
        DissapearVarious('.dis','');
        DissapearVarious('.das','none');
        carrera=document.getElementById("carreras").value;
        type=carrera.slice(-2);
    }
}
function CreateHistorialMateria(value) {
    document.getElementById('materias-oferta').style.display='grid';
        div=document.getElementById('materias-oferta');
        console.log(value);
        for (let index = 0; index < materiasArray.length; index=index+6) {
            if (value==materiasArray[index+3]) {
                span_add=document.createElement('span');
                span_add.innerHTML=materiasArray[index];
                div.appendChild(span_add);
                span_add=document.createElement('span');
                span_add.innerHTML=materiasArray[index+1];
                div.appendChild(span_add);
                span_add=document.createElement('span');
                if (materiasArray[index+2]==0) {
                    span_add.innerHTML="DISCIPLINARIA";
                }
                else {
                    span_add.innerHTML="MULTIDISCIPLINARIA";
                }
                div.appendChild(span_add);
                span_add=document.createElement('span');
                span_add.innerHTML=materiasArray[index+4];
                div.appendChild(span_add);
                span_add=document.createElement('span');
                span_add.innerHTML=materiasArray[index+5];
                div.appendChild(span_add);  
            }
}
}
async function AddMateria(modo) {
    OnLoad('active');
    var span_add=document.createElement("span");
        carrera=document.getElementById("carreras");
        codigo=document.getElementById('codigo_materia');
        nombre=document.getElementById('nombre_materia');
        nombre_add=document.getElementById('materias_add');
        tipo=document.getElementById('tipo_materia');
        horas=document.getElementById('horas_semana_unidad');
        creditos=document.getElementById('unidad_credito_unidad');
        div=document.getElementById('materia');
        drop=document.getElementById('materias_add_drop');
    
    let del=div.querySelector('#del_multi');
    
    let span=drop.querySelectorAll('span');
    let add=div.querySelector('#add_multi');
    if (modo=="add") {
        if (carrera.value!="" && codigo.value!="" && nombre.value!="" &&  horas.value!="" &&  creditos.value!="" && tipo.value==0 && tipo.value!="") {
            let valide=true;
            for (let index = 0; index < span.length; index++) {
                array=span[index].id.split("/");
                if (nombre.value.toUpperCase()==array[1] || codigo.value.toUpperCase()==array[0]) {
                    valide=false
                    break
                }
            }
           
           let valueconfirm=await MateriaConfirm(codigo.value,nombre.value).then(response=>response)
           array_del=del.value.split(",");
           for (let index = 0; index < array_del.length; index++) {
              if (array_del[index]==codigo.value) {
                  valueconfirm="no";
              }
           }
           console.log(valueconfirm);
           window.localStorage.removeItem('respuesta');
            if (valide && valueconfirm!="si") {
                span_add.innerHTML=codigo.value.toUpperCase()+", "+nombre.value.toUpperCase()+" | HS: "+horas.value+", UC: "+creditos.value;
                span_add.onclick=function () {AddValueMateria(nombre_add.id, this)}
                span_add.id=codigo.value.toUpperCase()+"/"+nombre.value.toUpperCase()+"/"+tipo.value;
                nombre_add.value=codigo.value.toUpperCase()+", "+nombre.value.toUpperCase()+" | HS: "+horas.value+", UC: "+creditos.value;
                document.getElementById('materias_add_drop').appendChild(span_add);
                if (add.value!="") {
                    add.value=add.value+","+codigo.value.toUpperCase()+","+nombre.value.toUpperCase()+","+tipo.value+","+horas.value+","+creditos.value;
                }
                else {
                    add.value=codigo.value.toUpperCase()+","+nombre.value.toUpperCase()+","+tipo.value+","+horas.value+","+creditos.value;
                }
                console.log(add);
                LabelInput()
                ValideAddMateria=ValideAddMateria+1;
                
                codigo.value="";
                nombre.value="";
                horas.value="";
                creditos.value="";
                nombre_add.style.borderColor="rgb(32, 190, 109)";
                setTimeout(() => {
                nombre_add.style.borderColor="";
                
                }, 800);
            }
            else {
                if (valueconfirm=="si") {
                    Error("El codigo de la materia '"+nombre.value+"' que intenta agregar ya existe","msg_error","p_error");
                }
                else {
                    Error("La materia que esta intentando agregar ya existe",'msg_error','p_error');
                }
               
            }
           
        }
        else if(carrera.value=="") {
            Error("Seleccione un PNF por favor",'msg_error','p_error')
            carrera.style.borderColor='red';
        }
        else if(tipo.value=="") {
            Error("Seleccione el tipo de materia",'msg_error','p_error')
            tipo.style.borderColor='red';
        }
        else {
            Error("Existen campos vacios se han marcando en rojo por favor verifique",'msg_error','p_error')
            if (codigo.value=="") {
                codigo.style.borderColor='red';
            }
            if (nombre.value=="") {
                nombre.style.borderColor='red';
            }
            if (horas.value=="") {
                horas.style.borderColor='red';
            }
            if (creditos.value=="") {
                creditos.style.borderColor='red';
            }
        }
    }
    else if (modo=="del") {
        for (let index = 0; index < span.length; index++) {
            array=span[index].id.split("/");
            nombre_span=span[index].innerText.split('-');
            if (nombre_add.value.toUpperCase()==span[index].innerText) {
                array=span[index].id.split("/");
                if (del.value!="") {
                    del.value=del.value+","+array[0];
                }
                else {
                    del.value=array[0];
                }
                console.log(del.value);
                add_array=span_update.length-2;
                nombre_add.value=""
                ValideDelMateria=ValideDelMateria+1;
                span[index].remove();
                nombre_add.style.borderColor="rgb(32, 190, 109)";
                setTimeout(() => {
                    nombre_add.style.borderColor="";
                }, 800);
            }
            
        }
    }
    
}
function SubmitHorario(){
    form=document.getElementById('horario_form');
    valide="";
    input=form.querySelectorAll('.input');
    for (let index = 0; index < input.length; index++) {
        if (input[index].value!="") {
            valide=valide+1;
        }   
    }
    if (valideBloque>0) {
        bloques=document.querySelectorAll('.bloque_add');
        formularios=document.querySelectorAll('.formularios');
        for (let index = 0; index < bloques.length; index++) {
            span=bloques[index].querySelectorAll("span");
            inputs=formularios[index].querySelectorAll('.input_horario');
            for (let i = 0; i < inputs.length; i++) {
                if (span[i].innerText!="") {
                    span_value=span[i].innerText.split(': ');
                    console.log(span_value)
                    inputs[i].value=span_value[1];

                }
            }
            
        }
        OnLoad("active")
        form.querySelector(".input-url").value=container_url+"-grid";
        form.submit();
    }
    else {
        Error("Tiene que al menos llenar un bloque", 'msg_error', 'p_error');
    }
}
function ChangeHorarioType(tipo) {
    document.getElementById('cedula_horario').value=document.getElementById('codigo_cedula_horario').value;
    document.getElementById('lapso_horario').value=document.getElementById('codigo_lapso_horario').value;
    OnLoad('active');
    document.getElementById('horario').querySelector(".input-url").value=container_url+"-grid";
    document.getElementById('tipo_horario').value=tipo;
    document.getElementById('horario').submit();
}
function HiddenDisponibilidad(value){
   
    dias=document.querySelectorAll('.input-dis');
    
    for (let index = 0; index < dias.length; index++) {
        option_value=value.querySelectorAll('option');
        option=dias[index].querySelectorAll('option');
        option_origin=dias[index].querySelectorAll('option');
        for (let i = 1; i < option.length; i++) {
            console.log(dias[index].value)
            if (option[i].value==value.value && value.value>0) {
                option[i].hidden=true
            }
            if (option[i].value!=value.value && value.value>0 && dias[0].value!=option[i].value && dias[1].value!=option[i].value && dias[2].value!=option[i].value && dias[3].value!=option[i].value && dias[4].value!=option[i].value) {
                option[i].hidden=false
            }

        }
        
        
        
    }
}
function ActiveHorario(cedula, lapso) {
    document.getElementById('cedula_horario').value=cedula;
    document.getElementById('lapso_horario').value=lapso;
    OnLoad('active');
    document.getElementById('horario').querySelector(".input-url").value=container_url+"-grid";
    document.getElementById('tipo_horario').value=0;
    document.getElementById('horario').submit();
}
function SubmitMateria(form) {
   
    OnLoad('active');
    if (container_url=="pensum-container") {
        carrera=document.getElementById('carreras');
        drop=document.getElementById('materias_add_drop');
        drop_main=document.getElementById('carreras_drop');
        span_main=drop_main.querySelectorAll('span');
        input_add=document.getElementById('materias_add');
        drop_multi=document.getElementById('materias_add_drop_unidad');
        span_multi=drop_multi.querySelectorAll('span');
        span=drop.querySelectorAll('span');
    }
    else if(container_url=="materia-container") {
        carrera=document.getElementById('carreras_unidad');
        drop_main=document.getElementById('carreras_drop_unidad');
        span_main=drop_main.querySelectorAll('span');
        input_add=document.getElementById('materias_add_unidad');
       
    }
    let valideCarrera=false;
    let valideSpan=false;
    for (let index = 0; index < span_main.length; index++) {
       if (carrera.value.toUpperCase()==span_main[index].innerText) {
            carrera_id=span_main[index].id;
            localStorage.setItem('carrera',carrera.value.toUpperCase()+" **");
            valideCarrera=true;
       }
       if (carrera.value=="") {
           carrera.style.borderColor='red';
       }
    }
    if (span.length>0 || span_multi.length>0) {
        valideSpan=true;
    }
    if (valideCarrera && valideSpan) {
        input_add.value="";
        if (container_url=="pensum-container") {
            for (let index = 0; index < span.length; index++) {
                array=span[index].id.split("/");
                nombre=span[index].innerText.split("/");
                hora=nombre[2].split(': ');
                creditos=nombre[3].split(': ');
                if (input_add.value!="") {
                    input_add.value=input_add.value+","+array[0]+","+nombre[1]+","+array[1]+","+hora[1]+","+creditos[1];
                }
                else {
                    input_add.value=array[0]+","+nombre[1]+","+array[1]+","+hora[1]+","+creditos[1];
                }
            }
        }
        else if (container_url=="materia-container") {
            
        }
        console.log(document.getElementById(form).querySelector('#add').value);
        carrera.value=carrera_id;
        OnLoad("active")
        document.getElementById(form).querySelector(".input-url").value=container_url+"-grid";
        document.getElementById(form).submit();
    }
    else {
        if (document.getElementById("tipo_materia").value==0) {
            Error("Parece que carrera esta vacia o no se han agregado materias", "msg_error","p_error");
        }
       
    }
}

function ValueDate() {
    var fecha_expiracion=document.getElementById('fecha_expiracion');
    console.log(fecha_expiracion.value);
    const date = new Date();
    fecha=date.getFullYear();
    let mes=date.getMonth()+1;
    if (mes<10) {
        fecha=fecha+"-0"+mes;
    }
    else {
        fecha=fecha+"-0"+mes;
    }
    fecha=fecha+"-"+date.getDate();
    console.log(fecha);
    if (fecha_expiracion.value<=fecha) {
        document.getElementById('fecha_expiracion').value="";
        Error("Tiene que ingresar una fecha mayor a la fecha actual","msg_error","p_error")
    }
}
//--------------------------------------------FUNCIONES--------------------------------

