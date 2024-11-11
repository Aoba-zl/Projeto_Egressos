const baseURL = "http://localhost:8000/"
const serverUrl = baseURL + "api/";
const DATE = new Date();

getCsrfToken();
async function getCsrfToken() {
  if(getCookie('XSRF-TOKEN') == undefined){
    await fetch(baseURL + 'sanctum/csrf-cookie', {
      method: 'GET',
      credentials: 'include'
    });
  }

  return getCookie('XSRF-TOKEN');
}
// consultar mdn docs
async function generateHash(value) {
    value+="portalDeEgressosFatecZlSalt";
    const encoder = new TextEncoder();
    const data = encoder.encode(value);
    const hashBuffer = await window.crypto.subtle.digest("SHA-256", data);

    const hashArray = Array.from(new Uint8Array(hashBuffer)); // convert buffer to byte array
    const hashHex = hashArray
      .map((b) => b.toString(16).padStart(2, "0"))
      .join(""); // convert bytes to hex string

    return hashHex;
}

/*  ============== USER ==================    */
function getUserId(){
  let user = JSON.parse(getStorage("user"));
  return user.user.id;
}

function getUserIdPosLogin(){
  let user = JSON.parse(getStorage("user"));
  return user.id;
}

function getEgressId(){
  let egress = JSON.parse(getStorage("egress"));
  return egress.id;
}

function getUser(){
  return JSON.parse(getStorage("user"));
}

/*  ============== FORMS ==================    */
function criarCampoDeTexto(name,placeholder,labelText){
  let div = document.createElement('div');

  let label = document.createElement("label");
  label.setAttribute("for","txt"+name);
  label.setAttribute("id","lblForTxt"+name);
  label.innerHTML = labelText;

  let field = document.createElement("input");
  field.setAttribute('id',"txt"+name);
  field.setAttribute('type',"text");
  field.setAttribute('class',"form-control");
  field.setAttribute('placeholder',placeholder);
  
  div.append(label,field);
  
  return div;
}

function limparTelefone(telefone){
  telefone = telefone.replace(" ","");
  telefone = telefone.replace("-","");
  telefone = telefone.replace("(","");
  telefone = telefone.replace(")","");

  return telefone;
}

function limparCEP(cep) {
  cep = cep.replace(" ","");
  cep = cep.replace("-","");
  return cep;
}

function limparCPF(cpf) {
  cpf = cpf.replace(".","");
  cpf = cpf.replace(" ","");
  cpf = cpf.replace("-","");
  cpf = cpf.replace(".","");
  return cpf;
}

function getSelectText(selectId){
  let select = document.getElementById(selectId);
  let index = select.selectedIndex;
  return select.options[index].text;
}

function criarOption(value,desc){
  let opt = document.createElement("option");
  opt.setAttribute("value",value);
  opt.innerHTML = desc;
  return opt;
}

function apagarDaTela(e){
  e.target.parentNode.remove();
}

function getStatusDescription(status) {
  let stat = "";
  switch (status) {
    case '0':
        stat = "Em análise"
        break;
    case '1':
        stat = "Aprovado"
        break;
    case '2':
        stat = "Reprovado"
        break;
    default:
        stat = "___"
        break;
  }

  return stat;
}
//----------------------- MODAL -----------------------------
function exibirModal(modalId){
  $(modalId).modal('show');
} 

function closeModal(modalId) {
  $(modalId).modal('hide');
}
/*  ============== SESSION ==================    */
function setStorage(name,value){
  sessionStorage.setItem(name,value);
}

function deleteStorage(name){
  sessionStorage.removeItem(name);
}

function getStorage(name) {
  return sessionStorage.getItem(name);
}

/*  ============== AUTOCOMPLETE FIELDS ==================    */
async function getNamesToAutocomplete(entity,field) {
  try {
    const response = await fetch(`${serverUrl}${entity}/search?name=${field.value}`);
    
    if (!response.ok) {
        throw new Error('Erro ao buscar cursos');
    }

    const result = await response.json();
    
    const names = result.original.data.map((item)=>item.name);
    
    autocomplete(field,names)
    
} catch (error) {
    console.error('Erro:', error);
}
}

/*  ============== COOKIE ==================    */
//W3Schools
function getCookie(name) {
  let cookie = {};
  document.cookie.split(';').forEach(function(el) {
    let [key,value] = el.split('=');
    cookie[key.trim()] = value;
  })
  return cookie[name];
}

function deleteCookie(name){
  setCookie(name,"",-700)
}

function setCookie(name,value,maxAgeSeconds){
	document.cookie = name+ "=" + value + ";SameSite=None; Secure; max-age="+maxAgeSeconds;
}