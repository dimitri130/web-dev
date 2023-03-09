<?php
include '../includes/db.php'?>

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
    <!-- Optional JavaScript -->
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<table class="table table-striped table-bordered table-responsive">
<thead class="thead-dark">
<tr>
<th scope="col">Username</th>
<th scope="col">Email</th>
<th scope="col">password</th>
<th scope="col">age</th>
</tr>
</thead>
<tbody>

<?php

function printUsersTable():void{
	global $conn;

	$sql = 'SELECT * from `mvn_users`';
	$stmt = $conn->query($sql);
	while ($row = $stmt->fetch()){
		echo '<tr>';
		echo '<td>';
		echo $row['username'];	
		echo '</td>';
		
		echo '<td>';
		echo "<a href='edit-user.php?id=" .$row['id']. "'>". $row['email']. "</a>";	
		echo '</td>';

		echo '<td>';
		echo $row['password'];	
		echo '</td>';

		echo '<td>';
		echo $row['age'];	
		echo '</td>';
		echo '</tr>';
	}
}
printUsersTable();
?>

</tbody>
</table>
  </body>
</html>

