// ----------------------------------VARIABLES---------------------------------
//VARIABLES PARA ANIMAR EL MENU LATERAL
var click=0;
var comparechild=0;
var button=[];
var div_edit="";
var container_url="";

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

function OnLoad(active){
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
    container_url=container+"-"+display;
    if (container!="" && active!="active") {
        AppearsAndDissapear(container,display)
    }
}
function LabelInput() {
     //--- y para los inputs
     y=0
     //--- l para los label
     l=0
     var input=document.querySelectorAll(".input-label");
     var label=document.querySelectorAll("label");
     totalinput=input.length;
     while (y<totalinput) {
         if (input[y].value!="") {
             LabelAnimation(input[y].id,label[y].id)
         }
         y=y+1
     }
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
function Submit(form){
   var div=document.getElementById(form).querySelector("div");
   var input=div.querySelectorAll(".input");
   var valide=true;
   for (let index = 0; index < input.length; index++) {
       if (input[index].id=="segundo_nombre" || input[index].id=="segundo_apellido") {
           
       }
       else {
            if (input[index].value=="") {
            valide=false;
 
         }
       }
      
       
   }
   console.log(valide);
   if (valide) {
        OnLoad("active")
        document.getElementById(form).querySelector(".input-url").value=container_url;
        document.getElementById(form).submit();
   }
}
function KeyTexto() {
    var x=new RegExp("[A-Za-z-ñ]+")
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
    span = div.getElementsByTagName("span");
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
    span=span.textContent || span.innerText;
    document.getElementById(input).value=span;
    LabelInput();
}
function AddAndRemove(div,div_add,input,input_add) {
    //VARIABLES
    var input_add=document.getElementById(input_add)
    var input=document.getElementById(input);
    var span_add=document.createElement("span");
    var div=document.getElementById(div);
    var div_add=document.getElementById(div_add);
    var span=div.querySelectorAll("span");
    //VARIABLES
    if (input!="") {
        for (let index = 0; index < span.length; index++) {
        if (span[index].innerText==input.value.toUpperCase()) {
            input_add.value=input.value.toUpperCase();
            span_add.innerHTML=input.value.toUpperCase();
            span_add.onclick=function () {AddValueMateria(input_add.id, this)}
            span[index].remove();
            div_add.appendChild(span_add);
            add.push(span[index].getAttribute('value'));
            console.log(add);
            input.value="";
            LabelInput();
            Search(input.id,div.id)
        }
        }
        
    }
    
}
//--------------------------------------------FUNCIONES--------------------------------

//----------------------------------------EJECUTAR FUNCIONES------------------------------------
document.getElementById("registrarMateria").addEventListener("click", function(){
    if (div_edit!="") {
        Close()
    }
    AppearsAndDissapear("materia-container","grid")})

document.getElementById("registrarProfesor").addEventListener("click", function(){
    if (div_edit!="") {
        Close()
    }
    AppearsAndDissapear("profesor-container","grid")})

document.getElementById("registrarAulas").addEventListener("click", function(){
    if (div_edit!="") {
        Close()
    }
    AppearsAndDissapear("aula-container","grid")})

document.getElementById("registrarCarreras").addEventListener("click", function(){
    if (div_edit!="") {
        Close()
    }
    AppearsAndDissapear("carrera-container","grid")})

document.getElementById("crearLapso").addEventListener("click", function(){
    if (div_edit!="") {
           Close()
    }

    AppearsAndDissapear("lapso-container","grid")})
document.getElementById("historialProfesor").addEventListener("click", function(){
if (div_edit!="") {
     Close()
    }
    DissapearVarious('.container','none');
    refresh(1,'profesor')
    
})
document.getElementById("historialMateria").addEventListener("click", function(){
    if (div_edit!="") {
         Close()
        }
    refresh(1,'materia')
    setTimeout(() => {
        AppearsAndDissapear("materia-historial","block");
    }, 200);

})
document.getElementById("historialCarreras").addEventListener("click", function(){
    if (div_edit!="") {
         Close()
        }
    refresh(1,'carrera')
    setTimeout(() => {
        AppearsAndDissapear("carrera-historial","block");
    }, 200);

})
document.getElementById("historialAulas").addEventListener("click", function(){
    if (div_edit!="") {
         Close()
        }
    refresh(1,'aula')
    setTimeout(() => {
        AppearsAndDissapear("aula-historial","block");
    }, 200);

})

    
document.getElementById("materias").addEventListener("click", function(){
    document.querySelector("#materias_drop").style.display="flex"})

document.getElementById("materias_add").addEventListener("click", function(){
    document.querySelector("#materias_add_drop").style.display="flex"})

document.getElementById("carreras").addEventListener("click", function(){
    document.querySelector("#carreras_drop").style.display="flex"})
    
document.getElementById("carreras_add").addEventListener("click", function(){
    document.querySelector("#carreras_add_drop").style.display="flex"})

document.addEventListener('mouseup', function(e) {
    var input = document.getElementById('materias');
    var input2= document.getElementById('materias_add')
    var input3= document.getElementById('carreras');
    var input4= document.getElementById('carreras_add')
    if (!input.contains(e.target)) {
        document.getElementById("materias_drop").style.display = 'none';
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
    if (!input4.contains(e.target)) {
        document.getElementById("carreras_add_drop").style.display = 'none';
        input4.style.border=""
    }
});
ValidateTexto('primer_nombre');
ValidateTexto('segundo_nombre');
ValidateTexto('primer_apellido');
ValidateTexto('segundo_apellido');
ValidateTexto('tipo_materia');
ValidateVarchar('nombre_aula');
ValidateVarchar('nombre_carrera');
ValidateNumeros('cedula');
ValidateNumeros('telefono');
ValidateVarchar('codigo_carrera');
ValidateVarchar('codigo_materia');
ValidateVarchar('codigo_aula');
OnLoad();
//----------------------------------------EJECUTAR FUNCIONES------------------------------------
