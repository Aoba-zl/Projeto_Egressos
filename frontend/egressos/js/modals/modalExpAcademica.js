document.getElementById("btnAddAcadExp").addEventListener("click",()=>{
    abrirModalCadExpAcademica();
});

function abrirModalCadExpAcademica(){
    let modalTitle = document.getElementById("modal-title");
    let modalBody = document.getElementById("modal-body");
    let modalFooter = document.getElementById("modal-footer");

    modalTitle.innerHTML = "Adicionar Experiência Acadêmica";

    modalBody.innerHTML = "";
    // --------------------- Body ----------------------------
    let frm = document.createElement("form");
    frm.setAttribute("autocomplete","off");
    frm.setAttribute("class","frmCadExp");

    let divInputInstituicao = criarCampoDeTexto(
      "Instituicao"
      ,"Digite o nome da instituição"
      ,"Digite o nome da Instituição que você estudou:"
    )
    divInputInstituicao.classList.add("autocomplete");

    let txtInstituicao = divInputInstituicao.querySelector("#txtInstituicao");

    txtInstituicao.addEventListener("keyup",()=>{
      if (txtInstituicao.value.length >= 2) {
        console.log(txtInstituicao.value.length );
        
      getNamesToAutocomplete('institution',txtInstituicao)
      }
    });

    frm.appendChild(divInputInstituicao);

    let divInputCurso = criarCampoDeTexto
    (
      "Curso"
      ,"Digite o nome do curso"
      ,"Digite o curso que você concluiu: "
    );
    divInputCurso.classList.add("autocomplete");

    let txtCurso = divInputCurso.querySelector("#txtCurso");

    txtCurso.addEventListener("keyup",() => {
      if (txtCurso.value.length >= 2) {
      getNamesToAutocomplete('course',txtCurso)
      }
    });


    frm.appendChild(divInputCurso);
    //-------------------------
    let divSelectTipoFormacao = document.createElement("div");

    let lblTipoFormacao = document.createElement("label");
    lblTipoFormacao.setAttribute("for","slcTipoFormacao");
    lblTipoFormacao.innerHTML = "Escolha o tipo de formaçao do seu curso: ";

    
    let slcTipoFormacao = document.createElement("select");
    slcTipoFormacao.classList.add("form-select");
    slcTipoFormacao.setAttribute("id","slcTipoFormacao");

    slcTipoFormacao.append(
        criarOption(0,"Escolha uma Formação: ")
        ,criarOption(1,"Tecnólogo")
        ,criarOption(2,"Bacharelado")
        ,criarOption(3,"Mestrado")
        ,criarOption(4,"Doutorado")
		    ,criarOption(5,"MBA")
		    ,criarOption(6,"Pós Doutorado")
    );

    divSelectTipoFormacao.append(lblTipoFormacao,slcTipoFormacao);
    frm.appendChild(divSelectTipoFormacao);
    // ------------------------
    let divSelectPeriodo = document.createElement("div");

    let lblPeriodo = document.createElement("label");
    lblPeriodo.setAttribute("for","slcPeriodo");
    lblPeriodo.innerHTML = "Escolha o período do seu curso: ";

    
    let slcPeriodo = document.createElement("select");
    slcPeriodo.classList.add("form-select");
    slcPeriodo.setAttribute("id","slcPeriodo");

    slcPeriodo.append(
        criarOption(0,"Escolha um Período: ")
        ,criarOption(1,"Matutino")
        ,criarOption(2,"Vespertino")
        ,criarOption(3,"Noturno")
        ,criarOption(4,"EAD")
    );

    divSelectPeriodo.append(lblPeriodo,slcPeriodo);
    frm.appendChild(divSelectPeriodo);
    
    let divAnoInicio = criarCampoDeTexto("AnoInicioFormacao",DATE.getFullYear()-5,"Digite o ano em que você começou o curso: ");
    divAnoInicio

    let txtAnoInicio = divAnoInicio.querySelector("#txtAnoInicioFormacao");

    txtAnoInicio.setAttribute("type","number");
    txtAnoInicio.setAttribute("class","form-control");
    txtAnoInicio.setAttribute("value",DATE.getFullYear()-5);
    txtAnoInicio.setAttribute("min",1800);

    let divAnoFormacao = document.createElement("div");

    let lblAnoFormacao = document.createElement("label");
    lblAnoFormacao.setAttribute("for","txtAnoFormacao");
    lblAnoFormacao.innerHTML = "Selecione a data aproximada em que você se formou: ";

    let txtAnoFormacao = document.createElement("input");
    txtAnoFormacao.setAttribute("id","txtAnoFormacao");
    txtAnoFormacao.setAttribute("type","number");
    txtAnoFormacao.setAttribute("class","form-control");
    txtAnoFormacao.setAttribute("value",DATE.getFullYear());
    txtAnoFormacao.setAttribute("min",1800);

    divAnoFormacao.append(lblAnoFormacao,txtAnoFormacao);
    frm.append(divAnoInicio,divAnoFormacao);

    modalBody.appendChild(frm);
    // --------------------- Footer --------------------------
    modalFooter.innerHTML = "";

    let btnAdicionar = document.createElement("button");
    btnAdicionar.setAttribute("type","button");
    btnAdicionar.setAttribute("class","btn btn-success");
    btnAdicionar.setAttribute("id","btnAdicionarFormacao");
    btnAdicionar.innerHTML = "Adicionar";

    btnAdicionar.addEventListener("click",()=>{
        adicionarExpAcad();
    });

    let btnFechar = document.createElement("button");
    btnFechar.setAttribute("type","button");
    btnFechar.setAttribute("class","btn btn-secondary");
    btnFechar.setAttribute("id","btnFechar");
    btnFechar.setAttribute("data-dismiss","modal");
    btnFechar.innerHTML = "Cancelar"


    modalFooter.append(btnAdicionar,btnFechar);
    
    exibirModal('#cad-modal');
}

function adicionarExpAcad(){
    let instituicao = document.getElementById("txtInstituicao").value;
    let curso = document.getElementById("txtCurso").value;
    let periodo = getSelectText("slcPeriodo");
    let tipoFormacao = getSelectText("slcTipoFormacao");
    let ano = document.getElementById("txtAnoFormacao").value;
    let anoInicio = document.getElementById("txtAnoInicioFormacao").value;

    if(instituicao != "" && instituicao != " "
        && curso != "" && curso != " "
            && periodo != "Escolha um Período:"
    ){
        let acadExp = new Object();
        
        let institution = new Object();
        institution.name = instituicao;

        let address = new Object();
        address.cep = '00000000';
        address.num_porta = '0';
        institution.address = address;

        acadExp.institution = institution;

        let course = new Object();
        course.name = curso;
        course.type_formation = tipoFormacao;
        
        acadExp.course = course;

        acadExp.begin_year = anoInicio;
        acadExp.end_year = ano;
        acadExp.period = periodo;

        criarExibicaoAcadExp(acadExp);
        closeModal('#cad-modal');
    }else{
        alert("Preencha os campos acima");
    }
}

function criarExibicaoAcadExp(experienciaAcademica){
    let div = document.createElement("div");
    div.classList.add("user-acad-exp-item");

    let spanInst = document.createElement("span");
    let spanCurso = document.createElement("span");
    let spanAno = document.createElement("span");

    spanInst.innerHTML = experienciaAcademica.institution.name;
    spanCurso.innerHTML = experienciaAcademica.course.name;
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

    div.append(spanInst,spanCurso,spanAno,lblExcluir,lblData);

    document.getElementById("user-academic-exp").appendChild(div);
}