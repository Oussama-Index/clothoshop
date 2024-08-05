<?php
session_start();
if(isset($_SESSION['user'])) header("location: home.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (!empty($_POST['email']) && !empty($_POST['password'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        if ( ($email === "oussama.irhil@usmba.ac.ma" && $password === "helloworld") ||
            ( $email === "faid@admin.com" && $password === "anafaid" )
        ){

            $_SESSION['user'] = 'admin';
            header("location:home.php");
            exit;
        }
        else {
            echo "wrong email or password";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div ms-4>
        <form class="form-inline" method="post">
            <div class="form-group">
                <label for="input2">Email</label>
                <input type="email" id="input2" name="email" class="form-control mx-sm-3" aria-describedby="passwordHelpInline">
            </div>
            <div class="form-group">
                <label for="input1">Password</label>
                <input type="password" id="input1" name="password" class="form-control mx-sm-3" aria-describedby="passwordHelpInline">
                <small id="passwordHelpInline" class="text-muted">
                Must be 8-20 characters long.
                </small>
            </div>
            <input type="submit" class="btn btn-primary" value="Submit" />
        </form>
    </div>
</body>
</html>