<?php
declare(strict_types=1);

$debug = true;
if($debug==true)
	var_dump($_POST);

$feedback = '';

function gregify(array $words): string{
$length = count($words);

for($i=0; $i<$length; $i++){
	if(rand(0, 10)>5){
		$words[$i] = "greg";
	}
}
return implode(" ", $words);
}

function greginate(array $words): string{
	$length = count($words);

	for($i=0; $i<$length; $i++){
		$tempWord = $words[$i];
		if (rand(0, 10)>2){
			$words[$i] = substr_replace($tempWord, 'greg', rand(0, strlen($tempWord)-1), 0);	
			}	
	}
	return implode(" ", $words);
}

function validGregify(string $input): bool{
	if(strpos($input, " ") === false){
		return false;
	}
	else return true;
}
function validGreginator(string $input): bool{
	if(strpos($input, " ") === false){
		return false;
	}
	else return true;
}


$bFormSubmitted = isset($_POST['gregifier']);
$cFormSubmitted = isset($_POST['greginator']);
if($bFormSubmitted===true && $_POST['gregifier']>0){
	
	$bValidInput1 = validGregify($_POST['gregifier']);

	$input1 = explode(" ", $_POST['gregifier']);
	
	if ($bValidInput1 === false){
		$feedback .=  $_POST['gregifier'] . ' is not valid. Please input a sentence separated with spaces.' . '<br>';
		
	}
	
	$output1 = gregify($input1);
}

if($cFormSubmitted === true && $_POST['greginator']>0){

	$bValidInput2 = validGreginator( $_POST['greginator']);
	$input2 = explode(" ", $_POST['greginator']);

	if ($bValidInput2 === false){
	$feedback .=  $_POST['greginator'] . ' is not valid. Please input a sentence separated with spaces.' . '<br>' ;
	}
   	$output2 = greginate($input2);	
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

    <title>Greginator</title>
  </head>
  <body>
    <div class="h1 p-2 font-weight-bold text-center">Get ready to Greg. The all new Greginator9000 has finally arrived. NOw the wait is over. EMBRACE IT. AcCEPT THE GREG.</h1>
<hr>
<form id="regform" method="post" action = "" class="border rounded m-4">
<div class="container col-12">
<div class="d-flex">
<div class="row">
<!-- replaces words randomly from text with greg - the more intense gregification the more words replaced-->
	<div class="input-group mt-3 mb-3">
   	<div class="input-group-prepend">
  	<span class="input-group-text" id="gregifierBox">Gregifier</span>
 	</div>
	<input type="text" class="form-control" name="gregifier" id="gregifier" placeholder="input pre-gregified sentence here" aria-label="gregified" aria-describedby="gregifierBox">
	<button id="gregifierBtn" type="btn" value="gregifierBtn" class="btn btn-primary"> gregify me</button>
    </div>
<!-- translates text into Greglish - Greglish dictionary to be determined-->
	<div class="input-group mt-3 mb-3">
   	<div class="input-group-prepend">
  	<span class="input-group-text" id="greginatorBox">Greginator</span>
 	</div>
	<input type="text" class="form-control" name="greginator" id="greginator" placeholder="input pre-greginated sentence here" aria-label="greginated" aria-describedby="">
	<button id="greginatorBtn" type="btn" value="greginatorBtn" class="btn btn-primary"> gregination time baby</button>
        		</div>
<div name="output" id="output" class="p-3">
	<?php 
	if($bFormSubmitted && strlen($feedback)>0){
		echo '<div class="col-12 bg-danger text-white mt-4 p-3" >'; 
		echo $feedback; 
		echo ' </div>';
	}
if(strlen($feedback)<1 && strlen($_POST['gregifier'])>1){
		echo '<div class="col-12 bg-info text-white mt-4 p-3" >'; 
		echo $output1; 
		echo ' </div>';
	}
	if(strlen($feedback)<1 && strlen($_POST['greginator'])>1){
		echo '<div class="col-12 bg-info text-white mt-4 p-3" >'; 
		echo $output2; 
		echo ' </div>';
	}
?>
</div>
</div>
</div>
	</form>
    <!-- Optional JavaScript -->
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
