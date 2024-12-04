window.onload = function () {
    $("#header").load("./components/header.html");
    $("#footer").load("./components/footer.html");

    loadModerators();
    setupSearch();
}

async function loadModerators() {
    const moderatorsListDiv = document.getElementById('divListaModerador');
    try {
        // Construct API URL
        const url = `${serverUrl}moderators`;

        // Fetch data from API
        const response = await fetch(url);

        if (!response.ok) {
            throw new Error('Erro ao buscar os moderadores.');
        }

        const moderators = await response.json();

        // Clear the list before displaying
        moderatorsListDiv.innerHTML = '';

        // Check if there are moderators to display
        if (moderators.length === 0) {
            moderatorsListDiv.innerHTML = '<p>Nenhum moderador encontrado.</p>';
            return;
        }

        // Create and append table for moderators
        const table = document.createElement('table');
        table.className = 'table table-striped';

        const thead = document.createElement('thead');
        thead.innerHTML = `
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Tipo de Conta</th>
                <th>Ação</th>
            </tr>`;
        table.appendChild(thead);

        const tbody = document.createElement('tbody');

        moderators.forEach(moderator => {
            const row = document.createElement('tr');

            const nameCell = document.createElement('td');
            nameCell.textContent = moderator.name;

            const emailCell = document.createElement('td');
            emailCell.textContent = moderator.email;

            const typeCell = document.createElement('td');
            typeCell.textContent = 'Moderador';

            const actionCell = document.createElement('td');
            const removeButton = document.createElement('button');
            removeButton.className = 'btn btn-danger';
            removeButton.textContent = 'Remover Moderador';
            // Add event listener to handle the removal of a moderator
            removeButton.onclick = () => handleModeratorRemoval(moderator.id);

            actionCell.appendChild(removeButton);

            row.appendChild(nameCell);
            row.appendChild(emailCell);
            row.appendChild(typeCell);
            row.appendChild(actionCell);

            tbody.appendChild(row);
        });

        table.appendChild(tbody);
        moderatorsListDiv.appendChild(table);
    } catch (error) {
        console.error('Erro:', error);
        moderatorsListDiv.innerHTML = '<p>Erro ao carregar a lista de moderadores.</p>';
    }
}

function setupSearch() {
    const searchButton = document.getElementById('btnBuscaModerador');
    const searchInput = document.getElementById('txtSearchModerador');

    // Add event listener to search button
    searchButton.addEventListener('click', async () => {
        const query = searchInput.value.trim();
        await searchUsers(query);
    });

    // Add event listener to handle "Enter" key press
    searchInput.addEventListener('keypress', async (event) => {
        if (event.key === 'Enter') {
            event.preventDefault(); // Prevent form submission or page reload
            const query = searchInput.value.trim();
            await searchUsers(query);
        }
    });
}

async function searchUsers(searchQuery = '') {
    const moderatorsListDiv = document.getElementById('divListaModerador');
    try {
        // Construct API URL
        const url = `${serverUrl}search_users?query=${encodeURIComponent(searchQuery)}`;

        // Fetch data from API
        const response = await fetch(url);

        if (!response.ok) {
            throw new Error('Erro ao buscar os usuários.');
        }

        const users = await response.json();

        // Clear the list before displaying
        moderatorsListDiv.innerHTML = '';

        // Check if there are users to display
        if (users.length === 0) {
            moderatorsListDiv.innerHTML = '<p>Nenhum usuário encontrado.</p>';
            return;
        }

        // Create and append table for users
        const table = document.createElement('table');
        table.className = 'table table-striped';

        const thead = document.createElement('thead');
        thead.innerHTML = `
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Tipo de Conta</th>
                <th>Ação</th>
            </tr>`;
        table.appendChild(thead);

        const tbody = document.createElement('tbody');

        users.forEach(user => {
            const row = document.createElement('tr');

            const nameCell = document.createElement('td');
            nameCell.textContent = user.name;

            const emailCell = document.createElement('td');
            emailCell.textContent = user.email;

            const typeCell = document.createElement('td');
            const actionCell = document.createElement('td');

            // Determine user type and actions
            if (user.type_account === '1') {
                typeCell.textContent = 'Moderador';

                const removeButton = document.createElement('button');
                removeButton.className = 'btn btn-danger';
                removeButton.textContent = 'Remover Moderador';
                // Add event listener to handle the removal of a moderator
                removeButton.onclick = () => handleModeratorRemoval(user.id);

                actionCell.appendChild(removeButton);
            } else if (user.type_account === '0') {
                typeCell.textContent = 'Egresso';

                const makeModeratorButton = document.createElement('button');
                makeModeratorButton.className = 'btn btn-primary me-2';
                makeModeratorButton.textContent = 'Tornar Moderador';
                // Add event listener to handle promotion to moderator
                makeModeratorButton.onclick = () => handleMakeModerator(user.id);

                actionCell.appendChild(makeModeratorButton);
                // actionCell.appendChild(deleteButton);
            } else if (user.type_account === '2') {
                typeCell.textContent = 'Administrador';
                actionCell.textContent = ''; // No actions for administrators
            }

            row.appendChild(nameCell);
            row.appendChild(emailCell);
            row.appendChild(typeCell);
            row.appendChild(actionCell);

            tbody.appendChild(row);
        });

        table.appendChild(tbody);
        moderatorsListDiv.appendChild(table);
    } catch (error) {
        console.error('Erro:', error);
        moderatorsListDiv.innerHTML = '<p>Erro ao carregar a lista de usuários.</p>';
    }
}

// Função para exibir um alerta de confirmação
function confirmAction(message, action) {
    if (confirm(message)) {
        action(); // Executa a ação passada como argumento
    }
}

// Função para tornar um usuário moderador
async function handleMakeModerator(userId) {
    confirmAction('Tem certeza que deseja tornar este usuário um moderador?', async () => {
        try {
            const searchInput = document.getElementById('txtSearchModerador');
            
            const token = await getUserToken();

            const response = await fetch(`${serverUrl}toggle_moderator/${userId}/${token}`, {
                method: 'PUT',
            });

            if (!response.ok) {
                throw new Error('Erro ao tornar o usuário um moderador.');
            }

            const query = searchInput.value.trim();
            if (query != "")
            {
                searchUsers(query);
            }
            else
            {
                loadModerators();
            }
        } catch (error) {
            console.error('Erro:', error);
            alert('Não foi possível tornar o usuário um moderador.');
        }
    });
}

// Função para remover um moderador
async function handleModeratorRemoval(userId) {
    confirmAction('Tem certeza que deseja remover este moderador?', async () => {
        try {
            const searchInput = document.getElementById('txtSearchModerador');

            const token = await getUserToken();

            const response = await fetch(`${serverUrl}toggle_moderator/${userId}/${token}`, {
                method: 'PUT',
            });

            if (!response.ok) {
                throw new Error('Erro ao remover o moderador.');
            }

            const query = searchInput.value.trim();
            if (query != "")
            {
                searchUsers(query);
            }
            else
            {
                loadModerators();
            }
        } catch (error) {
            console.error('Erro:', error);
            alert('Não foi possível remover o moderador.');
        }
    });
}


document.getElementById('btnCarregarModeradores').addEventListener('click', loadModerators)

