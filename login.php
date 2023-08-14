<?php
include_once("config.php");

$emptyErr = $errorOne = $errorTwo = "";

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $success = true;
    if ($username === "" || $password === "") {
        $emptyErr = "Please enter your email and password";
        $success = false;
    }
    if ($success) {
        $query = "SELECT * FROM `users` WHERE `username` = '$username'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if (password_verify($password, $row["password"])) {
                    $_SESSION["username"] = $row["username"];
                    $_SESSION["email"] = $row["email"];
                    $_SESSION["role"] = $row["role"];
                    if ($row["role"] === "admin") {
                        header("Location: admin.php");
                    } else {
                        header("Location: user.php");
                    }
                } else {
                    $errorOne = "Invalid Credentials";
                }
            }
        } else {
            $errorTwo = "Invalid Credentials";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="d-flex flex-column justify-content-center align-items-center vh-100">
            <h3 class="text-center">Login Please</h3>
            <form method="post">
                <div class="m-2">
                    <input type="text" name="username" id="username" class="form-control" placeholder="username">
                </div>
                <div class="m-2">
                    <input type="password" name="password" id="password" class="form-control" placeholder="password">
                </div>
                <span class="text-danger"><?= $emptyErr ?></span>
                <div class="m-2">
                    <button type="submit" name="login" id="login" class="btn btn-light w-100">Login</button>
                </div>
            </form>
            <span class="text-danger"><?= $errorOne ?></span>
            <span class="text-danger"><?= $errorTwo ?></span>
        </div>
    </div>
</body>

</html>