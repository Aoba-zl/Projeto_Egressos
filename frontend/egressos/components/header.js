window.onload = function () {
    init();
}
var user = sessionStorage.getItem('user')
var userData= JSON.parse(user)
function init() {
   

    let token =  sessionStorage.getItem('token')
    let btnLoged = document.getElementById("btnLoged")
    let btnEntrar=document.getElementById("btnEntrar");

    if (token) {
        btnEntrar.classList.add("d-none"); 
        btnLoged.classList.remove("d-none"); 
        document.getElementById('profileButton').textContent=userData.name.split(' ')[0];

    }else{
        btnEntrar.classList.remove("d-none"); 
        btnLoged.classList.add("d-none"); 
    }

}
init()

function isLoged() {
    const publicPages = ['/', '/cadastro.html', '/login.html','/cadastro2.html'];
    const currentPath = window.location.pathname;

    let token = sessionStorage.getItem('token');

    // Redireciona para a página de login se o token não estiver presente
    // e a página atual não estiver na lista de páginas públicas
    if (!token && !publicPages.includes(currentPath)) {
        window.location.href = 'login.html';
    }
}
    document.getElementById('sair').addEventListener('click',async function () {
        sessionStorage.removeItem("token")
        sessionStorage.removeItem('user');
        if (window.location.pathname == '/' ) {
            window.location.reload()
        }else{
            window.location.href = 'login.html';
        }
       
    })
    document.getElementById('myProfile').addEventListener('click',async function () {
        window.location.href = "./visualizarPerfil.html?profile=" + userData.id;
    })

setTimeout(() => {
    isLoged()
}, 1000);

  
