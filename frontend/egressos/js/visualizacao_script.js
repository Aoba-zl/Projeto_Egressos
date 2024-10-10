window.onload = function () {
    $("#header").load("./components/header.html");
    $("#footer").load("./components/footer.html"); 

    init();
}

function init(){
    const profileId = new URLSearchParams(window.location.search).get('profile');
    
    setTimeout(() => {
        let btnEntrar=document.getElementById("btnEntrar");
        btnEntrar.classList.add("d-none");
        console.log(btnEntrar);
    }, 100);
   

}