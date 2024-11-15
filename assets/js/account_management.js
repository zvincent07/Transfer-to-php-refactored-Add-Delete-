let userNameToDelete = null;

// Fetch accounts and populate the table
function fetchAccounts() {
    fetch('api/getAccounts.php')
        .then(response => response.json())
        .then(accounts => {
            const tableBody = document.getElementById('accountsTableBody');
            tableBody.innerHTML = ''; // Clear existing table rows
            accounts.forEach(account => {
                const row = `
                    <tr>
                        <td>${account.role}</td>
                        <td>${account.user_name}</td>
                        <td>${account.first_name}</td>
                        <td>${account.last_name}</td>
                        <td>${account.middle_name}</td>
                        <td class="text-center">
                            <button class="btn btn-danger btn-sm" onclick="showDeleteModal('${account.user_name}')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                `;
                tableBody.insertAdjacentHTML('beforeend', row);
            });
        });
}

// Show delete confirmation modal
function showDeleteModal(userName) {
    userNameToDelete = userName;
    $('#deleteAccountModal').modal('show');
}

// Confirm delete and remove account
document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
    if (userNameToDelete) {
        fetch(`api/deleteAccount.php?user_name=${userNameToDelete}`, { method: 'GET' })
            .then(response => response.text())
            .then(result => {
                $('#deleteAccountModal').modal('hide');
                fetchAccounts(); // Refresh the table
            });
    }
});

// Call fetchAccounts when the page loads
document.addEventListener('DOMContentLoaded', fetchAccounts);

function clearForm() {
    const form = document.querySelector('#addAccountModal form');
    form.reset();
}

// Handle form submission and show warning modal if necessary
document.querySelector('#addAccountModal form').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent the form from submitting the traditional way

    const formData = new FormData(this);

    fetch('api/addAccount.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'error') {
            // Show the warning modal with the error message
            document.getElementById('warningMessage').innerText = data.message;
            $('#warningModal').modal('show');
        } else {
            // Reload the accounts and close the modal if successful
            $('#addAccountModal').modal('hide');
            fetchAccounts();
            clearForm();
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

function filterAccounts() {
    const role = document.getElementById("role").value.toLowerCase();
    const searchTerm = document.getElementById("searchAccount").value.toLowerCase();

    const rows = document.querySelectorAll("tbody tr");
    rows.forEach(row => {
        const roleCell = row.children[0].textContent.toLowerCase();
        const firstName = row.children[2].textContent.toLowerCase();
        const lastName = row.children[3].textContent.toLowerCase();
        const middleName = row.children[4].textContent.toLowerCase();

        const matchesRole = role === "all" || role === roleCell;
        const matchesSearch = firstName.includes(searchTerm) || lastName.includes(searchTerm) || middleName.includes(searchTerm);

        if (matchesRole && matchesSearch) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
}