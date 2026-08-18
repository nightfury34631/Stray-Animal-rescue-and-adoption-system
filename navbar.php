<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
if(!isset($_SESSION['user']) || !isset($_SESSION['role'])){
    header("Location: login.php");
    exit();
}
?>

<nav class="navbar navbar-dark bg-dark">
<div>

<a href="index.php" class="btn btn-light btn-sm">Dashboard</a>

<?php if($_SESSION['role']=="admin"){ ?>
<a href="animals.php" class="btn btn-light btn-sm">Animals</a>
<?php } ?>

<?php if($_SESSION['role']=="rescuer" || $_SESSION['role']=="admin"){ ?>
<a href="rescue_animal.php" class="btn btn-light btn-sm">Rescue</a>
<a href="rescues.php" class="btn btn-light btn-sm">Rescue List</a>
<a href="report_sighting.php" class="btn btn-light btn-sm">Report Sighting</a>
<a href="sightings.php" class="btn btn-light btn-sm">Sightings</a>
<?php } ?>

<?php if($_SESSION['role']=="vet" || $_SESSION['role']=="admin"){ ?>
<a href="medical_records.php" class="btn btn-light btn-sm">Medical</a>
<?php } ?>

<?php if($_SESSION['role']=="adopter" || $_SESSION['role']=="admin"){ ?>
<a href="adoptions.php" class="btn btn-light btn-sm">Adoption</a>
<?php } ?>

<span class="text-white ms-3">
<?php echo $_SESSION['user']; ?> (<?php echo $_SESSION['role']; ?>)
</span>

<a href="logout.php" class="btn btn-danger btn-sm ms-2">Logout</a>

</div>
</nav>