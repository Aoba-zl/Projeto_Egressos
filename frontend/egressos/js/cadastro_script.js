window.onload = function () {
    $("#header").load("./components/header.html");
    $("#footer").load("./components/footer.html"); 

    init();
}

function init(){

}

document.getElementById("btnContinueCad").addEventListener("click",()=>{
    let cb = document.getElementById("cbAgreement");
    if(cb.checked == true){
        alert("Prosseguir");
    }else{
        cb.parentNode.classList.add("mark-red");
    }

    
});