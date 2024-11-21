window.onload = function () {
    $("#header").load("./components/header.html");
    $("#footer").load("./components/footer.html"); 

    init();
}

document.getElementById("slcFiltroStatus").addEventListener('change',()=>{
    const status = document.getElementById("slcFiltroStatus").value;
    loadEgresses(status);
});

document.getElementById("btnBuscaAlunos").addEventListener('click',async ()=>{
    let status = document.getElementById("slcFiltroStatus").value;
    let name = document.getElementById("txtSearchAluno").value;

    const container = document.getElementById("card-list-container");
    container.innerHTML = "";

    let url = serverUrl + `egresses/searchwithstatus?name=${name}&status=${status}`;
    await $.ajax({
        url : url,
        dataType: "json",
        contentType: "application/json",
        method : "GET",
      })
      .done(function(msg){
          msg.data.forEach(element => {
            container.appendChild(createEgressCard(element));
          });
      })
      .fail(function(jqXHR, textStatus, msg){
        console.log(jqXHR);
        console.log(textStatus);  
        console.log(msg);
      });
});

function init(){
    if(getUser().type_account == 0){
        window.location.href = './';
    }

    loadEgresses();
}

async function loadEgresses(status){
    if(status == undefined){
        status = 0;
    }

    let url = serverUrl;

    if(status == 0){
        url += "egresses/analysis";
    }else{
        url += "egresses/aproved-reproved?status="+status;
    }

    const container = document.getElementById("card-list-container");
    container.innerHTML = "";

    await $.ajax({
        url : url,
        dataType: "json",
        contentType: "application/json",
        method : "GET",
      })
      .done(function(msg){
          msg.data.forEach(element => {
            container.appendChild(createEgressCard(element));
          });
      })
      .fail(function(jqXHR, textStatus, msg){
        console.log(jqXHR);
        console.log(textStatus);  
        console.log(msg);
      });
}

function createEgressCard(egress){
    let card = document.createElement("div");
    card.setAttribute("class","egrees-card");

    card.addEventListener("click",()=>{
        window.location.href = "./avaliacao.html?egress=" + egress.id;
    });

    let img = document.createElement("img");
    img.setAttribute("alt","imagem do perfil");
    
    let src = serverUrl +'storage/'+ egress.image_path;

    img.setAttribute("src",src);

    let nome = document.createElement("span");
    nome.innerHTML = egress.name;

    let curso = document.createElement("span");
    curso.innerHTML = egress.course;

    let status = document.createElement("span");
    
    let stat = getStatusDescription(egress.status);
    status.innerHTML = stat;

    card.append(img,nome,curso,status);
    
    return card;
}