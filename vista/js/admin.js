// ----------------------------------VARIABLES---------------------------------
//VARIABLES PARA ANIMAR EL MENU LATERAL
var click=0;
var comparechild=0;
var button=[];
var div_edit="";
let valores_origin=[];



// ----------------------------------VARIABLES---------------------------------




//--------------------------------------------FUNCIONES--------------------------------
function AppearsAndDissapear(appear,display) {
    DissapearVarious(".container","none")
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
        for (let index = 0; index < 6; index++) {
            if (index==child) {
                const div=document.querySelector(".slide-menu").children[child];
                if (click>=2 && comparechild==child) {
                    div.children[1].style.transform = "rotate(0)";
                    div.children[2].style.maxHeight = "0";
                    click=0
                }
                else {
                    div.children[1].style.transform = "rotate(180deg)";
                    div.children[2].style.maxHeight = "120px";
                    
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
function OnLoad(){
    //Tomo la url de la pagina
    const url=window.location.href;
    //Creo un Regex donde estaran los divs de los formularios cada uno con su respectivo nombre
    var x=/([(profesor+\-container)(materia\-container)(aula\-container)(carrera\-container)])\w+/g;
    //Busco la coicidencias dentro del regex previamente creado
    var container=url.match(x)
    //Guardo el tipo de display que utiliza el formulario ya sea flex o grid
    var display=url.slice(-4)
    //Creo el nombre del div correspodiente
    container=container[6]+container[7]
    //Muestro el div al usuario
    if (container!="") {
        AppearsAndDissapear(container,display)
    }
    
}
function CreateDatos() {
    var cedula=document.getElementById("cedula").value;
    var rol=document.getElementById("rol").value;
    var primer_nombre=document.getElementById("primer_nombre").value;
    var segundo_nombre=document.getElementById("segundo_nombre").value;
    var primer_apellido=document.getElementById("primer_apellido").value;
    var segundo_apellido=document.getElementById("segundo_apellido").value;
    var direccion=document.getElementById("direccion").value;
    var telefono=document.getElementById("telefono").value;
    var codigo_materia=document.getElementById("codigo_materia").value;
    var nombre_materia=document.getElementById("nombre_materia").value;
    var tipo_materia=document.getElementById("tipo_materia").value;
    var codigo_aula=document.getElementById("codigo_materia").value;
    var nombre_aula=document.getElementById("nombre_materia").value;
    var codigo_carrera=document.getElementById("codigo_carrera").value;
    var nombre_carrera=document.getElementById("nombre_carrera").value;
    var buscar_profesor=document.getElementById("buscar_profesor").value;
    var buscar_materia=document.getElementById("buscar_materia").value;
}
function LabelOut(input,label){
    var inputs = document.getElementById(input).value;
    if (inputs=="") {
        document.getElementById(label).style.top = "20px";
        document.getElementById(label).style.fontSize = "18px";
        document.getElementById(input).style.borderColor= "rgb(225, 32, 109)"
    }
    else {
        document.getElementById(input).style.borderColor= "rgb(32, 190, 109)"
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
function Submit(){
    CreateDatos()
    if (cedula.value!="" && rol.value!="" && primer_nombre.value!="" && segundo_nombre.value!="" && primer_apellido.value!="" && segundo_apellido.value!="" && direccion.value!="" && telefono.value!="") {
        document.profesor.submit();
    }
    if (codigo_materia.value!="" && nombre_materia.value!="" && tipo_materia.value!="") {
        document.materia.submit();
    }
    if (codigo_aula.value!="" && nombre_aula.value!="") {
        document.aula.submit();
    }
    if (codigo_carrera.value!="" && nombre_carrera.value!="") {
        document.carrera.submit();
    }
    if (buscar_profesor.value!="") {
        document.find_profesor.submit();
    }
    if (buscar_materia.value!="") {
        document.find_materia.submit();
    }
    if (buscar_aula.value!="") {
        document.find_aula.submit();
    }
    else {
        
    }
    
}
function ValidateTexto(input){
    var x=new RegExp("[A-Za-z-ñ]+")
    var inputs=document.getElementById(input)
    inputs.addEventListener("keypress", function(){
        if (x.test(event.key)) {
        }
        else {
            event.preventDefault();
        }
    })
}
function ValidateNumeros(input){
    var x=new RegExp("[0-9]+")
    var inputs=document.getElementById(input)
    inputs.addEventListener("keypress", function(){
        if (x.test(event.key)) {
        }
        else {
            event.preventDefault();
        }
    })
}
function ValidateVarchar(input){
    var x=new RegExp("[A-Za-z0-9-ñ ]+")
    var inputs=document.getElementById(input)
    inputs.addEventListener("keypress", function(){
        if (x.test(event.key)) {
        }
        else {
            event.preventDefault();
        }
    })
}
function CheckboxDisabled(input, check) {
   if (check.checked) {
    document.getElementById(input).disabled=true;
   }
   else {
    document.getElementById(input).disabled=false;
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
function Save(form) {
    var input=div_edit.querySelectorAll("input[type=text]");
    var valideTrue=false;
    var valideFalse="";
    for (let index = 0; index < input.length; index++) {
        if (input[index].value!=valores[index] && input[index].value!="") {
            valideTrue=true;
        }
        if( input[index].value=="") {
            valideFalse="false"
        }
    }
    if (div_edit.id=="profesor-container") {
        select=div_edit.querySelector("select");
        if (select.value!=valores_origin[1] && select.value!="") {
            valideTrue=true
        }
        if (select.value=="") {
            valideFalse="false"
        }
    }
    if (valideTrue==true && valideFalse=="") {
        console.log("funciono")
        if (div_edit.id=="profesor-container") {
            div_edit.querySelector("select").disabled=false;
        }
        for (let index = 0; index < input.length; index++) {
            input[index].disabled=false;
            
        }
        document.querySelector("#"+form).querySelector(".input-update").value=valores_origin[0];
        document.querySelector("#"+form).submit();
    }
    else {
        console.log("error")
    }
}
function Delete(form) {
    document.querySelector(form).querySelector(".input-delete").value=valores_origin[0];
    document.querySelector(form).submit();
}
function Modificar(container,display,valores) {
     div_edit=document.getElementById(container);
     AppearsAndDissapear(div_edit.id,display)
     div_edit.querySelector("h2").innerHTML="Editar Datos";
     div_edit.querySelector(".close-icon").style.display="block";
    //---Hacer aparecer los botones correspondientes
    button=div_edit.querySelectorAll("button");
    button[0].style.display="none";
    button[1].style.display="block";
    button[2].style.display="block";
    for (let index = 0; index < valores.length; index++) {
        valores_origin.push(valores[index]);
        
    }
    //-----------------------------------------------

    //Se guardan en variables los elementos que vamos a utilizar
    var checkbox=div_edit.querySelectorAll(".checkbox-edit");

    //-----Se verifica que el div seleccionado sea el de profesor
    if (container=="profesor-container") {
        //Se procede a desactivar el select y darle los valores previamente buscados
        div_edit.querySelector("select").disabled=true;
        div_edit.querySelector("select").value=valores[1];
        //Se elimina un valor en especifico de el array de valores para evitar incovenientes
        
        valores.splice(1,1);
    }

    //----Contadores para el while
    //--- x para las checkbox
    x=0
     //--- y para los inputs
     y=0
     //--- l para los label
     l=0
    //---contadores para los while


    totalcheck=checkbox.length;
    while (x<totalcheck) {
        checkbox[x].style.display="block";
        checkbox[x].checked=true;
        x=x+1 
    }
    
     var input=div_edit.querySelectorAll("input");
     var label=div_edit.querySelectorAll("label");
     totalinput=input.length;
     while (y<totalinput) {
        if (input[y].type=="text") {
            LabelAnimation(input[y].id,label[l].id)
            input[y].disabled=true
            input[y].value=valores[l]
            l=l+1
        }
        y=y+1
    }
   
}
function Close() {
    DissapearVarious(".checkbox-edit","none")
    button[0].style.display="block";
    button[1].style.display="none";
    button[2].style.display="none";
    var input=div_edit.querySelectorAll("input");
    var label=div_edit.querySelectorAll("label");
    totalinput=input.length;
    y=0;
    l=0;
    while (y<totalinput) {
        if (input[y].type=="text") {
            input[y].disabled=false
            input[y].value=""
           document.getElementById(label[l].id).style.top = "20px";
            document.getElementById(label[l].id).style.fontSize = "18px";
            l=l+1
        }
        y=y+1
    }
    if (div_edit.id=="profesor-container") {
        div_edit.querySelector("h2").innerHTML="Registrar Profesor"
        div_edit.querySelector("select").value="";
        div_edit.querySelector("select").disabled=false;
        AppearsAndDissapear("profesor-find","flex")
    }
    if (div_edit.id=="materia-container") {
        div_edit.querySelector("h2").innerHTML="Registrar Materia";
        AppearsAndDissapear("materia-find","flex");
    }
    if (div_edit.id=="aula-container") {
        div_edit.querySelector("h2").innerHTML="Registrar Aula"
    }
    if (div_edit.id=="carrera-container") {
        div_edit.querySelector("h2").innerHTML="Registrar Carrera"
    }
    div_edit.querySelector(".close-icon").style.display="none"
    document.getElementById("buscar_profesor").value=""
}
function DisplayDelete(display, form) {
    if (display=="block") {
        document.querySelector(".container-delete").style.display=display
        document.querySelector(".delete-window").style.display=display
        document.querySelector(".delete-window").style.animationName="Appear"
        document.getElementById("yes-delete").addEventListener("click", function(){
            Delete(form)})
        
    }
    else {
        document.querySelector(".container-delete").style.display=display
        document.querySelector(".delete-window").style.display=display
    }
   
}
//--------------------------------------------FUNCIONES--------------------------------

//----------------------------------------EJECUTAR FUNCIONES------------------------------------
document.getElementById("registrarMateria").addEventListener("click", function(){
    if (div_edit!="") {
        Close()
    }
    AppearsAndDissapear("materia-container","flex")})

document.getElementById("registrarProfesor").addEventListener("click", function(){
    if (div_edit!="") {
        Close()
    }
    AppearsAndDissapear("profesor-container","grid")})

document.getElementById("registrarAulas").addEventListener("click", function(){
    if (div_edit!="") {
        Close()
    }
    AppearsAndDissapear("aula-container","flex")})

document.getElementById("registrarCarreras").addEventListener("click", function(){
    if (div_edit!="") {
        Close()
    }
    AppearsAndDissapear("carrera-container","flex")})

document.getElementById("editarProfesor").addEventListener("click", function(){
    if (div_edit!="") {
        Close()
    }
    AppearsAndDissapear("profesor-find","flex")})

document.getElementById("editarMateria").addEventListener("click", function(){
     if (div_edit!="") {
         Close()
    }
    AppearsAndDissapear("materia-find","flex")})

document.getElementById("editarAulas").addEventListener("click", function(){
    if (div_edit!="") {
        Close()
    }
    AppearsAndDissapear("aula-find","flex")})
ValidateTexto('primer_nombre');
ValidateTexto('segundo_nombre');
ValidateTexto('primer_apellido');
ValidateTexto('segundo_apellido');
ValidateTexto('tipo_materia');
ValidateVarchar('nombre_aula');
ValidateTexto('nombre_carrera');
ValidateNumeros('cedula');
ValidateNumeros('telefono');
ValidateNumeros('codigo_carrera');
ValidateNumeros('codigo_materia');
ValidateVarchar('codigo_aula');
OnLoad();
//----------------------------------------EJECUTAR FUNCIONES------------------------------------
