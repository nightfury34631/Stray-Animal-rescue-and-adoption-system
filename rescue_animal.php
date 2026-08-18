
<?php
session_start();

if($_SESSION['role'] != 'rescuer' && $_SESSION['role'] != 'admin'){
echo "Only rescuers can access this page.";
exit();
}
include 'db.php';

if(isset($_POST['submit'])){

$animal_id = $_POST['animal_id'];
$rescuer_id = $_POST['rescuer_id'];
$rescue_date = $_POST['rescue_date'];
$status = $_POST['status'];

$sql = "INSERT INTO Rescues (animal_id,rescuer_id,rescue_date,status)
VALUES ('$animal_id','$rescuer_id','$rescue_date','$status')";

mysqli_query($conn,$sql);

if($status == 'completed'){
    mysqli_query($conn, "UPDATE Animals SET status='rescued' WHERE animal_id='$animal_id'");
}

header("Location: rescues.php");
exit();
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Rescue Animal</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>Rescue Animal</h2>

<form method="POST">

<div class="mb-3">
<label>Select Animal</label>

<select name="animal_id" class="form-control" required>

<option value="">Select Animal</option>

<?php
$animals = mysqli_query($conn,"SELECT * FROM Animals WHERE status='found'");

if(mysqli_num_rows($animals) > 0){

while($animal = mysqli_fetch_assoc($animals)){
?>

<option value="<?php echo $animal['animal_id']; ?>">
<?php echo $animal['species']; ?> (ID: <?php echo $animal['animal_id']; ?>)
</option>

<?php
}

}else{
?>

<option value="">No animals available for rescue</option>

<?php
}
?>

</select>
</div>

<div class="mb-3">
<label>Select Rescuer</label>

<select name="rescuer_id" class="form-control" required>

<option value="">Select Rescuer</option>

<?php
$rescuers = mysqli_query($conn,"SELECT * FROM Users WHERE role='rescuer'");

while($rescuer = mysqli_fetch_assoc($rescuers)){
?>

<option value="<?php echo $rescuer['user_id']; ?>">
<?php echo $rescuer['username']; ?> (ID: <?php echo $rescuer['user_id']; ?>)
</option>

<?php
}
?>

</select>
</div>

<div class="mb-3">
<label>Rescue Date</label>
<input type="date" name="rescue_date" class="form-control">
</div>

<div class="mb-3">
<label>Status</label>

<select name="status" class="form-control">
<option value="pending">Pending</option>
<option value="in_progress">In Progress</option>
<option value="completed">Completed</option>
</select>

</div>

<button type="submit" name="submit" class="btn btn-success">
Rescue Animal
</button>

</form>

</div>

</body>
</html>