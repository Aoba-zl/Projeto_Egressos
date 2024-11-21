window.onload = function () {
    $("#header").load("./components/header.html");
    $("#footer").load("./components/footer.html"); 

    init();
}

function init(){
     //
}


async function reset_password() 
{
    let email = document.getElementById('txtEmail').value

    if (!email)
        showAlert('Digite um e-mail', 'alert-danger')

    try
    {
        let endpoint = serverUrl + "resetpasswd";

        const response = await fetch(endpoint, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ email: email }),
        })

        const data = await response.json();

        if (response.ok)
        {
            showAlert('E-mail com código de validação enviado', 'alert-success')
            alert('E-mail com código de validação enviado')
            window.location.href = "./index.html"
        }
        else
            showAlert("Erro ao enviar")

    }
    catch (error) {
        console.log(error)
    }
    
}

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


var btn_redefinir_senha = document.getElementById('btnResetPasswd').addEventListener('click', reset_password)

