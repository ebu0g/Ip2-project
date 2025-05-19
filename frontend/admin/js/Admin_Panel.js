function showSection(section) {
    document.getElementById('users-section').style.display = section === 'users' ? 'block' : 'none';
}

// USERS
function fetchUsers() {
    fetch('http://localhost:8000/backend/Admin/user_list.php')
        .then(res => res.json())
        .then(data => {
            if (Array.isArray(data)) {
                renderUserTable(data);
            } else if (data.message) {
                document.getElementById('users-list').innerHTML = `<p>${data.message}</p>`;
            }
        });
}

function renderUserTable(users) {
    let html = `<table>
        <tr>
            <th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Username</th><th>Profile Image</th><th>Action</th>
        </tr>`;
    users.forEach((user, idx) => {
        html += `<tr>
            <td>${user.id || idx + 1}</td>
            <td>${user.first_name}</td>
            <td>${user.last_name}</td>
            <td>${user.email}</td>
            <td>${user.username}</td>
            <td><img src="../backend/${user.profile_image}" width="40"></td>
            <td>
                <button class="action-btn" onclick="deleteUser(${user.id})">Delete</button>
            </td>
        </tr>`;
    });
    html += `</table>`;
    document.getElementById('users-list').innerHTML = html;
}

// Fetch single user by ID and display
function fetchSingleUser() {
    const id = document.getElementById('single-user-id').value;
    if (!id) return alert('Please enter a user ID.');
    fetch(`http://localhost:8000/backend/Admin/user_list.php?id=${id}`)
        .then(res => res.json())
        .then(data => {
            let html = '';
            if (data.first_name) {
                html = `<b>User:</b> ${data.first_name} ${data.last_name} (${data.username})<br>
                        Email: ${data.email}<br>
                        <img src="../backend/${data.profile_image}" width="60">`;
            } else if (data.message) {
                html = `<span style="color:red">${data.message}</span>`;
            }
            document.getElementById('single-user-result').innerHTML = html;
        });
}
// FIX: Delete user by ID
function deleteUser(id) {
    if (!id) return alert('User ID not found!');
    if (!confirm(`Are you sure you want to delete user with ID ${id}?`)) return;
    fetch('http://localhost:8000/backend/Admin/delete_user.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({id: id})
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message || "User deleted.");
        fetchUsers();
    })
    .catch(() => {
        alert("Failed to delete user.");
    });
}
