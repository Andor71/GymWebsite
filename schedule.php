 <?php 
    session_start();
    include("connection.php");

    if(!isset($_SESSION['user_id']))
    {

        // redirect to login
        header("Location: login.php");
        die;
    }


    if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$rating = $_POST['rating'];
		$date = $_POST['date'];
        $type = $_POST['type'];
        $id = $_SESSION['user_id'];

        $query = "insert into workouts (user_id,type,rating,date) values ('$id','$type',$rating,'$date')";
        mysqli_query($con, $query);
        header("Location: schedule.php");
    }


    if($_SERVER['REQUEST_METHOD'] == "GET"){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $query= "delete from workouts where id='$id'";
            mysqli_query($con, $query);
            header("Location: schedule.php");
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule</title>
    <link rel="stylesheet" href="./css/schedule.css">
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
        <table>
            <caption><h1>Your Workouts</h1></caption>
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Rating</th>
                <th>Delete</th>
            </tr>
            <tr>
                <?php

                    $id = $_SESSION['user_id'];
                    $query = "select * from workouts where user_id = '$id'";

                    $result = mysqli_query($con,$query);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                          echo "<tr><td>".$row["date"]."</td><td>".$row["type"]."</td><td>".$row["rating"]."</td><td> <a href=".$_SERVER['PHP_SELF']."?id=".$row["id"].",submit=delete>Delete</a></td></tr>";
                        }
                      }
                ?>
    
        </table>

        <form class="addWorkout" method="post">
            <div>
                <h1>Add Workout</h1>
            <hr>
            </div>
            <div>
                <select name="type" id="types" aria-placeholder="Type" require>
                    <option value="Push">Push</option>
                    <option value="Pull">Pull</option>
                    <option value="Leg">Leg</option>
                    <option value="Rest">Rest</option>
                </select>
            </div>
            <div>   
                <input type="number" name="rating" max="10" min="1" placeholder="Rating" require>
            </div>
            <div>   
                <input type="date" name="date" require>
            </div>
            <div>
                <input id="SendBtn" type="submit" name="submit" value="insert">
            </div>
        </form>

    </div>
</body>
</html>