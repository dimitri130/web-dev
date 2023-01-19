<?php
declare(strict_types=1);
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

    <title>PHP and Server settings</title>
  </head>
  <body>
	<div class="container">
<div class="row">
<div class ="col-12">
<h1> Forms </h1>

<?php

function formOk():bool{
	
$bFormSubmitted = isset($_POST['num1']);

if($bFormSubmitted && strlen($_POST['num1'])>0)
	return true;
else
	return false;

}

if (formOk()){
	$num = $_POST['num1'];
	echo 'You entered <b> ' . $num . '</b>';
}


?>

<form method ="post">
<label> Num 1: </label> <input type="text" name="num1" id="num1" value="3" placeholder="Enter a Number" />
<br />
<input type="submit" value="Submit" />
</form>

	<?php
//phpinfo();
//var_dump($_SERVER);

//echo $_SERVER["DOCUMENT_ROOT"];
//echo ' <br />';
//echo $_SERVER["HTTP_HOST"];
//echo ' <br />';
//echo $_SERVER["PHP_SELF"];

//var_dump($_GET);
//phpinfo();

//$foo = "1";
//var_dump($foo);
//echo '<br>';

//$foo = $foo*2;
//var_dump($foo);

//echo '<br>';

//$foo = $foo*1.3;
//var_dump($foo);

//echo '<br>';

//$name = "Foo";
//echo "hi ". $name;
//echo '<br>';
//echo "hi $name";
//echo '<br>';
//echo 'hi $name';

//function getGreeting(): string{
//	return "<b> Welcome to our site </b>";
//}
//	$result = getGreeting();
//	echo $result;

	
//$a='1';
//$b = 2;

//function doMath(int $a, int $b):void{
//	echo $a + $b;
//}
//doMath($a + $b);

//function greetUser(string $name):string{
//	return "Hello $name, welcome to our site!";
//}
//$greeting = greetUser("Jim");
//echo $greeting;
//
//function makeTags(string $tag, string $word):string{
//return "<$tag>$word</$tag>";
//}
//echo makeTags("i", "hello");
//
//function increaseBy1(&$num):void{
//	$num++;
//}
//$count = 5;
//increaseBy1($count);
//echo $count;

//function multiplesOf5(int $howMany):void{
//	$num = 5;
//	while($howMany>0){
//	echo $num;			
//	echo '<br />';
//	$num+=5;	
//	$howMany--;
//	}
//}
//multiplesOf5(4);

//function printFactors(int $n):void{
//	for($i=1;$i<=$n;$i++){
//		if($n%$i==0)
//		{echo $i .'<br>';}
//	}
//}
//printFactors(15);

//$email = "foo@foo.com";
//echo strpos($email, "@");
//echo '<br>';
//echo strpos($email, ".");
//echo '<br>';
//echo strpos($email, "!");
//echo false===strpos($email, "!");

$debug = true;
function isEmail(string $email):bool{
	global $debug;
	if(strpos($email, ".")===false){
		if($debug)
			echo 'no dot, <br />';
		return false;
	}
	if(strpos($email, "@")===false){
		if($debug)
			echo 'no @, <br />';
		return false;
	}
	return true;
}
$yourEmail = "foofoo.com";
if(isEmail($yourEmail)){
	echo "<span class='info'>$yourEmail is a valid email address</span>";
}
	else{
	echo "<span class='warning'> $yourEmail is not a valid email address</span>";}

	?>
	
<?php 
	//$num=4;
//	if($num>5)
//	{
?>
	<!-- p> This html prints if the php variable is greater than 5</p >
<?php
	//}
	//else
	//{
?>
	<p>This html prints if the variable is less than or equal to 5</p--> 
	<?php
	//}
?>

</div>
</div>
</div>
    <!-- Optional JavaScript -->
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
