
<?php
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
echo "Access denied";
exit();
}
include 'db.php';
$conditions = [];

if(!empty($_GET['search'])){
    $search = $_GET['search'];
    $conditions[] = "species LIKE '%$search%'";
}

if(!empty($_GET['status'])){
    $status = $_GET['status'];
    $conditions[] = "status='$status'";
}

$sql = "SELECT * FROM Animals";

if(count($conditions) > 0){
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Animals List</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
<?php include 'navbar.php'; ?>
<div class="container mt-5">

<form method="GET" class="mb-3">
<div class="row g-2">

<div class="col-md-5">
<input type="text" name="search" class="form-control" placeholder="Search by species..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
</div>

<div class="col-md-3">
<select name="status" class="form-control">
<option value="">Filter by Status</option>
<option value="found" <?php if(isset($_GET['status']) && $_GET['status']=="found") echo "selected"; ?>>Found</option>
<option value="rescued" <?php if(isset($_GET['status']) && $_GET['status']=="rescued") echo "selected"; ?>>Rescued</option>
<option value="treated" <?php if(isset($_GET['status']) && $_GET['status']=="treated") echo "selected"; ?>>Treated</option>
<option value="rehomed" <?php if(isset($_GET['status']) && $_GET['status']=="rehomed") echo "selected"; ?>>Rehomed</option>
</select>
</div>

<div class="col-md-4">
<button type="submit" class="btn btn-primary">Apply</button>
<a href="animals.php" class="btn btn-secondary">Show All</a>
</div>

</div>
</form>

<a href="add_animal.php" class="btn btn-primary mb-3">Add Animal</a>

<table class="table table-bordered table-striped">

<tr>
<th>ID</th>
<th>Species</th>
<th>Condition</th>
<th>Status</th>
<th>Location</th>
<th>Action</th>
</tr>

<?php
if(mysqli_num_rows($result) > 0){
while($row = mysqli_fetch_assoc($result)){
?>

<tr>
<td><?php echo $row['animal_id']; ?></td>
<td><?php echo $row['species']; ?></td>
<td><?php echo $row['animal_condition']; ?></td>
<td><?php echo $row['status']; ?></td>
<td><?php echo $row['location']; ?></td>

<td>
<a href="edit_animal.php?id=<?php echo $row['animal_id']; ?>" class="btn btn-warning btn-sm">Edit</a>

<a href="delete_animal.php?id=<?php echo $row['animal_id']; ?>" 
class="btn btn-danger btn-sm"
onclick="return confirm('Do you really want to delete this animal and all related records?');">
Delete
</a>
</td>

</tr>

<?php
}
}else{
?>
<tr>
<td colspan="6" class="text-center">No animals found.</td>
</tr>
<?php
}
?>

</table>

</div>

</body>
</html>