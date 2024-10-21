<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if password and confirm_password match
    if ($password !== $confirm_password) {
        echo "<p>Fjalëkalimet nuk përputhen!</p>";
    } else {
        // Hash the password before storing it
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashed_password);

        if ($stmt->execute()) {
            echo "<p>Regjistrimi ishte i suksesshëm!</p>";
        } else {
            echo "<p>Gabim: " . $stmt->error . "</p>";
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
    <title>Regjistrohu</title>
    <style>
        body {
            background-color: #2c2c2c;
            color: #ffffff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 300px;
            margin: 100px auto;
            padding: 20px;
            background-color: #3a3a3a;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        h1, h2 {
            text-align: center;
        }

        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #5a5a5a;
            color: #ffffff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #4a4a4a;
        }

        button#showPasswordButton {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            background-color: #5a5a5a;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button#showPasswordButton:hover {
            background-color: #4a4a4a;
        }

        .link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #ffffff;
        }
    </style>
    <script>
        function togglePassword() {
            var password = document.getElementById("password");
            if (password.type === "password") {
                password.type = "text";
            } else {
                password.type = "password";
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Regjistrohu</h2>
        <form method="post" action="">
            <label for="username">Emri i Përdoruesit:</label>
            <input type="text" name="username" required><br><br>

            <label for="password">Fjalëkalimi:</label>
            <input type="password" id="password" name="password" required><br><br>

            <label for="confirm_password">Konfirmo Fjalëkalimin:</label>
            <input type="password" id="confirm_password" name="confirm_password" required><br><br>

            <button type="button" id="showPasswordButton" onclick="togglePassword()">Shfaq Fjalëkalimin</button><br><br>

            <input type="submit" value="Regjistrohu">
        </form>
        <a class="link" href="login.php">Kthehu në Kyçje</a>
    </div>
</body>
</html>
