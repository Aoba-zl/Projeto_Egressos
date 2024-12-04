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

        if(user.type_account == 2){
            document.getElementById("sepAdministracao").classList.remove("disp-none");
            document.getElementById("btnAdministracao").classList.remove("disp-none");
        }

        let egressId = getEgressId();
        if(egressId == undefined || egressId == null){
            document.getElementById("myProfile").classList.add("disp-none");
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
    const publicPages = ['/', '/cadastro', '/login','/cadastro2','/visualizarperfil','/buscadealunos','/redefinirsenha','/novasenha'];
    let currentPath = window.location.pathname.toLowerCase();
    currentPath = currentPath.replace("/projeto_egressos/frontend/egressos","");

    //console.log(currentPath);
    let token = sessionStorage.getItem('token');
    //console.log(currentPath);

    // Redireciona para a página de login se o token não estiver presente
    // e a página atual não estiver na lista de páginas públicas
    if (!token && !publicPages.includes(currentPath)) {
        window.location.href = 'login';
    }
}

document.getElementById('sair').addEventListener('click',async function () {
    sessionStorage.removeItem("token")
    sessionStorage.removeItem('user');
    sessionStorage.removeItem('egress');
    if (window.location.pathname == '/' ) {
        window.location.reload()
    }else{
        window.location.href = 'login';
    }

});

document.getElementById('myProfile').addEventListener('click',async function () {
    window.location.href = "./visualizarPerfil?profile=" + user.id;
});

document.getElementById('btnModeracao').addEventListener('click',async function () {
    window.location.href = "./homemoderador"
});

document.getElementById('btnAdministracao').addEventListener('click',async function () {
    window.location.href = "./homeadministrador"
});

setTimeout(() => {
    isLoged()
}, 1000);
