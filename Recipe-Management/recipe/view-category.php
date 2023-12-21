<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Management</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>

<body style="background-color: #dac2c2;">
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
	 <?php
                $page_roles = array('admin', 'user');
				require_once  '../security/dbinfo.php';
				require_once '../security/checksession.php';
                $conn = new mysqli($hn, $un, $pw, $db);
                if ($conn->connect_error) die($conn->connect_error);

				if (isset($_GET['name'])) {
					$name = $_GET['name'];
					
					$query = "SELECT *  FROM recipes r 
                                        join categories c
                                        on c.category_id = r.category_id
										where c.name = '$name'";
				echo <<<_END
				<section class="heading">
					<h1><Strong>List of Recipes by Category: </Strong><span style="color: darkred;">$name</span></h1>
				</section>
				<main>
				<section class="about">
_END;
            $result = $conn->query($query);
            if (!$result) die($conn->error);

            $rows = $result->num_rows;
			  for ($j = 0; $j < $rows; $j++) {
                $row = $result->fetch_array(MYSQLI_ASSOC);
				$category_id = $row['category_id'];
				}
				
                $query = "SELECT * FROM recipes  WHERE category_id = $category_id";

                $result = $conn->query($query);
                if (!$result) die($conn->error);

                // Counter for recipes in a row
                $recipeCount = 0;

                while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                    // Increment the counter
                    $recipeCount++;

                    // Determine the class for the container based on the counter
                    $containerClass = ($recipeCount % 3 == 0) ? 'recipe-container-last' : 'recipe-container';

                    echo <<<_END
                        <div class="$containerClass">
                            <div class="recipe">
                                <img src="$row[image_path]" alt="$row[recipe_name]">
                                <p><strong>$row[recipe_name]</strong></p>
                                <p>Cooking time: $row[prep_cook_time] minutes</p>
                                <p>Servings: $row[servings]</p>
                                <p>Difficulty Level: $row[difficulty_level]</p>
                                <p>Rating: 
_END;

                    // Loop to display stars based on the rating value
                    for ($i = 0; $i < $row['rating']; $i++) {
                        echo '<i class="fas fa-star"></i>';
                    }

                    echo <<<_END
                                </p>
                                <form action="view-recipe.php" method="get">
                                    <input type="hidden" name="recipe_id" value="$row[recipe_id]">
                                    <button type="submit">View</button>
                                </form>
                            </div>
                        </div>
_END;

                    // If three recipes are displayed, start a new row
                    if ($recipeCount % 3 == 0) {
                        echo '<div style="clear:both;"></div>';
                    }
                }
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
