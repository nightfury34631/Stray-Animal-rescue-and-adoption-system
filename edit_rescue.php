<?php
session_start();
include 'db.php';

if($_SESSION['role'] != 'rescuer' && $_SESSION['role'] != 'admin'){
header("Location: index.php");
exit();
}

$id = $_GET['id'];

$result = mysqli_query($conn,"SELECT * FROM Rescues WHERE rescue_id=$id");
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

$status = $_POST['status'];

mysqli_query($conn,"UPDATE Rescues SET status='$status' WHERE rescue_id=$id");

header("Location: rescues.php");

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Rescue</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<?php include 'navbar.php'; ?>

<div class="container mt-5">

<h2>Edit Rescue Status</h2>

<form method="POST">

<div class="mb-3">
<label>Status</label>

<select name="status" class="form-control">

<option value="pending" <?php if($row['status']=="pending") echo "selected"; ?>>Pending</option>

<option value="in_progress" <?php if($row['status']=="in_progress") echo "selected"; ?>>In Progress</option>

<option value="completed" <?php if($row['status']=="completed") echo "selected"; ?>>Completed</option>

</select>

</div>

<button type="submit" name="update" class="btn btn-success">Update</button>

</form>

</div>

</body>
</html>