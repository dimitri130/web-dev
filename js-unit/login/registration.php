<?php 
declare(strict_types=1);
require('../../includes/db.php');

$debug = false;

if($debug == true)
var_dump($_POST);

$recaptchaData = recaptcha();
$captchaHash = hash('sha256', strval($recaptchaData['sum']));
$feedback = '';

function recaptcha():array{
	$n1=mt_rand(1,20);
	$n2=mt_rand(1,20);
	$arr = array(
		'n1'=> $n1,
		'n2'=> $n2,
		'sum'=>$n1 + $n2);
	return $arr;
}

	function validEmail(string $email):bool{
		$email = trim($email);
		if(strlen($email)<5)
			return false;
		$atAt = strpos($email, '@');
		$dotAt = strpos($email, '.' );
		if(false === $dotAt)
			return false;
		if(false ===$atAt)
			return false;
		if($dotAt<$atAt)
			return false;
		return true;
}
	function validUsername(string $username):bool{
		$username = trim($username);
		if(strlen($username)<5)
			return false;
		return true;
	}

	function validPassword(string $pword):bool{
		$pword = trim($pword);
		if(strlen($pword)<5)
			return false;
		$dollarAt = strpos($pword, '$');
		$asteriskAt = strpos($pword, '*');
		if(!false === $dollarAt)
			return false;
		if(!false === $asteriskAt)
			return false;
		return true;
}

	function validAge(string $age):bool{
		$age = trim($age);
		if($age<18)
			return false;
		return true;
	}


$bFormSubmitted = isset($_POST['email1']);

