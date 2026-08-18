<?php

session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    echo "Access denied";
    exit();
}

include 'db.php';

if(isset($_GET['id'])){

    $id = $_GET['id'];

    // Get pending sighting details
$result = mysqli_query($conn, "SELECT * FROM Sightings WHERE sighting_id=$id AND status='pending'");

    if(mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_assoc($result);

        $species = $row['species'];
        $condition = $row['animal_condition'];
        $location = $row['location'];

        // Add to Animals table
        mysqli_query($conn, "
        INSERT INTO Animals (species, animal_condition, status, location)
        VALUES ('$species', '$condition', 'found', '$location')
        ");

        // Update sighting status
        mysqli_query($conn, "
        UPDATE Sightings
        SET status='approved'
        WHERE sighting_id=$id
        ");

        header("Location: sightings.php");
        exit();

    }else{
        echo "Sighting not found.";
    }

}else{
    echo "No sighting selected.";
}

?>