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
        require_once 'login.php';
		require_once 'checksession.php';

        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error) die($conn->connect_error);

        if (isset($_POST['add'])) {

            $cardName = $_POST['cardName'];
            $cardType = $_POST['cardType'];
            $cardValue = $_POST['cardValue'];
            $points = $_POST['points'];

            $query = "INSERT INTO giftcard (cardName, cardType, cardValue, points) VALUES ('$cardName',  '$cardType', '$cardValue', '$points')";

            $result = $conn->query($query);
            if (!$result) die($conn->error);

            header("Location: card-list.php");
        }

        $conn->close();
        ?>
        <form action='card-add.php' method='post'>
            <div class="card-group">
                <label for="cardname">Card Name</label>
                <input type='text' name='cardName' value=''>
            </div>
            <div class="card-group">
                <label for="cardtype">Card Type</label>
                <select name='cardType' id='cardType'>
                    <option value='Electronic'>Electronic</option>
                    <option value='Physical'>Physical</option>
                </select>
            </div>
            <div class="card-group">
                <label for="cardvalue">Card Value</label>
                <input type='text' name='cardValue' value=''>
            </div>
            <div class="card-group">
                <label for="points">Points</label>
                <input type='text' name='points' value=''>
            </div>
            <div class="card-group">
                <input type='hidden' name='add' value='yes'>
                <input type='submit' value='ADD RECORD'>
            </div>
        </form>
    </div>
</body>

</html>
