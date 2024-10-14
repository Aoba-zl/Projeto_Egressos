import { EventoController } from "./libs/eventos/controller/EventoController.js";
import { Card } from "./libs/eventos/model/Card.js";

var lastColor = 0;

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

function loadDepoimentos() {
    let divDepoimentos= document.getElementById("divDepoimentos");
    $.ajax({
        url : serverUrl+"egresses-random",
        contentType: "application/json",
        method : "get",
        data : ""
      })
      .done(function(msg){
        console.log(msg);
        msg.forEach(element => {
            divDepoimentos.appendChild(createCardDepoimento(element));
        });
      })
      .fail(function(jqXHR, textStatus, msg){
          console.log(msg);
      });
}

function createCardDepoimento(depoimento) {
    let rand = lastColor;

    while(rand === lastColor){
        rand = Math.floor(Math.random()*8);
    }

    lastColor = rand;

    let divCard = document.createElement("div");
    divCard.setAttribute("class","depoimento-card p-4 depoimento-theme-"+rand);

    let row1 = document.createElement("div");
    row1.classList.add("row");

    let col1 = document.createElement("div");
    col1.setAttribute("class","col-sm-12 col-md-4");

    let row2 = document.createElement("div");
    row2.classList.add("row");

    //----------------------------------------------------
    let col2 = document.createElement("div");
    col2.setAttribute("class","col-12 text-center");

    let img = document.createElement("img");
    img.setAttribute("alt","imagem Aluno");
    img.setAttribute("class","imgPerfil");
    img.setAttribute("src","https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png");

    let nomeAluno = document.createElement("p");
    nomeAluno.setAttribute("class","nomeAluno text-center");
    nomeAluno.innerHTML = depoimento.user_name;

    let cursoAluno = document.createElement("p");
    cursoAluno.setAttribute("class","cursoAluno text-center");
    cursoAluno.innerHTML = depoimento.course_name;

    col2.append(img,nomeAluno,cursoAluno);
    row2.appendChild(col2);
    col1.appendChild(row2);
    row1.appendChild(col1);
    //----------------------------------------------------

    let col10 = document.createElement("div");
    col10.setAttribute("class","col-sm-12 col-md-7 p-3");

    let row20 = document.createElement("div");
    row20.setAttribute("class","row");

    let depAluno = document.createElement("p");
    depAluno.setAttribute("class","text-center");
    depAluno.innerHTML = depoimento.feedback_comment;

    row20.appendChild(depAluno);
    col10.appendChild(row20);

    row1.appendChild(col10);

    divCard.appendChild(row1);
    //----------------------------------------------------
    return divCard;
}