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
            <a href="home.php"><img src="../images/logo.jpeg" alt="Recipe Management Logo"></a>
            <h1><a href="home.php">Recipe Management</a></h1>
        </div>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="view-recipe-list.php">Recipes</a></li>
            <li><a href="../review/review-list.php">Reviews</a></li>
			<li><a href="../user/user-list.php">Users</a></li>
            <li><a href="../security/logout.php">Log Out</a></li>
        </ul>
    </nav>
    <main>
     <h1 style="text-align: center; margin-top: 1%;">Delete Recipe</h1>
        <section class="about">
		<?php

// Import credentials for the database
$page_roles = array('admin');
				require_once  '../security/dbinfo.php';
				require_once '../security/checksession.php';

// Connect to the database
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
    die($conn->connect_error);
}
if (isset($_GET['recipe_id'])) {
					$recipe_id = $_GET['recipe_id'];
}					

 echo <<<_END
 <h3>Are you sure to delete the Recipe?</h3>
 <div class="delete-recipe" style="display: flex">
 
<form action="delete-recipe.php" method="post">
                            <br />
							
                            <button class="delete-button" type="submit" class="login-button-black" value="yes">Yes</button>
                        <input type='hidden' name='delete' value='yes'>
                        <input type='hidden' name='recipe_id' value='$recipe_id'>
</form>&nbsp;&nbsp;&nbsp;&nbsp;
<form action="view-recipe.php?recipe_id=$recipe_id" method="post">
                            <br />
							<button class="delete-button" type="submit" class="login-button-black" value="no">No</button>
                      
                       
</form>
</div>
_END;  
if (isset($_POST['delete'])) {
    $recipe_id = $_POST['recipe_id'];
    $query = "DELETE FROM recipes WHERE recipe_id=$recipe_id ";

    // Run the query
    $result = $conn->query($query);
    if (!$result) {
        die($conn->error);
        echo 'Error while deleting the Recipe!';
    } else {
        echo 'Deleted the Recipe Successfully!';
        header("Location: view-recipe-list.php");
        exit;
    }
}


?>
 </section>
    </main>
    <footer>
        <p>&copy; 2023 Recipe Management</p>
    </footer>
</body>

</html>