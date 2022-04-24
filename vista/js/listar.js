var valores=[];
var span_array=[];
function ActiveModificar(fila,container) {
    console.log(container);
    if (container=="pensum-container") {
        ValideAddMateria=0;
        ValideDelMateria=0;
        add_array=0;
        filas=document.querySelectorAll(fila);
        ActiveModificarMateria(filas[0].innerText+" **");
    }
    else {
        valores=[];
        filas=document.querySelectorAll(fila);
        console.log(values);
        for (let index = 0; index < filas.length; index++) {
            if (filas[index].innerText=="PROFESOR" || filas[index].innerText=="DICIPLINARIA") {
                valores.push('0');
            }
            else if (filas[index].innerText=="ADMINISTRADOR" || filas[index].innerText=="MULTIDICIPLINARIA") {
                valores.push('1');
            }
            else if (index==5 && container=="profesor-container"){

                    var x=filas[8].value;
                    var values=x.split("/")
                    for (let index = 0; index < values.length; index++) {
                        valores.push(values[index]);
                    }
                    break
            }
            else if (index==0 && container=="oferta-container") {
                console.log("pasa");
            }
            else if (container=="noticia-container") {
                valores.push(filas[0].innerText);
                valores.push(filas[3].innerText);
                valores.push(filas[1].innerText);
                break
            }
            else {
                valores.push(filas[index].innerText);
            }
                
        }
        if (container!="") {
            console.log(valores);
            Modificar(container,"grid",valores);
            LabelInput();
        }
    }
    
   
}
function ActiveModificarMateria(value) {
    div_edit=document.getElementById("pensum-container");
    AppearsAndDissapear(div_edit.id,"grid")
    div_edit.querySelector(".close-icon").style.display="block";
    //---Hacer aparecer los botones correspondientes
    button=div_edit.querySelectorAll("button");
    button[0].style.display="none";
    button[1].style.display="block";
    button[2].style.display="block";
    document.getElementById('carreras').value=value;
    console.log(value);
    CreateMaterias(value);
}
function ClearSpan() {
    drop_add=div_edit.querySelector(".drop_add");
    drop=div_edit.querySelector(".drop");
    input_add=div_edit.querySelector('.input_add');
    input_added=div_edit.querySelector('.input_added');
    principal_input=div_edit.querySelector('.principal_input');
    span_materias=drop.querySelectorAll("span");
    span_add_materias=drop_add.querySelectorAll("span");
    for (let index = 0; index < span_materias.length; index++) {
        span_materias[index].remove();
    }
    
    for (let index = 0; index < span_array.length; index++) {
        span=document.createElement("span");
        span.innerHTML=span_array[index].innerHTML;
        span.onclick=span_array[index].onclick;
        span.id=span_array[index].id;
        drop.appendChild(span);
        
    }
    
    if (span_add_materias[0]!="") {
        for (let index = 0; index < span_add_materias.length; index++) {
            span_add_materias[index].remove();
        }
    }
    principal_input.disabled=false;
    input_added.disabled=false;
    input_add.disabled=false;
}

function ModificarPensum(lista, container){
    add_array=[];
    valores=[];
    div=document.getElementById(container);
    drop=div.querySelector(".drop");
    drop_add=div.querySelector(".drop_add");
    input_add=div.querySelector('.input_add');
    input_added=div.querySelector('.input_added');
    principal_input=div.querySelector('.principal_input');
    div_edit=document.getElementById(container);
    if (span_array=="") {
        span_array=drop.querySelectorAll("span");
    }
    ClearSpan();
    valores.push(lista[0])
    var id=1
    for (let index = 2; index < lista.length;) {
            span_add=document.createElement("span");
            span_add.innerHTML=lista[index];
            span_add.onclick=function () {AddValueMateria(input_add.id, this)}
            span_add.id=lista[id];
            add_array.push(lista[id]);
            valores.push(lista[id]);
            drop_add.appendChild(span_add);
            id=id+2;
            index=index+2;
    }
    for (let index = 0, i=1; index < span_array.length; index++) {
       
        if (span_array[index].id==lista[i]) {
            $('#'+drop.id).find('#'+span_array[index].id).remove();
            index=-1;
            i=i+2;
        }  
    }
    div_edit.querySelector("#add").value="";
    
    for (let index = 0; index < add_array.length; index++) {
        if (div_edit.querySelector("#add").value!="") {
                div_edit.querySelector("#add").value=div_edit.querySelector("#add").value+","+add_array[index];
        }
        else {
            div_edit.querySelector("#add").value=add_array[index];
            }
    }
    console.log(div_edit.querySelector("#add").value);   
    div_edit.querySelector(".close-icon").style.display="block";
    button=div_edit.querySelectorAll("button");
    button[0].style.display="none";
    button[1].style.display="none";
    button[2].style.display="block";
    button[3].style.display="block";
    div.querySelector('.principal_input').value=lista[0];
    AppearsAndDissapear(container,"grid");
    var checkbox=div_edit.querySelectorAll(".checkbox-edit");
   for (let index = 0; index < checkbox.length; index++) {
        checkbox[index].style.display="block";
        checkbox[index].checked=true;
   }
    principal_input.disabled=true;
    input_added.disabled=true;
    input_add.disabled=true;
    LabelInput();
}

