<?php
session_start();
include("connection.php");


if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if(empty($user_name) && empty($password) && is_numeric($user_name))
    {
        echo "Please enter some valid information!";
    }

    $query = "select id from users order by id DESC limit 1";

    $result = mysqli_query($con, $query);

    if ($row=mysqli_num_rows($result) > 0) {
        $user_id = $row["user_id"] + 1;
        } else {
        $user_id = 1;
        }

    $query = "insert into users (user_id,user_name,password) values ('$user_id','$user_name','$password')";

    mysqli_query($con, $query);

    header("Location: login.php");
    die;

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sing Up</title>
    <link rel="stylesheet" href="./css/singup.css">
</head>
<body>
<form method="post">
    <div>
        <h1>Sing Up</h1>
   <hr>
    </div>
        <input type="text" name="user_name" require placeholder="Username" maxlength="10">
    </div>
    <div>
        <input type="password" name="password" require placeholder="Password" maxlength="10">
    </div>
    <div>
        <input type="submit" name="submit" value="SignUp">
    </div>
    </form>
</body>
</html>