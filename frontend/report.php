<?php
require_once 'authorizationclass.php';
Authorization::islogin();
Authorization::hasPermission('access_report');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Enhanced Reports Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="css/report.css">

  
</head>
<body class="font-sans">
  <div class="container mx-auto p-6">
    <header class="text-center mb-8">
      <h1 class="text-3xl font-bold">Enhanced Reports Dashboard</h1>
      <p class="text-gray-400">Detailed insights and visual analytics for departments and users</p>
    </header>

    <!-- Key Metrics Section -->
    <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
      <!-- Total Departments -->
      <div class="card p-6 rounded-md shadow text-center">
        <h2 class="text-xl font-semibold mb-2">Total Departments</h2>
        <p class="text-3xl font-bold" id="departmentCount">loading</p>
      </div>
      <!-- Total Users -->
      <div class="card p-6 rounded-md shadow text-center">
        <h2 class="text-xl font-semibold mb-2">Total Users</h2>
        <p class="text-3xl font-bold" id="totalUsers">loding</p>
      </div>
      <!-- Most Popular Department -->
      <div class="card p-6 rounded-md shadow text-center">
        <h2 class="text-xl font-semibold mb-2">Popular Department</h2>
        <p class="text-3xl font-bold" id="popularDepartment">Computer Science</p>
      </div>
    </section>

    <!-- Charts Section -->
    <section class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Chart 1: Department Distribution -->
      <div class="card p-6 rounded-md shadow">
        <h2 class="text-xl font-semibold mb-4">Department Distribution</h2>
        <canvas id="departmentChart" class="w-full h-64"></canvas>
      </div>
      <!-- Chart 2: Recommended Departments -->
      <div class="card p-6 rounded-md shadow">
        <h2 class="text-xl font-semibold mb-4">Recommended Departments</h2>
        <canvas id="recommendedChart" class="w-full h-64"></canvas>
      </div>
    </section>
  </div>
  <script src="js/report.js"></script>
  <script src="js/user_report.js"></script>
  <script src="js/avaible_department.js"></script>
  <!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="js/report_recommendation.js"></script>

</body>
</html>