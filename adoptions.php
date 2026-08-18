<?php
session_start();

if($_SESSION['role'] != 'adopter' && $_SESSION['role'] != 'admin'){
echo "Only adopters can access this page.";
exit();
}

include 'db.php';

if($_SESSION['role']=="admin"){

    $result = mysqli_query($conn,"
    SELECT *
    FROM Adoption_Details
    ");

}else{

    $adopter_id = $_SESSION['user_id'];

    $result = mysqli_query($conn,"
    SELECT *
    FROM Adoption_Details
    WHERE user_id='$adopter_id'
    ");

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Adoption Details</title>



<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<?php include 'navbar.php'; ?>

<div class="container mt-5">

<h2>Adoption Details</h2>

<h5 class="text-success">
Data loaded from Adoption_Details View
</h5>

<?php if($_SESSION['role']=="adopter"){ ?>
<a href="request_adoption.php" class="btn btn-primary mb-3">
Request Adoption
</a>
<?php } ?>


<table class="table table-bordered">

<tr>
<th>Adoption ID</th>
<th>Animal ID</th>
<th>Animal</th>
<th>User ID</th>
<th>Adopter</th>
<th>Request Date</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result)){
?>

<tr>

<td><?php echo $row['adoption_id']; ?></td>

<td><?php echo $row['animal_id']; ?></td>

<td><?php echo $row['species']; ?></td>

<td><?php echo $row['user_id']; ?></td>

<td><?php echo $row['adopter_name']; ?></td>

<td><?php echo $row['request_date']; ?></td>

<td><?php echo $row['status']; ?></td>

<td>

<?php if($_SESSION['role']=="admin" && $row['status']=="pending"){ ?>

<a href="approve_adoption.php?id=<?php echo $row['adoption_id']; ?>" class="btn btn-success btn-sm">
Approve
</a>

<a href="reject_adoption.php?id=<?php echo $row['adoption_id']; ?>" class="btn btn-danger btn-sm">
Reject
</a>

<?php } ?>

<?php if($_SESSION['role']=="adopter" && $row['status']=="pending"){ ?>

<a href="cancel_adoption.php?id=<?php echo $row['adoption_id']; ?>" class="btn btn-warning btn-sm">
Cancel
</a>

<?php } ?>

</td>

</tr>

<?php
}
?>

</table>

</div>

</body>
</html>