function refresh(page,tabla,campo,dato) {
    setTimeout(() => {
        OnLoad('active');
        container=container_url.split("-");
        if (container[1]=="historial") {
            if (page=='') {
                page=localStorage.getItem('pagina');
            }
            if (tabla=='') {
                tabla=localStorage.getItem('tabla');
            }
            if (campo=='') {
                campo=localStorage.getItem('campo');
                console.log(campo);
            }
            if (dato=='') {
                dato=localStorage.getItem('dato');
                
            }
            else {
                localStorage.setItem('pagina',page);
                localStorage.setItem('tabla',tabla);
                localStorage.setItem('campo',campo);
                localStorage.setItem('dato',dato);
            }
            console.log(tabla);
            console.log(campo);
            console.log(dato);
            $('#refresh').load('listar.php?page='+page+'&tabla='+tabla+'&campo='+campo+'&dato='+dato);
            setTimeout(() => {
                SelectValidation();
            }, 100);
            setTimeout(() => {
                $(".listar-container").css("display", "grid");
            }, 300);
        }
    }, 200);
    
  
}
function SelectValidation() {
    var campo=document.getElementById('campo').value;
    var input=document.getElementById('buscar_historial');
    const div=document.getElementById('input_buscar');
    if (campo=='CEDULA' || campo=='TELEFONO' || campo=='HORAS_SEMANALES' || campo=='CREDITOS') {
        input.removeEventListener("keypress",KeyNumeros);
        input.removeEventListener("keypress",KeyTexto);
        input.removeEventListener("keypress",KeyVarchar);
        ValidateNumeros('buscar_historial');
        DissapearVarious('.find_inputs','none');
        document.getElementById("buscar_historial").style.display="block";
        document.getElementById("labelbuscar_historial").style.display="block";
    }
    else if (campo=="CONTRATACION") {
        DissapearVarious('.find_inputs','none')
        document.getElementById('contratacion_buscar').style.display="block";
    }
    else if (campo=="DEDICACION") {
        DissapearVarious('.find_inputs','none')
        document.getElementById('dedicacion_buscar').style.display="block";
    }
    else if (campo=="CATEGORIA") {
        DissapearVarious('.find_inputs','none')
        document.getElementById('categoria_buscar').style.display="block";
    }
    else if (campo=="ROL") {
        DissapearVarious('.find_inputs','none')
        document.getElementById('rol_buscar').style.display="block";
    }
    else if (campo=="DISPONIBILIDAD") {
        DissapearVarious('.find_inputs','none')
        document.getElementById('disponibilidad_buscar').style.display="block";
    }
    else if (campo=='PRIMER_NOMBRE' || campo=='SEGUNDO_NOMBRE' || campo=='PRIMER_APELLIDO' || campo=='SEGUNDO_APELIDO'
            || campo=='ROL' || campo=='TIPO') {
        input.removeEventListener("keypress",KeyNumeros)
        input.removeEventListener("keypress",KeyTexto)
        input.removeEventListener("keypress",KeyVarchar)
        DissapearVarious('.find_inputs','none')
        document.getElementById("buscar_historial").style.display="block";
        document.getElementById("labelbuscar_historial").style.display="block";
        ValidateTexto('buscar_historial');
    }
    else if (campo=="CORREO") {
        input.removeEventListener("keypress",KeyNumeros)
        input.removeEventListener("keypress",KeyTexto)
        input.removeEventListener("keypress",KeyVarchar)
        DissapearVarious('.find_inputs','none')
        document.getElementById("buscar_historial").style.display="block";
        document.getElementById("labelbuscar_historial").style.display="block";
    }
    else {
        input.removeEventListener("keypress",KeyNumeros)
        input.removeEventListener("keypress",KeyTexto)
        input.removeEventListener("keypress",KeyVarchar)
        DissapearVarious('.find_inputs','none')
        document.getElementById("buscar_historial").style.display="block";
        document.getElementById("labelbuscar_historial").style.display="block";
        ValidateVarchar('buscar_historial');
        
    }
    input.value=""
}
function findHistorial() {
    var campo=document.getElementById('campo').value;
    if (campo=="ROL") {
        var dato=document.getElementById('rol_buscar').value;
    }
    else if(campo=="CONTRATACION") {
        var dato=document.getElementById('contratacion_buscar').value;
    }
    else if(campo=="CATEGORIA") {
        var dato=document.getElementById('categoria_buscar').value;
    }
    else if(campo=="DEDICACION") {
        var dato=document.getElementById('dedicacion_buscar').value;
    }
    else if(campo=="DISPONIBILIDAD") {
        var dato=document.getElementById('disponibilidad_buscar').value;
    }
    else {
        var dato=document.getElementById('buscar_historial').value.toUpperCase();
    }
    if (dato!="") {
        datoarray=dato.split(" ");
        if (dato.length>0) {
            let newDato="";
            for (let index = 0; index < datoarray.length; index++) {
                if (newDato=="") {
                    newDato=datoarray[index];
                }
                else {
                    newDato=newDato+"+"+datoarray[index];
                }
            }
            dato=newDato;
        }
        
        if (dato=="MULTIDICIPLINARIA" && campo=='TIPO') {
            refresh(1,'',"1",campo);
        }
        else if (dato=="DICIPLINARIA" && campo=='TIPO'){
            refresh(1,'',"0",campo);
        }
        else {
            refresh(1,'',dato,campo);
        }
        
    }
  
}
refresh('','','','');