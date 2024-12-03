import { EventoController } from "./libs/eventos/controller/EventoController.js";
import { Card } from "./libs/eventos/model/Card.js";

const qttThemes = 5;
var lastColor = Math.floor(Math.random()*qttThemes);
var count = 1;

window.onload = function () {
    $("#header").load("./components/header.html");
    $("#footer").load("./components/footer.html");

    init();
}

async function init(){
    let eventoCtrl = new EventoController();
    let eventos = await eventoCtrl.getEventos();
    criarCards(eventos);

    loadDepoimentos();
}

function criarCards(eventos){
    let container = document.getElementById("proximosEventos");
    container.innerHTML = "";

    eventos.forEach(element => {
        let c = new Card(element);
        container.appendChild(c.draw());
    });
}

async function loadDepoimentos() {
    let divDepoimentos= document.getElementById("divDepoimentos");
    count = 1
    $.ajax({
        //headers: {'X-CSRF-TOKEN': await getCsrfToken()},
        url : serverUrl+"egresses-random",
        contentType: "application/json",
        method : "get",
        data : ""
      })
      .done(function(msg){
        msg.forEach(element => {
            divDepoimentos.appendChild(createCardDepoimento(element));
        });
      })
      .fail(function(jqXHR, textStatus, msg){
          console.log(jqXHR);
      });
}

function createCardDepoimento(depoimento) {
    let rand = lastColor;

    while(rand === lastColor){
        rand = Math.floor(Math.random()*qttThemes);
    }

    lastColor = rand;

    let divCard = document.createElement("div");
    divCard.setAttribute("class","depoimento-card p-4 depoimento-theme-"+rand);

    divCard.addEventListener("click",()=>{
        window.location.href = "./visualizarPerfil?profile="
        +depoimento.user_id;
    });

    let row1 = document.createElement("div");
    row1.classList.add("row");

    let col1 = document.createElement("div");
    col1.setAttribute("class","col-sm-12 col-md-4 p-3");

    if(count%2 === 0){
        col1.classList.add("col-push-md-4");
    }

    let row2 = document.createElement("div");
    row2.classList.add("row");

    //----------------------------------------------------
    let col2 = document.createElement("div");
    col2.setAttribute("class","col-12 text-center");

    let img = document.createElement("img");
    let src = serverUrl +'storage/'+ depoimento.image_path;
    img.setAttribute("alt","imagem Aluno");
    img.setAttribute("class","imgPerfil");
    img.setAttribute("src",src);

    let nomeAluno = document.createElement("p");
    nomeAluno.setAttribute("class","nomeAluno text-center mt-2");
    nomeAluno.innerHTML = depoimento.user_name;

    let cursoAluno = document.createElement("p");
    cursoAluno.setAttribute("class","cursoAluno text-center");
    cursoAluno.innerHTML = depoimento.course_name;

    col2.append(img,nomeAluno,cursoAluno);
    row2.appendChild(col2);
    col1.appendChild(row2);
    //----------------------------------------------------

    let col10 = document.createElement("div");
    col10.setAttribute("class","col-sm-12 col-md-8 align-middle p-3");

    let row20 = document.createElement("div");
    row20.setAttribute("class","row");

    let depAluno = document.createElement("p");
    depAluno.setAttribute("class","text-center");
    depAluno.innerHTML = depoimento.feedback_comment;

    row20.appendChild(depAluno);
    col10.appendChild(row20);

    row1.appendChild(col1);
    row1.appendChild(col10);

    if(count%2 === 0){
        //TODO: logica para inverter ordem dos depoimentos pares
    }

    divCard.appendChild(row1);
    //----------------------------------------------------
    count++;
    return divCard;
}
