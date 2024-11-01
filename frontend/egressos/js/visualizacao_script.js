window.onload = function () {
    $("#header").load("./components/header.html");
    $("#footer").load("./components/footer.html"); 

    init();
}

async function init(){
    const profileId = new URLSearchParams(window.location.search).get('profile');
    let endpoint = serverUrl + "egresses/"+profileId;

    await $.ajax({
        url : endpoint,
        contentType: "application/json",
        type : "get",
        data : ""
    })
    .done(function(msg){
        let image = document.getElementById("divImgPerfil")

        if(msg.image_path!=" " && msg.image_path!=""){
            let src = serverUrl +'storage/'+ msg.image_path;
            image.innerHTML = `<img src="${src}" alt="Foto do Perfil" srcset="">`
        }

        let fullName = document.getElementById("aluno-nome-completo");
        fullName.innerHTML = msg.name;
        
        let idade = document.getElementById("aluno-idade");
        let now = new Date();
        let birthdate = new Date(msg.birthdate);
        let diferencaEmMilissegundos = now - birthdate;
        
        const anos = Math.ceil(diferencaEmMilissegundos / (1000 * 60 * 60 * 24 * 365.25));
        idade.innerHTML = anos + " anos";

        let curso = document.getElementById("aluno-curso-nome");        
        let cursoAno = document.getElementById("aluno-curso-conclusao");

        msg.academic_formation.forEach(element => {
            if(element.institution_name.includes("FATEC-ZL")){
                curso.innerHTML = element.course_name;
                cursoAno.innerHTML = "Concluiu em "+element.end_year
            }
        });

        let jobAtual = document.getElementById("aluno-trabalho-atual");
        msg.professional_experience.forEach(element => {
            if(element.final_date == null){
                let dataIni = new Date(element.initial_date );
                jobAtual.innerHTML = element.name + ", " 
                    + element.area + ", "
                    + "desde " + dataIni.getFullYear();
            }
        });

        let feedback = document.getElementById("txtFeedback");
        feedback.value = msg.feedback.comment;
        feedback.setAttribute("disabled","true");

        let outrasExpsAcad = document.getElementById("exps-academicas");
        msg.academic_formation.forEach(element => {
            outrasExpsAcad.appendChild(criarExibicaoAcadExp(element));       
        });

        let outrasExpsProf = document.getElementById("exps-profissionais");
        msg.professional_experience.forEach(element => {
            if(element.final_date != null){
                outrasExpsProf.appendChild(criarExibicaoProfExp(element));       
            }
        });

        let contatos = document.getElementById("divContatos");
        contatos.innerHTML = "";

        msg.contacts.forEach(element => {
            contatos.appendChild(criarExibicaoContato(element));
        });
    })
    .fail(function(jqXHR, textStatus, msg){
        console.log(jqXHR);
    });
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

function criarExibicaoContato(contato){
    let div = document.createElement("div");
    div.classList.add("aluno-contato");

    let img = document.createElement('img');
    img.classList.add('icon-social');

    let link = document.createElement('a');
    link.setAttribute("target","_blank");
    link.setAttribute("href",contato.contact);
    link.setAttribute("rel","external");

    switch (contato.name.toUpperCase()) {
        case "EMAIL":
            img.setAttribute('alt','ícone do email');
            img.setAttribute('src','./img/social-media-icons/email.svg');
            link.setAttribute("href","mailto:"+contato.contact);
            link.setAttribute('title','Endereço de email do egresso');
            break;
        case "FACEBOOK":
            img.setAttribute('alt','ícone do facebook');
            img.setAttribute('src','./img/social-media-icons/facebook.svg');
            link.setAttribute('title','Facebook do egresso');
            break;
        case "GITHUB":
            img.setAttribute('alt','ícone do github');
            img.setAttribute('src','./img/social-media-icons/github.svg');
            link.setAttribute('title','Facebook do egresso');
            break;
        case "INSTAGRAM":
            img.setAttribute('alt','ícone do instagram');
            img.setAttribute('src','./img/social-media-icons/instagram.svg');
            link.setAttribute('title','Instagram do egresso');
            break;
        case "LINKEDIN":
            img.setAttribute('alt','ícone do linkedin');
            img.setAttribute('src','./img/social-media-icons/linkedin.svg');
            link.setAttribute('title','Linkedin do egresso');
            break;
        case "YOUTUBE":
            img.setAttribute('alt','ícone do youtube');
            img.setAttribute('src','./img/social-media-icons/youtube.svg');
            link.setAttribute('title','Canal do youtube do egresso');
            break;
        case "X":
            img.setAttribute('alt','ícone do x');
            img.setAttribute('src','./img/social-media-icons/x.svg');
            link.setAttribute('title','X do egresso');
            break;
        case "TELEFONE":
            img.setAttribute('alt','ícone de telefone');
            img.setAttribute('src','./img/social-media-icons/phone.svg');
            let foneFormatado = contato.contact;
            link.setAttribute("onclick","return false");
            link.setAttribute('title','Telefone do egresso: '+foneFormatado);
            break;
        default:
            img.setAttribute('alt','ícone de link');
            img.setAttribute('src','./img/social-media-icons/link.svg');
            link.setAttribute('title','contato do egresso');
            break;
    }

    link.appendChild(img);
    div.appendChild(link);

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
    
setTimeout(() => {
    let btnEntrar=document.getElementById("btnEntrar");
    btnEntrar.classList.add("d-none");
}, 200);