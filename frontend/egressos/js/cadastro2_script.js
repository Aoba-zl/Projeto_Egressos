const DATE = new Date();
window.onload = function () {
    $("#header").load("./components/header.html");
    $("#footer").load("./components/footer.html"); 

    init();
}

document.getElementById("btnAddContato").addEventListener("click",()=>{
    abrirModalCadContato();
});

document.getElementById("btnAddAcadExp").addEventListener("click",()=>{
    abrirModalCadExpAcademica();
});

document.getElementById("btnAddProfissionalExp").addEventListener("click",()=>{
    abrirModalCadExpProfissional();
});

document.getElementById("inputImagemPerfil").addEventListener("change",(e)=>{
    let imgPerfil = document.getElementById("exbImagemPerfil");
    imgPerfil.setAttribute("src",URL.createObjectURL(e.target.files[0]));
});

document.getElementById("txtFone").addEventListener("focus",()=>{
  $('#txtFone').mask('(00) 00000-0000');
});

document.getElementById("txtFone").addEventListener("change",()=>{
  
  if(document.getElementById("txtFone").value.length > 14){
    $('#txtFone').mask('(00) 00000-0000');
  }else{
    $('#txtFone').mask('(00) 0000-0000');
  }

});
//-------------- Functions -----------------------------
function init(){
    let user = getCookie("user");
    if(user != undefined){
      user = JSON.parse(user);
      if(user.user.id != undefined && user.user.id != ""){
        let txtName = document.getElementById("txtName");

        txtName.value = user.user.name;
        txtName.setAttribute("disabled","true");
      }else{
        window.location.href = "./cadastro.html";
      }
    }else{
      window.location.href = "./cadastro.html";
    }

    // formatar campos
    $('#txtCPF').mask('000.000.000-00');
}

function getUserId(){
  let user = JSON.parse(getCookie("user"));
  return user.user.id;
}

