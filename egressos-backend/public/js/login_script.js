window.onload = function () {
    $("#header").load("./components/header.html");
    $("#footer").load("./components/footer.html");

    init();
}

function init(){
    setTimeout(() => {
        let btnEntrar=document.getElementById("btnEntrar");
        btnEntrar.classList.add("d-none");

    }, 100);
}

document.getElementById('entrar').addEventListener('click', async function () {
    const email = document.getElementById('txtEmail').value;
    const password = document.getElementById('txtPassword').value;

    if (!email || !password) {
        showAlert('Por favor, preencha ambos os campos de email e senha.', 'alert-danger');
        return;
    }

    const payload = {
        email: email,
        password: await generateHash(password)
    };

    try {
        let endpoint = serverUrl + "login";
        const response = await fetch(endpoint, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(payload)
        });

        const data = await response.json();

        if (response.ok) {
            // Armazenar o token no sessionStorage

            sessionStorage.setItem('token', data.access_token);
            sessionStorage.setItem('user',JSON.stringify(data.user));
            
            // Login successful
            showAlert('Login realizado com sucesso!', 'alert-success');
            if(data.user.type_account == 0){
                // Save egress data in session
                await $.ajax({
                    url : serverUrl + "egresses/" + data.user.id,
                    dataType: "json",
                    contentType: "application/json",
                    method : "GET"
                })
                .done(function(msg){
                    setStorage("egress",JSON.stringify(msg));
                })
                .fail(function(jqXHR, textStatus, msg){
                    if(msg == "Not Found"){
                        window.location.href = "./";
                    }

                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(msg);
                });

                window.location.href = "./visualizarPerfil?profile=" + data.user.id;
            }else{
                window.location.href = "./homemoderador";
            }
        } else {
            // Login failed, show error message from the API
            showAlert(data.message || 'Falha ao realizar login', 'alert-danger');
        }
    } catch (error) {
        showAlert('Erro ao conectar com o servidor', 'alert-danger');
    }
});

document.getElementById("forgotPasswd").addEventListener("click", (e)=>{
    e.preventDefault();
    exibirModal("#redefinir-senha-modal");
});

function showAlert(message, alertType) {
    const alertPlaceholder = document.createElement('div');
    alertPlaceholder.className = `alert ${alertType} mt-3`;
    alertPlaceholder.textContent = message;
    document.querySelector('main').prepend(alertPlaceholder);

    // Remove alert after 5 seconds
    setTimeout(() => {
        alertPlaceholder.remove();
    }, 5000);
}


