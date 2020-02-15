<?php
    session_start();
?>
<html>
<head>
    <title>Registration</title>
    <style>
        .h{
            margin-top: 20px;
            font-family:cursive;
            background-color: lightcoral;
            text-align: center;
        }
        h1{
            font-family:cursive;
            background-color:lightblue;
        }
        .mes{
            font-family: cursive;
            background-color: grey;
            font-size: 15px;
            padding:25px 10px;
            text-align: center;
        }
        .but{
            margin-bottom: 15px;
            border-radius: 50px;
            cursor: pointer;
            box-shadow: 5px 5px 15px rgba(0,0,0,0.5);
        }
    </style>
    
</head>
<body>
    <div class="header">
        <h1 class="h"> User Registration & Login</h1>
    </div>
    <?php
    if(isset($_SESSION['message'])){
        echo "<div id='error_msg'>".$_SESSION['message']."</div>";
        unset($_SESSION['message']);
    }

    ?>
    <h1>HOME</h1>
    <div class="mes">
        <h4>Welcome <?php echo $_SESSION['username']?></h4>
    </div>
    <div class="but">
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>