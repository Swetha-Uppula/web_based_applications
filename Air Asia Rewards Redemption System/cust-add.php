<!DOCTYPE html>
<html>

<head>
    <title>Air Asia Add Gift Card Page</title>
    <style>
        body {
            text-align: center;
        }

        .card-details-container {
            width: 300px;
            margin: 0 auto;
            margin-top: 100px;
            padding: 20px;
        }

        .card-group {
            margin: 10px 0;
        }

        .card-group label {
            display: block;
            text-align: left;
        }

        .card-group input,
        .card-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .login-button-black {
            background-color: black;
            color: white;
        }
    </style>
</head>

<body>
    <div class="card-details-container">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f5/AirAsia_New_Logo.svg/2048px-AirAsia_New_Logo.svg.png"
            alt="AirAsia Logo" width="100" height="100">
        <br />
        <h1>Add Gift Card</h1>
		<?php

$page_roles = array('admin');

require_once 'login.php';
require_once 'checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

echo <<<_END
<form action='cust-add.php' method='post'>
            <div class="card-group">
                <label for="forename">Forename</label>
                <input type='text' name='forename' value=''>
            </div>
            <div class="card-group">
                <label for="surname">Surname</label>
                <input type='text' name='surname' value=''>
            </div>
            <div class="card-group">
                <label for="username">Username</label>
                <input type='text' name='username' value=''>
            </div>
			<div class="card-group">
                <label for="role">Role</label>
                <select id="role" name="role">
                                <option value="admin">Admin</option>
                                <option value="customer">Customer</option>
                            </select>
            </div>
            <div class="card-group">
                <label for="password">Password</label>
                <input type='password' name='password' value=''>
            </div>
			<div class="card-group">
                <input type='hidden' name='add' value='yes'>
                <input type='submit' value='ADD USER'>
            </div>
        </form>
_END;


if(isset($_POST['forename']) &&
	isset($_POST['surname']) &&
	isset($_POST['username']) &&
	isset($_POST['password'])) {
		$forename=get_post($conn, 'forename');
		$surname=get_post($conn, 'surname');
		$username=get_post($conn, 'username');
		$password=get_post($conn, 'password');
		$role=get_post($conn, 'role');
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
		
		$query="INSERT INTO users (forename, surname, username, password) VALUES ".
			"('$forename','$surname','$username','$hashedPassword')";
		$result=$conn->query($query);
		if(!$result) echo "INSERT failed: $query <br>" .
			$conn->error . "<br><br>";
			
		$query="INSERT INTO roles (username, role) VALUES ".
			"('$username','$role')";
		$result=$conn->query($query);
		if(!$result) echo "INSERT failed: $query <br>" .
			$conn->error . "<br><br>";
		 header("Location: card-list.php");
	
}

$conn->close();

function get_post($conn, $var) {
	return $conn->real_escape_string($_POST[$var]);
}

?>
    </div>
</body>

</html>