<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

    <nav class="w-full px-8 py-4 flex justify-between items-center shadow" style="background-color: hsl(180, 100%, 12%)">
        <span class="text-xl font-bold text-white">Department System</span>
        <div class="flex gap-4">
            <a href="index.php" class="px-4 py-2 rounded hover:bg-white hover:text-cyan-900 transition text-white">Home</a>
            <a href="signup.php" class="px-4 py-2 rounded bg-white text-cyan-900 font-semibold hover:bg-cyan-100 transition">Signup</a>
        </div>
    </nav>

    <div class="flex flex-1 items-center justify-center">
        <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-md mt-10">
            <!-- Display the logout message if it exists -->
            <?php 
            session_start();
            if (isset($_SESSION['user']['message'])): 
                $message = $_SESSION['user']['message'];
                $status = $_SESSION['user']['status'];
                $alertClass = $status ? 'bg-green-100 border-green-400 text-green-700' : 'bg-red-100 border-red-400 text-red-700';
            ?>
                <div class="<?php echo $alertClass; ?> border px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold"><?php echo $status ? 'Success!' : 'Error!'; ?></strong>
                    <span class="block sm:inline"><?php echo htmlspecialchars($message); ?></span>
                </div>
                <?php 
                // Clear the message and status after displaying
                unset($_SESSION['user']['message'], $_SESSION['status']); 
                ?>
            <?php endif; ?>

            <h1 class="text-2xl font-bold mb-6 text-center text-gray-800">Login to Your Account</h1>
            <form action="http://localhost:8000/backend/controllers/login.php" method="POST" class="space-y-5">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        placeholder="Enter your email" 
                        required 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="Enter your password" 
                        required 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                </div>
                <div>
                    <button 
                        type="submit" 
                        class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                        Login
                    </button>
                    <div class="text-center mt-4">
                        <a href="http://localhost:8000/backend/controllers/google_login.php" class="block">
                            <button 
                                type="button" 
                                class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition duration-200 flex items-center justify-center space-x-2">
                                <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google Logo" class="w-5 h-5">
                                <span>Login with Google</span>
                            </button>
                        </a>
                    </div>
                    <a href="http://localhost:8000/backend/controllers/logout.php" class="btn btn-danger">Logout</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>