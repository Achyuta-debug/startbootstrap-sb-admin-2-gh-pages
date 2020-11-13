<?php
include "function.php";
require ('fpdf/fpdf.php');
session_start();
$nam=name();
$empid=$_SESSION['user'];
$custid=generatecid();

if (isset($_POST['submit-emp'])){
    $connect = mysqli_connect('localhost','root','Achyuta123','hotel');
    $firstname= stripslashes($_POST['firstname']);
    $lastname=stripslashes($_POST['lastname']);
    $address=stripslashes($_POST['address']);
    $city=stripslashes($_POST['city']);
    $sex=stripslashes($_POST['sex']);
    $aadhaar=stripslashes($_POST['aadhaar']);
    $age=stripslashes($_POST['age']);
    $phoneno=stripslashes($_POST['phoneno']);
    $roomno=stripslashes($_POST['roomno']);
    $roomtype=stripslashes($_POST['roomtype']);
    $noofad=stripslashes($_POST['noofad']);
    $noofch=stripslashes($_POST['noofch']);
    $from=stripslashes($_POST['from']);
    $todate=stripslashes($_POST['todate']);
    $payment=stripslashes($_POST['payment']);
    $email = stripslashes($_POST['email']);
    $query= "INSERT INTO customers(customer_id,fname,lname,address,city,sex,id_proof,age,phone_no,room_no,room_type,
                     no_of_childrens,no_of_adults,from_date,to_date,payment_method,email,emp_id)
              VALUES('$custid','$firstname','$lastname','$address','$city','$sex',
                    '$aadhaar', $age,'$phoneno','$roomno','$roomtype',$noofch,$noofad,
                    '$from','$todate','$payment','$email','$empid')";
    $res=mysqli_query($connect,$query);
    if(!$res){
        die("query failed". mysqli_error($connect));
    }
    $query2= "INSERT INTO customers_logs(customer_id,fname,lname,address,city,sex,id_proof,age,phone_no,room_no,room_type,
                         no_of_childrens,no_of_adults,from_date,to_date,payment_method,email,emp_id)
                  VALUES('$custid','$firstname','$lastname','$address','$city','$sex',
                        '$aadhaar',$age,'$phoneno','$roomno','$roomtype','$noofad',
                        '$noofch','$from','$todate','$payment','$email','$empid')";
    $res2=mysqli_query($connect,$query2);
        if(!$res2){
            die("query failed". mysqli_error($connect));
        }
}

