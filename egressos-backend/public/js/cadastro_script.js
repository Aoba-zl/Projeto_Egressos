const cadModerator = new URLSearchParams(window.location.search).get('moderator')
window.onload = function () {
    $("#header").load("./components/header.html");
    $("#footer").load("./components/footer.html");
}

document.getElementById("btnContinueCad").addEventListener("click",async ()=>{
    let cb = document.getElementById("cbAgreement");
    if(cb.checked == true){
        let user = new Object();

        let name = getValueByID("txtNome");
        let email = getValueByID("txtEmail");
        let password = getValueByID("txtSenha");
        let cpassword = getValueByID("txtConfirmacaoSenha");

        let nameOk = (name != "" && name != " ");
        let emailOk = (email.includes("@") && email.includes("."));
        let regex =
           /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$*&@#])[0-9a-zA-Z$*&@#]{8,}$/;
        let senhaOk = (regex.test(password));

        let cadastroNormal = true;

        if(cadModerator != undefined && cadModerator != null){
            cadastroNormal = !cadModerator;
        }

        if(password === cpassword){
            if(nameOk && emailOk && senhaOk){

                let user = new Object();

                user.name = name;
                user.email = email;
                user.password = await generateHash(password);
                user.type_account = "0";

                if(cadastroNormal){
                    setStorage("user",JSON.stringify(user));
                    window.location.href = "./cadastro2"
                }else{
                    cadastrarUser(user);
                }
            }else{
                if(!nameOk){
                    alert("Digite o seu nome");
                }

                if(!emailOk){
                    alert("Digite um email válido");
                }

                if(!senhaOk){
                    alert("A senha deve ter no mínimo 8 caracteres,"
                        +" com letras maiúsculas, minúsculas e números"
                    );
                }
            }
        }else{
            alert("As senhas não sao iguais");
        }


    }else{
        cb.parentNode.classList.add("mark-red");
    }


});

function getValueByID(field){
    return document.getElementById(field).value;
}

function cadastrarUser(user){
    $.ajax({
        url : serverUrl+"new-user",
        dataType: "json",
        contentType: "application/json",
        method : "POST",
        data : JSON.stringify(user)
      })
      .done(function(msg){
          alert("Usuário criado com sucesso, seu id é "+ msg.user.id + ", informe esse número ao administrador");
          window.location.href = "./";
      })
      .fail(function(jqXHR, textStatus, msg){
        console.log(jqXHR);
        console.log(textStatus);
        console.log(msg);
      });
}
