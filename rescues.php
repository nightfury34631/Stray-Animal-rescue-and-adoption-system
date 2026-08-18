<?php
session_start();
include 'db.php';

if($_SESSION['role'] != 'rescuer' && $_SESSION['role'] != 'admin'){
echo "Access denied";
exit();
}

$result = mysqli_query($conn,"
SELECT *
FROM Rescue_Details
");
?>

<!DOCTYPE html>
<html>
<head>
<h5 class="text-success">
Data loaded from Rescue_Details View
</h5>
<title>Rescue Records</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<?php include 'navbar.php'; ?>

<div class="container mt-5">

<h2>Rescue Records</h2>

<table class="table table-bordered">

<tr>
<th>Animal ID</th>
<th>User ID</th>
<th>ID</th>
<th>Animal</th>
<th>Rescuer</th>
<th>Date</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['rescue_id']; ?></td>
<td><?php echo $row['species']; ?></td>
<td><?php echo $row['rescuer_name']; ?></td>
<td><?php echo $row['rescue_date']; ?></td>
<td><?php echo $row['animal_id']; ?></td>
<td><?php echo $row['user_id']; ?></td>
<td><?php echo $row['status']; ?></td>

<td>
<a href="edit_rescue.php?id=<?php echo $row['rescue_id']; ?>" class="btn btn-warning btn-sm">
Edit
</a>
</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>
