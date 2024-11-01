window.onload = function () {
    $("#header").load("./components/header.html");
    $("#footer").load("./components/footer.html"); 

    init();
}

function init(){
    const egressId = new URLSearchParams(window.location.search).get('egress');
    console.log(egressId);
}