<!DOCTYPE html>
<html>

<head>
    <title>Air Asia Gift Card Details Page</title>
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

        .card-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .card-group img {
            width: 200px;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="card-details-container">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f5/AirAsia_New_Logo.svg/2048px-AirAsia_New_Logo.svg.png"
            alt="AirAsia Logo" width="100" height="100">
        <br />
        <h1>View Gift Card</h1>
        
        <?php

        require_once 'login.php';

        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error) die($conn->connect_error);

        if (isset($_GET['cardId'])) {

            $cardId = $_GET['cardId'];

            $query = "SELECT * FROM giftcard where cardId=$cardId";

            $result = $conn->query($query);
            if (!$result) die($conn->error);

            $rows = $result->num_rows;

            for ($j = 0; $j < $rows; $j++) {
                $row = $result->fetch_array(MYSQLI_ASSOC);

                echo <<<_END
                <div class="card-group">
                    <label for="cardId">Card ID</label>
                    <input type="text" id="cardId" name="cardId" value="{$row['cardId']}" readonly>
                </div>
                <div class="card-group">
                    <label for="cardname">Card Name</label>
                    <input type="text" id="cardname" name="cardname" value="{$row['cardName']}" readonly>
                </div>
                <div class="card-group">
                    <label for="cardtype">Card Type</label>
                    <input type="text" id="cardtype" value="{$row['cardType']}" name="cardtype" readonly>
                </div>
                <div class="card-group">
                    <label for="cardvalue">Card Value</label>
                    <input type="text" id="cardvalue" value="{$row['cardValue']}" name="cardvalue" readonly>
                </div>
                <div class="card-group">
                    <label for="points">Points</label>
                    <input type="text" id="points" value="{$row['points']}" name="points" readonly>
                </div>
                <div class="card-group">
                    <label for="cardimage">Card Image</label>
                    <img src="./images/gift-card.png" alt="Gift Card 1">
                </div>
                <div><a href="card-update.php?cardId={$row['cardId']}">Update Card</a></div>
				<div><a href="redeem.php?cardId={$row['cardId']}">Redeem Card</a></div>
_END;
            }
        }

        $conn->close();

        ?>
    </div>
</body>

</html>
