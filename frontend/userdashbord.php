<?php 

require_once 'Authorization99520.php';

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
        <img 
          src="<?php
            echo (isset($_SESSION['user']['profile_picture']) && $_SESSION['user']['profile_picture'] !== '')
              ? '../backend/' . htmlspecialchars($_SESSION['user']['profile_picture'])
              : 'https://placehold.co/50x50';
          ?>" 
          alt="Profile Picture" 
          class="rounded-full w-12 h-12 object-cover border-2 border-white shadow"
        >

      <div>
        <h3 class="text-lg font-bold">
          <?php echo isset($_SESSION['user']['name']) && $_SESSION['user']['name'] !== '' 
              ? htmlspecialchars($_SESSION['user']['name']) 
              : 'Unknown User'; ?>
        </h3>
        <p class="text-sm text-gray-200">
          <?php echo isset($_SESSION['user']['email']) && $_SESSION['user']['email'] !== '' 
              ? htmlspecialchars($_SESSION['user']['email']) 
              : 'No email found'; ?>
        </p>
      </div>
    </div>
    <nav class="flex space-x-4">
       <a href="index.php" class="btn-primary px-4 py-2 rounded">Home</a>
      <a href="#" class="btn-primary px-4 py-2 rounded">Dashboard</a>
       <a href="chatbot.php" class="btn-primary flex items-center gap-2 px-4 py-2 rounded bg-gradient-to-r from-cyan-600 to-blue-700 hover:from-cyan-700 hover:to-blue-800 transition text-white shadow">
        <!-- Chatbot Icon (Heroicons or SVG) -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2H7l-4 4V6a2 2 0 012-2h12a2 2 0 012 2v2z" />
        </svg>
        <span>Chatbot</span>
      </a>
      <a href="department.php" class="btn-primary px-4 py-2 rounded">Departments</a>
      <a href="http://localhost:8000/frontend/report.php" class="btn-primary px-4 py-2 rounded">Reports</a>
    </nav>
  </header>

  <div class="flex">
    <!-- Sidebar -->
    <aside class="sidebar w-64 h-screen p-6">
      <h2 class="text-2xl font-bold mb-6">Navigation</h2>
      <nav class="space-y-4">
      
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