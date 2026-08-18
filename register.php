<?php
include 'db.php';

if(isset($_POST['register'])){

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];

$stmt = $conn->prepare("INSERT INTO Users (username,email,password_hash,role) VALUES (?,?,?,?)");
$stmt->bind_param("ssss", $username, $email, $password, $role);

if($stmt->execute()){
    header("Location: login.php");
    exit();
}else{
    echo "<div class='alert alert-danger text-center'>Registration failed!</div>";
}
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Register</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2 class="mb-4">User Registration</h2>

<form method="POST">

<div class="mb-3">
<label>Username</label>
<input type="text" name="username" class="form-control" required>
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<div class="mb-3">
<label>Role</label>
<select name="role" class="form-control">
<option value="admin">Admin</option>
<option value="rescuer">Rescuer</option>
<option value="vet">Vet</option>
<option value="adopter">Adopter</option>
</select>
</div>

<button type="submit" name="register" class="btn btn-primary">
Register
</button>

</form>

<div class="mt-3">
<a href="login.php">Already have an account? Login here</a>
</div>

</div>

</body>
</html>