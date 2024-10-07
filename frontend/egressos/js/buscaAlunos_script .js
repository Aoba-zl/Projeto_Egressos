window.onload = function () {
    $("#header").load("./components/header.html");
    $("#footer").load("./components/footer.html"); 

    init();
}

function init(){

}

document.getElementById("divCardsAluno").addEventListener("click",(e)=>{
    let id = e.target.children[0].innerHTML;
    window.location.href = "./visualizarPerfil.html?profile="+id;
});

async function fetchEgresses() {
    try {
        // Fazendo a requisição para o endpoint
        const response = await fetch('http://localhost:8000/api/egresses');
        
        // Verifica se a requisição foi bem-sucedida
        if (!response.ok) {
            throw new Error('Erro ao buscar egressos');
        }

        // Parseia a resposta como JSON
        const result = await response.json();

        // Pega o array "data" da resposta
        const egresses = result.data;

        // Renderizando os egressos no HTML
        renderEgresses(egresses);

    } catch (error) {
        console.error('Erro:', error);
    }
}

// Função para renderizar os egressos no HTML
function renderEgresses(egresses) {
    // Seleciona o elemento onde os egressos serão exibidos
    const egressContainer = document.getElementById('egress-list');
    
    // Limpa o conteúdo anterior
    egressContainer.innerHTML = '';

    // Itera pelos egressos e cria um HTML para cada um
    egresses.forEach(egress => {
        const egressElement = document.createElement('div');
        egressElement.classList.add('aluno-card');

        egressElement.innerHTML = `
            <span class="d-none">${egress.user_id}</span>
            <div class="row">
                <div class="col-4 img-aluno-card">
                    <img src="https://cdn.pixabay.com/photo/2023/10/24/05/08/dog-8337394_1280.jpg" alt="foto do aluno">
                </div>
                <div class="col-8">
                    <p>
                        <span class="aluno-nome">${egress.user_name}</span>
                        <span class="aluno-exp-atual">${egress.company_name}</span>
                        <p class="aluno-feedback">
                            ${egress.feedback_comment}
                        </p>
                    </p>
                </div>
            </div>
        `;

        // Adiciona o elemento criado no container
        egressContainer.appendChild(egressElement);
    });
}

// Chamando a função para buscar e renderizar os egressos
fetchEgresses();
