<?php
 function db(){
 global $connect;
 $connect = mysqli_connect('localhost','root','Achyuta123');
}

function name(){
    $connect = mysqli_connect('localhost', 'root', 'Achyuta123', 'hotel');
    $id = $_SESSION['user'];
    $query = "SELECT fname FROM employees WHERE emp_id = '{$id}'";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($result);
    $name = $row['fname'];
    return $name;
}


function generatekey() {
     $keylength=10;
     $str="1234567890abcdefghijklmnopqrstuvwxyz";
     $randstr=substr(str_shuffle($str),0,$keylength);
     return $randstr;
}

function roomcheck($roomno){
    $connection = mysqli_connect('localhost', 'root', 'Achyuta123', 'hotel');
    $query2 = "SELECT room_no FROM customers WHERE room_no=$roomno";
    $result4 = mysqli_query($connection,$query2);
    if(!$result4){
        die("query failed".mysqli_connect_error());
    }
    $row=mysqli_fetch_array($result4);
    if(mysqli_num_rows($result4)>0){
        return false;
    }
    return true;
}
function returndate ($roomno){
    $connect = mysqli_connect('localhost', 'root', 'Achyuta123', 'hotel');
    $query = "SELECT to_date FROM customers WHERE room_no= $roomno";
    $result=mysqli_query($connect,$query);
    $row=mysqli_fetch_array($result);
    $date=$row['to_date'];
    return $date;
}

function custinfo($roomno){
    $connect = mysqli_connect('localhost', 'root', 'Achyuta123', 'hotel');
    $query = "SELECT * FROM customers WHERE room_no= $roomno";
    $result=mysqli_query($connect,$query);
    if(!$result){
        die ("query failed".mysqli_error($connect));
    }
    $row=mysqli_fetch_array($result);
    return $row;
}

function custid($roomno){
     $connect = mysqli_connect('localhost', 'root', 'Achyuta123', 'hotel');
     $query = "SELECT customer_id FROM customers WHERE room_no = $roomno";
     $result = mysqli_query($connect, $query);
     if(!$result){
        die("query failed".mysqli_connect_error());
     }
     $row=mysqli_fetch_array($result);
     $id=$row['customer_id'];
     return $id;
}

function days($from_date,$to_date){
    $connect = mysqli_connect('localhost', 'root', 'Achyuta123', 'hotel');
    $query = "SELECT DATEDIFF('$to_date','$from_date') AS DateDiff FROM customers";
    $result = mysqli_query($connect,$query);
    $row = mysqli_fetch_array($result);
    $date = $row['DateDiff'];
    return $date;
}


function returnroomno()
{
    if (isset($_POST['101'])) {
        $room = $_POST['101'];return $room;
    } elseif (isset($_POST['102'])) {
        $room = $_POST['102'];return $room;
    }
    elseif (isset($_POST['103'])) {
        $room = $_POST['103'];return $room;
    }
    elseif (isset($_POST['104'])) {
        $room = $_POST['104'];return $room;
    }
    elseif (isset($_POST['105'])) {
        $room = $_POST['105'];return $room;
    }
    elseif (isset($_POST['106'])) {
        $room = $_POST['106'];return $room;
    }
    elseif (isset($_POST['107'])) {
        $room = $_POST['107'];return $room;
    }
    elseif (isset($_POST['108'])) {
        $room = $_POST['108'];return $room;
    }
    elseif (isset($_POST['201'])) {
        $room = $_POST['201'];return $room;
    }
    elseif (isset($_POST['202'])) {
        $room = $_POST['202'];return $room;
    }
    elseif (isset($_POST['203'])) {
        $room = $_POST['203'];return $room;
    }
    elseif (isset($_POST['204'])) {
        $room = $_POST['204'];return $room;
    }
    elseif (isset($_POST['205'])) {
        $room = $_POST['205'];return $room;
    }
    elseif (isset($_POST['206'])) {
        $room = $_POST['206'];return $room;
    }
    elseif (isset($_POST['207'])) {
        $room = $_POST['207'];return $room;
    }
    elseif (isset($_POST['208'])) {
        $room = $_POST['208'];return $room;
    }
    elseif (isset($_POST['301'])) {
        $room = $_POST['301'];return $room;
    }
    elseif (isset($_POST['302'])) {
        $room = $_POST['302'];return $room;
    }
    elseif (isset($_POST['303'])) {
        $room = $_POST['303'];return $room;
    }
    elseif (isset($_POST['304'])) {
        $room = $_POST['304'];return $room;
    }
    elseif (isset($_POST['305'])) {
        $room = $_POST['305'];return $room;
    }
    elseif (isset($_POST['306'])) {
        $room = $_POST['306'];return $room;
    }
    elseif (isset($_POST['307'])) {
        $room = $_POST['307'];return $room;
    }
    elseif (isset($_POST['308'])) {
        $room = $_POST['302'];return $room;
    }

}
function returnprice($roomno){
    if($roomno >=101 && $roomno <= 108){
        $price=5000;
    }
    else if($roomno >=201 && $roomno <= 208){
       $price =10000;
    }
    else{
        $price = 15000;
    }
    return $price;
}
function generatesid(){
    $connect = mysqli_connect('localhost', 'root', 'Achyuta123', 'hotel');
    $query = "SELECT service_id from services order by service_id DESC LIMIT 1";
    $stmt = $connect->query($query);
    if(mysqli_num_rows($stmt) > 0) {
        if ($row = mysqli_fetch_assoc($stmt)) {
            $value2 = $row['service_id'];
            $value2 = substr($value2, 6, 13);//separating numeric part
            $value2 = $value2 + 1;//Incrementing numeric part
            $value2 = "DELSER" . sprintf('%03s', $value2);//concatenating incremented value
            $value = $value2;
        }
    }
    else {
        $value2 = "SERVICE100";
        $value = $value2;
    }
    return $value;
}
function generatecid(){
    $connect = mysqli_connect('localhost', 'root', 'Achyuta123', 'hotel');
    $query = "SELECT customer_id from customers order by customer_id DESC LIMIT 1";
    $stmt = $connect->query($query);
    if(mysqli_num_rows($stmt) > 0) {
        if ($row = mysqli_fetch_assoc($stmt)) {
            $value2 = $row['customer_id'];
            $value2 = substr($value2, 6, 13);//separating numeric part
            $value2 = $value2 + 1;//Incrementing numeric part
            $value2 = "DELCUS" . sprintf('%03s', $value2);//concatenating incremented value
            $value = $value2;
        }
    }
    else {
        $value2 = "DELCUS100";
        $value = $value2;
    }
    return $value;
}
function generatempid(){
    $connect = mysqli_connect('localhost', 'root', 'Achyuta123', 'hotel');
    $query = "SELECT emp_id from employees order by employees.emp_id DESC LIMIT 1";
    $stmt = $connect->query($query);
    if(mysqli_num_rows($stmt) > 0) {
        if ($row = mysqli_fetch_assoc($stmt)) {
            $value2 = $row['emp_id'];
            $value2 = substr($value2, 6, 13);//separating numeric part
            $value2 = $value2 + 1;//Incrementing numeric part
            $value2 = "DELEMP" . sprintf('%03s', $value2);//concatenating incremented value
            $value = $value2;
        }
    }
    else {
        $value2 = "DELEMP100";
        $value = $value2;
    }
    return $value;
}
?>
