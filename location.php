<?php 

include "includes/db.php";

if(isset($_POST['lat']) && isset($_POST['longt']))
{
    $lat = $_POST['lat']; $longt = $_POST['longt']; $mac = $_POST['mac'];

    $insert_c = "INSERT INTO users(latitude, mac, longitude) VALUES ('$lat', '$mac', '$longt')";
    $run_c = mysqli_query($con, $insert_c);
}



?>