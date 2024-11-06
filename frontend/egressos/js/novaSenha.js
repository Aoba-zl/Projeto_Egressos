window.onload = function () {
    $("#header").load("./components/header.html");
    $("#footer").load("./components/footer.html"); 

    init();
}

document.getElementById("btnResetPasswd").addEventListener('click',salvarNovaSenha);

function salvarNovaSenha() {
    let password = document.getElementById("txtSenha").value;
    let cpassword = document.getElementById("txtConfirmacaoSenha").value;
    
    let regex = 
           /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$*&@#])[0-9a-zA-Z$*&@#]{8,}$/;
        let senhaOk = (regex.test(password));
    if(password === cpassword && senhaOk){
        alert("prosseguir com criação da nova senha");
    }else{
        if(!(password === cpassword)){
            alert("As senhas não sao iguais");
        }
        else{
            if(!senhaOk){
                alert("A senha deve ter no mínimo 8 caracteres,"
                    +" com letras maiúsculas, minúsculas e números"
                );
            }
        }        
    }
}

function init(){
     
}