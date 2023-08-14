<?php
include_once("config.php");

$username_regex = "/^[a-zA-z]*$/";
$email_validation_regex = "/^\\S+@\\S+\\.\\S+$/";
$password_regex = "/^(?=.*?[a-z])(?=.*?[0-9]).{8,}$/";

$usernameErr = $emailErr = $passwordErr = $emailAlready = "";

if (isset($_POST["signup"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $success = true;

    if ($username === "" || !preg_match($username_regex, $username)) {
        $usernameErr = "Please enter a valid username";
        $success = false;
    }
    if ($email === "" || !preg_match($email_validation_regex, $email)) {
        $emailErr = "Please enter a valid email";
        $success = false;
    }
    $validate_query = "SELECT * from `users` WHERE `email`='$email'";
    $validate_email = mysqli_query($conn, $validate_query);
    if (mysqli_num_rows($validate_email) > 0) {
        $emailAlready = "Email already exists";
        $success = false;
    }
    if ($password === "" || !preg_match($password_regex, $password)) {
        $passwordErr = "Please enter a strong password";
        $success = false;
    }
    if ($success) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO `users`(`username`, `email`, `password`) VALUES ('$username','$email','$hashedPassword')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            header("Location: login.php");
        } else {
            $mainError = "Something went wrong try later";
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
    <title>Signup</title>
</head>

<body>
    <div class="container">
        <div class="d-flex flex-column justify-content-center align-items-center vh-100">
            <h3 class="text-center">Signup Please</h3>
            <form method="post" id="form">
                <div class="m-2">
                    <input type="text" name="username" id="username" class="form-control" placeholder="username">
                    <span class="text-danger"><?= $usernameErr ?></span>
                </div>
                <div class="m-2">
                    <input type="text" name="email" id="email" class="form-control" placeholder="email">
                    <span class="text-danger"><?= $emailErr ?></span>
                    <span class="text-danger"><?= $emailAlready ?></span>
                </div>
                <div class="m-2">
                    <input type="password" name="password" id="password" class="form-control" placeholder="password">
                    <span class="text-danger"><?= $passwordErr ?></span>
                </div>
                <div class="m-2">
                    <button type="submit" name="signup" id="signup" class="btn btn-light w-100">Signup</button>
                </div>
            </form>

        </div>
    </div>
</body>

</html>