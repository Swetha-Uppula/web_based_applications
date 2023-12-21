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
     <h1 style="text-align: center; margin-top: 1%;">Update Recipe</h1>
        <section class="about">
           <?php
		   $page_roles = array('admin');
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
         

            for ($j = 0; $j < $rows; $j++) {
                $row = $result->fetch_array(MYSQLI_ASSOC);
				$category = $row['name'];
        $A = $B = $C = $D = $E = '';
        if ($category == 'Breakfast') $A = 'selected';
        if ($category == 'Lunch') $B = 'selected';
		if ($category == 'Dinner') $c = 'selected';
		if ($category == 'Snacks') $D = 'selected';
		if ($category == 'Desserts') $E = 'selected';
		
		$difficulty_level = $row['difficulty_level'];
        $A_D = $B_D = $C_D = '';
        if ($difficulty_level == 'Easy') $A_D = 'selected';
        if ($difficulty_level == 'Medium') $B_D = 'selected';
		if ($difficulty_level == 'Hard') $c_D = 'selected';

                echo <<<_END
				 <form action="update-recipe.php" method="post">
                    <input type="hidden" id="recipe_id" name="recipe_id" value="$row[recipe_id]" readonly>
					</br>
				<div class="recipe-detail" style="margin-top: 3%;">
                    <label for="recipe_name"><Strong>Recipe Name</Strong></label>
                    <input type="text" id="recipe_name" name="recipe_name" value="$row[recipe_name]">
                </div></br></br>
				<img src="$row[image_path]" alt="Recipe Image">
				<div class="recipe-detail" style="margin-top: 1%; ">
                    <label for="recipeimage"><strong>Recipe Image</strong></label>
                    <input type="text" id="image_path" name="image_path" value="$row[image_path]">
                </div>
				<div class="recipe-detail" style="margin-top: 3%; ">
                    <label for="description"><Strong>Description</Strong></label>
                    <input type="text" id="description" name="description" value="$row[description]" readonly>
                </div>
				<div class="recipe-detail" style="margin-top: 3%; ">
                <label for="category"><Strong>Category</Strong></label>
                <select name='category' id='category'>
                    <option value='Breakfast' $A>Breakfast</option>
                    <option value='Lunch' $B>Lunch</option>
					<option value='Dinner' $C>Dinner</option>
					<option value='Snacks' $D>Snacks</option>
					<option value='Desserts' $E>Desserts</option>
                </select>
            </div>
				<div class="recipe-detail" style="margin-top: 3%; ">
                    <label for="rating"><strong>Rating</strong></label>
                    <input type="text" id="rating" value="$row[rating]" name="rating">
                </div>
                <div class="recipe-detail" style="margin-top: 3%; ">
                    <label for="prep_cook_time"><strong>Preparation and Cooking Time(minutes)</strong></label>
                    <input type="text" id="prep_cook_time" value="{$row['prep_cook_time']}" name="prep_cook_time">
                </div>
                <div class="recipe-detail" style="margin-top: 3%; ">
                    <label for="servings"><strong>Servings</strong></label>
                    <input type="text" id="servings" value="{$row['servings']}" name="servings">
                </div>
				<div class="recipe-detail" style="margin-top: 3%; ">
                <label for="difficulty_level"><strong>Difficulty Level</strong></label>
                <select name='difficulty_level' id='difficulty_level'>
                    <option value='Easy' $A_D>Easy</option>
                    <option value='Medium' $B_D>Medium</option>
					<option value='Hard' $C_D>Hard</option>
                </select>
            </div>
			
				<div class="recipe-detail" style="margin-top: 3%; ">
                    <label for="instructions"><strong>Instructions</strong></label>
                    <input type="text" id="instructions" name="instructions" value="$row[instructions]" readonly>
                </div>
                
			<div class="recipe-detail" style="margin-top: 3%; ">
                            <button class="edit-button" type="submit" class="login-button-black">Update Recipe</button>
                        </div>
                        <input type='hidden' name='update' value='yes'>
                        <input type='hidden' name='recipe_id' value='$row[recipe_id]'>
                    </form>
					</br></br>
					<Strong>Ingredients</Strong>
_END;                
                for ($k = 0; $k < $rows_ingredients; $k++){
					 $row_ingredient = $ingredients_result->fetch_array(MYSQLI_ASSOC);
                    echo <<<_END
                        <div class="ingredient" style="display: flex; margin-right: 6%; margin-top: 3%;">
							<div class="ingredient-info">
								<label for="ingredient">{$row_ingredient['name']}</label>
								<input type="text" id="ingredient" value="{$row_ingredient['quantity_unit']}" readonly>
							</div>
							<form action="../ingredient/update-ingredient.php" method="get">
								<input type="hidden" name="recipe_ingredient_id" value="$row_ingredient[recipe_ingredient_id]">
								<button class="edit-button" style="font-size: 12px; margin-right:5%; " type="submit">Update Ingredient</button>
							</form>
						</div></br></br>
                </div>
_END;
                }
				
				 echo <<<_END
				 <div class="buttons" style="display: flex;">
				 <form action="../ingredient/add-ingredients.php" method="get">
					<input type="hidden" name="recipe_id" value="$row[recipe_id]">
					<button class="delete-button" type="submit">Add Ingredients</button>
				</form>	
				<form action="delete-recipe.php" method="get">
					<input type="hidden" name="recipe_id" value="$row[recipe_id]">
					<button class="delete-button" type="submit">Delete Recipe</button>
				</form>	
				</div>
                 
_END;
            }
        }
		
		if (isset($_POST['update'])) {
			$recipe_id = $_POST['recipe_id'];
			$recipe_name = $_POST['recipe_name'];
            $description = $_POST['description'];
			$category = $_POST['category'];
			$instructions = $_POST['instructions'];
            $prep_cook_time = $_POST['prep_cook_time'];
            $servings = $_POST['servings'];
            $difficulty_level = $_POST['difficulty_level'];
            $rating = $_POST['rating'];
			
			$category_query = "SELECT category_id from categories WHERE name = '$category'";
			$category_result = $conn->query($category_query);
            if (!$category_result) die($conn->error);
			$rows_category= $category_result->num_rows;
			
			for ($j = 0; $j < $rows_category; $j++) {
                $row = $category_result->fetch_array(MYSQLI_ASSOC);
				$category_id = $row['category_id'];
			}
			
    $query = "UPDATE recipes set recipe_name='$recipe_name', description='$description', category_id='$category_id', instructions='$instructions', prep_cook_time=$prep_cook_time, servings=$servings, difficulty_level='$difficulty_level', rating=$rating where recipe_id = $recipe_id ";

    $result = $conn->query($query);
    if (!$result) die($conn->error);

    header("Location: view-recipe-list.php");
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