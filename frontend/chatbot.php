
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Chat & Image Bot</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
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
    <script src="js/chatbot.js"></script>
</body>
</html>