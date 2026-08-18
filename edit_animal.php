
<nav class="navbar navbar-dark bg-dark">
<div class="container">
<a class="navbar-brand" href="index.php">Stray Animal System</a>

<div>
<a href="index.php" class="btn btn-light btn-sm">Dashboard</a>
<a href="animals.php" class="btn btn-light btn-sm">Animals</a>
<a href="add_animal.php" class="btn btn-light btn-sm">Add Animal</a>
</div>

</div>
</nav>
<?php
session_start();

if($_SESSION['role'] != 'admin'){
echo "Access denied";
exit();
}
include 'db.php';

$id = $_GET['id'];

$result = mysqli_query($conn,"SELECT * FROM Animals WHERE animal_id=$id");
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

$species = $_POST['species'];
$condition = $_POST['animal_condition'];
$status = $_POST['status'];
$location = $_POST['location'];

$sql = "UPDATE Animals 
SET species='$species',
animal_condition='$condition',
status='$status',
location='$location'
WHERE animal_id=$id";

mysqli_query($conn,$sql);

header("Location: animals.php");
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Animal</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>Edit Animal</h2>

<form method="POST">

<div class="mb-3">
<label>Species</label>
<input type="text" name="species" value="<?php echo $row['species']; ?>" class="form-control">
</div>

<div class="mb-3">
<label>Condition</label>
<input type="text" name="animal_condition" value="<?php echo $row['animal_condition']; ?>" class="form-control">
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
<input type="text" name="location" value="<?php echo $row['location']; ?>" class="form-control">
</div>

<button type="submit" name="update" class="btn btn-success">Update</button>

</form>

</div>

</body>
</html>