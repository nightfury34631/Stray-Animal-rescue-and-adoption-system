
<?php
session_start();

if($_SESSION['role'] != 'vet' && $_SESSION['role'] != 'admin'){
header("Location: index.php");
exit();
}
include 'db.php';

if(isset($_POST['submit'])){

$animal_id = $_POST['animal_id'];
$vet_id = $_POST['vet_id'];
$treatment = $_POST['treatment'];
$vaccine = $_POST['vaccine'];
$date = $_POST['date'];

$sql = "INSERT INTO MedRecords (animal_id,vet_id,treatment,vaccine,date)
VALUES ('$animal_id','$vet_id','$treatment','$vaccine','$date')";

mysqli_query($conn,$sql);

header("Location: medical_records.php");
exit();
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Add Medical Record</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>Add Medical Record</h2>

<form method="POST">

<div class="mb-3">
<label>Select Animal</label>

<select name="animal_id" class="form-control">

<?php
$animals = mysqli_query($conn,"SELECT * FROM Animals");

while($animal = mysqli_fetch_assoc($animals)){
?>

<option value="<?php echo $animal['animal_id']; ?>">
<?php echo $animal['species']; ?> (ID: <?php echo $animal['animal_id']; ?>)
</option>

<?php
}
?>

</select>
</div>

<div class="mb-3">
<label>Select Vet</label>

<select name="vet_id" class="form-control">

<?php
$vets = mysqli_query($conn,"SELECT * FROM Users WHERE role='vet'");

while($vet = mysqli_fetch_assoc($vets)){
?>

<option value="<?php echo $vet['user_id']; ?>">
<?php echo $vet['username']; ?>
</option>

<?php
}
?>

</select>

</div>

<div class="mb-3">
<label>Treatment</label>
<input type="text" name="treatment" class="form-control">
</div>

<div class="mb-3">
<label>Vaccine</label>
<input type="text" name="vaccine" class="form-control">
</div>

<div class="mb-3">
<label>Date</label>
<input type="date" name="date" class="form-control">
</div>

<button type="submit" name="submit" class="btn btn-success">
Add Record
</button>

</form>

</div>

</body>
</html>