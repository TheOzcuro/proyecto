let div_horario="";
let span_data="";
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
            if (form=="oferta") {
                document.querySelector("#"+form).querySelector(".input-update").value=valores[1];
            }
            else {
                document.querySelector("#"+form).querySelector(".input-update").value=valores[0];
            }
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
    var ValidePrincipal=false;
    form=document.querySelector(form);
    drop=form.querySelector('.drop_add');
    span=drop.querySelectorAll('span');
   
    if (add_array!=span.length) {
        valideTrue=true;
    }
    if (form.querySelector('.principal_input').value!=valores[0] && form.querySelector('.principal_input').value!="") {
        ValidePrincipal=true;
        carrera=document.getElementById("carreras_unidad").value.toUpperCase();
        if (span.length==0) {
            carrera_array=carrera.split(" **");
            console.log(carrera_array);
            localStorage.setItem('carrera',carrera_array[0]);
        }
        else {
            localStorage.setItem('carrera',carrera);
        }
        
    }
    if (valideTrue==true && ValidePrincipal==true) {
       form.querySelector(".input-update").value=valores[0];
        OnLoad("active");
        form.querySelector(".input-url").value=container_url+"-grid";
        form.submit();
    }
    else {
        Error("Tiene que hacer algun cambio si desea guardar", "msg_error", "p_error");
    }
}
function SaveMaterias() {
    var ValideCarrera=false;
    let carrera=document.getElementById('carreras');
    let drop=document.getElementById('materias_add_drop');
    let span=drop.querySelectorAll('span');
    let drop_main=document.getElementById('carreras_drop');
    let span_main=drop_main.querySelectorAll('span');
    let drop_multi=document.getElementById('materias_add_drop_unidad');
    let span_multi=drop_multi.querySelectorAll('span');
    let form=document.getElementById('materia');
    for (let index = 0; index < span_main.length; index++) {
        if (carrera.value.toUpperCase()==span_main[index].innerText) {
             carrera_id=span_main[index].id;
             if (span.length==0 && span_multi.length==0) {
                carrera_array=carrera.value.split(" **");
                localStorage.setItem('carrera',carrera_array[0]);
            }
            else {
                localStorage.setItem('carrera',carrera.value);
            }
             ValideCarrera=true;
        }
        if (carrera.value=="") {
            carrera.style.borderColor='red';
        }
     }
     console.log(add_array);
     console.log(span.length);
     console.log(ValideAddMateria);
     console.log(ValideDelMateria);
     console.log(form.querySelector('#add_multi').value)
     console.log(form.querySelector('#del_multi').value)
     console.log(form.querySelector('#add').value)
     console.log(form.querySelector('#del').value)
     if (ValideCarrera && ValideAddMateria>0 || ValideDelMateria>0) {
        form.querySelector(".input-update").value=carrera_id;
        form.querySelector(".input-url").value=container_url+"-grid";
        form.submit();
     }
     else {
         Error("Tiene que hacer algun cambio si desea guardar", "msg_error", "p_error");
     }
}
function SaveDisponibilidad() {
    var ValideCarrera=false;
    var ValideSpan=false;
    var ValideDias=false;
    div=document.getElementById('disponibilidad-container');
    cedula=div.querySelector('#cedula_dis');
    dias=div.querySelectorAll('.input-dis');
    bloques_add=div.querySelectorAll('.input_add');
    bloques_add_drop=div.querySelectorAll('.drop_add');
    drop_dis=div.querySelector('#disponibilidad_drop');
    span_main_mod=drop_dis.querySelectorAll('span');
    profesor_array=cedula.value.split(" **");
    form=document.getElementById('disponibilidad');
    diasarray=[];
    totalspan=0;
    ValideSubmit=SubmitDisponibilidad('active');
    OnLoad('active');
    for (let index = 0; index < bloques_add_drop.length; index++) {
        span_dis=bloques_add_drop[index].querySelectorAll('span');
        totalspan=totalspan+span_dis.length;
    }
    for (let index = 0; index < dias.length; index++) {
        if (dias[index].value!=dias_main[index] && dias[index].value!="") {
            ValideDias=true
        }
        if(dias[index].value!="") {
            diasarray.push(dias[index].value);
        }
    }
    for (let index = 0; index < dias_main.length; index++) {
        if (diasarray[index]!=dias_main[index]) {
            ValideDias=true
        }
    }
    for (let index = 0; index < dias_main.length; index++) {
        if (dias[index].value==dias_main[index]) {
            bloque=document.getElementById(dias[index].getAttribute('value')).querySelectorAll('span');
            if (bloque.length==0) {
                ValideSubmit=true
            }
        }
    }
    for (let index = 0; index < span_main_mod.length; index++) {
        
        if (cedula.value.toUpperCase()==span_main_mod[index].innerText) {
             carrera_id=profesor_array[0];
             array=span_main_mod[index].getAttribute('value').split('/');
             if (totalspan==0) {
                localStorage.setItem('disponibilidad',profesor_array[0]);
                localStorage.setItem('disponibilidad_n',array[0]+" "+array[1])
                localStorage.setItem('disponibilidad_c',array[2])
            }
            else {
              
                localStorage.setItem('disponibilidad',cedula.value);
                localStorage.setItem('disponibilidad_n',array[0]+" "+array[1])
                localStorage.setItem('disponibilidad_c',array[2])
            }
             ValideCarrera=true;
        }
        if (carrera.value=="") {
            carrera.style.borderColor='red';
        }
     }
     if (totalspan!=add_disponibilidad) {
         ValideSpan=true;
     }
     if (ValideSubmit && ValideDias) {
        ValideSpan=true;
     }
     if (ValideCarrera && ValideSpan && ValideSubmit) {
        for (let index = 0; index < bloques_add_drop.length; index++) {
            span=bloques_add_drop[index].querySelectorAll("span");
            if (span.length>0) {
                id=bloques_add_drop[index].getAttribute('value');
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
        for (let index = 0; index < dias.length; index++) {
            if (dias[index].value!="") {
                break
            }
            else if(index==4) {
                localStorage.setItem('disponibilidad',profesor_array[0]);
                localStorage.setItem('disponibilidad_n',array[0]+" "+array[1])
                localStorage.setItem('disponibilidad_c',array[2])
            }
            
        }
        form.querySelector(".input-update").value=carrera_id;
        form.querySelector(".input-url").value=container_url+"-grid";
        console.log(form.querySelector(".input-url").value)
        form.submit();
     }
     else {
         if (ValideSubmit==true) {
            Error("Tiene que hacer algun cambio si desea guardar", "msg_error", "p_error");
         }
         localStorage.setItem('disponibilidad',"");
         localStorage.setItem('disponibilidad_n',"");
         localStorage.setItem('disponibilidad_c',"");
     }
}
function Delete(form,valor) {
    console.log(form);
    console.log(document.querySelector(form))
        if (valores!="" && form!="#unidad") {
            document.querySelector(form).querySelector(".input-delete").value=valores[0];
        }
        else if(form=="#pensum") {
            document.querySelector("#materia").querySelector(".input-delete").value=valor;
            form="#materia";
        }
        else if(form=="#unidad") {

            drop=document.getElementById('materias_add_drop_unidad');
            span=drop.querySelectorAll('span');
            input_delete=document.querySelector(form).querySelector(".input-delete");
            for (let index = 0; index < span.length; index++) {
                if (input_delete.value!="") {
                    input_delete.value=input_delete.value+","+span[index].id;
                }
                else {
                    input_delete.value=span[index].id;
                }
            }
        }   
        else if (valor!="" && form!="#unidad") {
            document.querySelector(form).querySelector(".input-delete").value=valor;
        }
        OnLoad("active");
        document.querySelector(form).querySelector(".input-url").value=container_url+"-grid";
        console.log(document.querySelector(form).querySelector(".input-url").value)
        document.querySelector(form).submit();
    }
function Modificar(container,display,valores) {
         div_edit=document.getElementById(container);
         AppearsAndDissapear(div_edit.id,display)
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

        if (container=="materia-container") {
            document.getElementById('tipo_materia_multi').value=1;
        }
    }
function Close() {
        DissapearVarious(".checkbox-edit","none")
        if (div_edit.id=="disponibilidad-container") {
            button=div_edit.querySelectorAll('button');
            button[0].style.display="block";
            button[1].style.display="none";
            button[2].style.display="none";
            dias=div_edit.querySelectorAll('.input-dis');
            bloques_add_drop=div_edit.querySelectorAll('.drop_add');
            bloques_add=div_edit.querySelectorAll('.input_add');
            for (let index = 0; index < dias.length; index++) {
                dias[index].value="";
            }
            for (let index = 0; index < bloques_add_drop.length; index++) {
                for (let index = 0; index < bloques_add_drop.length; index++) {
                    bloques_add[index].value="";
                    span_bloques=bloques_add_drop[index].querySelectorAll('span');
                    for (let i = 0; i < span_bloques.length; i++) {
                        span_bloques[i].remove();
                    }
                }
            }
        }
        else if (div_edit.id=="pensum-container") {
            button[0].style.display="block";
            button[1].style.display="none";
            button[2].style.display="none";
        }
        else {
            button[0].style.display="block";
            button[1].style.display="block";
            button[2].style.display="none";
            button[3].style.display="none";
        }
        DissapearVarious('.dis','block');
        DissapearVarious('.das','none');
        document.getElementById('tipo_materia').value="";
        console.log(button.length);
        if (button.length>4) {
            button[4].style.display="none";
            button[5].style.display="none";
        }
        var input=div_edit.querySelectorAll(".input");
        var label=div_edit.querySelectorAll("label");
        for (let index = 0; index < input.length; index++) {
            input[index].disabled=false
            input[index].value=""
        }
        for (let index = 0; index < label.length; index++) {
            if (div_edit.id!="lapso_academico-container") {
                label[index].style.top="20px";
                label[index].style.fontSize="18px";
            }
            
        }
        console.log(div_edit.id)
        if (div_edit.id=="profesor-container") {
            div_edit.querySelector("h2").innerHTML="Profesor"
        }
        if (div_edit.id=="aula-container") {
            div_edit.querySelector("h2").innerHTML="Aula"
        }
        if (div_edit.id=="carrera-container") {
            div_edit.querySelector("h2").innerHTML="Carrera"
        }
        if (div_edit.id=="pensum-container") {
            document.getElementById('carreras').value="";
            CreateMaterias(document.getElementById('carreras').value);
            div_edit.querySelector("h2").innerHTML="Unidad Curricular";
            button[1].style.display="none";
        }
        if (div_edit.id=="oferta-container") {
            div_edit.querySelector("h2").innerHTML="Oferta Academica";
        }
        document.getElementById('tipo_materia_multi').value=1;
        OnLoad();
        div_edit.querySelector(".close-icon").style.display="none"
        document.getElementById("buscar_profesor").value=""
        div_edit="";
    }
function DisplayHorario(display,div,bloque) {
    span_data=[];
    div_horario=div;
    span=bloque.querySelectorAll('span');
    input_div=document.querySelector(div_horario).querySelectorAll('input');
    label_div=document.querySelector(div_horario).querySelectorAll('label');
    drop_div=document.querySelector(div_horario).querySelectorAll('.dropdown');
    input=document.querySelector(div_horario).querySelectorAll('.input');
    button=document.querySelector(div_horario).querySelectorAll('button');
    for (let index = 0; index < input.length; index++) {
        if (span[index].innerText!="") {
            span_value=span[index].innerText.split(': ');
            input[index].value=span_value[1];
            span_data.push(span_value[1]);
        }
       
    }
    if (span[0].innerText!="") {
        GetMateriasHorario(input_div[0].id,"",input_div[3].value,input_div[4].value, label_div[0].id,input_div[1].id,drop_div[1].id,input_div[2].id,drop_div[2].id,document.getElementById('codigo_lapso_horario').value);
        button[1].hidden=false;
        button[1].style.width='100px';
        button[0].style.width='100px';
        button[1].style.marginLeft='200px';
        button[0].style.marginLeft='-15px';
        

    }
    LabelInput();
    document.querySelector(".blackcover").removeEventListener("click",UnDisplayHorario);
    document.querySelector(".blackcover").addEventListener("click", UnDisplayHorario)
    document.querySelector(".blackcover").style.display=display;
    document.querySelector(div).style.display=display;
}
function UnDisplayHorario(){
    document.querySelector(div_horario).style.display="none";
    input=document.querySelector(div_horario).querySelectorAll('.input');
    for (let index = 0; index < input.length; index++) {
        input[index].value="";
        
    }
    document.querySelector(".blackcover").style.display='none';
}
function DisplayDelete(display,div,form,valor) {
        console.log(form)
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