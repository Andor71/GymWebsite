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
    <title>Home</title>
    <link rel="stylesheet" href="./css/lobby.css">
</head>
<body>
    <nav>
        <h1>Astetico</h1>
        <ul>
            <li>
               <a href="./home.php">Home</a>
            </li>
            <li>
            <a href="./profile.php">Profile</a></li>
            </li>
            <li>
                <a href="./logout.php">Log Out</a></li>
            </li>
        </ul>
    </nav>

    <div class="container">
        <h1>Welcome Back <?php echo $user_data['user_name'] ?></h1>
        <hr>
        
        <div class="navBtn">
            <a href="./schedule.php"> Add a WorkOut to Your Schedule</a>
            <a href="./diet.php">Check your Calories</a>
            <a href="./workputplan">Check your workout plan</a>
        </div>
    </div>
</body>
</html>