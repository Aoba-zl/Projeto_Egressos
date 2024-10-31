window.onload = function () {
    $("#header").load("./components/header.html");
    $("#footer").load("./components/footer.html"); 

    init();
}

async function init(){
    const egressId = new URLSearchParams(window.location.search).get('egress');
    
    let endpoint = serverUrl + "egresses/moderator/"+egressId;

    await $.ajax({
        url : endpoint,
        contentType: "application/json",
        type : "get",
        data : ""
    })
    .done(function(msg){
        console.log(msg);

        let image = document.getElementById("divImgPerfil")

        if(msg.image_path!=" " && msg.image_path!=""){
            let src = serverUrl +'storage/'+ msg.image_path;
            image.innerHTML = `<img src="${src}" alt="Foto do Perfil" srcset="">`
        }

        let fullName = document.getElementById("aluno-nome-completo");
        fullName.value = msg.name;
        fullName.setAttribute("disabled",'true');

        let cpf = document.getElementById("aluno-cpf");
        cpf.value = msg.cpf;
        $('#aluno-cpf').mask('000.000.000-00');
        cpf.setAttribute("disabled",'true');

        let dataNasc = document.getElementById("aluno-data-nasc");
        dataNasc.value = msg.birthdate.split("T")[0];
        dataNasc.setAttribute("disabled",'true');

        let feedback = document.getElementById("txtFeedback");
        feedback.value = msg.feedback.comment;
        feedback.setAttribute("disabled","true");

        let divContatos = document.getElementById("divContatos");
        divContatos.innerHTML = "";

        msg.contacts.forEach(element => {
            divContatos.appendChild(criarExibicaoContato(element));
        });
    })
    .fail(function(jqXHR, textStatus, msg){
        console.log(jqXHR);
    });
}

function criarExibicaoContato(contato){
    let div = document.createElement("div");
    div.setAttribute("class","egresso-contato");

    let spanRede = document.createElement("span");
    let spanContato = document.createElement("span");

    spanRede.innerHTML = contato.name;
    spanContato.innerHTML = contato.contact;

    div.append(spanRede,spanContato)
    return div;
}