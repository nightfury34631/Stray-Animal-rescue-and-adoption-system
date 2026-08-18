
<?php

session_start();

if(!isset($_SESSION['user'])){
header("Location: login.php");
exit();
}


include 'db.php';

$total_animals = mysqli_query($conn,"SELECT COUNT(*) as total FROM Animals");
$animals = mysqli_fetch_assoc($total_animals);

$treatedAnimals = mysqli_query($conn,"
SELECT AnimalsByStatus('treated') AS total
");

$treated = mysqli_fetch_assoc($treatedAnimals);

$approvedAdoptions = mysqli_query($conn,"
SELECT TotalApprovedAdoptions() AS total
");

$approved = mysqli_fetch_assoc($approvedAdoptions);

$total_rescues = mysqli_query($conn,"SELECT COUNT(*) as total FROM Rescues");
$rescues = mysqli_fetch_assoc($total_rescues);

$total_adoptions = mysqli_query($conn,"SELECT COUNT(*) as total FROM Adoptions");
$adoptions = mysqli_fetch_assoc($total_adoptions);

$total_medical = mysqli_query($conn,"SELECT COUNT(*) as total FROM MedRecords");
$medical = mysqli_fetch_assoc($total_medical);
?>

<!DOCTYPE html>
<html>
<head>

<title>Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
   background: url('https://images.unsplash.com/photo-1450778869180-41d0601e046e?auto=format&fit=crop&w=1500&q=80') no-repeat center center fixed;
    background-size: cover;
    margin: 0;
    padding: 0;
}

.overlay{
    background-color: rgba(0,0,0,0.65);
    min-height: 100vh;
    padding-bottom: 50px;
}

.dashboard-card{
    border-radius: 15px;
    box-shadow: 0 0 20px rgba(0,0,0,0.4);
    transition: transform 0.3s ease;
}

.dashboard-card:hover{
    transform: scale(1.05);
}

.dashboard-title{
    color: white;
    font-weight: bold;
    text-shadow: 2px 2px 8px rgba(0,0,0,0.7);
}
</style>

</head>

<body>

<?php include 'navbar.php'; ?>

<div class="container mt-5">

<h2>Dashboard</h2>

<div class="row mt-4">

<div class="col-md-3">
<div class="card text-center bg-primary text-white">
<div class="card-body">
<h4>Total Animals</h4>
<h2><?php echo $animals['total']; ?></h2>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card text-center bg-success text-white">
<div class="card-body">
<h4>Total Rescues</h4>
<h2><?php echo $rescues['total']; ?></h2>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card text-center bg-warning text-dark">
<div class="card-body">
<h4>Total Adoptions</h4>
<h2><?php echo $adoptions['total']; ?></h2>
</div>
</div>
</div>

<div class="col-md-3">
<div class="card text-center bg-danger text-white">
<div class="card-body">
<h4>Medical Records</h4>
<h2><?php echo $medical['total']; ?></h2>
</div>
</div>
</div>

<div class="col-md-3 mt-4">
<div class="card text-center bg-info text-white">
<div class="card-body">
<h4>Treated Animals</h4>
<h2><?php echo $treated['total']; ?></h2>
</div>
</div>
</div>



<div class="col-md-3 mt-4">
<div class="card text-center bg-secondary text-white">
<div class="card-body">
<h4>Approved Adoptions</h4>
<h2><?php echo $approved['total']; ?></h2>
</div>
</div>
</div>

</div> <!-- row -->

</div> <!-- container -->

</body>
</html>

