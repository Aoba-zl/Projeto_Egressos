window.onload = function () {
    init();
}

function init() {
    let token =  sessionStorage.getItem('token')
    let btnLoged = document.getElementById("btnLoged")
    let btnEntrar=document.getElementById("btnEntrar");

    let user = getUser();

    if(user != undefined){
        if(user.type_account != 0){
            document.getElementById("sepModeracao").classList.remove("disp-none");
            document.getElementById("btnModeracao").classList.remove("disp-none");
        }
    }

    if (token) {
        btnEntrar.classList.add("d-none"); 
        btnLoged.classList.remove("d-none"); 
        document.getElementById('profileButton').textContent=user.name.split(' ')[0];

    }else{
        btnEntrar.classList.remove("d-none"); 
        btnLoged.classList.add("d-none"); 
    }
}
init();

function isLoged() {
    const publicPages = ['/', '/cadastro.html', '/login.html','/cadastro2.html','/visualizarPerfil.html','/buscaDeAlunos.html','/redefinirSenha.html','/novaSenha.html'];
    let currentPath = window.location.pathname;
    currentPath = currentPath.replace("/projeto_egressos/frontend/egressos","");

    //console.log(currentPath);
    let token = sessionStorage.getItem('token');
    //console.log(currentPath);

    // Redireciona para a página de login se o token não estiver presente
    // e a página atual não estiver na lista de páginas públicas
    if (!token && !publicPages.includes(currentPath)) {
        window.location.href = 'login.html';
    }
}
    
document.getElementById('sair').addEventListener('click',async function () {
    sessionStorage.removeItem("token")
    sessionStorage.removeItem('user');
    sessionStorage.removeItem('egress');
    if (window.location.pathname == '/' ) {
        window.location.reload()
    }else{
        window.location.href = 'login.html';
    }
    
});

document.getElementById('myProfile').addEventListener('click',async function () {
    window.location.href = "./visualizarPerfil.html?profile=" + user.id;
});

document.getElementById('btnModeracao').addEventListener('click',async function () {
    window.location.href = "./homemoderador.html"
});

setTimeout(() => {
    isLoged()
}, 1000);