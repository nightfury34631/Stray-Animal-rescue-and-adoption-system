<?php
$conn = mysqli_connect("localhost", "root", "", "stray_animal_system");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
