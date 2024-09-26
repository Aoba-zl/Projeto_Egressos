import { EventoController } from "./libs/eventos/controller/EventoController.js";
import { Card } from "./libs/eventos/model/Card.js";

window.onload = function () {
    $("#header").load("./components/header.html");
    $("#footer").load("./components/footer.html"); 

    init();
}

async function init(){
    let eventoCtrl = new EventoController();
    let eventos = await eventoCtrl.getEventos();
    criarCards(eventos);
}

function criarCards(eventos){
    let container = document.getElementById("proximosEventos");
    container.innerHTML = "";

    eventos.forEach(element => {
        let c = new Card(element);
        container.appendChild(c.draw());
    });
}