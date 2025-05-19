<?php 
require_once 'Authorization.php';

Authorization::isLogin();
Authorization::hasPermission('access_admin_panel');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <header class="bg-blue-900 text-white p-6 shadow">
        <h1 class="text-3xl font-bold">Admin Panel</h1>
    </header>
    <nav class="bg-white shadow flex gap-4 px-6 py-4">
        <button onclick="showSection('users')" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Users</button>
        <button onclick="showSection('teams')" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">Team Members</button>
    </nav>
    <main class="p-8">
        <!-- USERS SECTION -->
        <section id="users-section" class="block">
            <h2 class="text-2xl font-semibold mb-4 text-blue-800">Users</h2>
            <div class="flex items-center gap-2 mb-4">
                <input type="number" id="single-user-id" placeholder="User ID" class="border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                <button onclick="fetchSingleUser()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Get User By ID</button>
            </div>
            <button onclick="fetchUsers()" class="mb-4 bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800 transition">List All Users</button>
            <div id="single-user-result" class="mb-4"></div>
            <div id="users-list"></div>
        </section>
        <!-- TEAM MEMBERS SECTION -->
        <section id="teams-section" class="hidden">
            <h2 class="text-2xl font-semibold mb-4 text-green-800">Team Members</h2>
            <div class="flex items-center gap-2 mb-4">
                <input type="number" id="single-team-id" placeholder="Team Member ID" class="border rounded px-3 py-2 focus:outline-none focus:ring focus:border-green-300">
                <button onclick="fetchSingleTeamMember()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">Get Team Member By ID</button>
            </div>
            <button onclick="fetchTeamsMembers()" class="mb-4 bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800 transition">List All Team Members</button>
            <div id="single-team-result" class="mb-4"></div>
            <div id="team_memeber-list"></div>
        </section>
    </main>
    <script src="admin/js/Admin_Panel.js"></script>
    <script src="admin/js/Admin_panel_teams.js"></script>
    <script>
        function showSection(section) {
            document.getElementById('users-section').classList.toggle('hidden', section !== 'users');
            document.getElementById('teams-section').classList.toggle('hidden', section !== 'teams');
        }
    </script>
</body>
</html>