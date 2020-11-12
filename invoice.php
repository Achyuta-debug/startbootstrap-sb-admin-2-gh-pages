<?php
include "function.php";
session_start();
require('fpdf/fpdf.php');
$id = $_SESSION['id'];
$_SESSION['cuid'] = $id;
$no = $_SESSION['room'];
$date = returndate($no);
$billid = $_SESSION['billid'];
$connect = mysqli_connect('localhost', 'root', 'Achyuta123', 'hotel');
$query = "SELECT fname,lname,city,phone_no,room_type,from_date,to_date FROM customers WHERE room_no= $no";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_array($result);
$fname = $row['fname'];
$lname = $row['lname'];
$city = $row['city'];
$phone_no = $row['phone_no'];
$roomtype = $row['room_type'];
$from = $row['from_date'];
$to = $row['to_date'];
$subt = array();
global $tax;
global $total;
global $charge;
global $full;
if (isset($_POST['submit-2'])) {
    $pdf = new FPDF('p', 'mm', 'A4');
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 14);

//Cell(width , height , text , border , end line , [align] )

    $pdf->Cell(130, 5, 'DELIGHTS', 0, 0);
    $pdf->Cell(59, 5, 'INVOICE', 0, 1);//end of line

//set font to arial, regular, 12pt
    $pdf->SetFont('Arial', '', 12);

    $pdf->Cell(130, 5, '', 0, 0);
    $pdf->Cell(59, 5, '', 0, 1);//end of line

    $pdf->Cell(130, 5, 'Bengaluru, India, 560085', 0, 0);
    $pdf->Cell(11, 5, 'Date:', 0, 0);
    $pdf->Cell(34, 5, $date, 0, 1);//end of line

    $pdf->Cell(130, 5, 'Near Balaji kalyana mantapa', 0, 0);
    $pdf->Cell(13, 5, 'Bill ID:', 0, 0);
    $pdf->Cell(34, 5, $billid, 0, 1);//end of line

    $pdf->Cell(130, 5, 'Banashankari ,080-26663525', 0, 0);
    $pdf->Cell(25, 5, 'Customer ID:', 0, 0);
    $pdf->Cell(34, 5, $id, 0, 1);//end of line

    $pdf->Cell(130, 5, '', 0, 0);
    $pdf->Cell(19, 5, 'Room No:', 0, 0);
    $pdf->Cell(34, 5, $no, 0, 1);//end of line

    $pdf->Cell(130, 5, '', 0, 0);
    $pdf->Cell(23, 5, 'Room Type:', 0, 0);
    $pdf->Cell(34, 5, $roomtype, 0, 1);//end of line
//make a dummy empty cell as a vertical spacer
    $pdf->Cell(189, 10, '', 0, 1);//end of line

//billing address
    $pdf->Cell(100, 5, 'Bill to:', 0, 1);//end of line

//add dummy cell at beginning of each line for indentation


    $pdf->Cell(14, 5, 'Name:', 0, 0);
    $pdf->Cell(90, 5, $fname . " " . $lname, 0, 1);

    $pdf->Cell(10, 5, 'City:', 0, 0);
    $pdf->Cell(90, 5, $city, 0, 1);

    $pdf->Cell(21, 5, 'Phone No:', 0, 0);
    $pdf->Cell(90, 5, $phone_no, 0, 1);

//make a dummy empty cell as a vertical spacer
    $pdf->Cell(189, 10, '', 0, 1);//end of line

//invoice contents
    $pdf->SetFont('Arial', 'B', 12);

    $pdf->Cell(90, 5, 'Description', 1, 0);
    $pdf->Cell(50, 5, 'price', 1, 0);
    $pdf->Cell(25, 5, 'Count', 1, 0);
    $pdf->Cell(34, 5, 'Amount', 1, 1);//end of lin

    $pdf->SetFont('Arial', '', 12);

    $days = days($from, $to);
    $charg = returnprice($no);
    $charge = $days * $charg;
    array_push($subt, $charge);
    $pdf->Cell(90, 5, "Room charges ", 1, 0);
    $pdf->Cell(50, 5, 'Rs' . " " . $charg, 1, 0,);
    $pdf->Cell(25, 5, $days, 1, 0);
    $pdf->Cell(34, 5, 'Rs' . " " . $charge, 1, 1);
