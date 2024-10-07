window.onload = function () {
    $("#header").load("./components/header.html");
    $("#footer").load("./components/footer.html"); 

    init();
}

function init(){

}

document.getElementById("divCardsAluno").addEventListener("click",(e)=>{
    let id = e.target.children[0].innerHTML;
    window.location.href = "./visualizarPerfil.html?profile="+id;
});


