<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Management</title>
    <link rel="stylesheet" href="../CSS/view-recipe.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
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
        <h1 style="text-align: center; margin-top: 1%;">Update Ingredient</h1>
        <section class="about">
            <?php
           $page_roles = array('admin');
				require_once  '../security/dbinfo.php';
				require_once '../security/checksession.php';
            $conn = new mysqli($hn, $un, $pw, $db);
            if ($conn->connect_error) die($conn->connect_error);

            if (isset($_GET['recipe_ingredient_id'])) {
                $recipe_ingredient_id = $_GET['recipe_ingredient_id'];

                $query = "SELECT * FROM ingredients i 
                          JOIN recipe_ingredients ri ON i.ingredient_id = ri.ingredient_id
                          WHERE ri.recipe_ingredient_id = $recipe_ingredient_id";

                $result = $conn->query($query);
                if (!$result) die($conn->error);

                $rows = $result->num_rows;

                for ($j = 0; $j < $rows; $j++) {
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    echo <<<_END
					
					<form action="update-ingredient.php" method="post">
						<div class="recipe-detail"  style="margin-top: 3%; ">
                            <label for="name"><Strong>Ingredient Name</Strong></label>
                            <input type="text" id="name" name="name" value="{$row['name']}">
                        </div>
                        <div class="recipe-detail"  style="margin-top: 3%; ">
                            <label for="quantity_unit"><Strong>Quantity in Units</Strong></label>
                            <input type="text" id="quantity_unit" name="quantity_unit" value="{$row['quantity_unit']}">
                        </div>
						<div class="recipe-detail"  style="margin-top: 3%; ">
                            <br />
                            <button type="submit" class="edit-button">Update Ingredient</button>
                        </div>
                        <input type='hidden' name='update' value='yes'>
                        <input type='hidden' name='recipe_ingredient_id' value='$row[recipe_ingredient_id]'>
					</form>	
					</br></br>
					<form action="delete-ingredient.php" method="get">
						<input type="hidden" name="recipe_ingredient_id" value="$row[recipe_ingredient_id]">
						<button type="submit" class="delete-button">Delete Ingredient</button>
					</form>	

_END;
                }
			}

                if (isset($_POST['update'])) {
					$recipe_ingredient_id = $_POST['recipe_ingredient_id'];
                    $name = $_POST['name'];
                    $quantity_unit = $_POST['quantity_unit'];
					
                    $query = "UPDATE ingredients i
							JOIN recipe_ingredients ri ON ri.ingredient_id = i.ingredient_id
							SET i.name='$name', i.quantity_unit='$quantity_unit'
							WHERE ri.recipe_ingredient_id = $recipe_ingredient_id;";

                    $result = $conn->query($query);
                    if (!$result) die($conn->error);
					
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
					header("Location: ../recipe/view-recipe.php?recipe_id=$recipe_id");
				}
					
            $conn->close();
            ?>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 Recipe Management</p>
    </footer>
</body>

</html>