//Numbers are right-aligned so we give 'R' after new line parameter
    $query4 = "select services.service_name,COUNT(*) AS count,SUM(price) AS sum from uses inner join services on
               services.service_id = uses.service_id where customer_id ='$id' group by uses.service_id";
    $result5 = mysqli_query($connect, $query4);
    while ($row = mysqli_fetch_array($result5)) {
        $sname = $row['service_name'];
        $count = $row['count'];
        $sum = $row['sum'];
        array_push($subt, $sum);
        $price = $sum / $count;
        $pdf->Cell(90, 5, $sname, 1, 0,);
        $pdf->Cell(50, 5, 'Rs' . " " . $price, 1, 0,);
        $pdf->Cell(25, 5, $count, 1, 0);
        $pdf->Cell(34, 5, 'Rs' . " " . $sum, 1, 1);//end of line
    }

    $total = array_sum($subt);
    $_SESSION['sub'] = $total;

//summary
    $pdf->Cell(130, 5, '', 0, 0);
    $pdf->Cell(31, 5, 'Subtotal', 0, 0);
    $pdf->Cell(8, 5, 'Rs', 1, 0);
    $pdf->Cell(30, 5, $total, 1, 1, 'R');//end of line

    $pdf->Cell(130, 5, '', 0, 0);
    $pdf->Cell(31, 5, 'GST', 0, 0);
    $pdf->Cell(8, 5, '%', 1, 0);
    $pdf->Cell(30, 5, '3.5', 1, 1, 'R');//end of line

    $tax = 0.035 * $total;
    $_SESSION['tax'] = $tax;
    $pdf->Cell(130, 5, '', 0, 0);
    $pdf->Cell(31, 5, 'Taxable', 0, 0);
    $pdf->Cell(8, 5, 'Rs', 1, 0);
    $pdf->Cell(30, 5, $tax, 1, 1, 'R');//end of line

    $full = $total + $tax;
    $_SESSION['total'] = $full;
    $pdf->Cell(130, 5, '', 0, 0);
    $pdf->Cell(31, 5, 'Total Due', 0, 0);
    $pdf->Cell(8, 5, 'Rs', 1, 0);
    $pdf->Cell(30, 5, $full, 1, 1, 'R');//end of line

    $pdf->Output();

}
if (isset($_POST['submit'])) {

    $bill_id = $billid;
    $customer_id = $id;
    $query = "select SUM(services.price) AS count from uses inner join services
    on services.service_id = uses.service_id where customer_id ='$customer_id' group by uses.customer_id";
    $result = mysqli_query($connect, $query);
    $row2 = mysqli_fetch_array($result);
    if (mysqli_num_rows($result)> 0) {
        $amt = $row2['count'];
    }
    else {
        $amt = 0;
    }
    $days = days($from, $to);
    $charg = returnprice($no);
    $charge = $days * $charg;
    $total_amt = $amt + $charge;
    $tax = $total_amt * 0.035;
    $query2 = "INSERT INTO billing(bill_id,customer_id,amt_from_service,total_amt,tax)
    VALUES ('$bill_id','$customer_id',$amt,$total_amt,$tax)";
    $result2 = mysqli_query($connect, $query2);
    if (!$result2) {
        die("Query failed" . mysqli_error($connect));
    }


    $query3 = "DELETE FROM customers WHERE customer_id = '$id'";
    $result3 = mysqli_query($connect, $query3);
    if (!$result3) {
        die("Query failed" . mysqli_error($connect));
    }
    header("Location:/startbootstrap-sb-admin-2-gh-pages/Employee.php");

}