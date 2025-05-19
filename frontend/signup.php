<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-tr from-blue-200 via-white to-purple-200 flex flex-col min-h-screen" >

    <!-- Replace your current navbar with this -->
    <nav class="w-full px-8 py-4 flex justify-between items-center shadow-lg" style="background-color: hsl(180, 100%, 12%)">
        <span class="text-2xl font-extrabold tracking-wide text-white">Department System</span>
        <div class="flex gap-4">
            <a href="index.php" class="px-5 py-2 rounded-lg hover:bg-white hover:text-cyan-900 transition text-white font-semibold">Home</a>
            <a href="signup.php" class="px-5 py-2 rounded-lg bg-white text-cyan-900 font-bold shadow hover:bg-cyan-100 transition">Signup</a>
        </div>
    </nav>

    <div class="flex flex-1 items-center justify-center">
        <div class="bg-white/90 p-10 rounded-3xl shadow-2xl w-full max-w-xl border border-gray-100">
            <h1 class="text-4xl font-extrabold text-center text-blue-900 mb-8 tracking-tight">Create an Account</h1>

            <form action="http://localhost:8000/backend/controllers/user_request_handler.php" method="POST" enctype="multipart/form-data" class="space-y-6">

                <!-- Profile Image Upload -->
                <div class="flex items-center space-x-6 justify-center">
                    <img id="previewImage" src="https://via.placeholder.com/80"
                        class="w-24 h-24 rounded-full border-4 border-blue-300 object-cover shadow-lg bg-gray-100">
                    <div>
                        <label for="profileImage" class="block text-sm text-blue-700 font-semibold cursor-pointer hover:underline">
                            Change profile photo
                        </label>
                        <input type="file" id="profileImage" name="image" accept="image/*"
                            class="hidden" onchange="previewFile()">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
                        <option value="">Select role</option>
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
                    class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white py-3 rounded-xl font-bold text-lg shadow-lg transition duration-300">
                    Sign Up
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-8">Already have an account?
                <a href="login.php" class="text-blue-600 hover:underline font-semibold">Login</a>
            </p>
        </div>
    </div>

    <script>
    function previewFile() {
        const preview = document.getElementById('previewImage');
        const file = document.getElementById('profileImage').files[0];
        const reader = new FileReader();
        reader.onloadend = function () {
            preview.src = reader.result;
        }
        if (file) {
            reader.readAsDataURL(file);
        }
    }
    </script>
</body>
</html>