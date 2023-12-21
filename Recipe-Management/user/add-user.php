<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Management</title>
    <link rel="stylesheet" href="../CSS/view-recipe.css">
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
     <h1 style="text-align: center; margin-top: 1%;">Add User</h1>
        <section class="about">
           <?php
		   $page_roles = array('admin', 'user');
				require_once  '../security/dbinfo.php';
				require_once '../security/checksession.php';
				
				$conn = new mysqli($hn, $un, $pw, $db);
        		if ($conn->connect_error) die($conn->connect_error);

        		if (isset($_POST['add'])) {

					$username = $_POST['username'];
					$password = $_POST['password'];
					$email = $_POST['email'];
					$role_id = $_POST['role_id'];

					$query = "INSERT INTO users (username, password, email, role_id) VALUES ('$username', '$password', '$email', '$role_id')";
					
					$result = $conn->query($query);
					if (!$result) die($conn->error);
					$user_id = $conn->insert_id;

					header("Location: user-list.php");
				}

        $conn->close();
        ?>
		<form action='add-user.php' method='post'>
            <div class="recipe-detail" style="margin-top: 3%;">
                <label for="username"><Strong>Username</Strong></label>
                <input type='text' name='username' value=''>
            </div>
			<div class="recipe-detail" style="margin-top: 3%;">
                <label for="password"><Strong>Password</Strong></label>
                <input type='text' name='password' value=''>
            </div>
			<div class="recipe-detail" style="margin-top: 3%;">
                <label for="email"><Strong>Email</Strong></label>
                <input type='text' name='email' value=''>
            </div>
			
			<div class="recipe-detail" style="margin-top: 3%;">
                <label for="role_id"><Strong>Role</Strong></label>
                <select name='role_id' id='role_id'>
                    <option value='admin'>admin</option>
                    <option value='user'>user</option>
                </select>
            
            <div class="recipe-detail" style="margin-top: 5%;">
                <input type='hidden' name='add' value='yes'>
                <input class="edit-button" type='submit' value='ADD USER'>
            </div>
        </form>

        </section>
    </main>
    <footer>
        <p>&copy; 2023 Recipe Management</p>
    </footer>
</body>

</html>
