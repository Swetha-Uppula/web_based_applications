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
        <section class="about">
           <?php
		   $page_roles = array('admin', 'user');
				require_once  '../security/dbinfo.php';
				require_once '../security/checksession.php';
				
				$conn = new mysqli($hn, $un, $pw, $db);
        		if ($conn->connect_error) die($conn->connect_error);

        		if (isset($_GET['recipe_id'])) {
					
				$recipe_id = $_GET['recipe_id'];

				
				$query = "SELECT *  FROM recipes r 
                                        join categories c
                                        on c.category_id = r.category_id
										where r.recipe_id = $recipe_id";

				$result = $conn->query($query);
				if (!$result) die($conn->error);

				$rows = $result->num_rows;
			
				$query_ingredients = "SELECT * FROM recipes r 
										join recipe_ingredients ri 
										on r.recipe_id = ri.recipe_id
										join ingredients i 
										on ri.ingredient_id = i.ingredient_id
										where r.recipe_id = $recipe_id";

				$ingredients_result = $conn->query($query_ingredients);
				if (!$ingredients_result) die($conn->error);
				$rows_ingredients = $ingredients_result->num_rows;
         
				$query_ingredients = "SELECT * FROM recipes r 
										join recipe_ingredients ri 
										on r.recipe_id = ri.recipe_id
										join ingredients i 
										on ri.ingredient_id = i.ingredient_id
										where r.recipe_id = $recipe_id";

            
				$ingredients_result = $conn->query($query_ingredients);
				if (!$ingredients_result) die($conn->error);
				$rows_ingredients = $ingredients_result->num_rows;
			

				for ($j = 0; $j < $rows; $j++) {
					$row = $result->fetch_array(MYSQLI_ASSOC);

                echo <<<_END
				<h1>$row[recipe_name]</h1>
				<div class="image">
                    <img src="$row[image_path]" alt="Recipe Image">
					<div class="description">
						<p>$row[description]</p>
						<p><strong>Category:</strong> $row[name]</p>
						<p><strong>Rating:</strong> $row[rating]
_END;

                    // Loop to display stars based on the rating value
                    for ($i = 0; $i < $row['rating']; $i++) {
                        echo '<i class="fas fa-star"></i>';
                    }

                    echo <<<_END
                    </p>
					<p><strong>Preparation and Cooking Time(minutes):</strong> $row[prep_cook_time]</p>
					<p><strong>Servings:</strong> $row[servings]</p>
					<p><strong>Difficulty Level:</strong> $row[difficulty_level]</p>
					<p><strong>Ingredients:</strong></p>
					<ul class="ingredients-list">
_END;                
					
         
            for ($k = 0; $k < $rows_ingredients; $k++){
					 $row_ingredient = $ingredients_result->fetch_array(MYSQLI_ASSOC);
                    echo <<<_END
                        <li>$row_ingredient[quantity_unit] $row_ingredient[name]</li>

_END;
			}
			echo <<<_END
					</ul>
				</div>
			</div>
			<div class="details">
				<p><strong>Instructions:</strong></p>
				<ol class="instructions-list">
					<li>$row[instructions]</li>
				</ol>
                </div>
				<div class="actions">
					<form action="update-recipe.php" method="get">
						<input type="hidden" name="recipe_id" value="$row[recipe_id]">
						<button class="edit-button" type="submit">Update Recipe</button>
					</form>
					<form action="delete-recipe.php" method="get">
						<input type="hidden" name="recipe_id" value="$row[recipe_id]">
						<button class="delete-button" type="submit">Delete Recipe</button>
					</form>	
					<form action="../review/add-review.php" method="get">
						<input type="hidden" name="recipe_id" value="$row[recipe_id]">
						<button class="delete-button" type="submit">Add Review</button>
					</form>	
				</div> 
_END;
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
