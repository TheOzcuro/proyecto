function LabelAnimation(input,label){
    document.getElementById(input).style.borderColor=""
    document.getElementById(label).style.top = "1px";
    document.getElementById(label).style.fontSize = "15px";
}
function LabelOut(input,label){
    var inputs = document.getElementById(input).value;
    if (inputs=="") {
        document.getElementById(label).style.top = "20px";
        document.getElementById(label).style.fontSize = "18px";
    }
    else {
        
    }
    
}
function Submit(){
    var usuario=document.getElementById("usuario");
    var password=document.getElementById("pass");
    if (usuario.value=="" && password.value=="") {
        password.style.borderColor="red"
        usuario.style.borderColor="red"
    }
    if (usuario.value=="") {
        usuario.style.borderColor="red"
    }
    if (password.value=="") {
        password.style.borderColor="red"
    }
    if (usuario.value!="" && password.value!="") {
        document.login.submit();
    }

}
function AppearRecover() {
    document.querySelector(".blackcover").style.display="block"
    document.querySelector(".recover").style.animationName="Appear"
}
function DissapearRecover() {
    document.querySelector(".blackcover").style.display="none"
    document.querySelector(".recover").style.animationName=""
}
function Recover() {
    if (document.getElementById("recover_cedula").value!="") {
        document.getElementById("usuario").value=document.getElementById("recover_cedula").value
        document.getElementById("pass").value="recovery"
        document.login.submit();
    }
    else {
        document.getElementById("recover_cedula").style.borderColor= "red"
    }
}
