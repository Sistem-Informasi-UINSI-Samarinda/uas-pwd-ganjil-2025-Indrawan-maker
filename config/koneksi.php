<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "pwd_indra";


$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    die("Koneksi Gagal: ". mysqli_connect_error());
}

?>