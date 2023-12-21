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
     <h1 style="text-align: center; margin-top: 1%;">Add Recipe</h1>
        <section class="about">
           <?php
		   $page_roles = array('admin', 'user');
				require_once  '../security/dbinfo.php';
				require_once '../security/checksession.php';
				
				$conn = new mysqli($hn, $un, $pw, $db);
        		if ($conn->connect_error) die($conn->connect_error);

        		if (isset($_POST['add'])) {

            $recipe_name = $_POST['recipe_name'];
            $description = $_POST['description'];
			$category = $_POST['category'];
			$instructions = $_POST['instructions'];
            $prep_cook_time = $_POST['prep_cook_time'];
            $servings = $_POST['servings'];
            $difficulty_level = $_POST['difficulty_level'];
            $rating = $_POST['rating'];
			$image_path = $_POST['image_path'];
			$number_of_ingredients = $_POST['number_of_ingredients'];
			
			$category_query = "SELECT category_id from categories WHERE name = '$category'";
			$category_result = $conn->query($category_query);
            if (!$category_result) die($conn->error);
			$rows_category= $category_result->num_rows;
			
			for ($j = 0; $j < $rows_category; $j++) {
                $row = $category_result->fetch_array(MYSQLI_ASSOC);
				$category_id = $row['category_id'];
			}
			
			$escaped_description = mysqli_real_escape_string($conn, $description);
			$escaped_instructions = mysqli_real_escape_string($conn, $instructions);

			$query = "INSERT INTO recipes (recipe_name, category_id, description, instructions, prep_cook_time, servings, difficulty_level, rating, image_path) VALUES ('$recipe_name', '$category_id', '$escaped_description', '$escaped_instructions', $prep_cook_time, $servings, '$difficulty_level', $rating, '$image_path')";
			
            $result = $conn->query($query);
            if (!$result) die($conn->error);
			$recipe_id = $conn->insert_id;

            header("Location: ../ingredient/add-ingredients.php?recipe_id=$recipe_id&number_of_ingredients=$number_of_ingredients");
        }

        $conn->close();
        ?>
		<form action='add-recipe.php' method='post'>
            <div class="recipe-detail" style="margin-top: 3%;">
                <label for="recipe_name"><Strong>Recipe Name</Strong></label>
                <input type='text' name='recipe_name' value=''>
            </div>
			<div class="recipe-detail" style="margin-top: 3%;">
                <label for="description"><Strong>Description</Strong></label>
                <input type='text' name='description' value=''>
            </div>
			
			<div class="recipe-detail" style="margin-top: 3%;">
                <label for="category"><Strong>Category</Strong></label>
                <select name='category' id='category'>
                    <option value='Breakfast'>Breakfast</option>
                    <option value='Lunch'>Lunch</option>
					<option value='Dinner'>Dinner</option>
					 <option value='Lunch'>Snacks</option>
					<option value='Dinner'>Desserts</option>
                </select>
            </div>
			<div class="recipe-detail" style="margin-top: 3%;">
                <label for="rating"><strong>Rating</strong></label>
                <input type='text' name='rating' value=''>
            </div>
			<div class="recipe-detail" style="margin-top: 3%;">
                <label for="prep_cook_time"><strong>Preparation and Cooking Time(minutes)</strong></label>
                <input type='text' name='prep_cook_time' value=''>
            </div>
			<div class="recipe-detail" style="margin-top: 3%;">
                <label for="servings"><strong>Servings</strong></label>
                <input type='text' name='servings' value=''>
            </div>
            <div class="recipe-detail" style="margin-top: 3%;">
                <label for="difficulty_level"><strong>Difficulty Level</strong></label>
                <select name='difficulty_level' id='difficulty_level'>
                    <option value='Easy'>Easy</option>
                    <option value='Medium'>Medium</option>
					<option value='Hard'>Hard</option>
                </select>
            </div>
            
			<div class="recipe-detail" style="margin-top: 3%;">
                <label for="image_path"><strong>Image Link/URL</strong></label>
                <input type='text' name='image_path' value=''>
            </div>
			<div class="recipe-detail" style="margin-top: 3%;">
                <label for="instructions"><strong>Instructions</strong></label>
                <input type='text' name='instructions' value=''>
            </div>
			 <div class="recipe-detail" style="margin-top: 3%;">
                <label for="number_of_ingredients"><strong>Number of ingredients</strong></label>
                <input type='text' name='number_of_ingredients' value=''>
            </div>
            <div class="recipe-detail" style="margin-top: 5%;">
                <input type='hidden' name='add' value='yes'>
                <input class="edit-button" type='submit' value='ADD RECIPE'>
            </div>
        </form>

        </section>
    </main>
    <footer>
        <p>&copy; 2023 Recipe Management</p>
    </footer>
</body>

</html>
