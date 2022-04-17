let resp="no";
function userConfirm(){
    var cedula = document.querySelector("#cedula");
    const data = new FormData();
    data.append("cedula",`${cedula.value}`);
    data.append("find-user","find");
    data.append("url","paraEvitarError")
    fetch('../control/c_profesor.php', {
        method: 'POST',
        body: data
     })
     .then(function(response) {
        if(response.ok) {
            return response.text()
        } 
     })
     .then(function(response) {
        if(response=="yes"){
            cedula.value = "";
            LabelOut('cedula','labelcedula')
            Error("El profesor ya se encuentra registrado.","msg_error","p_error")
        }
     })
     .catch(function(err) {
        console.log(err);
     });
}
function MateriaConfirm(codigo,nombre){
   const data = new FormData();
   data.append("codigo_confirm",codigo);
   data.append("nombre_confirm",nombre);
   data.append("url","paraEvitarError")
   return fetch('../control/c_materia.php', {
       method: 'POST',
       body: data
    })
    .then(function(response) {
       if(response.ok) {
        return response.text()
       } 
    })
    .then(function(response) {
       if(response=="si"){
            localStorage.setItem('respuesta',"si");
           
           return response
       }
    })
    .catch(function(err) {
       console.log(err);
    });
}
function GetMateriasHorario(input, span, bloque, dia,  label, input_materias, drop_materias, input_aula, drop_aulas, lapso){
   if (span!="") {
      document.querySelector("#"+input).value=span.innerText;
   }
   let span_horario=document.getElementById(drop_materias).querySelectorAll('span');
   let span_horario_aula=document.getElementById(drop_aulas).querySelectorAll('span');
   for (let index = 0; index < span_horario.length; index++) {
      span_horario[index].remove();
   }
   for (let index = 0; index < span_horario_aula.length; index++) {
      span_horario_aula[index].remove();
   }
   
   var horario = document.querySelector("#"+input);
   LabelAnimation(input,label);
   const data = new FormData();
   data.append("carrera_horario",`${horario.value}`);
   data.append("bloque",bloque);
   data.append("dia",dia);
   data.append("lapso",lapso);
   data.append("url","paraEvitarError")
   fetch("../control/c_horario.php",{//primer parametro ruta de envio, segundo parametro configuracion de envio
      method: "POST",//metodo de envieo en este caso post
      body: data//envio del formulario
  })
  .then((response)=>{//aqui vemos si la respuesta fue positiva retornamos el resultado
   if(response.ok){
       return response.json();// si es un dato json es .json si es puro un dato individual .text
   }
   })
   .then((data)=>{ //aqui es donde manipularemos el resultado al q le dimos return, ya sea un array o una simple variable
      if(data=="fallo"){
          alert("El usuario no existe");
      }
      else{
         for (let index = 0; index < data[0].length; index++) {
            let span_add=document.createElement('span');
            span_add.innerHTML=data[0][index][1];
            span_add.onclick=function () {AddValueMateria(input_materias, this)}
            span_add.id=data[0][index][0];
            document.getElementById(drop_materias).appendChild(span_add);
            
         }
         for (let index = 0; index < data[1].length; index++) {
            let span_add=document.createElement('span');
            span_add.innerHTML=data[1][index][1];
            span_add.onclick=function () {AddValueMateria(input_aula, this)}
            span_add.id=data[1][index][0];
            document.getElementById(drop_aulas).appendChild(span_add);
            
         }
        
      }
  })
  .catch((error)=>{
      console.log(error);
  }) 
    
}