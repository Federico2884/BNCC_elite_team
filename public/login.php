<?php 
    session_start();

    $error = isset($_SESSION['ERROR']) ? $_SESSION['ERROR'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-gray-100">

    <div class="flex items-center justify-center h-screen bg-blue-300">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full sm:w-96">
            <h1 class="text-3xl font-semibold text-center mb-6">Login</h1>

            <?php if (!empty($error)): ?>
                <div class="text-red-500 text-center mb-4">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form action="UserController.php" method="post">
                <input type="hidden" name="action" value="login">

                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" name="username" id="username" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <button type="submit" class="w-full py-2 px-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Login</button>
            </form>

            <div class="mt-4 text-center">
                <a href="register.php" class="text-blue-500 hover:text-blue-700">Don't have an account? Register</a>
            </div>
        </div>
    </div>

</body>
</html>
