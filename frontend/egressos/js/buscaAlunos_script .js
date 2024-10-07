window.onload = function () {
    $("#header").load("./components/header.html");
    $("#footer").load("./components/footer.html"); 

    init();
}

function init(){

}
let currentPage = 1;
const limit = 1; // Quantidade de egressos por página

async function fetchEgresses(page = 1, limit = 1) {
    try {
        // Fazendo a requisição para o endpoint com paginação
        const response = await fetch(`http://localhost:8000/api/egresses?page=${page}&limit=${limit}`);
        
        // Verifica se a requisição foi bem-sucedida
        if (!response.ok) {
            throw new Error('Erro ao buscar egressos');
        }

        // Parseia a resposta como JSON
        const result = await response.json();

        // Pega o array "data" e informações de paginação da resposta
        const egresses = result.data;
        const totalItems = result.total; // Supondo que sua API retorne o total de egressos

        // Renderizando os egressos no HTML
        renderEgresses(egresses);

        // Renderizando a paginação
        renderPagination(totalItems, page, limit);
        
    } catch (error) {
        console.error('Erro:', error);
    }
}

// Função para renderizar os egressos no HTML
function renderEgresses(egresses) {
    const egressContainer = document.getElementById('egress-list');
    egressContainer.innerHTML = '';

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
        egressContainer.appendChild(egressElement);
    });
}

// Função para renderizar os botões de paginação
function renderPagination(totalItems, currentPage, limit) {
    const totalPages = Math.ceil(totalItems / limit);
    const paginationContainer = document.getElementById('pagination');

    // Limpa a paginação anterior
    paginationContainer.innerHTML = '';

    // Cria os botões de página
    for (let i = 1; i <= totalPages; i++) {
        const pageButton = document.createElement('button');
        pageButton.innerText = i;
        pageButton.classList.add('page-btn');
        if (i === currentPage) {
            pageButton.classList.add('active'); // Destaca a página atual
        }
        pageButton.addEventListener('click', () => {
            fetchEgresses(i, limit);
        });
        paginationContainer.appendChild(pageButton);
    }
}

// Chamando a função para buscar e renderizar os egressos na página inicial
fetchEgresses(currentPage, limit);

//Get by name
document.getElementById('btnBuscaAlunos').addEventListener('click', function() {
    // Pega o valor digitado pelo usuário
    const nomeAluno = document.getElementById('txtSearchAluno').value;

    // Verifica se o campo não está vazio
    if (nomeAluno.trim() === '') {
        alert('Por favor, digite o nome de um aluno.');
        return;
    }

    // Faz a requisição ao endpoint com o nome digitado
    fetch(`http://localhost:8000/api/egresses?name=${encodeURIComponent(nomeAluno)}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro ao buscar egressos');
            }
            return response.json();
        })
        .then(data => {
            // Chama a função para renderizar os egressos
            renderEgresses(data.data);
        })
        .catch(error => {
            console.error('Erro:', error);
        });
});