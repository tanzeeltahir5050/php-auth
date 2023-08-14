<?php
include_once("config.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <title>Admin</title>
</head>

<body>
    <div class="container">
        <div class="d-flex flex-column justify-content-center align-items-center vh-100">
            <h2 class="text-center">Admin Dashboard</h2>
            <div class="conatiner">
                <h4>Hello <?= $_SESSION["username"] ?></h4>
                <p>Your email is <?= $_SESSION["email"] ?></p>
                <a href="logout.php" type="submit" name="signup" id="signup" class="btn btn-light w-100">Logout</a>
            </div>
        </div>
    </div>
</body>

</html>