if ($bFormSubmitted ===true){
	$email1 = $_POST['email1'];
	$email2 = $_POST['email2'];
	$username = $_POST['username'];
	$pword = $_POST['pword'];
	$age = $_POST['age'];

	$bValidEmail = validEmail($email1);
	if($email1 != $email2)
		$feedback .= 'Your emails do not match' . '<br>';
	else if(false===$bValidEmail)
		$feedback .=  $_POST['email1'] . ' is not valid' . '<br>' ;

	$bValidUsername = validUsername($username);
	if(false===$bValidUsername)
		$feedback .= $_POST['username'] . ' is not valid' . '<br>';

	$bValidPword = validPassword($pword);
	if(false === $bValidPword)
		$feedback .= $_POST['pword'] . ' is not valid' . '<br>';

	$bValidAge = validAge($age);
	if(false===$bValidAge)
		$feedback .= $_POST['age'] . ' is not valid' . '<br>';


	if(hash('sha256', strval($_POST['antibotanswer'])) != $_POST['captchaAns']){
		if(strlen($_POST['antibotanswer'])<1){
			$feedback .= 'Please answer the anti-bot question.' . '<br>';
		}
		else{
		$feedback .= $_POST['antibotanswer'] .  ' is not correct' . '<br>';
		}
	}

	if(strlen($feedback)<1){
		register($email1, $pword, intval($age), $username);
		header('Location: dashboard.php');
	}
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

    <title>Registration</title>
  </head>

  <body>
	  <div class="h1 p-2 font-weight-bold text-center">Register for Mr M.'s Premium Content</div>
	  <div class="text-center h6 ml-4 mr-4 d-block border rounded p-4"> Upgrade your <u>life</u> by accessing these premium educational content including a calculator that will tell you how many years you have been alive!!</div>

	  <form id="regform" method="post" action = "" class="border rounded m-4">
		<div class="container col-12">
		<div class="row border rounded">
			<div class="col-8 d-inline">

				<div class="input-group mt-3 mb-3">
          			<div class="input-group-prepend">
            			<span class="input-group-text" id="usernameBox">Username</span>
          			</div>
          			<input type="text" class="form-control" name="username" id="username" placeholder="Username123" aria-label="username" aria-describedby="usernameBox">
        		</div>

				<div class="input-group mb-3">
          			<div class="input-group-prepend">
            			<span class="input-group-text" id="ageBox">Age</span>
          			</div>
          			<input type="text" class="form-control" name="age" id="age" placeholder="#" aria-label="age" aria-describedby="ageBox">
        		</div>
			</div>

			<div class="col-4 border-left d-inline ">
				<div class="form-check">
					<label class="form-check-label">
					<input type="radio" class="form-check-input" name="gender" value="male" id="m"> Male
					</label>
				</div>
				<div class="form-check">
					<label class="form-check-label">
					<input type="radio" class="form-check-input" name="gender" value="female" id="f"> Female 
					</label>
				</div>
				<div class="form-check">
					<label class="form-check-label">
					<input type="radio" class="form-check-input" name="gender" value="other" id="Other"> Other 
					</label>
				</div>
			</div>
		</div>

		<div class="row border rounded">
			<div class="col-12">

				<div class="input-group mt-3 mb-3">
          			<div class="input-group-prepend">
            			<span class="input-group-text" id="passwordBox">Password</span>
          			</div>
          			<input type="text" class="form-control" name="pword" id="pword" placeholder="password123" aria-label="password" aria-describedby="passwordBox">
        		</div>

				<div class="input-group mt-3 mb-3">
          			<div class="input-group-prepend">
            			<span class="input-group-text" id="emailBox">Email</span>
          			</div>
          			<input type="text" class="form-control" name="email1" id="email1" placeholder="email@gmail.com" aria-label="email1" aria-describedby="emailBox">
        		</div>

				<div class="input-group mt-3 mb-3">
          			<div class="input-group-prepend">
						<span class="input-group-text" name="emailBox2" id="emailBox2">Email</span>
          			</div>
          			<input type="text" class="form-control" name="email2" id="email2" placeholder="email@gmail.com" aria-label="email2" aria-describedby="emailBox2">
        		</div>

		<div class="input-group mb-3  ">
                  <div class="input-group-prepend ">
				  <span class="input-group-text" ><span id="botq"> What is <?php echo $recaptchaData['n1']; ?> + <?php echo $recaptchaData['n2'];?> </span> </span>
                  </div>
                  <input class="form-control loginform" type="number" name="antibotanswer" id="antibotanswer" value='' placeholder="enter solution"  />
                </div>
		</div>
		</div>
		<input name="captchaAns" type="hidden" value="<?php echo $captchaHash; ?>"/>
		</div>

	<div class="row">
	<div class="ml-5">
        <button id="registerBttn" type="btn" value="login" class="btn btn-primary btn-lg"> register </button>
      </div>
	</div>
	</form>

	<div class="row">
	<div id="feedback" style="display:none;" class=""></div>
	<?php 
	if($bFormSubmitted && strlen($feedback)>0){
		echo '<div class="col-12 bg-danger text-white ml-2 mt-4 p-3" >'; 
		echo $feedback; 
		echo ' </div>';
	}

?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"></script> 
 
	<script>
		let docG = (id) => {
        return document.getElementById(id);}

		let registerClicked = () =>{
				
		let errorDiv = docG("feedback");
		errorDiv.style.display="none";	
	    let usernameError= false;
		let ageError= false;
		let pwordError= false;
		let emailError= false;
		let genderError= false;
		let generalError = false;
		let usernameElem = docG("username")
		let ageElem = docG("age");
        let pwordElem = docG("pword");
		let emailElem = docG("email1");
		let emailElem2 = docG("email2");

		let usernameTest = isValidUsername(usernameElem.value);
		console.log("usernameTest: " + usernameTest);

		let ageTest = isValidAge(ageElem.value);
		console.log("ageTest: " + ageTest);

		let pwordTest = isValidPword(pwordElem.value);
		console.log("pwordTest: " + pwordTest);

		let emailTest = isValidEmail(emailElem.value);
		console.log("emailTest: " + emailTest);
		let emailTest2 = isValidEmail(emailElem2.value);
		console.log("emailTest2: " + emailTest2);			

		let genderTest = isValidGender();
		console.log("isValidGender: " + isValidGender());
		console.log("genderTest: " + genderTest);

        console.log("registerClicked()");

		if (usernameTest === false){
		  $("#feedback").fadeIn();
          errorDiv.className = "bg-danger col-12 d-block text-light m-4 p-4 mt-2 ";
          errorDiv.innerHTML = " <p> Your username does not meet the criteria </p>";
          errorDiv.innerHTML += " <ul> ";
          errorDiv.innerHTML += " <li> At least 5 characters </li>";
          errorDiv.innerHTML += " </ul>";
          usernameElem.select();
          usernameError= true;
		  generalError = true; 
				}

		if(ageTest === false){
		  $("#feedback").fadeIn();
          errorDiv.className = "bg-danger col-12 d-block text-light m-4 p-4 mt-2 ";
          errorDiv.innerHTML = " <p> You are underage go away please</p>";
          errorDiv.innerHTML += " <ul> ";
          errorDiv.innerHTML += " <li> At least 18 years of age </li>";
          errorDiv.innerHTML += " </ul>";
          ageElem.select();
          ageError = true;
		  generalError = true; 
				}

        if (pwordTest=== false) {
		  $("#feedback").fadeIn();
          errorDiv.className = "bg-danger col-12 d-block text-light m-4 p-4 mt-2 ";
          errorDiv.innerHTML = " <p> Your password does not meet the criteria </p>";
          errorDiv.innerHTML += " <ul> ";
          errorDiv.innerHTML += " <li> At least 5 characters </li>";
          errorDiv.innerHTML += " <li> NO dollar sign($) </li>";
          errorDiv.innerHTML += " <li> NO asterisk( * ) </li>";
          errorDiv.innerHTML += " </ul>";
          pwordElem.select();
          pwordError = true;
		  generalError = true; 
        }

		if(emailTest===false){
		  $("#feedback").fadeIn();
			errorDiv.className = "bg-danger col-12 d-block text-light m-4 p-4 mt-2";
					errorDiv.innerHTML = " <p> Your email does not meet the criteria </p>";
          errorDiv.innerHTML += " <ul> ";
          errorDiv.innerHTML += " <li> At least 5 characters </li>";
          errorDiv.innerHTML += " <li> Must contain the @ symbol  </li>";
          errorDiv.innerHTML += " <li> Must contain the . symbol </li>";
	      errorDiv.innerHTML += " <li> The @ symbol must come before the . symbol </li>";	
		  errorDiv.innerHTML += "<li> Your emails must match </li>";
          errorDiv.innerHTML += " </ul>";
          emailElem.select();
          emailError = true;
		  generalError = true;
				}

		 if(emailTest2===false){
		  $("#feedback").fadeIn();
			errorDiv.className = "bg-danger col-12 d-block text-light m-4 p-4 mt-2";
			errorDiv.innerHTML = " <p> Your email does not meet the criteria </p>";
          errorDiv.innerHTML += " <ul> ";
          errorDiv.innerHTML += " <li> At least 5 characters </li>";
          errorDiv.innerHTML += " <li> Must contain the @ symbol  </li>";
          errorDiv.innerHTML += " <li> Must contain the . symbol </li>";
	      errorDiv.innerHTML += " <li> The @ symbol must come before the . symbol </li>";	
		  errorDiv.innerHTML += "<li> Your emails must match </li>";
          errorDiv.innerHTML += " </ul>";
          emailElem.select();
          emailError = true;
		  generalError = true;
				}

        if (genderTest===false){
		  $("#feedback").fadeIn();
          errorDiv.className = "bg-danger col-12 d-block text-light m-4 p-4 mt-2 ";
          errorDiv.innerHTML = " <p> Please select a gender </p>";
          errorDiv.innerHTML += " <ul> ";
					errorDiv.innerHTML += " <li> Must select a gender </li>";
          errorDiv.innerHTML += " </ul>";
          genderError= true;
		  generalError = true; 
				}

        if (generalError === false) {
	      $("#feedback").fadeIn();
          errorDiv.className = "bg-info col-12 d-block text-light m-4 p-4 mt-2 ";
		  docG("regform").submit();
    }
					console.log("generalError: " + generalError);
	}
					

		let isValidUsername= (str) => 
		{ console.log("(isValidUsername" + str + ")"); 
		if (str.length<5){ return false; } 
		return true;
			  }

		let isValidAge= (num) => 
		{ console.log("(isValidAge" + num + ")"); 
		if (num<18){ return false; } 
		return true;
			  }

        let isValidPword = (str) => {
        console.log("(isValidPword " + str + ")");
        if (str.length < 5) {
          return false;
        }
        if (str.indexOf("$") > -1) {
          return false;
        }
        if (str.indexOf("*") > -1) {
          return false;
        }
        return true;
      }

		let isValidEmail = (str) => 
		{ console.log("(isValidEmail" + str + ")"); 
		let indexOfAtsign = str.indexOf("@"); 
		let indexOfPeriod = str.indexOf("."); 
		let email2 = docG("email2");
		if (str.length<5){ return false; } 
		if (indexOfAtsign<0){ return false;}
		if (indexOfPeriod<0){ return false;} 
		if (indexOfAtsign>indexOfPeriod){ return false;}	
		if(!email2.value === str){return false;}
		return true;
			  }

		let isValidEmail2 = (str) => 
		{ console.log("(isValidEmail" + str + ")"); 
		let indexOfAtsign = str.indexOf("@"); 
		let indexOfPeriod = str.indexOf("."); 
		let email = docG("email");
		if (str.length<5){ return false; } 
		if (indexOfAtsign<0){ return false;}
		if (indexOfPeriod<0){ return false;} 
		if (indexOfAtsign>indexOfPeriod){ return false;}	
		if(!email.value === str){return false;}
		return true;
			  }


		let isValidGender = () => {
			var checkRadio = document.querySelector('input[name="gender"]:checked');
            if(checkRadio === null ) {
			return false;
            }
			return true;
				}	
		
		let tempFormat = () => {
		docG("username").value="farter";
		docG("age").value="19";
		docG("pword").value="peepoopee";
		docG("email1").value="bruhhouse@gmail.com";
		docG("email2").value="bruhhouse@gmail.com";
		docG("Other").checked = true;
		}
		
		let clearAll = () =>{
		docG("username").value="";
		docG("age").value="";
		docG("pword").value="";
		docG("email1").value="";
		docG("email2").value="";
		docG("m").checked = false;
		docG("f").checked = false;
		docG("Other").checked = false;
		}

	  const pageAccessedByReload = (
  (window.performance.navigation && window.performance.navigation.type === 1) ||
    window.performance
      .getEntriesByType('navigation')
      .map((nav) => nav.type)
      .includes('reload')
);

	  window.addEventListener('load', clearAll);
      window.addEventListener('load', docG("username").select());
      window.addEventListener('load', tempFormat); 
      docG("registerBttn").addEventListener("click", registerClicked);
   
	</script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
