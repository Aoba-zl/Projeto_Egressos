document.getElementById("btnAddProfissionalExp").addEventListener("click",()=>{
    abrirModalCadExpProfissional();
});

function criarExibicaoProfExp(experienciaProfissional){
    let div = document.createElement("div");
    div.classList.add("user-prof-exp-item");
    console.log("fdggfh");
    
console.log(experienciaProfissional);

    let spanEmpresa = document.createElement("span");
    let spanCargo = document.createElement("span");
    let spanAnoInicio = document.createElement("span");
    let spanAnoFim = document.createElement("span");

    spanEmpresa.innerHTML = experienciaProfissional.name;
    spanCargo.innerHTML = experienciaProfissional.area ? experienciaProfissional.area : experienciaProfissional.area_activity
;
    let dataInicio = new Date(experienciaProfissional.initial_date)
    spanAnoInicio.innerHTML = dataInicio.getFullYear();

    let end_year=experienciaProfissional.final_date
   
    if(end_year != "" 
        && end_year != " " && end_year != undefined){
        spanAnoFim.innerHTML = end_year;
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
        btnApagarDaTela(e);
    });

    div.append(spanEmpresa,spanCargo,spanAnoInicio,spanAnoFim,lblExcluir,spanData);

    document.getElementById("user-profission-exp").appendChild(div);
    //CASO SEJA EDIÇÃO DE DADOS
    div.addEventListener('click', (e)=>{
      if(e.target.classList.contains("btn-remove-item-exp")){
        return
    }
      abrirModalCadExpProfissional(e)
      let inputEmpresa = document.getElementById('txtEmpresa')
      inputEmpresa.value=experienciaProfissional.name
        loadCompanyData();
      let inputArea=document.getElementById('txtAreaAtuacao')
        inputArea.value=experienciaProfissional.area ? experienciaProfissional.area : experienciaProfissional.area_activity
      let inputInitialDate=document.getElementById('txtAnoInicio')
      inputInitialDate.value=experienciaProfissional.initial_date.split('T')[0]
      let inputFinalDate=document.getElementById('txtAnoFim')
      inputFinalDate.value=experienciaProfissional.final_date.split('T')[0]
      
  });
}

function adicionarExpProfissional(e){
  if(e!=undefined && e.target.classList.contains("btn-remove-item-exp")){
    return
}
    let nomeEmpresa = document.getElementById("txtEmpresa").value; 
    let telefoneEmpresa = document.getElementById("txtTelefone").value; 
    let emailEmpresa = document.getElementById("txtEmail").value;  
    let siteEmpresa = document.getElementById("txtSite").value;   
    let cepEmpresa = document.getElementById("txtCEP").value;
    let numPorta = document.getElementById("txtNumPorta").valueAsNumber;

    let areaAtuacao = document.getElementById("txtAreaAtuacao").value;
    let anoInicio = document.getElementById("txtAnoInicio").value;
    let anoFim = document.getElementById("txtAnoFim").value;
    let anoFimTxt = document.getElementById("txtAnoFim").value;

    let nomeOk = (nomeEmpresa != "" && nomeEmpresa != " ");
    let telefoneLimpo = limparTelefone(telefoneEmpresa); 
    let telefoneOK = (telefoneLimpo.length>9);
    let emailOk = (emailEmpresa.includes('@') && emailEmpresa.includes('.'));
    let siteOk = (siteEmpresa.includes("."));
    let cepOk = (limparCEP(cepEmpresa).length == 8);
    let numPortaOk = (Number.isInteger(numPorta));
    let areaOK = (areaAtuacao != "" && areaAtuacao != " ");
    let inicioOk = (anoInicio != " " && anoInicio != "");
    let fimOk = (true);

    console.log(anoInicio);
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
        expProfissional.area_activity = areaAtuacao;
        expProfissional.initial_date = anoInicio;
        expProfissional.final_date = anoFim;
        
        //-----------------------
        expProfissional.name = nomeEmpresa;
        expProfissional.phone = limparTelefone(telefoneEmpresa);
        expProfissional.email = emailEmpresa;
        expProfissional.site = siteEmpresa;
        expProfissional.address = address;
        //-----------------------

        criarExibicaoProfExp(expProfissional);
        closeModal('#cad-modal');
        if (e != undefined) {
          apagarDaTela(e)
        }
    }else{
        alert("Preencha os dados acima");
    }
}

function abrirModalCadExpProfissional(e){
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
    txtEmpresa.addEventListener("change",()=>{
      loadCompanyData();
    });

    txtEmpresa.addEventListener("keyup",()=>
    {      
      getNamesToAutocomplete('company',txtEmpresa);
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
      ,"Data aproximada de Início: "
    );

    let txtAnoInicio = divAnoInicio.querySelector("#txtAnoInicio");
    txtAnoInicio.setAttribute("type","date");

    form.appendChild(divAnoInicio);

    let divAnoFim = criarCampoDeTexto
    (
      "AnoFim"
      ,""
      ,"Data aproximada de Fim: "
    );
    divAnoFim.setAttribute('id',"divAnoFim");

    let txtAnoFim = divAnoFim.querySelector("#txtAnoFim");
    txtAnoFim.setAttribute("type","date");

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
        adicionarExpProfissional(e);
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

async function loadCompanyData() {
  let companyName = document.getElementById("txtEmpresa");

  let fone = document.getElementById("txtTelefone");
  let mail = document.getElementById("txtEmail");
  let site = document.getElementById("txtSite");
  let cep= document.getElementById("txtCEP");
  let number = document.getElementById("txtNumPorta");

  let vl = companyName.value.slice(0,-1);
  await $.ajax({
    url : serverUrl+"company/search?name="+vl,
    dataType: "json",
    contentType: "application/json",
    method : "get"
  })
  .done(async function(msg){
    if(msg.original.data[0] != null && msg.original.data[0] != undefined){
      if(companyName.value.includes(msg.original.data[0].name)){
        fone.removeAttribute("disabled");
        mail.removeAttribute("disabled");
        site.removeAttribute("disabled");

        fone.value = msg.original.data[0].phone;        
        mail.value = msg.original.data[0].email;
        site.value = msg.original.data[0].site;

        fone.setAttribute("disabled",true);
        mail.setAttribute("disabled",true);
        site.setAttribute("disabled",true);

        await $.ajax({
          url : serverUrl+"address/"+msg.original.data[0].id_address,
          dataType: "json",
          contentType: "application/json",
          method : "get"
        })
        .done(function(msg){          
          cep.removeAttribute("disabled");
          number.removeAttribute("disabled");

          cep.value = msg.cep;          
          number.value = msg.num_porta;

          cep.setAttribute("disabled",true);
          number.setAttribute("disabled",true);
        }).fail(function(jqXHR, textStatus, msg){
          console.log(jqXHR);
        });
      }else{        
        clearFields();
      }
    }else{      
      clearFields();
    }
  })
  .fail(function(jqXHR, textStatus, msg){
    console.log(jqXHR);
  });

  function clearFields(params) {
    fone.value = "";
    mail.value = "";
    site.value = "";
    cep.value = "";
    number.value = "";

    fone.removeAttribute("disabled");
    mail.removeAttribute("disabled");
    site.removeAttribute("disabled");
    cep.removeAttribute("disabled");
    number.removeAttribute("disabled");
  }
}
