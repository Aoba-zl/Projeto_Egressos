import { Evento } from "../model/Evento.js";

export
class EventoDAO{
    constructor(){

    }

    async getEventos(){
        let eventos = new Array();
        
        await fetch("./js/libs/eventos/data/data.json")
        .then(response => response.json())
        .then(json => {
           json.forEach(element => {
            let event = new Evento();            
            event.edition = element.edition;
            event.enddate = element.enddate;
            event.endtime = element.endtime;
            event.name = element.name;
            event.startdate = element.startdate;
            event.starttime = element.starttime;
            event.acronym = element.acronym;
            eventos.push(event);
           });         
        });
        return eventos;
    }
}