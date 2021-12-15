function Error(parrafo, msg, p){
    document.getElementById(p).innerHTML=parrafo
    document.getElementById(msg).style.display="block"
    setTimeout(function(){
        document.getElementById(msg).style.right="30px"
    },500)
    setTimeout(function(){
        document.getElementById(msg).style.right="-500px"
    },5000)
    setTimeout(function(){
        document.getElementById(msg).style.display="none"
    },6000)
}
