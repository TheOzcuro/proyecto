// ----------------------------------VARIABLES---------------------------------
//VARIABLES PARA ANIMAR EL MENU LATERAL
var click=0;
var comparechild=0;


// ----------------------------------VARIABLES---------------------------------




//--------------------------------------------FUNCIONES--------------------------------
function AppearsAndDissapear(appear,firstdiss,secondiss,display) {
    document.getElementById(firstdiss).style.display="none";
    document.getElementById(secondiss).style.display="none";
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
    var url=window.location.href;
    url=url.slice(-5);
    if (url=="#aula") {
        AppearsAndDissapear("aula-container","profesor-container","materia-container","flex")
    }
    if (url=="profe") {
        AppearsAndDissapear("profesor-container","materia-container","aula-container","grid")
    }
    if (url=="mater") {
        AppearsAndDissapear("materia-container","profesor-container","aula-container","flex")
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
    else {
        
    }
    
}
function ValidateTexto(input){
    var x=new RegExp("[A-Za-z ]+")
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
//--------------------------------------------FUNCIONES--------------------------------
/*
document.getElementById("materia").addEventListener("click", function(){
    AppearsAndDissapear("materia-container","profesor-container","aula-container","flex")})
document.getElementById("profesor").addEventListener("click", function(){
    AppearsAndDissapear("profesor-container","materia-container","aula-container","grid")})
document.getElementById("aula").addEventListener("click", function(){
    AppearsAndDissapear("aula-container","profesor-container","materia-container","flex")})
*/
//----------------------------------------EJECUTAR FUNCIONES------------------------------------
ValidateTexto('primer_nombre');
ValidateTexto('segundo_nombre');
ValidateTexto('primer_apellido');
ValidateTexto('segundo_apellido');
ValidateTexto('tipo_materia');
ValidateTexto('nombre_aula');
ValidateNumeros('cedula');
ValidateNumeros('telefono');
ValidateNumeros('codigo_materia');
ValidateNumeros('codigo_aula');
OnLoad();
//----------------------------------------EJECUTAR FUNCIONES------------------------------------
