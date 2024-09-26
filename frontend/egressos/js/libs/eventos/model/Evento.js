import { TimeLeft } from "./TimeLeft.js";
export
class Evento{
    name;
    acronym;
    startdate;
    starttime;
    enddate;
    endtime;
    edition;

    constructor(){
        
    }

    calcTimeLeft(){        
        let timel = new TimeLeft();
        let date = new Date();

        let sttDate = this.startdate.split("/");
        let sttTime = this.starttime.split(":");

        let devent = new Date(sttDate[2],sttDate[1]-1,sttDate[0],sttTime[0],sttTime[1]);

        let diffMiliSeg = devent - date;
        // convertendo a diferença de milisegundos para segundos -> minutos -> horas -> dias
        let diffSegundos = diffMiliSeg/1000;
        let diffMin = diffSegundos/60;
        let diffHoras = diffMin/60;
        let diffDias = diffHoras/24;

        diffDias = Math.trunc(diffDias);
 
        if(diffDias>=0){
            timel.days = diffDias;
            timel.time = "";
            
            let horas = Math.trunc(diffHoras-(Math.trunc(diffDias)*24));

            if(horas<10){
                timel.time+="0"+horas;
            }else{
                timel.time+=horas;
            }

            timel.time += ":";

            let min = Math.trunc(diffMin-(Math.trunc(diffHoras)*60));

            if(min<10){
                timel.time+="0"+min;
            }else{
                timel.time+=min;
            }
            
            timel.time += ":";
            
            let sec = Math.trunc(diffSegundos-(Math.trunc(diffMin)*60))
            
            if(sec<10){
                timel.time+="0"+sec;
            }else{
                timel.time+=sec;
            }

            if(sec<0 || min < 0 || horas < 0){
                timel = "";
            }
        }

        return timel;
    }

    static parseEventDate(date,hour){
        let d1 = date.split("/");        

        if(hour != undefined){
            let h1 = hour.split(":");
            return new Date(d1[2],d1[1]-1,d1[0],h1[0],h1[1]);
        }

        return new Date(d1[2],d1[1]-1,d1[0]);
    }
}