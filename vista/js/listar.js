var valores=[];
function TableName() {
    var rol=document.querySelectorAll(".rol");
    var tipo=document.querySelectorAll(".tipo");
    if (rol!="") {
        for (let index = 0; index < rol.length; index++) {
           if (rol[index].innerText==0) {
               rol[index].innerText="PROFESOR";
           }
           if (rol[index].innerText==1) {
                rol[index].innerText="ADMINISTRADOR";
           }
        }
    }
    if (tipo!="") {
        for (let index = 0; index < tipo.length; index++) {
           if (tipo[index].innerText==0) {
               tipo[index].innerText="DICIPLINARIA";
           }
           if (tipo[index].innerText==1) {
                tipo[index].innerText="MULTIDICIPLINARIA";
           }
        }
    }
}
function ActiveModificar(fila,container) {
    valores=[];
    filas=document.querySelectorAll(fila);
    for (let index = 0; index < filas.length; index++) {
        if (filas[index].innerText=="PROFESOR" || filas[index].innerText=="DICIPLINARIA") {
            valores.push('0');
        }
        else if (filas[index].innerText=="ADMINISTRADOR" || filas[index].innerText=="MULTIDICIPLINARIA") {
            valores.push('1');
        }
        else {
            valores.push(filas[index].innerText);
        }
    
    }
    if (container!="") {
        Modificar(container,"grid",valores);
        LabelInput();
    }
   
}
function refresh(page,tabla,campo,dato) {
    setTimeout(() => {
        OnLoad('active');
        if (container_url=="profesor-historial-grid" || container_url=="materia-historial-grid" ||
            container_url=="carrera-historial-grid" || container_url=="aula-historial-grid") {
            if (page=='') {
                page=localStorage.getItem('pagina');
            }
            if (tabla=='') {
                tabla=localStorage.getItem('tabla');
            }
            if (campo=='') {
                campo=localStorage.getItem('campo');
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
            $('#refresh').load('listar.php?page='+page+'&tabla='+tabla+'&campo='+campo+'&dato='+dato);
            setTimeout(() => {
                TableName();
                SelectValidation();
            }, 100);
            setTimeout(() => {
                document.querySelector(".listar-container").style.display="grid";
            }, 300);
        }
    }, 200);
    
  
}
function SelectValidation() {
    var campo=document.getElementById('campo').value;
    var input=document.getElementById('buscar_historial');
    if (campo=='CEDULA' || campo=='TELEFONO') {
        input.removeEventListener("keypress",KeyNumeros)
        input.removeEventListener("keypress",KeyTexto)
        input.removeEventListener("keypress",KeyVarchar)
        ValidateNumeros('buscar_historial');
        
    }
    else if (campo=='PRIMER_NOMBRE' || campo=='SEGUNDO_NOMBRE' || campo=='PRIMER_APELLIDO' || campo=='SEGUNDO_APELIDO'
            || campo=='ROL') {
        input.removeEventListener("keypress",KeyNumeros)
        input.removeEventListener("keypress",KeyTexto)
        input.removeEventListener("keypress",KeyVarchar)
        ValidateTexto('buscar_historial');
        
    }
    else {
        input.removeEventListener("keypress",KeyNumeros)
        input.removeEventListener("keypress",KeyTexto)
        input.removeEventListener("keypress",KeyVarchar)
        ValidateVarchar('buscar_historial');
        
    }
    input.value=""
}
function findHistorial() {
    var dato=document.getElementById('buscar_historial').value.toUpperCase() ;
    var campo=document.getElementById('campo').value;
    if (dato!="") {
        refresh(1,'',dato,campo);
    }
  
}
refresh('','','','');
TableName();