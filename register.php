<?php
    session_start();
    $dbhost="localhost:3306";
    $uname="root";
    $password="";
    $dbname="myDB";
    $conn=mysqli_connect($dbhost,$uname,$password,$dbname) or die($conn);
    if(isset($_POST['register_btn'])){
        //session_start();
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);
        $password2 = mysqli_real_escape_string($conn,$_POST['password2']);

        if($password == $password2)
        {
            //create user
            $password=md5($password);//encrypt password before storing it
            $sql="INSERT INTO USERS(username, email, password) VALUES('$username','$email','$password')";
            mysqli_query($conn,$sql);
            $_SESSION['message'] = "You Are Now Logged In!";
            $_SESSION['username'] = $username;
            header("location:home.php"); //redirect to home page

        }
        else{
            //failed
            $_SESSION['message'] = "Two Password Do Not Match!";

        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration</title>
    <style>
        *{
            margin:0;
        }
        .header{
            font-family:"monotype corsiva";
            background-color: grey;
            text-align: center;
            margin-top: 15px;
            padding:30px;
            
        }
        body{
            background-color: lightgrey;
        }
        .frm{
            margin-top: 50px;
        }
        .btn{
            cursor:pointer;
            box-shadow: 5px 5px 15px rgba(0,0,0,0.5);
            padding: 10px 15px;
        }
        #error_msg{
            width:50%;
            margin:5px auto;
            height:30px;
            border: 1px solid #FF0000;
            background-color: #FFB9B8;
            text-align: center;
            padding-top:10px;
        }
        
        
    </style>
</head>
<body>
    <center>
    <div class="header">
        <h1> User Registration</h1>
    </div>
    <?php
    if(isset($_SESSION['message'])){
        echo "<div id='error_msg'>".$_SESSION['message']."</div>";
        unset($_SESSION['message']);
    }

    ?>
    
    
    <form method="post" action="register.php" class="frm">
        <table>
            <tr>
            <td>Username:</td>
            <td><input type="text" name="username" class="text"></td>
            </tr>
            <tr>
            <td>Email:</td>
            <td><input type="email" name="email" class="text"></td>
            </tr>
            <tr>
            <td>Password:</td>
            <td><input type="password" name="password" class="text"></td>
            </tr>
            <tr>
            <td>Confirm Password:</td>
            <td><input type="password" name="password2" class="text"></td>
            </tr>
            <tr>
            <td><input type="submit" name="register_btn" value="Register" class="btn"></td>
            </tr>
        </table>
    </form>
    <center>
</body>
</html>