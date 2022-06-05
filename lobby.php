<?php
    session_start();

    include("connection.php");
    if(!isset($_SESSION['user_id']))
	{

        //redirect to login
        header("Location: login.php");
        die;
	}

    $id = $_SESSION['user_id'];
    $query = "select * from users where user_id = '$id' limit 1";

    $result = mysqli_query($con,$query);
    if($result && mysqli_num_rows($result) > 0)
    {
        $user_data = mysqli_fetch_assoc($result);
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>LIVE SESSION <?php echo $user_data['user_name'] ?> </h1>
</body>
</html>