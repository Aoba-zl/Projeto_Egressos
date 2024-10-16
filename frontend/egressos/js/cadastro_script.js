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
        
        if(password === cpassword){
            if(nameOk && emailOk && senhaOk){
            
                let user = new Object();

                user.name = name;
                user.email = email;
                user.password = await generateHash(password);
                user.type_account = "0";

                setStorage("user",JSON.stringify(user));
                window.location.href = "./cadastro2.html"
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