<?php

include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($username) || empty($password) || empty($confirm_password)) {
        $error = "All fields are required!";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Username is already taken!";
        } else {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $username, $hashed_password);

            if ($stmt->execute()) {
                header("Location: home.php");
                exit;
            } else {
                $error = "Error: Could not register user. Please try again later.";
            }
        }
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Account</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <div class="flex items-center justify-center h-screen bg-blue-300">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full sm:w-96">
            <h1 class="text-3xl font-semibold text-center mb-6">Register</h1>

            <form action="UserController.php" method="post">
                <input type="hidden" name="action" value="register">

                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" name="username" id="username" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
 
                <button type="submit" class="w-full py-2 px-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Register</button>
            </form>

            <div class="mt-4 text-center">
                <a href="login.php" class="text-blue-500 hover:text-blue-700">Already have an account? Login</a>
            </div>
        </div>
    </div>

</body>
</html>
