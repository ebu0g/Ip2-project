<?php

session_start();
require_once 'Authorization.php';

Authorization::isLogin();
Authorization::hasPermission('access_chatbot');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Chat & Image Bot</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/chatbotstyle.css">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

  <!-- Navbar -->
  <header class="w-full bg-cyan-900 shadow-lg">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4">
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
          <h3 class="text-lg font-bold text-white">
            <?php echo isset($_SESSION['user']['name']) && $_SESSION['user']['name'] !== '' 
                ? htmlspecialchars($_SESSION['user']['name']) 
                : 'Unknown User'; ?>
          </h3>
          <p class="text-sm text-cyan-100">
            <?php echo isset($_SESSION['user']['email']) && $_SESSION['user']['email'] !== '' 
                ? htmlspecialchars($_SESSION['user']['email']) 
                : 'No email found'; ?>
          </p>
        </div>
      </div>
      <nav class="flex space-x-2">
        <a href="index.php" class="px-4 py-2 rounded-lg font-semibold text-white hover:bg-cyan-800 transition">Home</a>
        <a href="dashbord.php" class="px-4 py-2 rounded-lg font-semibold text-white hover:bg-cyan-800 transition">Dashboard</a>
        <a href="chatbot.php" class="flex items-center gap-2 px-4 py-2 rounded-lg bg-gradient-to-r from-cyan-600 to-blue-700 hover:from-cyan-700 hover:to-blue-800 transition text-white shadow font-semibold">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2H7l-4 4V6a2 2 0 012-2h12a2 2 0 012 2v2z" />
          </svg>
          <span>Chatbot</span>
        </a>
        <a href="department.php" class="px-4 py-2 rounded-lg font-semibold text-white hover:bg-cyan-800 transition">Departments</a>
        <a href="http://localhost:8000/frontend/report.php" class="px-4 py-2 rounded-lg font-semibold text-white hover:bg-cyan-800 transition">Reports</a>
      </nav>
    </div>
  </header>

  <!-- Chatbot Container -->
  <main class="flex-1 flex items-center justify-center py-8">
    <div class="chat-container bg-white shadow-lg rounded-lg flex flex-col w-full max-w-3xl h-[85vh]">
        <!-- Chat Header -->
        <div class="chat-header bg-green-500 text-white text-center font-bold py-4 rounded-t-lg flex justify-between items-center px-4">
            <span>AI Chat & Image Bot</span>
            <button id="clear-history" class="text-white hover:text-gray-200 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Chat History -->
        <div id="chat-history" class="chat-history flex-grow p-4 overflow-y-auto border-b border-gray-300 space-y-4">
            <!-- Chat messages will be dynamically added here -->
        </div>

        <!-- Chat Input -->
        <form id="chat-form" class="chat-input flex items-center gap-4 p-4 bg-gray-50 border-t border-gray-300" enctype="multipart/form-data">
            <textarea id="user-message" name="user_message" placeholder="Type message or '/image your prompt'..." rows="1" required autofocus
                class="flex-grow p-3 border border-gray-300 rounded-lg resize-none focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
            <input type="file" id="file-input" name="file" accept="image/*" class="hidden">
            <label for="file-input" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg cursor-pointer hover:bg-gray-300 transition">
                Upload Image
            </label>
            <button type="submit"
                class="bg-blue-500 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-600 transition">
                Send
            </button>
        </form>
    </div>
  </main>
  <script src="js/chatbot.js"></script>
</body>
</html>