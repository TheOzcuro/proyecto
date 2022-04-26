const x=document.getElementsByClassName("parrafo")

document.getElementById("mision").addEventListener('click', function(){
    x[1].style.display="none";
    x[2].style.display="none";
    x[0].style.display="block";
    document.querySelector('.container-noticia').style.display="none";
    x[0].style.animationName="Opacity";
    x[0].style.animationDuration="0.7s";
})
document.getElementById("vision").addEventListener('click', function(){
    x[0].style.display="none";
    x[2].style.display="none";
    x[1].style.display="block";
    document.querySelector('.container-noticia').style.display="none";
    x[1].style.animationName="Opacity";
    x[1].style.animationDuration="0.7s";
})
document.getElementById("sobren").addEventListener('click', function(){
    x[0].style.display="none";
    x[1].style.display="none";
    x[2].style.display="block";
    document.querySelector('.container-noticia').style.display="none";
    x[2].style.animationName="Opacity";
    x[2].style.animationDuration="0.7s";
})
document.getElementById("noticias").addEventListener('click', function(){
    x[0].style.display="none";
    x[2].style.display="none";
    x[1].style.display="none";
   document.querySelector('.container-noticia').style.display="block";
   document.querySelector('.container-noticia').style.animationName="Opacity";
   document.querySelector('.container-noticia').style.animationDuration="0.7s";
})
