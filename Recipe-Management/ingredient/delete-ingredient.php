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
			<li><a href="../user/user-list.php">Users</a></li>
            <li><a href="../security/logout.php">Log Out</a></li>
        </ul>
    </nav>
    <main>
     <h1 style="text-align: center; margin-top: 1%;">Delete Ingredient</h1>
        <section class="about">
		<?php

//import credentials for db
$page_roles = array('admin');
				require_once  '../security/dbinfo.php';
				require_once '../security/checksession.php';

//connect to db
$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);


if (isset($_GET['recipe_ingredient_id'])) {
					$recipe_ingredient_id = $_GET['recipe_ingredient_id'];
					$query = "SELECT recipe_id 
				FROM recipe_ingredients
				WHERE recipe_ingredient_id = $recipe_ingredient_id;";

                    $result = $conn->query($query);
                    if (!$result) die($conn->error);
					$rows = $result->num_rows;
					
					 for ($j = 0; $j < $rows; $j++) {
						$row = $result->fetch_array(MYSQLI_ASSOC);
						$recipe_id = $row['recipe_id'];
					}
				

 echo <<<_END
 <h3>Are you sure to delete the Ingredient?</h3>
 <div class="delete-Ingredient" style="display: flex">
 
<form action="delete-ingredient.php" method="post">
                            <br />
							
                            <button class="delete-button" type="submit" value="yes">Yes</button>
                        <input type='hidden' name='delete' value='yes'>
                        <input type='hidden' name='recipe_ingredient_id' value='$recipe_ingredient_id'>
</form>&nbsp;&nbsp;&nbsp;&nbsp;
<form action="../recipe/view-recipe.php?recipe_id=$recipe_id" method="post">
                            <br />
							<button class="delete-button" type="submit" value="no">No</button>
                      
                       
</form>
</div>
_END;  
}	

if(isset($_POST['delete']))
{
	$recipe_ingredient_id = $_POST['recipe_ingredient_id'];
	
	$query = "SELECT ingredient_id, recipe_id 
				FROM recipe_ingredients
				WHERE recipe_ingredient_id = $recipe_ingredient_id;";

                    $result = $conn->query($query);
                    if (!$result) die($conn->error);
					$rows = $result->num_rows;
					
					 for ($j = 0; $j < $rows; $j++) {
						$row = $result->fetch_array(MYSQLI_ASSOC);
						$recipe_id = $row['recipe_id'];
						$ingredient_id = $row['ingredient_id'];
					}
					

	$query = "DELETE FROM ingredients 
              WHERE ingredient_id = $ingredient_id";
	
	//Run the query
	$result = $conn->query($query); 
	if(!$result) die($conn->error);
	
	
	header("Location: ../recipe/view-recipe.php?recipe_id=$recipe_id");
	
}


?>
 </section>
    </main>
    <footer>
        <p>&copy; 2023 Recipe Management</p>
    </footer>
</body>

</html>