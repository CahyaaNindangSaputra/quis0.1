

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">

    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center text-gray-700">Login</h2>
        <form action="login.php" method="post">
            <div>
                <label class="block text-gray-600">user</label>
                <input type="user" name="user" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>
            <div>
                <label class="block text-gray-600">Password</label>
                <input type="password" name="pass" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>
            <input type="submit" name="Login" value="Log In" class="w-full py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600"></button>
        </form>
       
    </div>
</body>
</html>