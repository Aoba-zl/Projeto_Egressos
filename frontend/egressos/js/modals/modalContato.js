document.getElementById("btnAddContato").addEventListener("click",()=>{
    abrirModalCadContato();
});

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
    exibirModal('#cad-modal');
}

function adicionarContato(){
    let plataformaId = document.getElementById("slcPlatforma").value;

    let plataforma = getSelectText("slcPlatforma");

    let contato = document.getElementById("txtLinkContato").value;

    let platformOK = false;

    switch (plataforma.toUpperCase()) {
        case "EMAIL":
            platformOK = (contato.includes("@") && contato.includes("."));
            break;
        case "FACEBOOK":
            platformOK = (contato.includes("https://www.facebook.com/"));
            break;
        case "GITHUB":
            platformOK = (contato.includes("https://github.com/"));
            break;
        case "INSTAGRAM":
            platformOK = (contato.includes("https://www.instagram.com/"));
            break;
        case "LINKEDIN":
            platformOK = (contato.includes("https://www.linkedin.com/"));
            break;
        case "YOUTUBE":
            platformOK = (contato.includes("https://www.youtube.com/"));
            break;
        case "X":
            platformOK = (contato.includes("https://x.com/"));
            break;    
        default:
            platformOK = true;
            break;
    }

    if(plataformaId != 0 && contato != "" && contato != " " && platformOK){
        let cont = new Object();
        cont.plataform_name = plataforma;
        cont.id_platform = plataformaId;
        cont.contact = contato;
        
        criarExibicaoContato(cont);
        closeModal('#cad-modal');
    }else{
        if(platformOK){
            alert("Preencha os dados");
        }else{
            alert("Coloque um link válido para a rede social");
        }
    }
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

    spanId.innerHTML = contato.id_platform;
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

function preencherSelectPlataforma(select){
    select.appendChild(criarOption(0,"Escolha uma Plataforma: "));

    $.ajax({
      url : serverUrl+"platform",
      contentType: "application/json",
      method : "get",
      data : ""
    })
    .done(function(msg){
        let contatos = document.getElementById("user-contacts").innerHTML;
        msg.forEach(element => {
            if(!contatos.includes(element.name)){
                select.appendChild(criarOption(element.id,element.name));
            }
        });
    })
    .fail(function(jqXHR, textStatus, msg){
        console.log(msg);
    });

    return select;
}