<?php
include 'db.php';
session_start();

if(isset($_POST['login'])){

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM Users WHERE email=? AND password_hash=?");
$stmt->bind_param("ss", $email, $password);
$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows == 1){

$user = $result->fetch_assoc();

$_SESSION['user'] = $user['username'];
$_SESSION['role'] = $user['role'];
$_SESSION['user_id'] = $user['user_id'];

header("Location: index.php");
exit();

}else{
echo "<div class='alert alert-danger text-center'>Invalid login!</div>";
}

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background: url('https://images.unsplash.com/photo-1525253086316-d0c936c814f8?auto=format&fit=crop&w=1500&q=80') no-repeat center center fixed;
    background-size: cover;
}

.overlay{
    background-color: rgba(0,0,0,0.6);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.login-box{
    background: rgba(255,255,255,0.9);
    padding: 40px;
    border-radius: 15px;
    width: 100%;
    max-width: 450px;
    box-shadow: 0 0 20px rgba(0,0,0,0.4);
}
</style>

</head>
<body>

<div class="overlay">
<div class="login-box">

<h2 class="mb-4 text-center">Stray Animal Rescue System</h2>

<form method="POST">

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<button type="submit" name="login" class="btn btn-primary">Login</button>

<div class="mt-3">
<a href="register.php">New user? Register here</a>
</div>

</form>

</div>
</div>

</body>
</html>