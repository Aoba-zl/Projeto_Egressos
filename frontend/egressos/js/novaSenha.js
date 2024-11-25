window.onload = function () {
    $("#header").load("./components/header.html");
    $("#footer").load("./components/footer.html"); 

    init();
}

document.getElementById("btnResetPasswd").addEventListener('click',salvarNovaSenha);

async function salvarNovaSenha() {
    let endpoint = serverUrl + 'resetpasswd-updatepasswd'

    let password = document.getElementById("txtSenha").value;
    let cpassword = document.getElementById("txtConfirmacaoSenha").value;
    
    let regex = 
           /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$*&@#])[0-9a-zA-Z$*&@#]{8,}$/;
    let senhaOk = (regex.test(password));
    
    if(password === cpassword && senhaOk){
        try
        {
            const response = await fetch(endpoint, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ 
                      email: sessionStorage.getItem('email')
                    , password: await generateHash(password)
                    , token: sessionStorage.getItem('reset_token') }),
            })

            const data = await response.json();
        
            if (data.success)
            {
                showAlert(data.success, 'alert-success')
                setTimeout(() => {
                    showAlert("Vocêserá redirecionado para página de Login!", 'alert-success')
                }, 500);
                setTimeout(() => {
                    sessionStorage.removeItem('email');
                    sessionStorage.removeItem('reset_token');
    
                    window.location.href = "./login.html"
                }, 1000);
            }
            else
                alert(data.error)


        }
        catch (error) {
            alert(data.error)
        }
    }else{
        if(!(password === cpassword)){
            showAlert("As senhas não sao iguais", 'alert-danger');
        }
        else{
            if(!senhaOk){
                showAlert ("A senha deve ter no mínimo 8 caracteres,"
                    +" com letras maiúsculas, minúsculas e números"
                    , 'alert-danger');
            }
        }        
    }
}

function init()
{
    exibirModal("#validar-codigo-modal");
}


var modal_validar = $('#validar-codigo-modal')

var btn_send_token = document.getElementById('btnCodigoValidacao')
var btn_resend_token = document.getElementById('btnReenviarCodigo')

let is_token_valide = false

async function validate_token() 
{
    var txt_token = document.getElementById('txtCodigoValidacao').value
    let endpoint = serverUrl + "validatetoken"

    showAlert("Validando código...", 'alert-primary')

    try
    {
        const response = await fetch(endpoint, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ 
                email: sessionStorage.getItem('email')
                ,token: txt_token }),
        })
        
        const data = await response.json();
        
        if (data.success)
        {
            is_token_valide = true
            sessionStorage.setItem('reset_token', txt_token);
            closeModal("#validar-codigo-modal")
        }
        else
            alert(data.error)
        
        txt_token = '';
    }
    catch (error) {
        alert(data.error)
        txt_token = '';
    }
}


modal_validar.on('hide.bs.modal', function(){

    if (!is_token_valide)
    {
        alert('Sem um código não poderá redefinir a senha.')
        setTimeout(() => {
            exibirModal("#validar-codigo-modal");
        }, 200);
    }
})

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



btn_send_token.addEventListener('click', validate_token)
