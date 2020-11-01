<?php
session_start();
global $connect;
$connect = mysqli_connect('localhost','root','Achyuta123','hotel');
if(isset($_POST['submit2'])) {
    $empid = $_POST['adm-id'];
    $password = $_POST['password-adm'];
    $var2=1;
    $query2 = "SELECT emp_id , password , is_admin FROM employees WHERE emp_id='{$empid}' && password='{$password}' && is_admin = '{$var2}' ";
    $result2 = mysqli_query($connect, $query2);
    if (!$result2) {
        die("QUERY FAILED" . mysqli_error($connect));
    }
    $row = mysqli_fetch_array($result2);
    $db_empid=$row['emp_id'];
    $db_pass=$row['password'];
    if (mysqli_num_rows($result2) > 0 && $empid==$db_empid && $password==$db_pass) {
        $_SESSION['inco'] = true;
        $_SESSION['user'] = $row['emp_id'];
        $_SESSION['pass'] = $row['password'];
        $_SESSION['num']=100;

        header("Location:/startbootstrap-sb-admin-2-gh-pages/index.php");
    } else {
        header("Location:/startbootstrap-sb-admin-2-gh-pages/login.php?error=1");
    }
}

if(isset($_POST['submit1'])) {
    $empid = $_POST['emp-id'];
    $password = $_POST['password-emp'];
    $var1=0;
    $query1 = "SELECT emp_id , password , is_admin FROM employees WHERE emp_id='{$empid}' && password='{$password}' && is_admin = '{$var1}' ";
    $result1= mysqli_query($connect, $query1);
    if (!$result1) {
        die("QUERY FAILED" . mysqli_error($connect));
    }
    $row = mysqli_fetch_array($result1);
    $db_empid=$row['emp_id'];
    $db_pass=$row['password'];
    if (mysqli_num_rows($result1) > 0 && $empid==$db_empid && $password==$db_pass) {
        $_SESSION['inco'] = true;
        $_SESSION['user'] = $row['emp_id'];
        $_SESSION['pass'] = $row['password'];
        header("Location:/startbootstrap-sb-admin-2-gh-pages/Employee.php");
    } else {
        header("Location:/startbootstrap-sb-admin-2-gh-pages/login.php?error=1");
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">
    <link rel="stylesheet" href="tut1.css">
</head>
<body>
<div class="hero">
    <div class="form-box">

        <div class="button-box">

            <div id="btn"></div>
            <button type="button" class="toggle-btn" onclick="login()">Employee</button>
            <button type="button" class="toggle-btn" onclick="register()">Admin</button>
        </div>
        <div class="social-icons">
            <img src="fb.png">
            <img src="tw.png">
            <img src="gp.png">
            <?php if(isset($_GET['error'])){ ?>
                <font size="2.5px" color='#8b0000'><p align='center' class="err" >Incorrect ID or Password.</p> </font>
            <?php }?>
        </div>

        <form id="login" class="input-group" action="login.php" method="post">

            <input type="text" class="input-field" placeholder="Employee Id" name="emp-id" required maxlength="10">
            <input type="password" class="input-field" placeholder="Password" name="password-emp" required maxlength="15">
            <button type="submit" name="submit1" class ="submit-btn">Login</button>

        </form>

        <form  id="register" class="input-group" action="login.php" method="post">
            <input type="text" class="input-field" placeholder="Admin Id" name="adm-id" required>
            <input type="password" class="input-field" placeholder="Password"  name="password-adm" required maxlength="15">
            <button type="submit" name="submit2" class ="submit-btn">Login</button>
        </form>

    </div>
</div>

<script>
    var x = document.getElementById("login");
    var y = document.getElementById("register");
    var z = document.getElementById("btn");

    function register(){
        x.style.left = "-400px";
        y.style.left = "50px";
        z.style.left = "110px";
    }
    function login(){
        x.style.left = "50px";
        y.style.left = "450px";
        z.style.left = "0px";
    }

</script>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>
