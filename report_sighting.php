<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include 'db.php';

if(isset($_POST['submit'])){

$species = $_POST['species'];
$animal_condition = $_POST['animal_condition'];
$location = $_POST['location'];
$date = $_POST['date'];
$reported_by = $_SESSION['user_id'];

$sql = "INSERT INTO Sightings (species, animal_condition, location, date, status, reported_by)
VALUES ('$species','$animal_condition','$location','$date','pending','$reported_by')";

mysqli_query($conn,$sql);

header("Location: sightings.php");
exit();
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Report Sighting</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>Report Stray Animal</h2>

<form method="POST">

<div class="mb-3">
<label>Species</label>
<input type="text" name="species" class="form-control" placeholder="Dog / Cat / Bird / Other" required>
</div>

<div class="mb-3">
<label>Animal Condition</label>
<input type="text" name="animal_condition" class="form-control" placeholder="Injured / Sick / Healthy / Weak" required>
</div>

<div class="mb-3">
<label>Location</label>
<input type="text" name="location" class="form-control">
</div>

<div class="mb-3">
<label>Date</label>
<input type="date" name="date" class="form-control">
</div>

<button type="submit" name="submit" class="btn btn-success">
Report Sighting
</button>

</form>

</div>

</body>
</html>