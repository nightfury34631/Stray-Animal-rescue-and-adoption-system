<?php
include 'db.php';

$id = $_GET['id'];

mysqli_query($conn,"DELETE FROM Adoptions WHERE adoption_id=$id");

header("Location: adoptions.php");
?>