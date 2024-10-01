<?php
$server = "localhost"
$username = "root"
$password = ""
$database = "faththinks"

$konek = mysql_connect($server, $username, $password, $database);
if($konek == TRUE){
    echo "Terhubung ke database";
}
else{
    echo "Tidak Terhubung"
}
?>