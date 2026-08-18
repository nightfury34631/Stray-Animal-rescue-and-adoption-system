
<?php
session_start();

if($_SESSION['role'] != 'admin'){
echo "Access denied";
exit();
}
include 'db.php';

if(isset($_POST['submit'])){

$species = $_POST['species'];
$condition = $_POST['animal_condition'];
$status = $_POST['status'];
$location = $_POST['location'];

$sql = "INSERT INTO Animals (species, animal_condition, status, location)
VALUES ('$species','$condition','$status','$location')";

mysqli_query($conn,$sql);

header("Location: animals.php");
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Add Animal</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<?php include 'navbar.php'; ?>

<div class="container mt-5">

<h2>Add New Animal</h2>

<form method="POST">

<div class="mb-3">
<label>Species</label>
<input type="text" name="species" class="form-control">
</div>

<div class="mb-3">
<label>Condition</label>
<input type="text" name="animal_condition" class="form-control">
</div>

<div class="mb-3">
<label>Status</label>
<select name="status" class="form-control">
<option value="found">Found</option>
<option value="rescued">Rescued</option>
<option value="treated">Treated</option>
<option value="rehomed">Rehomed</option>
</select>
</div>

<div class="mb-3">
<label>Location</label>
<input type="text" name="location" class="form-control">
</div>

<button type="submit" name="submit" class="btn btn-success">Save</button>

</form>

</div>

</body>
</html>