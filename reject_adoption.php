<?php
include 'db.php';

$id = $_GET['id'];

mysqli_query($conn,"UPDATE Adoptions SET status='rejected' WHERE adoption_id=$id");

header("Location: adoptions.php");
?>