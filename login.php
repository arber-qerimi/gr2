<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            echo "<p>Mirë se erdhët, " . $username . "!</p>";
        } else {
            echo "<p>Fjalëkalimi është i gabuar!</p>";
        }
    } else {
        echo "<p>Përdoruesi nuk ekziston!</p>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kyçu</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Kyçu</h2>
        <form method="post" action="">
            <label for="username">Emri i Përdoruesit:</label>
            <input type="text" name="username" required><br><br>
            <label for="password">Fjalëkalimi:</label>
            <input type="password" name="password" required><br><br>
            <input type="submit" value="Kyçu">
        </form>
        <a class="link" href="register.php">Kthehu në Regjistrim</a>
    </div>
</body>
</html>
