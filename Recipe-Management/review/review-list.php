<?php

$page_roles = array('admin', 'user');
				require_once  '../security/dbinfo.php';
				require_once '../security/checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);

$query = "SELECT * FROM reviews order by review_id";
	
$result = $conn->query($query);
if(!$result) die($conn->error);
	
$rows = $result->num_rows;	

echo <<<_END
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Add Review Page</title>
		<link rel="stylesheet" type="text/css" href="../CSS/user-list.css">
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
		
		<body>
		
	</body>
		
	</body>
_END;



	
for($j=0; $j<$rows; $j++)
{
	//$result->data_seek($j);
	$row = $result->fetch_array(MYSQLI_ASSOC);

echo <<<_END

	<body>
		<main>
			<section class="review-container">
				<form method='post' action='review-list.php'>
					<div>
						Review ID: <a href='update-review.php?review_id=$row[review_id]'>$row[review_id]</a> <br>
						
						User ID: $row[user_id]<br>
						Recipe ID: $row[recipe_id]<br>
						Review Text: $row[review_text]<br>
						Review Date: $row[review_date]
					</div>
				</form>
				<form action="delete-review.php" method="get">
						<input type="hidden" name="review_id" value="$row[review_id]">
						<button class="edit-button" type="submit">Delete Review</button>
					</form>
			</section>
		</main>
	</body>
	
	
_END;

}
	
$conn->close();

?>