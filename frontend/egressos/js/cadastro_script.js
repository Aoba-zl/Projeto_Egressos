window.onload = function () {
    $("#header").load("./components/header.html");
    $("#footer").load("./components/footer.html");
}

document.getElementById("btnContinueCad").addEventListener("click",()=>{
    let cb = document.getElementById("cbAgreement");
    if(cb.checked == true){
        let user = new Object();

        let name = getValueByID("txtNome");
        let email = getValueByID("txtEmail");
        let password = getValueByID("txtSenha");
        let cpassword = getValueByID("txtConfirmacaoSenha");

        let nameOk = (name != "" && name != " ");
        let emailOk = (email.includes("@") && email.includes("."));
        let senhaOk = (password.length > 7);

        console.log(nameOk +" - "+ emailOk +" - "+ senhaOk)
        if(password === cpassword){
            if(nameOk && emailOk && senhaOk){
            
                let user = new Object();

                user.name = name;
                user.email = email;
                user.password = (password);
                user.type_account = "0";

                console.log(JSON.stringify(user));
                sendUser(user,"POST","new-user");
            }else{
                if(!nameOk){
                    alert("Digite o seu nome");
                }
                
                if(!emailOk){
                    alert("Digite um email válido");
                }

                if(!senhaOk){
                    alert("A senha deve ter no mínimo 8 caracteres");
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

function sendUser(user,method,endpoint){
    endpoint = serverUrl + endpoint; 

    $.ajax({
        url : endpoint,
        contentType: "application/json",
        type : method,
        data : JSON.stringify(user)
    })
    .done(function(msg){
        console.log(msg);
        setCookie("user",JSON.stringify(msg));
        window.location.href = "./cadastro2.html";
    })
    .fail(function(jqXHR, textStatus, msg){
        console.log(msg);
    });
}

/*  ============== COOKIES ==================    */
function setCookie(name,value){
    let maxAgeSeconds = 604800;
	document.cookie = name+ "=" + value + ";SameSite=None; Secure; max-age="+maxAgeSeconds;
}

function deleteCookie(name){
  document.cookie = name+ "=" + value + ";SameSite=None; Secure; max-age="+-700;
}

//W3Schools
function getCookie(name) {
  let cookie = {};
  document.cookie.split(';').forEach(function(el) {
    let [key,value] = el.split('=');
    cookie[key.trim()] = value;
  })
  return cookie[name];
}
