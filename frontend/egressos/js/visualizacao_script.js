window.onload = function () {
    $("#header").load("./components/header.html");
    $("#footer").load("./components/footer.html"); 

    init();
}

function init(){
    const profileId = new URLSearchParams(window.location.search).get('profile');
    console.log("id = "+profileId);
}