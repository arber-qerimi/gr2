<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regjistrim dhe Kyçje</title>
</head>
<body>
    <h1>Regjistrim</h1>
    <form action="" method="post">
        <label for="emri">Emri:</label>
        <input type="text" id="emri" name="emri" required><br><br>
        <label for="password">Fjalëkalimi:</label>
        <input type="password" id="password" name="fjalkalimi" required><br><br>
        <input type="submit" name="regjistro" value="Regjistrohu">
    </form>
    <h1>Kyçje</h1>
    <form action="" method="post">
        <label for="emri_login">Emri:</label>
        <input type="text" id="emri_login" name="emri_login" required><br><br>
        <label for="fjalkalimi_login">Fjalëkalimi:</label>
        <input type="password" id="fjalkalimi_login" name="fjalkalimi_login" required><br><br>
        <input type="submit" name="kyc" value="Kyçu">
    </form>
    <?php
    // Check if the form is submitted for registration
    if (isset($_POST['regjistro'])) {
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "perdoruesi";
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Lidhja dështoi: " . $conn->connect_error);
        }
        // Get data from the registration form
        $emri = $conn->real_escape_string($_POST['emri']);
        $fjalkalimi = $conn->real_escape_string($_POST['fjalkalimi']);
        // Hash the password
        $hashed_password = password_hash($fjalkalimi, PASSWORD_DEFAULT);
        // Insert user into database
        $sql = "INSERT INTO klienti (emri, fjalkalimi) VALUES ('$emri', '$hashed_password')";
        if ($conn->query($sql) === TRUE) {
            echo "<p>Regjistrimi ishte i suksesshëm!</p>";
        } else {
            echo "<p>Gabim: " . $sql . "<br>" . $conn->error . "</p>";
        }
        $conn->close();
    }
    // Check if the form is submitted for login
    if (isset($_POST['kyc'])) {
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "perdoruesi";
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Lidhja dështoi: " . $conn->connect_error);
        }
        // Get data from the login form
        $emri_login = $conn->real_escape_string($_POST['emri_login']);
        $fjalkalimi_login = $conn->real_escape_string($_POST['fjalkalimi_login']);
        // Check if user exists
        $sql = "SELECT * FROM klienti WHERE emri='$emri_login'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Verify the password
            if (password_verify($fjalkalimi_login, $row['fjalkalimi'])) {
                echo "<p>Kyçja ishte e suksesshme!</p>";
            } else {
                echo "<p>Fjalëkalimi është i sakt! kyqja eshte e suksesshme!</p>";
            }
        } else {
            echo "<p>Emri është i gabuar!</p>";
        }
        $conn->close();
    }
    ?>
</body>
</html>