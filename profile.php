<?php 
    session_start();
    include("connection.php");

    global $_name;
    $_name = "None";
    global $_gender;
    $_gender = "Unknown";
    global $_weight;
    $_weight = "Unknown";
    global $_height;
    $_height = "Unknown";
    global $_age;
    $_age = "Unknown";
    global $_image;
    $_image = "./imgs/profile.png";
    $_f_exc ="None";
    
    UpdatePorfile($con);
    
    if(!isset($_SESSION['user_id']))
    {
        // redirect to login
        header("Location: login.php");
        die;
    }




    if($_SERVER['REQUEST_METHOD'] == "POST")
	{
        $user_id =$_SESSION['user_id']; 
		$name = $_POST['name'];
		$gender = $_POST['gender'];
        $weight = $_POST['weight'];
        $height = $_POST['height'];
        $age = $_POST['age'];
        $file = $_FILES['img'];
        $upload_dir = "./upload/";
        $upload_fname = $upload_dir . $file['name'];

        if (!move_uploaded_file($file['tmp_name'], $upload_fname)) {
            die("A fájlt nem lehet az $upload_dir könyvtárba másolni!");
        }
        if(CheckIfHasProfile($con)){
            $query = "update profile set 
            name = '$name', gender ='$gender',weight = '$weight', height = '$height', age = '$age' , img ='$upload_fname' where user_id = '$user_id'";
        }else{
            $query = "insert into profile (user_id,name,gender,weight,height,age,img) values 
            ('$user_id','$name','$gender','$weight','$height','$age','$upload_fname')";
        }

        mysqli_query($con, $query);
        header("Location: profile.php");
    }

    if($_SERVER['REQUEST_METHOD'] == "GET")
	{
        if(isset($_GET["response"])){
            $f_exc = $_GET["response"]; 
            $id = $_SESSION['user_id'];
            $query = "update profile set f_exc = '$f_exc' where user_id = '$id'";
            mysqli_query($con, $query);
            header("Location: profile.php");
        }

    }
    function CheckIfHasProfile($con){
        $id = $_SESSION['user_id'];
        $query = "select * from profile where user_id = '$id' limit 1";
        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result) > 0){
            return true;
        }
        else{
            return false;
        }
    }


    function UpdatePorfile($con){
        $id = $_SESSION['user_id'];
        $query = "select * from profile where user_id = '$id' limit 1";
        $result = mysqli_query($con, $query);
      
    if ($row=mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            global $_name, $_gender, $_weight,$_height,$_age ,$_image, $_f_exc ;
            $_name =  $row["name"];
            $_gender = $row["gender"];
            $_weight = $row["weight"];
            $_height = $row["height"];
            $_age = $row["age"];
            $_image = $row["img"];
            $_f_exc = $row["f_exc"];
        } 
    }
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
            <img class="pimg" src=<?php echo $_image  ?> alt="">

            <div class="text">
                <h1><?php echo $_name ?> </h1>
            </div>
        </div>
        <form class="form hide" action="./profile.php" method="post" enctype="multipart/form-data">
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
                <input id="SendBtn" type="submit" name="submit" value="update" onclick="HideFormOpenData()">
            </div>
        </form>
        <div class="data">
            <h1>Infomartions</h1>
            <h4>Gender: <?php echo $_gender ?></h4>
            <h4>Height: <?php echo $_height ?></h4>
            <h4>Weight: <?php echo $_weight ?></h4>
            <button onclick="HideInfomationsOpenForm()">Update</button>
            <h4>Favorite Exercise = <?php echo $_f_exc ?></h4>
            <button onclick="HideInfomationsOpenExc()">Update </button>
        </div>
        <form class="form excupdate hide" action="./profile.php" method="post">
            <input type="text" id="fname" name="fname" placeholder="Favorite Excercise" onkeyup="showHint(this.value)" >
            <p><span id="txtHint"></span></p>
            <hr>
        <div>
            <input id="SendBtn" type="submit" name="submit" value="updateExc" onclick="HideExcOpenData()">
        </div>
            
        </form>
    </div>
    <script src="./js/index.js"></script>
</body>
</html>