<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Management</title>
    <link rel="stylesheet" href="../CSS/view-review.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
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
	<section class="review-container">
     <h1>Update Review</h1>
        <section class="about">
           <?php
				$page_roles = array('admin');
				require_once  '../security/dbinfo.php';
				require_once '../security/checksession.php';
				$conn = new mysqli($hn, $un, $pw, $db);
        		if ($conn->connect_error) die($conn->connect_error);

        		if (isset($_GET['review_id'])) {

					$review_id = $_GET['review_id'];
					$user = $_SESSION['user'];
					$username = $user->username;
	
					$query = "SELECT user_id FROM users WHERE username = '$username'";
					$result = $conn->query($query);

					if ($result) {
						$row = $result->fetch_assoc();
						$user_id = $row['user_id'];
					}
		

 
					
			$query = "SELECT * FROM reviews where review_id='$review_id'";

            $result = $conn->query($query);
            if (!$result) die($conn->error);

            $rows = $result->num_rows;

            for ($j = 0; $j < $rows; $j++) {
                $row = $result->fetch_array(MYSQLI_ASSOC);
				$review_date = date('Y-m-d',strtotime($row['review_date']));

echo <<<_END
	
	<form action='update-review.php' method='post'>

	<pre>
	
Review Text: <input type='text' name='review_text' value='$row[review_text]'>
Date: <input type='date' name='review_date' value='$review_date'>
Review ID: <input type='text' name='review_id' value='$row[review_id]' readOnly>
User ID:<input type='text' name='user_id' value='$user_id' readOnly>
Recipe ID: <input type='text' name='recipe_id' value='$row[recipe_id]' readOnly>

	</pre>
		<input type='hidden' name='update' value='yes'>
		<input type='hidden' name='review_id' value='$row[review_id]'>
		<input type='submit' value='UPDATE RECORD'>	
	</form>
	
_END;
			}

            }
if (isset($_POST['update'])) {
			$review_text = $_POST['review_text'];
            $review_date = $_POST['review_date'];
			$review_id = $_POST['review_id'];
		
    $query = "UPDATE reviews set review_text='$review_text', review_date='$review_date' where review_id = '$review_id'";

    $result = $conn->query($query);
    if (!$result) die($conn->error);

    header('Location: review-list.php');
}
        $conn->close();
?>
        </section>
	</section>
    </main>
    <footer>
        <p>&copy; 2023 Recipe Management</p>
    </footer>
</body>

</html>
