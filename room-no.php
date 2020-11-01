<?php
function rno()
{
    global $room;
    if (isset($_POST['101'])) {
        $room = $_POST['101'];
        return $room;
    } elseif (isset($_POST['102'])) {
        $room = $_POST['102'];
        return $room;
    }
}
?>
