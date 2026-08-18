<?php
session_start();

if($_SESSION['role'] != 'vet' && $_SESSION['role'] != 'admin'){
echo "Only vets can access this page.";
exit();
}
include 'db.php';

$result = mysqli_query($conn,"
SELECT *
FROM Medical_Record_Details
");
?>

<!DOCTYPE html>
<html>
<head>

<title>Medical Records</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<?php include 'navbar.php'; ?>

<div class="container mt-5">

<h5 class="text-success">
Data loaded from Medical_Record_Details View
</h5>

<h2>Medical Records</h2>

<?php if($_SESSION['role']=="vet" || $_SESSION['role']=="admin"){ ?>
<a href="add_medical_record.php" class="btn btn-primary mb-3">Add Medical Record</a>
<?php } ?>

<table class="table table-bordered">

<tr>
<th>Record ID</th>
<th>Animal ID</th>
<th>Animal</th>
<th>User ID</th>
<th>Vet</th>
<th>Treatment</th>
<th>Vaccine</th>
<th>Date</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result)){
?>

<tr>
<td><?php echo $row['record_id']; ?></td>
<td><?php echo $row['animal_id']; ?></td>
<td><?php echo $row['species']; ?></td>
<td><?php echo $row['user_id']; ?></td>
<td><?php echo $row['vet_name']; ?></td>
<td><?php echo $row['treatment']; ?></td>
<td><?php echo $row['vaccine']; ?></td>
<td><?php echo $row['date']; ?></td>
</tr>

<?php
}
?>

</table>

</div>

</body>
</html>
