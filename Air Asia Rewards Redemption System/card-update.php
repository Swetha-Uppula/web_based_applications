<?php
require_once 'login.php';
require_once 'checksession.php';

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
        $cardType = $row['cardType'];
        $A = $B = '';
        if ($cardType == 'Electronic') $A = 'selected';
        if ($cardType == 'Physical') $B = 'selected';

        echo <<<_END
            <!DOCTYPE html>
            <html lang="en">
            
            <head>
                <title>Air Asia Update Gift Card Page</title>
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

                    .card-group img {
                        width: 200px;
                        height: auto;
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
                    <h1>Update Gift Card</h1>
                    <form action="card-update.php" method="post">
                        <div class="card-group">
                            <label for="cardname">Card Name</label>
                            <input type="text" id="cardname" name="cardName" value="$row[cardName]">
                        </div>
                        <div class="card-group">
                            <label for="cardtype">Card Type</label>
                            <select id="cardtype" name="cardType">
                                <option value="Electronic" $A>Electronic</option>
                                <option value="Physical" $B>Physical</option>
                            </select>
                        </div>
                        <div class="card-group">
                            <label for="cardvalue">Card Value</label>
                            <input type="text" id="cardvalue" value="$row[cardValue]" name="cardValue">
                        </div>
                        <div class="card-group">
                            <label for="points">Points</label>
                            <input type="text" id="points" value="$row[points]" name="points">
                        </div>
                        <div class="card-group">
                            <label for="cardimage">Card Image</label>
                            <img src="./images/gift-card.png" alt="Gift Card 1">
                            <button type="submit" class="login-button">Change Image</button>
                        </div>
                        <div class="card-group">
                            <br />
                            <button type="submit" class="login-button-black">Update Card</button>
                        </div>
                        <input type='hidden' name='update' value='yes'>
                        <input type='hidden' name='cardId' value='$row[cardId]'>
                    </form>
                </div>
            </body>
            
            </html>
        _END;
    }
}

if (isset($_POST['update'])) {
    $cardId = $_POST['cardId'];
    $cardName = $_POST['cardName'];
    $cardType = $_POST['cardType'];
    $cardValue = $_POST['cardValue'];
    $points = $_POST['points'];

    $query = "UPDATE giftcard set cardName='$cardName', cardType='$cardType', cardValue='$cardValue', points='$points' where cardId = $cardId ";

    $result = $conn->query($query);
    if (!$result) die($conn->error);

    header("Location: card-list.php");
}

$conn->close();
?>
