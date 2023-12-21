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
    <main>
     <h1 style="text-align: center; margin-top: 1%;">Delete Review</h1>
        <section class="about">
<?php
$page_roles = array('admin');
				require_once  '../security/dbinfo.php';
				require_once '../security/checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);


if (isset($_GET['user_id'])) {
					$user_id = $_GET['user_id'];
}					

 echo <<<_END
 <h3>Are you sure to delete the User?</h3>
 <div class="delete-review" style="display: flex">
 
<form action="delete-user.php" method="post">
                            <br />
							
                            <button class="delete-button" type="submit" value="yes">Yes</button>
                        <input type='hidden' name='delete' value='yes'>
                        <input type='hidden' name='user_id' value='$user_id'>
</form>&nbsp;&nbsp;&nbsp;&nbsp;
<form action="user-list.php" method="post">
                            <br />
							<button class="delete-button" type="submit" value="no">No</button>
                      
                       
</form>
</div>
_END;


if(isset($_POST['delete'])){

	$user_id = $_POST['user_id'];
	$query = "DELETE FROM users WHERE user_id='$user_id' ";
		
	$result = $conn->query($query);
	if(!$result) die($conn->error);
	
	header("Location: user-list.php");

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