<!doctype html>
<html lang="en">
	<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>String Methods</title>
    </head>
	
    <body>
	
<div class="container">
<?php 
$n=5;
$nHash=hash('sha256', $n);
echo $nHash;

$bFormSubmitted= isset($_POST['num1_hash']);
if($bFormSubmitted){
	$userInput = trim($_POST['num1']);
	$num1_hash = trim($_POST['num1_hash']);

	if(hash('sha256', $userInput) === $num1_hash)
		echo "<h1>congrats</h1>";
	else
		echo "<h1>fail</h1>";
}

?>
<form method="post">
<div class="row">
<div id = 'div1' class="input-group mb-3">
<div class="input-group-prepend">
<span class="input-group-text"> Enter the number</span>
</div>
<input name = "num1" class="form-control loginfrom highlightable" type = "number" />
</div>

<div id='div2' class="input-group mb-3">
<div class="input-group-prepend">
<span class="input-group-text"> Enter the number </span>
</div>
<input name="num1_hash" value="<?php echo $nHash;?>" class="form-control loginform highlightable" type="text" readonly />
</div>
<div class='ml-5 mt-3'> 
<input type="submit" value="submit" class="btn btn-lg btn-primary">
</div>
</div>
</form>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
