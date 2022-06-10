<?php 

session_start();

	include("connection.php");


    $Error = "";

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

        $_Error = array();
        //Name
        if(!isset($_POST['name'])){
            $_POST['name'] = "";
        }else    if (!preg_match("/[a-z]/",$_POST['name'])) {
            array_push($_Error,"Only letters and white space allowed in name");
        }
 

		if(empty($user_name) && empty($password))
		{
            ErrorMsg("Fill the inputs");
        }

        $query = "select * from users where user_name = '$user_name' limit 1";
        $result = mysqli_query($con, $query);

        if($result)
        {
            if($result && mysqli_num_rows($result) > 0)
            {

                $user_data = mysqli_fetch_assoc($result);
                
                if($user_data['password'] === $password)
                {

                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: home.php");
                    die;
                }
            }
            else
            {
                $Error=  ErrorMsg("Wrong username or password");
            }
        }
        else
        {
            $Error =ErrorMsg("Wrong username or password");
        }
	}

    function ErrorMsg($msg){
        echo " <div class=error>
                <p>'$msg'
                </p>
            </div>";
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <title>Login</title>
</head>
<body>
    <form action="<?=$_SERVER['PHP_SELF'] ?>" method="post">
    <div>
        <h1>Login</h1>
   <hr>
    </div>
        <input type="text" name="user_name" require placeholder="Username" maxlength="10">
    </div>
    <div>
        <input type="password" name="password" require placeholder="Password" maxlength="10">
    </div>
    <div>
        <?php 
            echo $Error;
        ?>
 
    </div>
    <div>
        <input id="SendBtn" type="submit" name="submit">
        <a id="RegisterBtn" href="./singup.php">Register</a>
    </div>
    </form>
</body>
</html>