if (isset($_POST['update-emp'])) {
    $connect = mysqli_connect('localhost','root','Achyuta123','hotel');
    $firstname = stripslashes($_POST['firstname']);
    $lastname = stripslashes($_POST['lastname']);
    $address = stripslashes($_POST['address']);
    $city = stripslashes($_POST['city']);
    $sex = stripslashes($_POST['sex']);
    $aadhaar = stripslashes($_POST['aadhaar']);
    $age = stripslashes($_POST['age']);
    $phoneno = stripslashes($_POST['phoneno']);
    $roomno = stripslashes($_POST['roomno']);
    $custoid = custid($roomno);
    $roomtype = stripslashes($_POST['roomtype']);
    $noofad = stripslashes($_POST['noofad']);
    $noofch = stripslashes($_POST['noofch']);
    $from = stripslashes($_POST['from']);
    $todate = stripslashes($_POST['todate']);
    $payment = stripslashes($_POST['payment']);
    $email = stripslashes($_POST['email']);
    $query1 = "UPDATE customers SET fname = '$firstname',
            lname = '$lastname',address = '$address',city = '$city',sex = '$sex',id_proof = '$aadhaar',
            age = $age,phone_no = $phoneno,room_no = $roomno,room_type = '$roomtype',
            no_of_childrens = $noofch,no_of_adults = $noofad,from_date = '$from',
            to_date = '$todate',payment_method = '$payment',email = '$email',emp_id = '$empid'
            WHERE customer_id = '$custoid'";
    $query2 = "UPDATE customers_logs SET fname = '$firstname',
               lname = '$lastname',address = '$address',city = '$city',sex = '$sex',id_proof = '$aadhaar',
               age = $age,phone_no = $phoneno,room_no = $roomno,room_type = '$roomtype',
               no_of_childrens = $noofch,no_of_adults = $noofad,from_date = '$from',
               to_date = '$todate',payment_method = '$payment',email = '$email',emp_id = '$empid'
               WHERE customer_id = '$custoid'";

    $res1 = mysqli_query($connect, $query1);
    $res2 = mysqli_query($connect, $query2);
    if (!$res1||!$res2) {
        die("query failed" . mysqli_error($connect));
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Delights-Dashbord</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="Admin-reg.php">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Delights</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="Employee.php">
                <i class="fas fa-fw fa-hotel"></i>
                <span>View rooms</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Nav Item - Pages Collapse Menu -->

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-user-friends"></i>
                <span>Customer</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <!--            <h6 class="collapse-header">Custom Utilities:</h6>-->
                    <a class="collapse-item" href="Add-serv.php">Add/Delete Services</a>
                    <a class="collapse-item" href="update-cus.php">Update information</a>

                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>


                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">


                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $nam; ?></span>
                            <!--                            <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">-->
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile settings
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">

                    <h1 class="h3 mb-0 text-primary">Check rooms</h1>
                    <!--                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
                </div>

                <!-- Content Row -->
                <div class="row">

                    <!-- Earnings (Monthly) Card Example -->
                   <?php if(!roomcheck(101)) { ?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-inf.php" method="post">

                                            <input type="submit" name="101" value="101" class="btn btn-danger">
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Standard</div>
                                        <p class="text-danger">Booked  until
                                              <?php  $date101=returndate(101);
                                                echo $date101;
                                                     ?></p>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                    else {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-reg.php" method="post">
                                           <input type="submit" name="101" value="101" class="btn btn-primary">
<!--                                            <a href="index.php"><h2>101</h2></a>-->
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Standard</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if (!roomcheck(102))
                    {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-inf.php" method="post">
                                            <input type="submit" name="102" value="102" class="btn btn-danger">
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Standard</div>
                                        <p class="text-danger">Booked  until
                                            <?php  $date102=returndate(102);
                                            echo $date102;
                                            ?></p>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                    else {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-reg.php" method="post">
                                            <input type="submit" name="102" value="102" class="btn btn-primary">
                                            <!--                                            <a href="index.php"><h2>101</h2></a>-->
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Standard</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
           <?php } ?>

           <?php if (!roomcheck(103))
                    {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-inf.php" method="post">
                                            <input type="submit" name="103" value="103" class="btn btn-danger">
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Standard</div>
                                        <p class="text-danger">Booked  until
                                            <?php  $date103=returndate(103);
                                            echo $date103;
                                            ?></p>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                    else {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-reg.php" method="post">
                                            <input type="submit" name="103" value="103" class="btn btn-primary">
                                            <!--                                            <a href="index.php"><h2>101</h2></a>-->
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Standard</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
           <?php } ?>

           <?php if (!roomcheck(104))
                    {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-inf.php" method="post">
                                            <input type="submit" name="104" value="104" class="btn btn-danger">
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Standard</div>
                                        <p class="text-danger">Booked  until
                                            <?php  $date104=returndate(104);
                                            echo $date104;
                                            ?></p>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                    else {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-reg.php" method="post">
                                            <input type="submit" name="104" value="104" class="btn btn-primary">
                                            <!--                                            <a href="index.php"><h2>101</h2></a>-->
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Standard</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
           <?php } ?>

           <?php if (!roomcheck(105))
                    {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-inf.php" method="post">
                                            <input type="submit" name="105" value="105" class="btn btn-danger">
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Standard</div>
                                        <p class="text-danger">Booked  until
                                            <?php  $date105=returndate(105);
                                            echo $date105;
                                            ?></p>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                    else {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-reg.php" method="post">
                                            <input type="submit" name="105" value="105" class="btn btn-primary">
                                            <!--                                            <a href="index.php"><h2>101</h2></a>-->
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Standard</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
           <?php } ?>

           <?php if (!roomcheck(106))
                    {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-inf.php" method="post">
                                            <input type="submit" name="106" value="106" class="btn btn-danger">
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Standard</div>
                                        <p class="text-danger">Booked  until
                                            <?php  $date106=returndate(106);
                                            echo $date106;
                                            ?></p>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                    else {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-reg.php" method="post">
                                            <input type="submit" name="106" value="106" class="btn btn-primary">
                                            <!--                                            <a href="index.php"><h2>101</h2></a>-->
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Standard</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
           <?php } ?>

           <?php if (!roomcheck(107))
                    {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-inf.php" method="post">
                                            <input type="submit" name="107" value="107" class="btn btn-danger">
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Standard</div>
                                        <p class="text-danger">Booked  until
                                            <?php  $date107=returndate(107);
                                            echo $date107;
                                            ?></p>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                    else {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-reg.php" method="post">
                                            <input type="submit" name="107" value="107" class="btn btn-primary">
                                            <!--                                            <a href="index.php"><h2>101</h2></a>-->
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Standard</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
           <?php } ?>

           <?php if (!roomcheck(108))
                    {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-inf.php" method="post">
                                            <input type="submit" name="108" value="108" class="btn btn-danger">
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Standard</div>
                                        <p class="text-danger">Booked  until
                                            <?php  $date108=returndate(108);
                                            echo $date108;
                                            ?></p>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                    else {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-reg.php" method="post">
                                            <input type="submit" name="108" value="108" class="btn btn-primary">
                                            <!--                                            <a href="index.php"><h2>101</h2></a>-->
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Standard</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
           <?php } ?>

            <?php if (!roomcheck(201))
                    {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-inf.php" method="post">
                                            <input type="submit" name="201" value="201" class="btn btn-danger">
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Deluxe</div>
                                        <p class="text-danger">Booked  until
                                            <?php  $date201=returndate(201);
                                            echo $date201;
                                            ?></p>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                    else {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-reg.php" method="post">
                                            <input type="submit" name="201" value="201" class="btn btn-primary">
                                            <!--                                            <a href="index.php"><h2>101</h2></a>-->
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Deluxe</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
           <?php } ?>
             <?php if (!roomcheck(202))
                    {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-inf.php" method="post">
                                            <input type="submit" name="202" value="202" class="btn btn-danger">
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Deluxe</div>
                                        <p class="text-danger">Booked  until
                                            <?php  $date202=returndate(202);
                                            echo $date202;
                                            ?></p>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                    else {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-reg.php" method="post">
                                            <input type="submit" name="202" value="202" class="btn btn-primary">
                                            <!--                                            <a href="index.php"><h2>101</h2></a>-->
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Deluxe</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
           <?php } ?>
            <?php if (!roomcheck(203))
                    {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-inf.php" method="post">
                                            <input type="submit" name="203" value="203" class="btn btn-danger">
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Deluxe</div>
                                        <p class="text-danger">Booked  until
                                            <?php  $date203=returndate(203);
                                            echo $date203;
                                            ?></p>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                    else {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-reg.php" method="post">
                                            <input type="submit" name="203" value="203" class="btn btn-primary">
                                            <!--                                            <a href="index.php"><h2>101</h2></a>-->
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Deluxe</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
           <?php } ?>
            <?php if (!roomcheck(204))
                    {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-inf.php" method="post">
                                            <input type="submit" name="204" value="204" class="btn btn-danger">
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Deluxe</div>
                                        <p class="text-danger">Booked  until
                                            <?php  $date204=returndate(204);
                                            echo $date204;
                                            ?></p>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                    else {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-reg.php" method="post">
                                            <input type="submit" name="204" value="204" class="btn btn-primary">
                                            <!--                                            <a href="index.php"><h2>101</h2></a>-->
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Deluxe</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
           <?php } ?>
            <?php if (!roomcheck(205))
                    {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-inf.php" method="post">
                                            <input type="submit" name="205" value="205" class="btn btn-danger">
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Deluxe</div>
                                        <p class="text-danger">Booked  until
                                            <?php  $date205=returndate(205);
                                            echo $date205;
                                            ?></p>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                    else {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-reg.php" method="post">
                                            <input type="submit" name="205" value="205" class="btn btn-primary">
                                            <!--                                            <a href="index.php"><h2>101</h2></a>-->
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Deluxe</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
           <?php } ?>
            <?php if (!roomcheck(206))
                    {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-inf.php" method="post">
                                            <input type="submit" name="206" value="206" class="btn btn-danger">
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Deluxe</div>
                                        <p class="text-danger">Booked  until
                                            <?php  $date206=returndate(206);
                                            echo $date206;
                                            ?></p>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                    else {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-reg.php" method="post">
                                            <input type="submit" name="206" value="206" class="btn btn-primary">
                                            <!--                                            <a href="index.php"><h2>101</h2></a>-->
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Deluxe</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
           <?php } ?>
            <?php if (!roomcheck(207))
                    {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-inf.php" method="post">
                                            <input type="submit" name="207" value="207" class="btn btn-danger">
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Deluxe</div>
                                        <p class="text-danger">Booked  until
                                            <?php  $date207=returndate(207);
                                            echo $date207;
                                            ?></p>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                    else {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-reg.php" method="post">
                                            <input type="submit" name="207" value="207" class="btn btn-primary">
                                            <!--                                            <a href="index.php"><h2>101</h2></a>-->
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Deluxe</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
           <?php } ?>
            <?php if (!roomcheck(208))
                    {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-inf.php" method="post">
                                            <input type="submit" name="208" value="208" class="btn btn-danger">
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Deluxe</div>
                                        <p class="text-danger">Booked  until
                                            <?php  $date208=returndate(208);
                                            echo $date208;
                                            ?></p>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                    else {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-reg.php" method="post">
                                            <input type="submit" name="208" value="208" class="btn btn-primary">
                                            <!--                                            <a href="index.php"><h2>101</h2></a>-->
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Deluxe</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
           <?php } ?>

            <?php if (!roomcheck(301))
                    {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-inf.php" method="post">
                                            <input type="submit" name="301" value="301" class="btn btn-danger">
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Super-Deluxe</div>
                                        <p class="text-danger">Booked  until
                                            <?php  $date301=returndate(301);
                                            echo $date301;
                                            ?></p>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                    else {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-reg.php" method="post">
                                            <input type="submit" name="301" value="301" class="btn btn-primary">
                                            <!--                                            <a href="index.php"><h2>101</h2></a>-->
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Super-Deluxe</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
           <?php } ?>
           <?php if (!roomcheck(302))
                    {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-inf.php" method="post">
                                            <input type="submit" name="302" value="302" class="btn btn-danger">
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Super-Deluxe</div>
                                        <p class="text-danger">Booked  until
                                            <?php  $date302=returndate(302);
                                            echo $date302;
                                            ?></p>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                    else {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-reg.php" method="post">
                                            <input type="submit" name="302" value="302" class="btn btn-primary">
                                            <!--                                            <a href="index.php"><h2>101</h2></a>-->
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Super-Deluxe</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
           <?php } ?>
           <?php if (!roomcheck(303))
                    {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-inf.php" method="post">
                                            <input type="submit" name="303" value="303" class="btn btn-danger">
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Super-Deluxe</div>
                                        <p class="text-danger">Booked  until
                                            <?php  $date303=returndate(303);
                                            echo $date303;
                                            ?></p>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                    else {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-reg.php" method="post">
                                            <input type="submit" name="303" value="303" class="btn btn-primary">
                                            <!--                                            <a href="index.php"><h2>101</h2></a>-->
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Super-Deluxe</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
           <?php } ?>
           <?php if (!roomcheck(304))
                    {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-inf.php" method="post">
                                            <input type="submit" name="304" value="304" class="btn btn-danger">
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Super-Deluxe</div>
                                        <p class="text-danger">Booked  until
                                            <?php  $date304=returndate(304);
                                            echo $date304;
                                            ?></p>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                    else {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-reg.php" method="post">
                                            <input type="submit" name="304" value="304" class="btn btn-primary">
                                            <!--                                            <a href="index.php"><h2>101</h2></a>-->
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Super-Deluxe</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
           <?php } ?>
           <?php if (!roomcheck(305))
                    {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-inf.php" method="post">
                                            <input type="submit" name="305" value="305" class="btn btn-danger">
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Super-Deluxe</div>
                                        <p class="text-danger">Booked  until
                                            <?php  $date305=returndate(305);
                                            echo $date305;
                                            ?></p>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                    else {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-reg.php" method="post">
                                            <input type="submit" name="305" value="305" class="btn btn-primary">
                                            <!--                                            <a href="index.php"><h2>101</h2></a>-->
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Super-Deluxe</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
           <?php } ?>
           <?php if (!roomcheck(306))
                    {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-inf.php" method="post">
                                            <input type="submit" name="306" value="306" class="btn btn-danger">
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Super-Deluxe</div>
                                        <p class="text-danger">Booked  until
                                            <?php  $date306=returndate(306);
                                            echo $date306;
                                            ?></p>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                    else {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-reg.php" method="post">
                                            <input type="submit" name="306" value="306" class="btn btn-primary">
                                            <!--                                            <a href="index.php"><h2>101</h2></a>-->
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Super-Deluxe</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
           <?php } ?>
           <?php if (!roomcheck(307))
                    {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-inf.php" method="post">
                                            <input type="submit" name="307" value="307" class="btn btn-danger">
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Super-Deluxe</div>
                                        <p class="text-danger">Booked  until
                                            <?php  $date307=returndate(307);
                                            echo $date307;
                                            ?></p>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                    else {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-reg.php" method="post">
                                            <input type="submit" name="307" value="307" class="btn btn-primary">
                                            <!--                                            <a href="index.php"><h2>101</h2></a>-->
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Super-Deluxe</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
           <?php } ?>
           <?php if (!roomcheck(308))
                    {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-inf.php" method="post">
                                            <input type="submit" name="308" value="308" class="btn btn-danger">
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Super-Deluxe</div>
                                        <p class="text-danger">Booked  until
                                            <?php  $date308=returndate(308);
                                            echo $date308;
                                            ?></p>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                    else {?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <form class="form-group" action="cust-reg.php" method="post">
                                            <input type="submit" name="308" value="308" class="btn btn-primary">
                                            <!--                                            <a href="index.php"><h2>101</h2></a>-->
                                        </form>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Super-Deluxe</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bed fa-4x text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
           <?php } ?>




                </div>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Delights 1995-2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>
</html>


