
function CheckboxDisabled(input, check, type) {
    var input=document.getElementById(input);
       if (check.checked) {
        input.disabled=true;
        input.style.borderColor=""
        if (type!="active") {
            input.value=valores[CountInput(input)];
            LabelInput();
        }
       }
       else {
        input.disabled=false;
        input.value=""
       }
      
    }
function Save(form) {
        var input=div_edit.querySelectorAll(".input");
        var valideTrue=false;
        var valideFalse="";
        ValidateDate();
        for (let index = 0; index < input.length; index++) {
            if (input[index].id=="segundo_nombre") {
                if (input[index].value!=valores[index]) {
                    valideTrue=true;
               };
            }
            else if (input[index].id=="segundo_apellido") {
               if (input[index].value!=valores[index]) {
                    valideTrue=true;
               };
               
            }
            else if (input[index].id=="telefono") {
                if (input[index].value!=valores[index]) {
                    valideTrue=true;
               };
            }
            else if (input[index].id=="telefono_fijo") {
               if (input[index].value!=valores[index]) {
                    valideTrue=true;
               };
               
            }
            else if (input[index].id=="titulo") {
                if (input[index].value!=valores[index]) {
                    valideTrue=true;
               };
            }
            else if (input[index].id=="telefono_fijo") {
               if (input[index].value!=valores[index]) {
                    valideTrue=true;
               };
               
            }
            else {
                if (input[index].value!=valores[index] && input[index].value!="") {
                    valideTrue=true;
                }
                if( input[index].value=="") {
                    input[index].style.borderColor='red'
                    valideFalse="false";
                }
            }
           
        }
        if (valideTrue==true && valideFalse=="") {
            console.log("funciono")
            for (let index = 0; index < input.length; index++) {
                input[index].disabled=false;
                
            }
            document.querySelector("#"+form).querySelector(".input-update").value=valores[0];
            OnLoad("active");
            document.getElementById(form).querySelector(".input-url").value=container_url
            document.querySelector("#"+form).submit();
        }
        else {
            Error("Parece que algunos datos estan vacios o son erroneos","msg_error","p_error")
            console.log("error")
        }
    }
function SavePensum(form) {
    var valideTrue=false;
    var valideFalse="";
    console.log(form);
    form=document.querySelector(form);
    for (let index = 0; index < add_array.length; index++) {
        if (add_array[index]!=valores[index+1]) {
            valideTrue=true
            valideFalse="";
        }
        else {
            valideFalse="false";
        }
    }
    
    if (form.querySelector('.principal_input').value!=valores[0] && form.querySelector('.principal_input').value!="") {
        valideTrue=true
        valideFalse="";
    }

    if (valideTrue=true && valideFalse=="") {
       form.querySelector(".input-update").value=valores[0];
        OnLoad("active");
        form.querySelector(".input-url").value=container_url;
        form.querySelector('.principal_input').disabled=false;
        form.submit();
    }
    else {
        console.log("error")
    }
}
function Delete(form,valor) {
        if (valores!="") {
            document.querySelector(form).querySelector(".input-delete").value=valores[0];
        }
       else if (valor!="") {
            document.querySelector(form).querySelector(".input-delete").value=valor;
        }
        OnLoad("active");
        document.querySelector(form).querySelector(".input-url").value=container_url;
        console.log(document.querySelector(form).querySelector(".input-url").value)
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
        button[1].style.display="none";
        button[2].style.display="block";
        button[3].style.display="block";
        //-----------------------------------------------
    
        //Se guardan en variables los elementos que vamos a utilizar
        var checkbox=div_edit.querySelectorAll(".checkbox-edit");
        //----Contadores para el while
        //--- x para las checkbox
       for (let index = 0; index < checkbox.length; index++) {
            checkbox[index].style.display="block";
            checkbox[index].checked=true;
       }
        var input=div_edit.querySelectorAll(".input");
      
        for (let index = 0; index < input.length; index++) {
                input[index].disabled=true
                input[index].value=valores[index]
             
         }
    }
function Close() {
        DissapearVarious(".checkbox-edit","none")
        button[0].style.display="block";
        button[1].style.display="block";
        button[2].style.display="none";
        button[3].style.display="none";
        var input=div_edit.querySelectorAll(".input");
        var label=div_edit.querySelectorAll("label");
        for (let index = 0; index < input.length; index++) {
            input[index].disabled=false
            input[index].value=""
        }
        document.getElementById('materias').disabled=false;
        document.getElementById('materias_add').disabled=false;
        for (let index = 0; index < label.length; index++) {
            if (div_edit.id!="lapso_academico-container") {
                label[index].style.top="20px";
                label[index].style.fontSize="18px";
            }
            
        }
        if (div_edit.id=="profesor-container") {
            div_edit.querySelector("h2").innerHTML="Profesor"
        }
        if (div_edit.id=="materia-container") {
            div_edit.querySelector("h2").innerHTML="Materia";
        }
        if (div_edit.id=="aula-container") {
            div_edit.querySelector("h2").innerHTML="Aula"
        }
        if (div_edit.id=="carrera-container") {
            div_edit.querySelector("h2").innerHTML="Carrera"
        }
        if (div_edit.id=="pensum-container" || div_edit.id=="oferta-container") {
            ClearSpan();
            span_array=[];
        }
        OnLoad();
        div_edit.querySelector(".close-icon").style.display="none"
        document.getElementById("buscar_profesor").value=""
        div_edit="";
    }
function DisplayDelete(display,div,form,valor) {
        document.querySelector(".blackcover").addEventListener("click", function(){
            DisplayDelete("none",div,form)})
            var input=document.querySelector(div).querySelector("input");
        if (display!="") {
            document.querySelector(".blackcover").style.display=display;
            document.querySelector(div).style.display=display;
            document.querySelector(div).style.animationName="Appear";
            if (input!=undefined) {
                input.focus();
            }
            document.getElementById("yes-delete").addEventListener("click", function(){
                Delete(form,valor)})
            
        }
        else {
            document.querySelector(".blackcover").style.display="none"
            document.querySelector(div).style.display="none"
        }
       
    }