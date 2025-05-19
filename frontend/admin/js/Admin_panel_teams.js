function fetchTeamsMembers() {
    fetch('http://localhost:8000/backend/Admin/team_list.php')
        .then(res => res.json())
        .then(data => {
            if (Array.isArray(data)){
                renderTeamsMembersTable(data);
            } else if (data.message) {
                document.getElementById('team_memeber-list').innerHTML = `<p>${data.message}</p>`;
            }
        });
}

function renderTeamsMembersTable(TeamsMembers){
    let html = `<table>
        <tr>
            <th>ID</th><th>Name</th><th>Role</th><th>Profile Image</th><th>Action</th>
        </tr>`;
    TeamsMembers.forEach((member) => {
        html += `<tr>
            <td>${member.id}</td>
            <td>${member.name}</td>
            <td>${member.role}</td>
            <td><img src="../frontend/${member.image_url}" width="40"></td>
            <td>
                <button class="action-btn" onclick="deleteTeamMember(${member.id})">Delete</button>
            </td>
        </tr>`;
    });
    html += `</table>`;
    document.getElementById('team_memeber-list').innerHTML = html;
}

// Fetch single team member by ID and display
function fetchSingleTeamMember() {
    const id = document.getElementById('single-team-id').value;
    if (!id) return alert('Please enter a team member ID.');
    fetch(`http://localhost:8000/backend/Admin/team_list.php?id=${id}`)
        .then(res => res.json())
        .then(data => {
            let html = '';
            if (data.name) {
                html = `<b>Team Member:</b> ${data.name} (${data.role})<br>
                        <img src="../backend/${data.image_url}" width="60">`;
            } else if (data.message) {
                html = `<span style="color:red">${data.message}</span>`;
            }
            document.getElementById('single-team-result').innerHTML = html;
        });
}

// Delete team member by ID
function deleteTeamMember(id) {
    if (!id) return alert('Team Member ID not found!');
    if (!confirm(`Are you sure you want to delete this team member ${id}?`)) return;
    fetch('http://localhost:8000/backend/Admin/delete_team.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({id: id})
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message || "Team member deleted.");
        fetchTeamsMembers();
    })
    .catch(() => {
        alert("Failed to delete team member.");
    });
}