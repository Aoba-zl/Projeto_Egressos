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
        console.log(msg);
        
        let title = document.getElementById("perfilName");
        title.innerHTML = "Perfil de "+(msg.name.split(" ")[0]);
        
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
            if(element.institution_name == "FATEC-ZL"){
                curso.innerHTML = element.course_name;
                cursoAno.innerHTML = "Concluiu em "+element.end_year
            }
        });
    })
    .fail(function(jqXHR, textStatus, msg){
        console.log(msg);
    });
}

function displayEgressData(egress) {
    
}

function criarExibicaoProfExp(experienciaProfissional){
    let div = document.createElement("div");
    div.classList.add("user-prof-exp-item");

    let spanEmpresa = document.createElement("span");
    let spanCargo = document.createElement("span");
    let spanAnoInicio = document.createElement("span");
    let spanAnoFim = document.createElement("span");

    spanEmpresa.innerHTML = experienciaProfissional.name;
    spanCargo.innerHTML = experienciaProfissional.phone;
    spanAnoInicio.innerHTML = experienciaProfissional.begin_year;

    if(!isNaN(experienciaProfissional.end_year)){
        spanAnoFim.innerHTML = experienciaProfissional.end_year;
    }else{
        spanAnoFim.innerHTML = "Atual";
    }

    let spanData = document.createElement("span");
    spanData.classList.add("d-none");
    spanData.innerHTML = JSON.stringify(experienciaProfissional);

    let lblExcluir = document.createElement("label");
    lblExcluir.innerHTML = "X"
    lblExcluir.classList.add("btn-remove-item-exp");
    lblExcluir.addEventListener('click',(e)=>{
        apagarDaTela(e);
    });

    div.append(spanEmpresa,spanCargo,spanAnoInicio,spanAnoFim,lblExcluir,spanData);

    document.getElementById("exps-profissionais").appendChild(div);
}

function criarExibicaoContato(contato){
    
}

function criarExibicaoAcadExp(experienciaAcademica){
    let div = document.createElement("div");
    div.classList.add("user-acad-exp-item");

    let spanInst = document.createElement("span");
    let spanCurso = document.createElement("span");
    let spanPeriodo = document.createElement("span");
    spanPeriodo.classList.add("d-none");
    let spanAno = document.createElement("span");

    spanInst.innerHTML = experienciaAcademica.institution;
    spanCurso.innerHTML = experienciaAcademica.course;
    spanPeriodo.innerHTML = experienciaAcademica.period;
    spanAno.innerHTML = experienciaAcademica.end_year;

    let lblExcluir = document.createElement("label");
    lblExcluir.innerHTML = "X"
    lblExcluir.classList.add("btn-remove-item-exp");
    lblExcluir.addEventListener('click',(e)=>{
        apagarDaTela(e);
    });

    let lblData = document.createElement("label");
    lblData.classList.add("d-none");
    lblData.innerHTML = JSON.stringify(experienciaAcademica);

    div.append(spanInst,spanCurso,spanPeriodo,spanAno,lblExcluir,lblData);

    document.getElementById("exps-academicas").appendChild(div);
}