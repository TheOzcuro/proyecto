function Submit() {
    const pass=document.getElementById("contra").value;
    const passcon=document.getElementById("con").value;
    if (pass!="" && passcon!="" && pass==passcon) {
        document.regpass.submit();
    }
    else if (pass!=passcon) {
        document.getElementById("first-pass").innerHTML="Las contraseñas no coinciden"
    }
    else {
        document.getElementById("contra").style.borderColor="red";
        document.getElementById("con").style.borderColor="red";
    }
}