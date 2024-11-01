window.onload = function () {
    $("#header").load("./components/header.html");
    $("#footer").load("./components/footer.html"); 

    init();
}

function init(){

}

var currentPage = 1;
let currentButtonGroup = 1; // Controla o grupo atual de botões de paginação
let totalPages = 0; // Variável global para armazenar o total de páginas
var limit = 4; // Quantidade de egressos por página
const buttonsPerPage = 5; // Quantos botões serão exibidos por grupo
var totalItems=0

async function fetchEgresses(page = 1, limit = 1) {
    try {
        const response = await fetch(`${serverUrl}all-egresses?page=${page}&limit=${limit}`);
        
        if (!response.ok) {
            throw new Error('Erro ao buscar egressos');
        }

        const result = await response.json();
        
        const egresses = result.data;
        totalItems = result.total;

        renderEgresses(egresses);
        renderPagination(totalItems, page, limit);
        
    } catch (error) {
        console.error('Erro:', error);
    }
}

function renderEgresses(egresses) {
    const egressContainer = document.getElementById('egress-list');
    egressContainer.innerHTML = '';

    egresses.forEach(egress => {
        const egressElement = document.createElement('div');

        let src = serverUrl +'storage/'+ egress.image_path;
        egressElement.addEventListener("click",()=>{
            window.location.href = "./visualizarPerfil.html?profile="
                    +egress.user_id;
        });
        
        egressElement.classList.add('aluno-card');        
        egressElement.innerHTML = `
            <span class="d-none">${egress.user_id}</span>
            <div class="row">
                <div class="col-4 img-aluno-card">
                    <img src="${src}" alt="foto do aluno">
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

function renderPagination(totalItems, currentPage, limit) {
    totalPages = Math.ceil(totalItems / limit); // Armazena o total de páginas globalmente
    const paginationContainer = document.getElementById('pagination');
    
    paginationContainer.innerHTML = '';
    
    const totalButtonGroups = Math.ceil(totalPages / buttonsPerPage); // Quantos grupos de botões existem
    const startPage = (currentButtonGroup - 1) * buttonsPerPage + 1; // Primeira página do grupo atual
    const endPage = Math.min(startPage + buttonsPerPage - 1, totalPages); // Última página do grupo atual

    for (let i = startPage; i <= endPage; i++) {
        const pageButton = document.createElement('button');
        pageButton.innerText = i;
        pageButton.classList.add('page-btn');
        if (i === currentPage) {
            pageButton.classList.add('active');
        }
        pageButton.addEventListener('click', () => {
            fetchEgresses(i, limit);
        });
        paginationContainer.appendChild(pageButton);
    }

    // Atualizar visibilidade dos ícones de navegação
    document.getElementById('leftIcon').style.visibility = currentButtonGroup > 1 ? 'visible' : 'hidden';
    document.getElementById('rightIcon').style.visibility = currentButtonGroup < totalButtonGroups ? 'visible' : 'hidden';
}

// Função para mover para o próximo grupo de botões
function nextButtonGroup() {
    const totalButtonGroups = Math.ceil(totalPages / buttonsPerPage);
    if (currentButtonGroup < totalButtonGroups) {
        currentButtonGroup++;
        renderPagination(totalItems, currentPage, limit);
    }
}

// Função para mover para o grupo anterior de botões
function previousButtonGroup() {
    if (currentButtonGroup > 1) {
        currentButtonGroup--;
        renderPagination(totalItems, currentPage, limit);
    }
}

// Adicionando eventos aos ícones de navegação
document.getElementById('rightIcon').addEventListener('click', () => nextButtonGroup());
document.getElementById('leftIcon').addEventListener('click', previousButtonGroup);

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
            const egresses = data.data;

            // Verifica se a lista de egressos está vazia
            if (egresses.length === 0) {
                // Exibe a mensagem de que o egresso não foi encontrado
                document.getElementById('egress-list').innerHTML = `
                    <div class="egresso-nao-encontrado text-center m-5 h1">
                        Egresso não encontrado :(
                    </div>
                `;
            } else {
                // Chama a função para renderizar os egressos encontrados
                renderEgresses(egresses);
            }
        })
        .catch(error => {
            console.error('Erro:', error);
        });
});