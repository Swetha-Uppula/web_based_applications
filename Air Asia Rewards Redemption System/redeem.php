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
        <h1>Redeem Gift Card</h1>
		<?php
$page_roles = array('admin');
require_once 'login.php';
require_once 'checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

if (isset($_GET['cardId'])) {
    $cardId = $_GET['cardId'];
	$user = $_SESSION['user'];
	$username = $user->username;
	
	$query = "SELECT id FROM roles WHERE username = '$username'";
    $result = $conn->query($query);

 if ($result) {
        $row = $result->fetch_assoc();
		$userId = $row['id'];
		
 }
 

    // Fetch card details
    $query = "SELECT * FROM giftcard WHERE cardId=$cardId";
    $result = $conn->query($query);

    if ($result) {
        $row = $result->fetch_assoc();
        $redeemedPoints = $row['points'];

        // Deduct points from user account
        $updateUserPointsQuery = "UPDATE account SET points = points - $redeemedPoints WHERE userId = $userId";
        $conn->query($updateUserPointsQuery);

        // Insert a new row into the Redemption table
        $insertRedemptionQuery = "INSERT INTO Redemption (cardId, userId, redeemedPoints) VALUES ($cardId, $userId, $redeemedPoints)";
        $conn->query($insertRedemptionQuery);

        echo "Gift card redeemed successfully!";
    } else {
        echo "Error fetching gift card details.";
    }


}

$conn->close();
?>
