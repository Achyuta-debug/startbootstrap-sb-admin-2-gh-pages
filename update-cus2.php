<?php
include "function.php";
session_start();
$connect = mysqli_connect('localhost', 'root', 'Achyuta123', 'hotel');
$empid = $_SESSION['user'];

$room=$_GET['ron'];
$name=name();
$custid = custid($room);
if ($room >= 101 && $room <= 108) {
    $type = "Standard";
}
if ($room >= 201 && $room <= 208) {
    $type = "Deluxe";
}
if ($room >= 301 && $room <= 308) {
    $type = "Super-Deluxe";
}
$info = custinfo($room);


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Delights-Dashbord</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper"
<!--    Sidebar -->
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


    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
           aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-user"></i>
            <span>Customer</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!--<h6 class="collapse-header">Custom Utilities:</h6>-->
                <a class="collapse-item" href="Add-serv.php">Add/Delete Services</a>
                <a class="collapse-item" href="update-cus.php">Update information</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->


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


                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $name ?></span>
                        <!--                            <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">-->
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                         aria-labelledby="userDropdown">
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
            <div class="row">

                <div class="col-lg-12 mb-8">
                    <form action="Employee.php" method="post">
                        <div class="card shadow mb-8">
                            <div class="card-header py-8">
                                <h4 class="m-0 font-weight-bold text-primary">Update Customer</h4>
                            </div>
                            <div class="card-body">
                                <div class="text-primary">
                                    <!--                                <form action="Employee.php" method="post">-->
                                    <div class="form-row">

                                        <div class="form-group col-md-6">
                                            <label for="fname">Firstname:</label>
                                            <input type="text" value="<?php echo $info['fname'] ?>" class="form-control"
                                                   id="fname" name="firstname">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="lastname">Lastname:</label>
                                            <input type="text" value="<?php echo $info['lname'] ?>" class="form-control"
                                                   id="lastname" name="lastname">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4">Email</label>
                                            <input type="text" class="form-control" value="<?php echo $info['email'] ?>"
                                                   id="inputPassword4" name="email">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputAddress">Address</label>
                                            <input type="text" class="form-control" id="inputAddress"
                                                   placeholder="1234 Main St" value="<?php echo $info['address'] ?>"
                                                   name="address">
                                        </div>
                                        <div class="form-group col-md-6 ">
                                            <label for="inputCity">City</label>
                                            <input type="text" value="<?php echo $info['city'] ?>" class="form-control"
                                                   id="inputCity" name="city">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputState">Sex</label>
                                            <select id="inputState" class="form-control" name="sex">
                                                <option selected>Male</option>
                                                <option>Female</option>
                                                <option>Others</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputState">Payment-method</label>
                                            <select id="inputState" class="form-control" name="payment">
                                                <option selected>Cash</option>
                                                <option>Card</option>
                                                <option>UPI</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="tel">Aadhaar-no</label>
                                            <input type="tel" value="<?php echo $info['id_proof'] ?>"
                                                   pattern="[0-9]{4}-[0-9]{4}-[0-9]{4}" class="form-control" id="tel"
                                                   name="aadhaar" required>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="Age">Age</label>
                                            <input type="number" value="<?php echo $info['age'] ?>" class="form-control"
                                                   id="Age" max="100" name="age" required>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="phone">Phone-no</label>
                                            <input type="tel" value="<?php echo $info['phone_no'] ?>" id="phone"
                                                   pattern="[0-9]{10}" class="form-control" name="phoneno" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Room-no">Room-no</label>
                                            <select id="Room-no" class="form-control" name="roomno" required>
                                                <option selected><?php echo $room; ?></option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="Room-type">Room-type</label>
                                            <select id="Room-type" class="form-control" name="roomtype" required>
                                                <option selected><?php echo $type; ?></option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="adults">No Of Adults</label>
                                            <select id="adults" class="form-control" name="noofad" required>
                                                <option selected>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="children">No Of Children</label>
                                            <select id="children" class="form-control" name="noofch" required>
                                                <option selected>1</option>
                                                <option>0</option>
                                                <option>2</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="from">Check-in Date</label>
                                            <input class="form-control" type="date"
                                                   value="<?php echo $info['from_date'] ?>" id="from" name="from"
                                                   required>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="to">Check-out Date</label>
                                            <input class="form-control" type="date"
                                                   value="<?php echo $info['to_date'] ?>" id="to" name="todate"
                                                   required>
                                        </div>


                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12 ">
                                        <div class="text-center">
                                            <input type="submit" value="Update"
                                                   name="update-emp" class="btn btn-primary col-sm-3 btn-user ">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!--                             Approach -->

                        </div>
                    </form>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto text-center">
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
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current
                session.
            </div>
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
</body>
</html>
<!---->
