<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Management</title>
    <link rel="stylesheet" href="../CSS/view-review.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
</head>

<body>
     <nav id="home">
        <div class="navbar-logo">
            <a href="../recipe/home.php"><img src="../images/logo.jpeg" alt="Recipe Management Logo"></a>
            <h1><a href="../recipe/home.php">Recipe Management</a></h1>
        </div>
        <ul>
            <li><a href="../recipe/home.php">Home</a></li>
            <li><a href="../recipe/view-recipe-list.php">Recipes</a></li>
            <li><a href="../review/review-list.php">Reviews</a></li>
			<li><a href="user-list.php">Users</a></li>
            <li><a href="../security/logout.php">Log Out</a></li>
        </ul>
    </nav>
    <main>
	<section class="review-container">
     <h1>Update User</h1>
        <section class="about">
           <?php
				$page_roles = array('admin');
				require_once  '../security/dbinfo.php';
				require_once '../security/checksession.php';
				$conn = new mysqli($hn, $un, $pw, $db);
        		if ($conn->connect_error) die($conn->connect_error);

        		if (isset($_GET['user_id'])) {

					$user_id = $_GET['user_id'];

					
					$query = "SELECT * FROM users where user_id='$user_id'";

            $result = $conn->query($query);
            if (!$result) die($conn->error);

            $rows = $result->num_rows;

            for ($j = 0; $j < $rows; $j++) {
                $row = $result->fetch_array(MYSQLI_ASSOC);
echo <<<_END
	
	<form action='update-user.php' method='post'>

	<pre>
	
	Username: <input type='text' name='username' value='$row[username]'>
	Role: <input type='text' name='role_id' value='$row[role_id]'>
	Email: <input type='text' name='email' value='$row[email]'>
	Password: <input type='text' name='password' value='$row[password]'>
	User ID: <input type='text' name='user_id' value='$row[user_id]' readOnly>

	
	</pre>
	
	
		<input type='hidden' name='update' value='yes'>
		<input type='hidden' name='user_id' value='$row[user_id]'>
		<input type='submit' value='UPDATE RECORD'>	
	</form>
	
_END;

            }
        }
if (isset($_POST['update'])) {
			$username = $_POST['username'];
            $role_id = $_POST['role_id'];
            $email = $_POST['email'];
            $password = $_POST['password'];
			$user_id = $_POST['user_id'];
			$hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
    $query = "UPDATE users set username='$username', role_id='$role_id', email='$email', password='$hashed_password' where user_id = '$user_id'";

    $result = $conn->query($query);
    if (!$result) die($conn->error);

    header('Location: user-list.php');
}
        $conn->close();
?>
        </section>
	</section>
    </main>
    <footer>
        <p>&copy; 2023 Recipe Management</p>
    </footer>
</body>

</html>