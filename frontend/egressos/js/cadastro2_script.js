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

//-------------- Functions -----------------------------
function init(){

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

    let divContatoLink = document.createElement("div");
    divContatoLink.setAttribute("class","mt-3");

    let lblLink = document.createElement("label");
    lblLink.setAttribute("for","txtLinkContato");
    lblLink.innerHTML = "Cole o link da sua rede social no campo abaixo: ";

    let linkContato = document.createElement("input");
    linkContato.setAttribute('id',"txtLinkContato")
    linkContato.setAttribute('type',"text")
    linkContato.setAttribute('class',"form-control")
    linkContato.setAttribute('placeholder',"Cole o link para a sua rede social aqui")

    divContatoLink.appendChild(lblLink);
    divContatoLink.appendChild(linkContato);
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
        alert("Adicionando ...........");
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

    let divInputInstituicao = document.createElement("div");
    divInputInstituicao.classList.add("autocomplete");

    let lblInstituicao = document.createElement("label");
    lblInstituicao.setAttribute("for","txtInstituicao");
    lblInstituicao.innerHTML = "Digite o nome da Instituição que você estudou: ";

    let txtInstituicao = document.createElement("input");
    txtInstituicao.setAttribute("id","txtInstituicao");
    txtInstituicao.setAttribute("type","text");
    txtInstituicao.setAttribute("class","form-control");
    txtInstituicao.setAttribute("placeholder","Digite o nome da instituição");

    txtInstituicao.addEventListener("focus",()=>{
        autoCompleteInstituicao(txtInstituicao);
    });

    divInputInstituicao.append(lblInstituicao,txtInstituicao);
    frm.appendChild(divInputInstituicao);

    let divInputCurso = document.createElement("div");
    divInputCurso.classList.add("autocomplete");

    let lblCurso = document.createElement("label");
    lblCurso.setAttribute("for","txtCurso");
    lblCurso.innerHTML = "Digite o curso que você concluiu: "

    let txtCurso = document.createElement("input");
    txtCurso.setAttribute("id","txtCurso");
    txtCurso.setAttribute("type","text");
    txtCurso.setAttribute("class","form-control");
    txtCurso.setAttribute("placeholder","Digite o nome do curso");

    txtCurso.addEventListener("focus",() => {
        autoCompleteCurso(txtCurso);
    });

    divInputCurso.append(lblCurso,txtCurso);
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
        criarOption(0,"Escolha um Período")
        ,criarOption(1,"Matutino")
        ,criarOption(2,"Vespertino")
        ,criarOption(3,"Noturno")
        ,criarOption(4,"EAD")
    );

    divSelectPeriodo.append(lblPeriodo,slcPeriodo);
    frm.appendChild(divSelectPeriodo);
    
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
    frm.appendChild(divAnoFormacao);

    modalBody.appendChild(frm);
    // --------------------- Footer --------------------------
    modalFooter.innerHTML = "";

    let btnAdicionar = document.createElement("button");
    btnAdicionar.setAttribute("type","button");
    btnAdicionar.setAttribute("class","btn btn-success");
    btnAdicionar.setAttribute("id","btnAdicionarFormacao");
    btnAdicionar.innerHTML = "Adicionar";

    btnAdicionar.addEventListener("click",()=>{
        alert("Adicionando Formacao...........");
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

    // ------------------- FOOTER ----------------------
    modalFooter.innerHTML = "";

    let btnAdicionar = document.createElement("button");
    btnAdicionar.setAttribute("type","button");
    btnAdicionar.setAttribute("class","btn btn-success");
    btnAdicionar.setAttribute("id","btnAdicionarExpProfissional");
    btnAdicionar.innerHTML = "Adicionar";

    btnAdicionar.addEventListener("click",()=>{
        alert("Adicionando Experiência Profissional...........");
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

function preencherSelectPlataforma(select){
    select.appendChild(criarOption(0,"Escolha uma Plataforma: "));

    // Adicionar mais com um loop

    return select;
}

function criarOption(value,desc){
    let opt = document.createElement("option");
    opt.setAttribute("value",value);
    opt.innerHTML = desc;
    return opt;
}

function exibirModal(){
    let modal = document.getElementById("cad-modal");
    let bootstrapModal = new bootstrap.Modal(modal);
    bootstrapModal.show(); 
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