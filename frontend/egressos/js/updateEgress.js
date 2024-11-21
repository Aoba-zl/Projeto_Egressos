window.onload = function () {
    $("#header").load("./components/header.html");
    $("#footer").load("./components/footer.html"); 

    init();
}
var idEgresso=''
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

async function carregaDados() {
    
    try {
       const response = await fetch(serverUrl+"egresses/"+user.id)
       if (!response.ok) {
        throw new Error('Erro ao buscar dados');
    }
    const result = await response.json();    
    console.log(result);
    
    return result
    } catch (error) {
        console.log(error);
        
    }
}
function preencheCampos(dados) {
    let txtName = document.getElementById("txtName");
    let txtCPF=document.getElementById("txtCPF")
    let chkIsPhonePublic=document.getElementById("cbFonePublico")
    let txtPhone=document.getElementById("txtFone")
    let txtBirthDate=document.getElementById("txtDtNasc")
    let txtFeedback=document.getElementById("txtFeedback")
    let image = document.getElementById("exbImagemPerfil")
    let pathImage = serverUrl +'storage/'+ dados.image_path;
            
    idEgresso=dados.id
    txtName.value = dados.name;
    txtCPF.value=dados.cpf
    txtPhone.value=dados.phone
    chkIsPhonePublic.checked=!dados.phone_is_public
    txtBirthDate.value=dados.birthdate.split("T")[0]
    txtFeedback.value=dados.feedback.comment
    image.setAttribute("src",pathImage)
    image.setAttribute("alt","Foto do Perfil")
console.log(dados);

    dados.contacts.forEach(contato => {
      if (contato.name!='Telefone') {
        criarExibicaoContato(contato)
      }
    });
    dados.academic_formation.forEach(formacao=>{
       
        criarExibicaoAcadExp( transformData(formacao))
    })
    dados.professional_experience.forEach(experiencia=>{
      experiencia.area_activity=experiencia.area
      let address=new Object()
      address.cep=experiencia.cep
      address.num_porta=experiencia.num_porta
      experiencia.address=address
      criarExibicaoProfExp(experiencia)
    })
}
async function init(){

    let dados=await carregaDados()
    preencheCampos(dados)

    // formatar campos
    $('#txtCPF').mask('000.000.000-00');
}
function transformData(data) {
  
    return {
      institution: {
        name: data.institution_name,
        address:{
          cep:"03694000",
          num_porta:"2983"
        }
      },
      course: {
        name: data.course_name, // Pega "ADS"
        type_formation: data.course_type_formation
      },
      begin_year: data.begin_year,  // Exemplo de conversão para 2008
      end_year: data.end_year, // Exemplo de conversão para 2012
      period: data.period
    };
  
 
}
document.getElementById('btnContinuarCadastro').addEventListener('click', ()=>{
 saveUser()
  saveUserContactsAndExperience()
}
)

//----------------------- SAVE -----------------------------
async function saveUser() {
  let name=document.getElementById('txtName').value

  await $.ajax({
    url : serverUrl+'user/'+getUserId(),
    dataType: "json",
    processData: true,
    contentType: 'application/json',
    method : "PUT",
    data : `{"name":"${name}"}`,
})
.done(async function(){
})
.fail(function(jqXHR, textStatus, msg){
  console.log(jqXHR);
  console.log(textStatus);  
  console.log(msg);
  alert(JSON.parse(jqXHR.responseText).message);
});
}

async function saveUserContactsAndExperience(){
  let contacts = getDivData("user-contacts");
  let acadExperiences = getDivData("user-academic-exp");
  let profExperiences = getDivData("user-profission-exp");

  let cpf = limparCPF(document.getElementById("txtCPF").value);
  let telefone = limparTelefone(document.getElementById("txtFone").value);
  let isTelefonePublico = document.getElementById("cbFonePublico").checked;
  let dataNasc = document.getElementById("txtDtNasc").value;
  let feedBack = document.getElementById("txtFeedback").value;
  let academic_formation = JSON.parse("[" + acadExperiences + "]");
  let image_file = document.getElementById('inputImagemPerfil').files[0];
  
  if (!image_file)
    image_file = document.getElementById("exbImagemPerfil").src

  let form_data_egress = new FormData();
  form_data_egress.append('_method', 'PUT')
  form_data_egress.append('id', idEgresso + '')
  form_data_egress.append('cpf', cpf)
  form_data_egress.append('phone', telefone);
  form_data_egress.append('isPhonePublic', isTelefonePublico);
  form_data_egress.append('birthdate', dataNasc);
  form_data_egress.append('feedback', feedBack.trim());
  form_data_egress.append('contacts', JSON.stringify(JSON.parse("["+contacts+"]")));
  form_data_egress.append('academic_formation', JSON.stringify(academic_formation));
  form_data_egress.append('professional_profile', JSON.stringify(JSON.parse("["+profExperiences+"]")));
  
  form_data_egress.append('image', image_file);
  
  let cpfOk = cpf.length > 10;
  let foneOk = telefone.length > 8;
  let dataNOk = dataNasc.length > 8;
  let feedBackOk = feedBack.trim().length > 2;

  if(cpfOk && foneOk && dataNOk && feedBackOk && image_file){    
    let endpoint = serverUrl + "egresses";
   
    let cursos = JSON.stringify(academic_formation);
    if((cursos.includes("FATEC-ZL"))){
      await $.ajax({
          url : endpoint,
          dataType: "json",
          processData: false,
          contentType: false,
          method : "POST",
          data : form_data_egress,
      })
      .done(async function(){
        alert("Enviado para análise")
        window.location.href='./visualizarPerfil.html?profile=' + user.id;
      })
      .fail(function(jqXHR, textStatus, msg){
        console.log(jqXHR);
        console.log(textStatus);  
        console.log(msg);
        alert(JSON.parse(jqXHR.responseText).message);
      });
    }else{
      alert("Você deve possuir uma formação na FATEC-ZL");
    }
  }else{
    if(!cpf || !foneOk || !dataNOk){
      alert("Preencha seus dados !");
    } else if (!image_file){
      alert("Escola uma imagem!")
    }else{
      alert("Escreva um feedback");
    }
  } 
}

function getDivData(divId) {
  let divData = document.getElementById(divId);
  let data = "";

  for (let i = 0; i < divData.children.length; i++) {
    data += divData.children[i].lastChild.innerHTML; 
    data += ",";   
  }

  data = data.slice(0,-1);
  return data;
}
//-----------------------------------------
// function autoCompleteInstituicao(txtInstituicao){
//     let instituicoes = ["FATEC-ZL","FATEC-SP","FATEC-FRV","USP","ITA","UNICAMP"]

//     autocomplete(txtInstituicao,instituicoes);
// }

// function autoCompleteCurso(txtCurso) {
//     let cursos = ['ADS','DSM','ADM','COMEX','RH'];

//     autocomplete(txtCurso,cursos);
// }

// function autoCompleteEmpresa(txtEmpresa){
//   let empresas = ['TOTVS','IBM','GOOGLE','MICROSOFT','IFOOD','NUBANK','BRADESCO','MERCADO LIVRE'];

//   autocomplete(txtEmpresa,empresas);
// }

// -------------------- @W3SCHOOLS ----------------------
function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus = 0;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", input);
  
  function input(e) {
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
        //if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
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
        //}
      }
  };
 
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