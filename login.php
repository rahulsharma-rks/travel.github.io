<?php
    session_start();
    $dbhost="localhost:3306";
    $uname="root";
    $password="";
    $dbname="myDB";
    $conn=mysqli_connect($dbhost,$uname,$password,$dbname) or die($conn);
    if(isset($_POST['login_btn'])){
        //session_start();
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);
        $password = md5($password);
        $sql="SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result= mysqli_query($conn,$sql);

        if(mysqli_num_rows($result) == 1){
            $_SESSION['message'] ="You Are Now Logged In!";
            $_SESSION['username'] = $username;
            header("location:home.php"); //redirect to home page
        }
        else{
            $_SESSION['message'] ="Username/Password Combination Is Incorrect!"; 
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
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
            background-color: #05ffb0;
            box-shadow: 5px 5px 15px rgba(0,0,0,0.5);
            padding: 10px;
            font-family: sans-serif;
            font-size: 20px;
            font-weight: bolder;
            border-radius: 5px;
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
        .capbox {
            margin-left: 20px;
            background-color: #92D433;
            border: #B3E272 0px solid;
            border-width: 0px 12px 0px 0px;
            display: inline-block;
            *display: inline; zoom: 1; /* FOR IE7-8 */
            padding: 8px 40px 8px 8px;
        }

        .capbox-inner {
            font: bold 11px arial, sans-serif;
            color: #000000;
            background-color: #DBF3BA;
            margin: 5px auto 0px auto;
            padding: 3px;
            -moz-border-radius: 4px;
            -webkit-border-radius: 4px;
            border-radius: 4px;
        }

        #CaptchaDiv {
            font: bold 17px verdana, arial, sans-serif;
            font-style: italic;
            color: #000000;
            background-color: #FFFFFF;
            padding: 4px;
            -moz-border-radius: 4px;
            -webkit-border-radius: 4px;
            border-radius: 4px;
        }

        #CaptchaInput {
        margin: 1px 0px 1px 0px; width: 135px; }

        
    </style>
</head>
<body>
    <center>
    <div class="header">
        <h1> User Login</h1>
    </div>

    <?php
    if(isset($_SESSION['message'])){
        echo "<div id='error_msg'>".$_SESSION['message']."</div>";
        unset($_SESSION['message']);
    }

    ?>
    

    <form method="post" action="login.php" class="frm"  onsubmit="return checkform(this);">
            <label for="username">Username:</label>
            <input type="text" name="username" class="text"><br/><br/>
            <label for="password">Password:</label>
            <input type="password" name="password" class="text"><br/><br/>
            <!-- START CAPTCHA -->
            <br>
            <div class="capbox">
            <div id="CaptchaDiv"></div>

            <div class="capbox-inner">
                Type the above number:<br>

                <input type="hidden" id="txtCaptcha">
                <input type="text" name="CaptchaInput" id="CaptchaInput" size="15"><br>
            </div>
        </div>
    <br><br>
    <!-- END CAPTCHA -->
            <input type="submit" name="login_btn" value="Login" class="btn">
    </form>
    </center>
</body>
</html>

<script>

function checkform(theform){
var why = "";

if(theform.CaptchaInput.value == ""){
why += "- Please Enter CAPTCHA Code.\n";
}
if(theform.CaptchaInput.value != ""){
if(ValidCaptcha(theform.CaptchaInput.value) == false){
why += "- The CAPTCHA Code Does Not Match.\n";
}
}
if(why != ""){
alert(why);
return false;
}
}

var a = Math.ceil(Math.random() * 9)+ '';
var b = Math.ceil(Math.random() * 9)+ '';
var c = Math.ceil(Math.random() * 9)+ '';
var d = Math.ceil(Math.random() * 9)+ '';
var e = Math.ceil(Math.random() * 9)+ '';

var code = a + b + c + d + e;
document.getElementById("txtCaptcha").value = code;
document.getElementById("CaptchaDiv").innerHTML = code;

// Validate input against the generated number
function ValidCaptcha(){
var str1 = removeSpaces(document.getElementById('txtCaptcha').value);
var str2 = removeSpaces(document.getElementById('CaptchaInput').value);
if (str1 == str2){
return true;
}else{
return false;
}
}

// Remove the spaces from the entered and generated code
function removeSpaces(string){
return string.split(' ').join('');
}
</script>