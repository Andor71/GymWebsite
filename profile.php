<?php 
    session_start();
    include("connection.php");

    if(!isset($_SESSION['user_id']))
    {
        // redirect to login
        header("Location: login.php");
        die;
    }

    echo "ee";
    if($_SERVER['REQUEST_METHOD'] == "POST")
	{
        $user_id =$_SESSION['user_id']; 
		$name = $_POST['name'];
		$gender = $_POST['gender'];
        $weight = $_POST['weight'];
        $height = $_POST['height'];
        $age = $_POST['age'];
        $file = $_FILES['img'];

        $query = "insert into profile (user_id,name,gender,weight,height,age,img) values 
                                    ('$user_id','$name',$gender,'$weight','$height',$age,'$file')";
        mysqli_query($con, $query);
        header("Location: profile.php");
    }


    // if($_SERVER['REQUEST_METHOD'] == "GET"){
    //     if(isset($_GET['id'])){
    //         $id = $_GET['id'];
    //         $query= "delete from workouts where id='$id'";
    //         mysqli_query($con, $query);
    //         header("Location: schedule.php");
    //     }
    // }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="./css/profile.css">
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
        <div class="profile">
            <img class="pimg" src="./imgs/profile.png" alt="">
            <div class="text">
                <h1>Name</h1>
            </div>
        </div>
        <form class="form" action="./profile.php" method="post" enctype="multipart/form-data">
            <h1>Update Your Profile</h1>
            <div>
                <input type="text" name="name" placeholder="Name" require>
            </div>
            <div>
                <div>
                    <select name="gender" id="types" aria-placeholder="Gender" require>
                        <option value="man">man</option>
                        <option value="woman">woman</option>
                    </select>
                </div>
            </div>
            <div>
                <input type="number" name="weight" placeholder="weight" require>
            </div>
            <div>
                <input type="number" name="height" placeholder="height" require>
            </div>
            <div>
                <input type="number" name="age" placeholder="age" require>
            </div>
            <div>
                <input type="file" name="img" placeholder="Profie Picture" require>
            </div>
            <div>
                <input id="SendBtn" type="submit" name="submit" value="update" onclick="ChangeLayoutOnForm()">
            </div>
        </form>
        <div class="data hide">
            <h1>Infomartions</h1>
            <h4>Gender: None</h4>
            <h4>Height: None</h4>
            <h4>Weight: None</h4>
            <h4>Best Excerise: None</h4>
            <button onclick="ChangeLayoutOnInformation()">Update</button>
        </div>
    </div>
    <script src="./js/index.js"></script>
</body>
</html>