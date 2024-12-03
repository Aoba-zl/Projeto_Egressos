import { Evento } from "./Evento.js";

export
class Card{
    
    eventName;
    eventDate;
    startTime;
    eventId;

    constructor(evento){
        this.eventName = evento.name;
        this.eventDate = evento.startdate;
        this.eventId = evento.acronym +"."+evento.edition;
        this.startTime = evento.starttime;
    }

    draw(){
        var cardDiv = document.createElement("div");
        cardDiv.setAttribute("class","event-card");
        cardDiv.setAttribute("id",this.eventId);

        var spanName = document.createElement("span");
        spanName.innerHTML = this.eventName;

        var spanDate = document.createElement("span");
        spanDate.innerHTML = this.eventDate;

        var spanTime = document.createElement("span");
        spanTime.innerHTML = this.startTime;

        cardDiv.appendChild(spanName);
        cardDiv.appendChild(spanDate);  
        cardDiv.appendChild(spanTime);

        return cardDiv;
    }    
}