function abrirModalCadContato(){
    let modalTitle = document.getElementById("modal-title");
    let modalBody = document.getElementById("modal-body");
    let modalFooter = document.getElementById("modal-footer");

    modalTitle.innerHTML = "Adicionar Contato";
    
    // --------------------- Body ----------------------------
    let form = document.createElement("form");
    form.setAttribute("id","frmCadContato");

    let divContatoSelect = document.createElement("div");
    
    let lblSelect = document.createElement("label");
    lblSelect.setAttribute("for","slcPlatforma");
    lblSelect.innerHTML = "Escolha uma rede social na lista: ";
    

    let select = document.createElement("select");
    select.classList.add("form-select");
    select.setAttribute("id","slcPlatforma");
    
    select = preencherSelectPlataforma(select);
    
    divContatoSelect.appendChild(lblSelect);
    divContatoSelect.appendChild(select);

    form.appendChild(divContatoSelect);

    let divContatoLink =  criarCampoDeTexto(
                            "LinkContato",
                            "Cole o link para a sua rede social aqui",
                            "Cole o link da sua rede social no campo abaixo: "
                          );

    form.appendChild(divContatoLink);
    
    modalBody.innerHTML = "";
    modalBody.appendChild(form);

    // --------------------- Footer --------------------------
    modalFooter.innerHTML = "";

    let btnAdicionar = document.createElement("button");
    btnAdicionar.setAttribute("type","button");
    btnAdicionar.setAttribute("class","btn btn-success");
    btnAdicionar.setAttribute("id","btnAdicionarContato");
    btnAdicionar.innerHTML = "Adicionar"

    btnAdicionar.addEventListener("click",()=>{
        adicionarContato();
    });

    let btnFechar = document.createElement("button");
    btnFechar.setAttribute("type","button");
    btnFechar.setAttribute("class","btn btn-secondary");
    btnFechar.setAttribute("id","btnFechar");
    btnFechar.setAttribute("data-dismiss","modal");
    btnFechar.innerHTML = "Cancelar"


    modalFooter.appendChild(btnAdicionar);
    modalFooter.appendChild(btnFechar);
    exibirModal();
}

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

    txtInstituicao.addEventListener("focus",()=>{
        autoCompleteInstituicao(txtInstituicao);
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

    txtCurso.addEventListener("focus",() => {
        autoCompleteCurso(txtCurso);
    });

    frm.appendChild(divInputCurso);

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
    txtAnoInicio.setAttribute("placeholder","");
    txtAnoInicio.setAttribute("min","1800");
    txtAnoInicio.setAttribute("value",DATE.getFullYear()-5);

    let divAnoFormacao = document.createElement("div");

    let lblAnoFormacao = document.createElement("label");
    lblAnoFormacao.setAttribute("for","txtAnoFormacao");
    lblAnoFormacao.innerHTML = "Digite o ano em que você se formou: ";

    let txtAnoFormacao = document.createElement("input");
    txtAnoFormacao.setAttribute("id","txtAnoFormacao");
    txtAnoFormacao.setAttribute("type","number");
    txtAnoFormacao.setAttribute("class","form-control");
    txtAnoFormacao.setAttribute("placeholder","2024");
    txtAnoFormacao.setAttribute("min","1800");
    txtAnoFormacao.setAttribute("value",DATE.getFullYear());

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
    
    exibirModal();
}

function abrirModalCadExpProfissional(){
    let modalTitle = document.getElementById("modal-title");
    let modalBody = document.getElementById("modal-body");
    let modalFooter = document.getElementById("modal-footer");

    modalTitle.innerHTML = "Adicionar Experiência Profissional";
    
    // ------------------- BODY ----------------------
    modalBody.innerHTML = "";
    let form = document.createElement("form");

    let headerEmpresa = document.createElement("h2");
    headerEmpresa.innerHTML = "Empresa";
    form.append(headerEmpresa,document.createElement("hr"));

    let divInputEmpresa = criarCampoDeTexto
    (
      "Empresa"
      ,"Digite o nome da Empresa"
      ,"Empresa que você trabalha ou trabalhou:"
    );

    divInputEmpresa.classList.add("autocomplete");

    let txtEmpresa = divInputEmpresa.querySelector("#txtEmpresa");

    txtEmpresa.addEventListener("focus",()=>
    {
      autoCompleteEmpresa(txtEmpresa);
    });

    form.appendChild(divInputEmpresa);

    let divTelefoneEmpresa = criarCampoDeTexto
    (
      "Telefone"
      ,"(11) 1234-5678"
      ,"Digite o telefone da empresa: "
    );

    let txtTelefone = divTelefoneEmpresa.querySelector("#txtTelefone");

    txtTelefone.addEventListener("focus",()=>{
      $('#txtTelefone').mask('(00) 00000-0000');
    });

    txtTelefone.addEventListener("change",()=>{  
      if(document.getElementById("txtTelefone").value.length > 14){
        $('#txtTelefone').mask('(00) 00000-0000');
      }else{
        $('#txtTelefone').mask('(00) 0000-0000');
      }    
    });

    form.appendChild(divTelefoneEmpresa);

    let divEmailEmpresa = criarCampoDeTexto
    (
      "Email"
      ,"Digite o email da empresa"
      ,"Email da empresa: "
    );

    form.appendChild(divEmailEmpresa);

    let divSiteEmpresa = criarCampoDeTexto
    (
      "Site"
      ,"Digite o Site da empresa"
      ,"Site da Empresa: "
    )

    form.appendChild(divSiteEmpresa);

    let divCepEmpresa = criarCampoDeTexto
    (
      "CEP"
      ,"Digite o CEP"
      ,"CEP do Logradouro(Rua) da empresa:"
    )

    let cep = divCepEmpresa.querySelector("#txtCEP");
    cep.addEventListener("focus",()=>{
      $('#txtCEP').mask('00000-000');
    });    
    
    form.appendChild(divCepEmpresa);

    let divNumPorta = criarCampoDeTexto
    (
      "NumPorta"
      ,"Digite o numero de porta da empresa (numero da rua)"
      ,"Número de porta da empresa (numero da rua):"
    );
    let num = divNumPorta.querySelector("#txtNumPorta");
    num.setAttribute("type","number");
    num.setAttribute("min","0");
    num.setAttribute("step","1");
    
    num.addEventListener("keyup",()=>{
      let value = num.value;

    });

    form.appendChild(divNumPorta);
    
    let headerSuaExp = document.createElement("h2");
    headerSuaExp.innerHTML = "Sua Experiência"

    form.append(
        document.createElement("br"),
        headerSuaExp,
        document.createElement("hr")
      );

    let divAtuacao = criarCampoDeTexto
    (
      "AreaAtuacao"
      ,"Digite a área de Atuação"
      ,"Área de atuação: "
    );
    form.appendChild(divAtuacao);

    let divAnoInicio = criarCampoDeTexto
    (
      "AnoInicio"
      ,""
      ,"Ano de Início:"
    );

    let txtAnoInicio = divAnoInicio.querySelector("#txtAnoInicio");
    txtAnoInicio.setAttribute("type","number");
    txtAnoInicio.setAttribute("value",DATE.getFullYear()-5);

    form.appendChild(divAnoInicio);

    let divAnoFim = criarCampoDeTexto
    (
      "AnoFim"
      ,""
      ,"Ano de Fim:"
    );
    divAnoFim.setAttribute('id',"divAnoFim");

    let txtAnoFim = divAnoFim.querySelector("#txtAnoFim");
    txtAnoFim.setAttribute("type","number");
    txtAnoFim.setAttribute("value",DATE.getFullYear());

    form.appendChild(divAnoFim); 

    

    modalBody.appendChild(form);
    // ------------------- FOOTER ----------------------
    modalFooter.innerHTML = "";

    let btnAdicionar = document.createElement("button");
    btnAdicionar.setAttribute("type","button");
    btnAdicionar.setAttribute("class","btn btn-success");
    btnAdicionar.setAttribute("id","btnAdicionarExpProfissional");
    btnAdicionar.innerHTML = "Adicionar";

    btnAdicionar.addEventListener("click",()=>{
        adicionarExpProfissional();
    });

    let btnFechar = document.createElement("button");
    btnFechar.setAttribute("type","button");
    btnFechar.setAttribute("class","btn btn-secondary");
    btnFechar.setAttribute("id","btnFechar");
    btnFechar.setAttribute("data-dismiss","modal");
    btnFechar.innerHTML = "Cancelar"


    modalFooter.append(btnAdicionar,btnFechar);
    exibirModal();
}

function adicionarContato(){
  let plataformaId = document.getElementById("slcPlatforma").value;
  
  let plataforma = getSelectText("slcPlatforma");

  let contato = document.getElementById("txtLinkContato").value;

  if(plataformaId != 0 && contato != "" && contato != " "){
    let cont = new Object();
    cont.plataform_name = plataforma;
    cont.plataform = plataformaId;
    cont.contact = contato;
    cont.id_egress = getUserId();
    
    criarExibicaoContato(cont);
    closeModal();
  }else{
    alert("Preencha os dados");
  }
}

function adicionarExpAcad(){
  let instituicao = document.getElementById("txtInstituicao").value;
  let curso = document.getElementById("txtCurso").value;
  let periodo = getSelectText("slcPeriodo");
  let ano = document.getElementById("txtAnoFormacao").value;
  let anoInicio = document.getElementById("txtAnoInicioFormacao").value;

  console.log(periodo)
  if(instituicao != "" && instituicao != " "
      && curso != "" && curso != " "
        && periodo != "Escolha um Período:"
  ){
    let acadExp = new Object();
    acadExp.institution = instituicao;
    acadExp.course = curso;
    acadExp.period= periodo;
    acadExp.begin_year = anoInicio;
    acadExp.end_year = ano;
    acadExp.id_egress = getUserId();

    criarExibicaoAcadExp(acadExp);
    closeModal();
  }else{
    alert("Preencha os campos acima");
  }
}

function adicionarExpProfissional(){
  let nomeEmpresa = document.getElementById("txtEmpresa").value; 
  let telefoneEmpresa = document.getElementById("txtTelefone").value; 
  let emailEmpresa = document.getElementById("txtEmail").value;  
  let siteEmpresa = document.getElementById("txtSite").value;   
  let cepEmpresa = document.getElementById("txtCEP").value;
  let numPorta = document.getElementById("txtNumPorta").valueAsNumber;

  let areaAtuacao = document.getElementById("txtAreaAtuacao").value;
  let anoInicio = document.getElementById("txtAnoInicio").valueAsNumber;
  let anoFim = document.getElementById("txtAnoFim").valueAsNumber;
  let anoFimTxt = document.getElementById("txtAnoFim").value;

  let nomeOk = (nomeEmpresa != "" && nomeEmpresa != " ");
  let telefoneLimpo = limparTelefone(telefoneEmpresa); 
  let telefoneOK = (telefoneLimpo.length>9);
  let emailOk = (emailEmpresa.includes('@') && emailEmpresa.includes('.'));
  let siteOk = (siteEmpresa.includes("."));
  let cepOk = (limparCEP(cepEmpresa).length == 8);
  let numPortaOk = (Number.isInteger(numPorta));
  let areaOK = (areaAtuacao != "" && areaAtuacao != " ");
  let inicioOk = (Number.isInteger(anoInicio));
  let fimOk = (Number.isInteger(anoFim) || (anoFimTxt == "" 
                || anoFimTxt == " "));

  console.log(anoFim);

  if(nomeOk && telefoneOK && emailOk 
      && siteOk && cepOk && numPortaOk
        &&areaOK && inicioOk && fimOk){

    /*
    let empresa = new Object();
    empresa.name = nomeEmpresa;
    empresa.phone = limparTelefone(telefoneEmpresa);
    empresa.email = emailEmpresa;
    empresa.site = siteEmpresa;
    
    */
    let address = new Object();
    
    address.cep = limparCEP(cepEmpresa);
    address.num_porta = numPorta;

    //empresa.address = address;

    let expProfissional = new Object();
    //expProfissional.empresa = empresa;
    expProfissional.area_atuacao = areaAtuacao;
    expProfissional.ano_ingresso = anoInicio;
    expProfissional.ano_saida = anoFim;
    expProfissional.id_egress = getUserId();
    
    //-----------------------
    expProfissional.nome = nomeEmpresa;
    expProfissional.telefone = limparTelefone(telefoneEmpresa);
    expProfissional.email = emailEmpresa;
    expProfissional.site = siteEmpresa;
    expProfissional.endereco = address;
    //-----------------------

    criarExibicaoProfExpB(expProfissional);
    closeModal();
  }else{
    alert("Preencha os dados acima");
  }
}

function limparTelefone(telefone){
  console.log(telefone);
  telefone = telefone.replace(" ","");
  telefone = telefone.replace("-","");
  telefone = telefone.replace("(","");
  telefone = telefone.replace(")","");

  console.log(telefone);
  return telefone;
}

function limparCEP(cep) {
  cep = cep.replace(" ","");
  cep = cep.replace("-","");
  return cep;
}

function getSelectText(selectId){
  let select = document.getElementById(selectId);
  let index = select.selectedIndex;
  return select.options[index].text;
}

function apagarDaTela(e){
  e.target.parentNode.remove();
}

function criarExibicaoProfExp(experienciaProfissional){
  let div = document.createElement("div");
  div.classList.add("user-prof-exp-item");

  let spanEmpresa = document.createElement("span");
  let spanCargo = document.createElement("span");
  let spanAnoInicio = document.createElement("span");
  let spanAnoFim = document.createElement("span");

  spanEmpresa.innerHTML = experienciaProfissional.empresa.name;
  spanCargo.innerHTML = experienciaProfissional.areaAtuacao;
  spanAnoInicio.innerHTML = experienciaProfissional.anoInicio;
  
  console.log(experienciaProfissional.anoFim);
  if(!isNaN(experienciaProfissional.anoFim)){
    spanAnoFim.innerHTML = experienciaProfissional.anoFim;
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

  document.getElementById("user-profission-exp").appendChild(div);
}

function criarExibicaoProfExpB(experienciaProfissional){
  let div = document.createElement("div");
  div.classList.add("user-prof-exp-item");

  let spanEmpresa = document.createElement("span");
  let spanCargo = document.createElement("span");
  let spanAnoInicio = document.createElement("span");
  let spanAnoFim = document.createElement("span");

  spanEmpresa.innerHTML = experienciaProfissional.nome;
  spanCargo.innerHTML = experienciaProfissional.telefone;
  spanAnoInicio.innerHTML = experienciaProfissional.ano_ingresso;
  
  if(!isNaN(experienciaProfissional.ano_saida)){
    spanAnoFim.innerHTML = experienciaProfissional.ano_saida;
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

  document.getElementById("user-profission-exp").appendChild(div);
}

function criarExibicaoContato(contato){
  let divContatos = document.getElementById("user-contacts");

  let divNovoContato = document.createElement("div");
  divNovoContato.setAttribute("id",contato.plataform_name+"_"+
    divContatos.childElementCount);
  divNovoContato.classList.add("user-contact-item");

  let spanId = document.createElement("span");
  let spanPlataform = document.createElement("span");
  let spanContato = document.createElement("span");

  spanId.classList.add("d-none");

  spanId.innerHTML = contato.id;
  spanPlataform.innerHTML = contato.plataform_name;
  spanContato.innerHTML = contato.contact;

  let lblExcluir = document.createElement("label");
  lblExcluir.innerHTML = "X"
  lblExcluir.classList.add("btn-remove-item");
  lblExcluir.addEventListener('click',(e)=>{
    apagarDaTela(e);
  });

  let spanData = document.createElement("span");
  spanData.classList.add("d-none");
  spanData.innerHTML = JSON.stringify(contato);
  
  divNovoContato.append(spanId,spanPlataform,spanContato,lblExcluir,spanData);
  divContatos.appendChild(divNovoContato);
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

  document.getElementById("user-academic-exp").appendChild(div);
}

function preencherSelectPlataforma(select){
    select.appendChild(criarOption(0,"Escolha uma Plataforma: "));

    $.ajax({
      url : serverUrl+"platform",
      contentType: "application/json",
      type : "get",
      data : ""
    })
    .done(function(msg){
        msg.forEach(element => {
          select.appendChild(criarOption(element.id,element.name));
        });
    })
    .fail(function(jqXHR, textStatus, msg){
        console.log(msg);
    });

    return select;
}

function criarOption(value,desc){
    let opt = document.createElement("option");
    opt.setAttribute("value",value);
    opt.innerHTML = desc;
    return opt;
}

function exibirModal(){
  $('#cad-modal').modal('show');
} 

function closeModal() {
  $('#cad-modal').modal('hide');
}

function criarCampoDeTexto(name,placeholder,labelText){
  let div = document.createElement('div');

  let label = document.createElement("label");
  label.setAttribute("for","txt"+name);
  label.innerHTML = labelText;

  let field = document.createElement("input");
  field.setAttribute('id',"txt"+name);
  field.setAttribute('type',"text");
  field.setAttribute('class',"form-control");
  field.setAttribute('placeholder',placeholder);
  
  div.append(label,field);
  
  return div;
}
//-----------------------------------------
function autoCompleteInstituicao(txtInstituicao){
    let instituicoes = ["FATEC-ZL","FATEC-SP","FATEC-FRV","USP","ITA","UNICAMP"]

    autocomplete(txtInstituicao,instituicoes);
}

function autoCompleteCurso(txtCurso) {
    let cursos = ['ADS','DSM','ADM','COMEX','RH'];

    autocomplete(txtCurso,cursos);
}

function autoCompleteEmpresa(txtEmpresa){
  let empresas = ['TOTVS','IBM','GOOGLE','MICROSOFT','AVANADE','IFOOD','NUBANK','BRADESCO','MERCADO LIVRE'];

  autocomplete(txtEmpresa,empresas);
}
// -------------------- @W3SCHOOLS ----------------------
function autocomplete(inp, arr) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function(e) {
        var a, b, i, val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) { return false;}
        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);
        /*for each item in the array...*/
        for (i = 0; i < arr.length; i++) {
          /*check if the item starts with the same letters as the text field value:*/
          if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
            /*create a DIV element for each matching element:*/
            b = document.createElement("DIV");
            /*make the matching letters bold:*/
            b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
            b.innerHTML += arr[i].substr(val.length);
            /*insert a input field that will hold the current array item's value:*/
            b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
            /*execute a function when someone clicks on the item value (DIV element):*/
                b.addEventListener("click", function(e) {
                /*insert the value for the autocomplete text field:*/
                inp.value = this.getElementsByTagName("input")[0].value;
                /*close the list of autocompleted values,
                (or any other open lists of autocompleted values:*/
                closeAllLists();
            });
            a.appendChild(b);
          }
        }
    });
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function(e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
          /*If the arrow DOWN key is pressed,
          increase the currentFocus variable:*/
          currentFocus++;
          /*and and make the current item more visible:*/
          addActive(x);
        } else if (e.keyCode == 38) { //up
          /*If the arrow UP key is pressed,
          decrease the currentFocus variable:*/
          currentFocus--;
          /*and and make the current item more visible:*/
          addActive(x);
        } else if (e.keyCode == 13) {
          /*If the ENTER key is pressed, prevent the form from being submitted,*/
          e.preventDefault();
          if (currentFocus > -1) {
            /*and simulate a click on the "active" item:*/
            if (x) x[currentFocus].click();
          }
        }
    });
    function addActive(x) {
      /*a function to classify an item as "active":*/
      if (!x) return false;
      /*start by removing the "active" class on all items:*/
      removeActive(x);
      if (currentFocus >= x.length) currentFocus = 0;
      if (currentFocus < 0) currentFocus = (x.length - 1);
      /*add class "autocomplete-active":*/
      x[currentFocus].classList.add("autocomplete-active");
    }
    function removeActive(x) {
      /*a function to remove the "active" class from all autocomplete items:*/
      for (var i = 0; i < x.length; i++) {
        x[i].classList.remove("autocomplete-active");
      }
    }
    function closeAllLists(elmnt) {
      /*close all autocomplete lists in the document,
      except the one passed as an argument:*/
      var x = document.getElementsByClassName("autocomplete-items");
      for (var i = 0; i < x.length; i++) {
        if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

/*  ============== COOKIES ==================    */
function setCookie(name,value){
  let maxAgeSeconds = 604800;
document.cookie = name+ "=" + value + ";SameSite=None; Secure; max-age="+maxAgeSeconds;
}

function deleteCookie(name){
document.cookie = name+ "=" + value + ";SameSite=None; Secure; max-age="+-700;
}

//W3Schools
function getCookie(name) {
let cookie = {};
document.cookie.split(';').forEach(function(el) {
  let [key,value] = el.split('=');
  cookie[key.trim()] = value;
})
return cookie[name];
}