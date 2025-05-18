<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-tr from-blue-100 via-white to-purple-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-10 rounded-2xl shadow-2xl w-full max-w-lg border border-gray-200">
        <h1 class="text-3xl font-extrabold text-center text-gray-800 mb-8">Create an Account</h1>

        <form action="http://localhost:8000/backend/controllers/user_request_handler.php" method="POST" enctype="multipart/form-data" class="space-y-5">

            <!-- Profile Image Upload -->
            <div class="flex items-center space-x-5">
                <img id="previewImage" src="https://via.placeholder.com/80"
                     class="w-20 h-20 rounded-full border-2 border-gray-500 object-cover">
                <div>
                    <label for="profileImage" class="text-sm text-blue-600 cursor-pointer hover:underline">
                        Change profile photo
                    </label>
                    <input type="file" id="profileImage" name="image" accept="image/*"
                           class="hidden" onchange="previewFile()">
                </div>
            </div>

            <!-- First Name -->
            <div>
                <label for="firstname" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                <input type="text" id="firstname" name="firstname" placeholder="First Name"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>

            <!-- Middle Name -->
            <div>
                <label for="middlename" class="block text-sm font-medium text-gray-700 mb-1">Middle Name</label>
                <input type="text" id="middlename" name="middlename" placeholder="Middle Name"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>

            <!-- Last Name -->
            <div>
                <label for="lastname" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                <input type="text" id="lastname" name="lastname" placeholder="Last Name"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>

            <!-- Username -->
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input type="text" id="username" name="username" placeholder="Username"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" id="email" name="email" placeholder="Email"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>

            <!-- Role -->
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                <select id="role" name="role"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    <option value="disable role selection">Select role</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>   
                </select>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" id="password" name="password" placeholder="Password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-semibold transition duration-300">
                Sign Up
            </button>
        </form>

        <p class="text-center text-sm text-gray-500 mt-6">Already have an account?
            <a href="#" class="text-blue-500 hover:underline">Login</a>
        </p>
    </div>

    <script src="./js/signup.js"></script>
</body>
</html>
