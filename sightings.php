<?php
session_start();
include 'db.php';

if(isset($_GET['search'])){

    $search = $_GET['search'];

    $result = mysqli_query($conn,"
    SELECT sighting_id, species, animal_condition, location, date, status
    FROM Sightings
    WHERE species LIKE '%$search%' OR location LIKE '%$search%'
    ");

}else{

    $result = mysqli_query($conn,"
SELECT *
FROM Pending_Sightings
");

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Sightings</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<?php include 'navbar.php'; ?>

<div class="container mt-5">

<h2>Animal Sightings</h2>

<form method="GET" class="mb-3">
<div class="input-group">
<input type="text" name="search" class="form-control"
placeholder="Search by species or location..."
value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
<button type="submit" class="btn btn-primary">Search</button>
<a href="sightings.php" class="btn btn-secondary">Show All</a>
</div>
</form>



<a href="report_sighting.php" class="btn btn-success mb-3">
Report New Sighting
</a>

<table class="table table-bordered">

<tr>
<th>ID</th>
<th>Species</th>
<th>Condition</th>
<th>Location</th>
<th>Date</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php
if(mysqli_num_rows($result) > 0){
while($row = mysqli_fetch_assoc($result)){
?>

<tr>
<td><?php echo $row['sighting_id']; ?></td>
<td><?php echo $row['species']; ?></td>
<td><?php echo $row['animal_condition']; ?></td>
<td><?php echo $row['location']; ?></td>
<td><?php echo $row['date']; ?></td>
<td>
<?php
if($row['status'] == 'pending'){
    echo "<span class='badge bg-warning text-dark'>Pending</span>";
}elseif($row['status'] == 'approved'){
    echo "<span class='badge bg-success'>Approved</span>";
}else{
    echo $row['status'];
}
?>
</td>

<td>
<?php
if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin' && $row['status'] == 'pending'){
?>
<a href="approve_sighting.php?id=<?php echo $row['sighting_id']; ?>" 
class="btn btn-primary btn-sm"
onclick="return confirm('Approve this sighting and add it to Animals?');">
Approve
</a>
<?php
}else{
echo "-";
}
?>
</td>

</tr>

<?php
}
}else{
?>
<tr>
<td colspan="7" class="text-center">No sightings found.</td>
</tr>
<?php
}
?>

</table>

</div>

</body>
</html>