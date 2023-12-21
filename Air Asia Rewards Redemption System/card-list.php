<!DOCTYPE html>
<html>

<head>
    <title>Air Asia Gift Cards List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        .card {
            display: inline-block;
            margin: 10px;
        }

        .card img {
            width: 200px;
            height: auto;
        }

        .card h3 {
            font-size: 20px;
        }
    </style>
</head>

<body>
    <div class="card-container">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f5/AirAsia_New_Logo.svg/2048px-AirAsia_New_Logo.svg.png"
            alt="AirAsia Logo" width="100" height="100">
        <br />
        <h1>List of Gift Cards</h1>
        <div><a href="card-add.php">Add New Gift Card</a></div>
		<div><a href="cust-add.php">Add New User</a></div>
        <?php
        require_once 'login.php';

        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error) die($conn->connect_error);

        $query = "SELECT * FROM giftcard";
        $result = $conn->query($query);
        if (!$result) die($conn->error);

        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            echo <<<_END
                <div class="card">
                    <img src="./images/gift-card.png" alt="$row[cardName]">
                    <h3>$row[cardName]</h3>
                    <p>$row[cardType] $row[cardValue] $row[points]</p>
                    <a href="card-details.php?cardId=$row[cardId]">View</a>
                </div>
_END;
        }

        $conn->close();
        ?>
    </div>
</body>

</html>
