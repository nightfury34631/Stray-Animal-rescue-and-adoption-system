<?php
session_start();

if($_SESSION['role'] != 'adopter'){
header("Location: index.php");
exit();
}

include 'db.php';

if(isset($_POST['submit'])){

$animal_id = $_POST['animal_id'];
$adopter_id = $_SESSION['user_id'];
$date = date("Y-m-d");

mysqli_query($conn,"INSERT INTO Adoptions (animal_id, adopter_id, request_date, status)
VALUES ('$animal_id','$adopter_id','$date','pending')");

header("Location: adoptions.php");

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Request Adoption</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<?php include 'navbar.php'; ?>

<div class="container mt-5">

<h2>Request Animal Adoption</h2>

<form method="POST">

<div class="mb-3">
<label>Select Animal</label>

<select name="animal_id" class="form-control">

<?php
$animals = mysqli_query($conn,"SELECT * FROM Animals WHERE status='treated'");

while($row = mysqli_fetch_assoc($animals)){
?>

<option value="<?php echo $row['animal_id']; ?>">
<?php echo $row['species']; ?> (ID: <?php echo $row['animal_id']; ?>)
</option>

<?php
}
?>

</select>

</div>

<button type="submit" name="submit" class="btn btn-success">
Submit Request
</button>

</form>

</div>

</body>
</html>