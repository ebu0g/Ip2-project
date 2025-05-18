<?php 

require_once 'authorizationclass.php';

Authorization::isLogin();
Authorization::hasPermission('access_userdashboard');

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Department Recommendation Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="css/dashboard.css">
</head>
<body class="text-white font-sans">
  <!-- Navbar -->
  <header class="navbar flex items-center justify-between px-6 py-4 shadow">
    <div class="flex items-center space-x-4">
      <img src="https://placehold.co/50x50" alt="Profile Picture" class="rounded-full">
      <div>
        <h3 class="text-lg font-bold">John Doe</h3>
        <p class="text-sm text-gray-200">johndoe@example.com</p>
      </div>
    </div>
    <nav class="flex space-x-4">
      <a href="#" class="btn-primary px-4 py-2 rounded">Dashboard</a>
      <a href="#" class="btn-primary px-4 py-2 rounded">Recommendations</a>
      <a href="#" class="btn-primary px-4 py-2 rounded">Departments</a>
      <a href="http://localhost:8000/frontend/report.html" class="btn-primary px-4 py-2 rounded">Reports</a>
    </nav>
  </header>

  <div class="flex">
    <!-- Sidebar -->
    <aside class="sidebar w-64 h-screen p-6">
      <h2 class="text-2xl font-bold mb-6">Navigation</h2>
      <nav class="space-y-4">
        <a href="#" class="block btn-primary px-4 py-2 rounded">Settings</a>
        <!-- Database Link -->
        
        <!-- Container for displaying database table names -->
        
      </nav>

      <!-- Widgets/Statistics Cards -->
      <div class="mt-8 space-y-4">
        
      </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
      <!-- Header Section -->
      <header class="bg-gradient-to-r from-purple-700 to-purple-900 p-6 rounded-md shadow">
        <h1 class="text-3xl font-bold">Welcome to the Department Recommendation System</h1>
        <p class="mt-2 text-gray-200">Get personalized recommendations for departments based on your preferences and data.</p>
       <div class="flex space-x-6 mt-4">
            <span>📊 <span id="recommendationsCount">120</span> Recommendations Generated</span>
            <span class="department_number">🏢 <span id="departmentCount">Loading...</span> Departments Available</span>
      </div>
      </header>

      <!-- Search and Filter Section -->
      <section class="mt-8">
        <div class="flex items-center space-x-4">
          <input type="text" id="searchInput" placeholder="Search departments..." class="px-3 py-2 rounded text-black w-1/2">
          <select id="filterCategory" class="px-3 py-2 rounded text-black">
            <option value="all">All Categories</option>
            <option value="science">Science</option>
            <option value="arts">Arts</option>
            <option value="commerce">Commerce</option>
          </select>
        </div>
      </section>

      <!-- Recommended Departments -->
      <section class="mt-8">
        <h2 class="text-xl font-semibold mb-4">Recommended Departments</h2>
        <div id="departmentContainer" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
         
        </div>
      </section>
    </main>
  </div>

  
  <!-- Include the recommendations.js file -->
  <script src="js/recommendations.js"></script>
 

  <script src="js/avaible_department.js"></script>

</body>
</html>