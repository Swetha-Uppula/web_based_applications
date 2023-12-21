<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Management</title>
    <link rel="stylesheet" href="../CSS/logout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>

<body>
    <nav id="home">
        <div class="navbar-logo">
            <a href="loginScreen.php"><img src="../images/logo.jpeg" alt="Recipe Management Logo"></a>
            <h1><a href="loginScreen.php">Recipe Management</a></h1>
        </div>
        <ul>
            <li><a href="loginScreen.php">Login</a></li>
        </ul>
    </nav>
<?php

session_start();

destroy_session_and_data();

function destroy_session_and_data(){
	$_SESSION = array();
	setcookie(session_name(), '', time()-2592000, '/');
	session_destroy();
}

echo <<<_END
<main>
        <section class="about">
            <h1>Logged out successfully!</h1>
			</br></br></br>
            <h2>Please revisit our Recipe Management Application</h2>
            <h3>To Create, Organize, and Store Recipes!</h3>
            <button onclick="location.href='loginScreen.php'">Login!</button>
        </section>

	</main>

_END;

?>
<footer>
        <p>&copy; 2023 Recipe Management</p>
    </footer>
</body>

</html>
