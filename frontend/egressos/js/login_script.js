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
        password: password
    };

    try {
        const response = await fetch('http://127.0.0.1:8000/api/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(payload)
        });

        const data = await response.json();

        if (response.ok) {
            // Login successful
            showAlert('Login realizado com sucesso!', 'alert-success');
            window.location.href = "./visualizarPerfil.html?profile="+data.user.id;
        } else {
            // Login failed, show error message from the API
            showAlert(data.message || 'Falha ao realizar login', 'alert-danger');
        }
    } catch (error) {
        showAlert('Erro ao conectar com o servidor', 'alert-danger');
    }
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
