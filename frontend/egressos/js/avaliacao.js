const egressId = new URLSearchParams(window.location.search).get('egress');
var egressToEdit = 0;

window.onload = function () {
    $("#header").load("./components/header.html");
    $("#footer").load("./components/footer.html"); 

    init();
}

document.getElementById("btnMarcarTd").addEventListener("click",()=>{
    marcarComoInválidos();
});

document.getElementById("btnContinuar").addEventListener("click",()=>{
    avancarEtapa();
});

document.getElementById("btnRejeitarPerfil").addEventListener("click",()=>{
    rejeitarPerfil();
});

document.addEventListener("click",mudarBtnAcao);

async function init(){    
    let endpoint = serverUrl + "egresses/moderator/"+egressId;

    if(getUser().type_account == 0){
        window.location.href = './';
    }
    
    await $.ajax({
        url : endpoint,
        contentType: "application/json",
        type : "get",
        data : ""
    })
    .done(function(msg){
        let image = document.getElementById("divImgPerfil")

        egressToEdit = msg.id;
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

        let expAcademicas = document.getElementById("exps-academicas");
        expAcademicas.innerHTML = "";
        msg.academic_formation.forEach(element => {
            expAcademicas.appendChild(criarExibicaoAcadExp(element));
        });

        let expsProfissionais = document.getElementById("exps-profissionais");
        expsProfissionais.innerHTML = "";
        msg.professional_experience.forEach(element => {           
            expsProfissionais.appendChild(criarExibicaoProfExp(element));       
        });

        adicionarCheckbox();
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

function criarExibicaoAcadExp(experienciaAcademica){
    let div = document.createElement("div");
    div.classList.add("user-acad-exp-item");

    let spanInst = document.createElement("span");
    let spanCurso = document.createElement("span");
    let spanPeriodo = document.createElement("span");
    spanPeriodo.classList.add("d-none");
    let spanAno = document.createElement("span");

    spanInst.innerHTML = experienciaAcademica.institution_name;
    spanCurso.innerHTML = experienciaAcademica.course_name;
    spanPeriodo.innerHTML = experienciaAcademica.period;
    spanAno.innerHTML = experienciaAcademica.end_year;

    div.append(spanInst,spanCurso,spanPeriodo,spanAno);

    return div;
}

function criarExibicaoProfExp(experienciaProfissional){
    let div = document.createElement("div");
    div.classList.add("user-prof-exp-item");

    let spanEmpresa = document.createElement("span");
    let spanCargo = document.createElement("span");
    let spanAnoInicio = document.createElement("span");
    let spanAnoFim = document.createElement("span");

    spanEmpresa.innerHTML = experienciaProfissional.name;
    spanCargo.innerHTML = experienciaProfissional.area;
    let dtInicio = new Date(experienciaProfissional.initial_date);
    spanAnoInicio.innerHTML = dtInicio.getFullYear();

    if(experienciaProfissional.final_date != null){
        let dtFim = new Date(experienciaProfissional.final_date);
        spanAnoFim.innerHTML = dtFim.getFullYear();
    }else{
        spanAnoFim.innerHTML = "Atual";
    }

    div.append(spanEmpresa,spanCargo,spanAnoInicio,spanAnoFim);

    return div;
}

function adicionarCheckbox(){
    let foto = document.getElementById("divImgPerfil");
    let contatos = document.getElementById("divContatos");
    let nome = document.getElementById("aluno-nome-completo");
    let cpf = document.getElementById("aluno-cpf");
    let dataNasc = document.getElementById("aluno-data-nasc");
    let feedback = document.getElementById("txtFeedback");
    let perfilAcademico = document.getElementById("exps-academicas");
    let perfilProfissional = document.getElementById("exps-profissionais");

    foto.appendChild(criarCb("cbFotoPerfil","cb-user-data-img"));
    let i = 1;
    contatos.childNodes.forEach(element => {
       element.appendChild(criarCb("cb-contato-"+i,"cb-user-data-contato"));
       i++;
    });

    nome.parentNode.appendChild(criarCb("cbNome"));
    cpf.parentNode.appendChild(criarCb("cbCpf"));
    dataNasc.parentNode.appendChild(criarCb("cbDataNasc"));
    
    feedback.parentNode.appendChild(criarCb("cbFeedback"));
    
    i = 1;
    perfilAcademico.childNodes.forEach(element => {
       element.appendChild(criarCb("cb-acad-"+i,"cb-user-data-exp")); 
       i++;
    });

    i = 1;
    perfilProfissional.childNodes.forEach(element => {
       element.appendChild(criarCb("cb-prof-"+i,"cb-user-data-exp"));
       i++;
    });
}

function criarCb(cbId,classe){
    let cb = document.createElement("input");
    cb.setAttribute("id",cbId);
    cb.setAttribute("type","checkbox");
    cb.classList.add("cb");
    if(classe == undefined){
        cb.classList.add("cb-user-data");
    }else{
        cb.classList.add(classe);
    }

    return cb;
}

function marcarComoInválidos() {
    let cbs = document.querySelectorAll(".cb");
    cbs.forEach(element => {
       element.setAttribute("checked",true); 
    });
}

function mudarBtnAcao(){
    let cbs = document.querySelectorAll(".cb");
    let haReprovados = false;

    cbs.forEach(element => {
        if(element.checked){
            haReprovados = true;
        }
    });

    let btn = document.getElementById('btnContinuar');

    if(haReprovados){
        btn.innerHTML = "Continuar";
        btn.classList.remove("btn-outline-success");
        btn.classList.add("btn-outline-danger");        
    }else{
        btn.innerHTML = "Aprovar Perfil";
        btn.classList.remove("btn-outline-danger");
        btn.classList.add("btn-outline-success");
    }
}

function avancarEtapa(){
    let cbs = document.querySelectorAll(".cb");
    let dadosReprovados = [];
    cbs.forEach(element => {
        if(element.checked){
            console.log(element.parentNode);
            if(element.parentNode.id == "divImgPerfil"){
                dadosReprovados.push("[ Foto de Perfil ]");
            }

            if(element.parentNode.classList.contains("egresso-contato")){
                dadosReprovados.push("[ Contato: " 
                    + element.parentNode.firstChild.innerHTML + " ]");
            }

            if(element.parentNode.classList.contains("div")){
                if(element.id.toUpperCase().includes("NOME")){
                    dadosReprovados.push("[ Nome ]");
                }

                if(element.id.toUpperCase().includes("CPF")){
                    dadosReprovados.push("[ CPF ]");
                }

                if(element.id.toUpperCase().includes("DATA")){
                    dadosReprovados.push("[ Data de Nascimento ]");
                }
            }

            if(element.parentNode.id === "div-feedback"){
                dadosReprovados.push("[ Feedback ]");
            }

            if(element.parentNode.classList.contains("user-acad-exp-item")){
                dadosReprovados.push("[ Formação: " +  
                    element.parentNode.children[1].innerHTML + " ]"
                );
            }

            if(element.parentNode.classList.contains("user-prof-exp-item")){
                dadosReprovados.push("[ Experiência profissional:  " +  
                    element.parentNode.children[0].innerHTML + " ]"
                );
            }

            console.log(dadosReprovados);
        }
     });

    if(dadosReprovados.length == 0){
        salvarAvaliacao("ok",1);
    }else{
        let reprovados = document.getElementById("txtDadosReprovados");
        let value = "";
        dadosReprovados.forEach(element => {
            value += element+"\n";
        });
        reprovados.value = value;
        exibirModal("#av-modal");    
    }
}

function rejeitarPerfil(){
    let txt = document.getElementById("txtDescricao").value;
    let dados = document.getElementById("txtDadosReprovados").value;

    if(txt != null && txt.trim().length > 3){
        salvarAvaliacao(txt + "\n\n" +dados,2);
    }else{
        alert("Escreva uma justificativa para a rejeição do perfil do egresso");
    }
}

function salvarAvaliacao(comentario,status) {
    let data = new Object();
    let avaliacao = new Object();
    avaliacao.id_moderator_admi = getUserIdPosLogin()+"";
    avaliacao.id_egress = egressToEdit;
    avaliacao.comment = comentario;

    data.status = status+"";
    data.assessment = avaliacao;

    console.log(JSON.stringify(data));

    $.ajax({
        //headers: {'X-CSRF-TOKEN': await getCsrfToken()},
        url : serverUrl+"saveAssessment",
        contentType: "application/json",
        method : "POST",
        data : JSON.stringify(data)
      })
      .done(function(msg){
        alert(msg.message);
        window.location.href = "homemoderador.html";
      })
      .fail(function(jqXHR, textStatus, msg){
          console.log(jqXHR);
          console.log(textStatus);
          console.log(msg);
      });
}