<?php
include('Faththinks.php');

$humidity = $_GET['humidity'];

$input = mysql_query($konek, "INSERT INTO data (humidity, temperature, soil_moisture) VALUE($humidity'.'$temperature'.'$soil_moisture')");
if ($input == TRUE){
    echo "Berhasil Input Data";
}else{
    echo "Gagal Input Data";
}