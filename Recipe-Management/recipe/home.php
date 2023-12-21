<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Management</title>
    <link rel="stylesheet" href="../CSS/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
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
            <h1>Recipe Management</h1>
            <h2>A Digital Cookbook for Your Culinary Creativity</h2>
            <h3>Create, Organize, and Store Recipes!</h3>
            <button onclick="location.href='view-recipe-list.php'">Get Started!</button>
        </section>
	</main>
        <section class="browse">
            <p><Strong>RECIPE CATEGORIES</Strong></p><br/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?php
            require_once '../security/dbinfo.php';

            $conn = new mysqli($hn, $un, $pw, $db);
            if ($conn->connect_error) die($conn->connect_error);

            $query = "SELECT * FROM categories";

            $result = $conn->query($query);
            if (!$result) die($conn->error);

            $rows = $result->num_rows;

            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                echo <<<_END
				<div class="category" style="display: flex;">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 <form action="view-category.php?name=$row[name]" method="post">
					  <button><img src="../images/$row[name].jpeg" alt="$row[name]">$row[name]</button>
				</form>
				<div>
_END;
            }

            $conn->close();
            ?>
        </section>
        <br/>
    <footer>
        <p>&copy; 2023 Recipe Management</p>
    </footer>
</body>

</html>
