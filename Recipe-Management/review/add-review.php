<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Add Review Page</title>
		<link rel="stylesheet" type="text/css" href="../CSS/add-review.css">
	</head>
	
	<body>
		<nav id="home">
        <div class="navbar-logo">
            <a href="../recipe/home.php"><img src="../images/logo.jpeg" alt="Recipe Management Logo"></a>
            <h1><a href="home.php">Recipe Management</a></h1>
        </div>
        <ul>
            <li><a href="../recipe/home.php">Home</a></li>
            <li><a href="../recipe/view-recipe-list.php">Recipes</a></li>
            <li><a href="review-list.php">Reviews</a></li>
			<li><a href="../user/user-list.php">Users</a></li>
            <li><a href="../security/logout.php">Log Out</a></li>
        </ul>
    </nav>
		<main>
		<?php

$page_roles = array('admin', 'user');
            require_once '../security/dbinfo.php';
			require_once '../security/checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);

if (isset($_GET['recipe_id'])) {
                $recipe_id = $_GET['recipe_id'];
}

if(isset($_POST['add'])){
	
	$recipe_id = $_POST['recipe_id'];
	$review_text = $_POST['review_text'];
	$user = $_SESSION['user'];
	$username = $user->username;
	
	$query = "SELECT user_id FROM users WHERE username = '$username'";
    $result = $conn->query($query);

 if ($result) {
        $row = $result->fetch_assoc();
		$user_id = $row['user_id'];
		
 }
	$query = "INSERT into reviews(user_id, recipe_id, review_text) 
	values('$user_id','$recipe_id','$review_text')";
	
	$result = $conn->query($query);
	if(!$result) die($conn->error);
	
	header("Location: review-list.php");
}

$conn->close();

?>
			<section class="review-container">
				<h2>Add a review </h2>
				<form action='add-review.php' method='post'>
			<div class="recipe-detail">
                Recipe ID:<input type='text' name='recipe_id' value='<?= $recipe_id ?>' readonly></br>
				Review Text:<input type='text' name='review_text' value='' >
            </div>
			<br>
                <div class="recipe-detail" style="margin-top: 3%;">
                    <input type='hidden' name='add' value='yes'>
                    <input class="edit-button" type='submit' value='ADD Review'>
                </div>
            </form>
			</section>
		</main>
	</body>
	
</html>
