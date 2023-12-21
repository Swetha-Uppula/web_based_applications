<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Management</title>
    <link rel="stylesheet" href="../CSS/loginScreen.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>

<body>
    <nav id="home">
        <div class="navbar-logo">
            <a href="loginScreen.php">
                <img src="../images/logo.jpeg" alt="Recipe Management Logo">
            </a>
            <h1><a href="loginScreen.php">Recipe Management</a></h1>
        </div>
    </nav>
    <main>
        <section class="login-container">
            <h2>Welcome!</h2>
            <form method='post' action='loginscreen.php'>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit" value='Login'>Login</button>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 Recipe Management</p>
    </footer>
</body>

</html>

<?php

require_once 'dbinfo.php';
require_once '../user/User.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

if (isset($_POST['username']) && isset($_POST['password'])) {

    // Get values from login screen
    $tmp_username = mysql_entities_fix_string($conn, $_POST['username']);
    $tmp_password = mysql_entities_fix_string($conn, $_POST['password']);

    // Get password from DB w/ SQL
    $query = "SELECT password FROM users WHERE username = '$tmp_username'";

    $result = $conn->query($query);
    if (!$result) die($conn->error);

    $rows = $result->num_rows;
    $passwordFromDB = "";
    for ($j = 0; $j < $rows; $j++) {
        $result->data_seek($j);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $passwordFromDB = $row['password'];
    }

    // Compare passwords hash
    if (password_verify($tmp_password, $passwordFromDB)) {
        echo "successful login<br>";
		$user = new User($tmp_username);

		session_start();
		$_SESSION['user'] = $user;
		header("Location: ../recipe/home.php");
    } else {
        echo "login error<br>";
    }
}

$conn->close();

// Sanitization functions
function mysql_entities_fix_string($conn, $string)
{
    return htmlentities(mysql_fix_string($conn, $string));
}

function mysql_fix_string($conn, $string)
{
    $string = stripslashes($string);
    return $conn->real_escape_string($string);
}

?>
