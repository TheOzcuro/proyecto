var click=0;
var eyes="";
function Submit() {
    const pass=document.getElementById("contra").value;
    const passcon=document.getElementById("con").value;
    var x=new RegExp("^(?=.*[A-Za-z])(?=.*[0-9]).{8,}");
    if (pass!="" && passcon!="" && pass==passcon && x.test(pass)) {
        document.regpass.submit();
    }
    else if (x.test(pass)==false) {
        Error("La contraseña debe contener mas de 8 caracteres y contener una letra y un numero","msg_error","p_error")
    }
    else if (pass!=passcon) {
        Error("Las contraseñas no coiciden","msg_error","p_error")
    }
    else {
        document.getElementById("contra").style.borderColor="red";
        document.getElementById("con").style.borderColor="red";
    }
}
function ValidateNumeros(input){
    var x=new RegExp("[a-zA-Z0-9.]+")
    var inputs=document.getElementById(input)
    inputs.addEventListener("keypress", function(){
        if (x.test(event.key)) {
        }
        else {
            event.preventDefault();
        }
    })
}
function SeePass(input,eye) {
    var srceye=document.getElementById(eye).src.slice(43,60)
    if (srceye=="eye_close.png") {
        document.getElementById(eye).src="css/img/eye_open.png";
        document.getElementById(input).type="text"
        
    }
    if (srceye=="eye_open.png") {
        document.getElementById(eye).src="css/img/eye_close.png";
        document.getElementById(input).type="password"
        click=0;
    }
}
ValidateNumeros("contra")