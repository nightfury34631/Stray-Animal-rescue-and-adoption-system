<?php

session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    echo "Access denied";
    exit();
}

include 'db.php';

if(isset($_GET['id'])){

    $id = $_GET['id'];

    // Delete all child/dependent records first
    mysqli_query($conn, "DELETE FROM MedRecords WHERE animal_id=$id");
    mysqli_query($conn, "DELETE FROM Rescues WHERE animal_id=$id");
    mysqli_query($conn, "DELETE FROM Adoptions WHERE animal_id=$id");
    // Sightings table no longer directly depends on animal_id
    mysqli_query($conn, "DELETE FROM Neutering WHERE animal_id=$id");

    // Delete the main animal record
    if(mysqli_query($conn, "DELETE FROM Animals WHERE animal_id=$id")){
        header("Location: animals.php");
        exit();
    }else{
        echo "Delete failed: " . mysqli_error($conn);
    }

}else{
    echo "No animal selected.";
}

?>