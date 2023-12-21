<?php

 $page_roles = array('admin', 'user');
				require_once  '../security/dbinfo.php';
				require_once '../security/checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);

$query = "SELECT * FROM users order by user_id";

	
$result = $conn->query($query);
if(!$result) die($conn->error);
	
$rows = $result->num_rows;	

echo <<<_END
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Add User Page</title>
		<link rel="stylesheet" type="text/css" href="../CSS/user-list.css">
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
			<li><a href="user-list.php">Users</a></li>
            <li><a href="../security/logout.php">Log Out</a></li>
        </ul>
    </nav>
		
		<body>
		<main>
			<section class="add-user">
				<form method='post' action='add-user.php'>
					<div>
						<form method='post' action='add-user.php'>
							<form action='add-user.php' method='post'>
							<input type='submit' value='Add User'>	
							</form>
						</form>
					</div>
				</form>
			</section>
		</main>
	</body>
		
	</body>
_END;



	
for($j=0; $j<$rows; $j++)
{

	$row = $result->fetch_array(MYSQLI_ASSOC);

echo <<<_END

	<body>
		<main>
			<section class="review-container">
				<form method='post' action='user-list.php'>
					<div>
						User ID: <a href='update-user.php?user_id=$row[user_id]'>$row[user_id]</a> <br>
						Username: $row[username]<br>
						Role: $row[role_id]<br>
						Email: $row[email]<br>
					</div>
				</form>
				<form action="delete-user.php" method="get">
						<input type="hidden" name="user_id" value="$row[user_id]">
						<button class="edit-button" type="submit">Delete User</button>
				</form>
			</section>
		</main>
	</body>
	
	
_END;

}
	
$conn->close();

?>