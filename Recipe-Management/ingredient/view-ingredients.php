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
    <main>
        <section class="about">
		<div class="image">
		<div class="description">
		 <ul class="ingredients-list">
           <?php
		   $page_roles = array('admin', 'user');
				require_once  '../security/dbinfo.php';
				require_once '../security/checksession.php';
				$conn = new mysqli($hn, $un, $pw, $db);
        		if ($conn->connect_error) die($conn->connect_error);
			
			if (isset($_GET['recipe_id'])) {
					
            $recipe_id = $_GET['recipe_id'];

				
			
			$query_ingredients = "SELECT * FROM recipes r 
										join recipe_ingredients ri 
										on r.recipe_id = ri.recipe_id
										join ingredients i 
										on ri.ingredient_id = i.ingredient_id
										where r.recipe_id = $recipe_id";

            
			$ingredients_result = $conn->query($query_ingredients);
            if (!$ingredients_result) die($conn->error);
			$rows_ingredients = $ingredients_result->num_rows;
         
            for ($k = 0; $k < $rows_ingredients; $k++){
					 $row_ingredient = $ingredients_result->fetch_array(MYSQLI_ASSOC);
                    echo <<<_END
                        <li>$row_ingredient[quantity_unit] $row_ingredient[name]</li>
                </div>
_END;
                }
            }

        $conn->close();

        ?>
		</ul>
		</div>
		</div>
        </section>
    </main>
</body>

</html>
