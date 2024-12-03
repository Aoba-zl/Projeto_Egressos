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
    let elem_email = document.getElementById('txtEmailRedefinicao')
    let email = elem_email.value

    closeModal("#redefinir-senha-modal")

    if (!email)
    {
        showAlert('Digite um e-mail', 'alert-danger')
        return;
    }

    showAlert('Um e-mail com o código de validação será enviado.', 'alert-success')

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
            showAlert('E-mail enviado. Aguarde, você será redirecionado para página de Redefinição de senha!', 'alert-success')

            setTimeout(() => {
                // Armazena o email na sessão
                sessionStorage.setItem('email', email);

                window.location.href = "./novaSenha"
            }, 2500);
        }
        else
            showAlert(data.error, 'alert-danger')

        elem_email.value = '';

    }
    catch (error) {
        showAlert(data.error, 'alert-danger')
        elem_email.value = '';
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

