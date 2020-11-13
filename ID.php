<?php


class ID
{
    function autoincemp()
    {
        $db = mysqli_connect('localhost', 'root', 'Achyuta123', 'hotel');
        global $value2;
        $query = "SELECT service_id from services order by service_id desc LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $value2 = $row['empid'];
            $value2 = substr($value2, 3, 5);
            $value2 = (int) $value2 + 1;
            $value2 = "EMP" . sprintf('%04s', $value2);
            $value = $value2;
            return $value;
        } else {
            $value2 = "EMP0001";
            $value = $value2;
            return $value;
        }
    }
}