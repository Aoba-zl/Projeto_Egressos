import { Evento } from "../model/Evento.js";
import { EventoDAO } from "../dao/EventoDAO.js";

export
class EventoController{
    constructor(){

    }

    async getEventos(){
        let dao = new EventoDAO();
        let eventos = await dao.getEventos();
        return this.ordenar(eventos);
    }

    ordenar(eventos){
        eventos.sort((a, b) => {
            return Evento.parseEventDate(a.startdate) - Evento.parseEventDate(b.startdate);
        });
        
        for(let i = 0;i<eventos.length;i++){
            let element = eventos[i];
            let now = new Date();
            let eventEDt = Evento.parseEventDate(element.enddate,element.endtime);
            
            if((eventEDt < now)){
               eventos = this.removeItem(eventos,i);
               i=-1;
            } 
        };

        return eventos;
    }

    removeItem(array,index){
        let arrays = new Array();
        let i = 0;
        
        array.forEach(element => {
            if(!(index == i)){
                arrays.push(element);
            }
            i++;
        });
        
        return arrays;
    }
}