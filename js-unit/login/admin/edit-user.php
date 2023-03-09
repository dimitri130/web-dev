<?php
include '../includes/db.php';


if(isset($_GET['id']))
{
	$uid = trim($_GET['id']);
	$sql = "SELECT * FROM `mvn_users` WHERE `id`=$uid LIMIT 1";
	$stmt = $conn->query($sql);
	$row = $stmt->fetch();
	var_dump($row);
}
else
	header('Location:index.php');

if(isset($_POST['username']))
{
	$username = trim($_POST['username']);
	$age = trim($_POST['age']);
	$email = trim($_POST['email']);
	$id = trim($_POST['id']);

	$sql = "UPDATE mvn_users SET email=?, age=?, username=? WHERE id=?";

	$stmt = $conn->prepare($sql);
	$result = $stmt->execute([$email, $age, $username, $id]);
	$done = $stmt !== false ? true : false; 
	$rowsAffected = $stmt -> rowCount();
	echo " rows affected : $rowsAffected ";
}

if(isset($_POST['changepword'])){
	$password = trim($_POST['password']);
	$password = hash('sha256', $password . $salt);
	$id = trim($_POST['id']);
	$sql = "UPDATE mvn_users SET password=? WHERE id=?";
	$stmt = $conn->prepare($sql);
	$result = $stmt->execute([$password, $id]);
	$done = $stmt !== false ? true: false;
	$rowsAffected = $stmt->rowCount();
}

else if(isset($_POST['username']))
{}

if(isset($_POST['deluser'])){
echo 'delete user with id ' . $_POST['deluser'];
$id = ($_POST['id']);
$sql = "DELETE FROM mvn_users WHERE `mvn_users`.`id` = ?";
$stmt = $conn->prepare($sql);
$result = $stmt->execute([$id]);
$done = $stmt !== false ? true: false;
header('Location: index.php');
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 <!-- jQuery --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"></script> 

    <title>Admin Panel</title>
  </head>
  <body>
<h1>Admin Panel - Edit User</h1>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
    <li class="breadcrumb-item"><a href="index.php">Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit User</li>
  </ol>
</nav>

<form method="post">
      <div class="row">
        <div class="input-group mb-3 col-6">
          <div class="input-group-prepend">
            <span class="input-group-text" id="usernameBox">Username</span>
          </div>
	      <input id="username" name="username" class="form-control loginform highlightable" type="text" placeholder="username" value="<?php echo $row ['username']; ?>"/>
        </div>
      </div>

      <div class="row">
        <div class="input-group mb-3 col-6">
          <div class="input-group-prepend">
            <span class="input-group-text" id="ageBox">Age</span>
          </div>
	      <input id="age" name="age" class="form-control loginform highlightable" type="text" placeholder="age" value="<?php echo $row ['age']; ?>"/>
        </div>
      </div>

      <div class="row">
        <div class="input-group mb-3 col-6">
          <div class="input-group-prepend">
            <span class="input-group-text" id="emailBox">Email</span>
          </div>
	      <input id="email" name="email" class="form-control loginform highlightable" type="text" placeholder="email" value="<?php echo $row ['email']; ?>"/>
        </div>
      </div>

      <div class="row">
        <div class="input-group mb-3 col-6">
          <div class="input-group-prepend">
            <span class="input-group-text" id="idBox">id</span>
          </div>
	      <input readonly type="text" name="id" value="<?php echo $row ['id']; ?>"/>
        </div>
      </div>

		<div class="input-group-append">
        <button id="updateBttn" type="btn"  value="login" class="btn btn-primary btn-lg"> update </button>
		</div>
      </div>
</form>

<form method="post">
      <div class="row">
        <div class="input-group mb-3 col-6">
          <div class="input-group-prepend">
            <span class="input-group-text" id="passwordBox">Password</span>
          </div>
	      <input id="password" name="password" class="form-control loginform highlightable" type="text" placeholder="password" value="<?php echo $row ['password']; ?>"/>

		  <div class="input-group-append">
		  <input type="submit" value="Change Password" name="changepword" class="btn btn-primary">
	      </div>
	    </div>
		<input type="hidden" readonly name='id' class="form-control" type="text" value="<?php echo $row ['id']; ?>">
      </div>
</form>


<form method="post">
<button type="submit" class="btn btn-danger btn-lg" name='deluser' value=`<?php echo $row ['id']; ?>` >Delete this user</button>
<input type="hidden" readonly name='id' class="form-control" type="text" value="<?php echo $row ['id']; ?>">
</form>

    <!-- Optional JavaScript -->
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
