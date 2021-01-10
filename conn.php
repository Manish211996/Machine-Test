<?php
    $conn=mysqli_connect("localhost","root","") or die("connection failed");
    mysqli_select_db($conn,"exctecdatabase") or die("dataBase is not selected");
?>