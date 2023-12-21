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
        <h1 style="text-align: center; margin-top: 1%;">Add Ingredients</h1>
        <section class="about">

            <?php
			$page_roles = array('admin', 'user');
            require_once '../security/dbinfo.php';
			require_once '../security/checksession.php';
			
            $conn = new mysqli($hn, $un, $pw, $db);
            if ($conn->connect_error) die($conn->connect_error);

            if (isset($_GET['recipe_id']) && isset($_GET['number_of_ingredients'])) {
                $recipe_id = $_GET['recipe_id'];
                $number_of_ingredients = $_GET['number_of_ingredients'] ? $_GET['number_of_ingredients'] : 1;
            }
			else if (isset($_GET['recipe_id'])) {
                $recipe_id = $_GET['recipe_id'];
                $number_of_ingredients = 1;
            }

            if (isset($_POST['add'])) {
				$recipe_id = $_POST['recipe_id'];
				$number_of_ingredients = $_POST['number_of_ingredients'];
                if ($number_of_ingredients > 0) {
                    for ($i = 1; $i <= $number_of_ingredients; ++$i) {
                        $name = $_POST["name$i"];
                        $quantity_unit = $_POST["quantity_unit$i"];

                        // Insert into ingredients table
                        $query = "INSERT INTO ingredients (name, quantity_unit) VALUES ('$name', '$quantity_unit')";
                        $result = $conn->query($query);
                        if (!$result) die($conn->error);
                        echo "DONE 1";

                        // Get the ingredient_id of the newly added ingredient
                        $ingredient_id = $conn->insert_id;

                        // Insert into recipe_ingredients table
                        $query = "INSERT INTO recipe_ingredients (recipe_id, ingredient_id) VALUES ($recipe_id, $ingredient_id)";
                        $result = $conn->query($query);
                        if (!$result) die($conn->error);
                    }
                }
				header("Location: ../recipe/view-recipe.php?recipe_id=$recipe_id");
            }

            $conn->close();
            ?>
            
            <form action='add-ingredients.php' method='post'>
			<div class="recipe-detail">
                <input type='hidden' name='recipe_id' value='<?= $recipe_id ?>' readonly>
            </div>
			<div class="recipe-detail" style="margin-top: 3%;">
                <label for="number_of_ingredients"><Strong>Number of Ingredients</Strong></label>
                <input type='text' name='number_of_ingredients' value='<?= $number_of_ingredients ?>' readonly>
            </div>
                <?php for ($i = 1; $i <= $number_of_ingredients; ++$i) { ?>
                    <br>
                    <div class="recipe-detail" style="margin-top: 3%;">
                        <label for="name<?= $i ?>"><Strong>Ingredient Name <?= $i ?></Strong></label>
                        <input type='text' name='name<?= $i ?>' value=''>
                    </div>
                    <div class="recipe-detail" style="margin-top: 3%;">
                        <label for="quantity_unit<?= $i ?>"><Strong>Quantity in units <?= $i ?></Strong></label>
                        <input type='text' name='quantity_unit<?= $i ?>' value=''>
                    </div>
                <?php } ?>
                <br>
                <div class="recipe-detail" style="margin-top: 3%;">
                    <input type='hidden' name='add' value='yes'>
                    <input class="edit-button" type='submit' value='ADD Ingredients'>
                </div>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 Recipe Management</p>
    </footer>
</body>

</html>
