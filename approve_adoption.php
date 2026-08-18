<?php
include 'db.php';

$id = $_GET['id'];

/* get animal id from adoption request */
$result = mysqli_query($conn,"SELECT animal_id FROM Adoptions WHERE adoption_id=$id");
$row = mysqli_fetch_assoc($result);

$animal_id = $row['animal_id'];

/* approve adoption */
mysqli_query($conn,"UPDATE Adoptions SET status='approved' WHERE adoption_id=$id");

/* update animal status */
mysqli_query($conn,"UPDATE Animals SET status='rehomed' WHERE animal_id=$animal_id");

header("Location: adoptions.php");
?>