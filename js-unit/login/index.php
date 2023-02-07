<?php

declare(strict_types = 1);
$debug = false;
if($debug==true)
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

$bFormSubmitted = isset($_POST['email1']);

if ($bFormSubmitted ===true){
	$email1 = $_POST['email1'];
	$pword = $_POST['pword1'];

	$bValidEmail = validEmail($email1);
	if(strlen($_POST['email1'])<1)
		$feedback .= 'Please input an email' . '<br>';
	else if(false===$bValidEmail)
		$feedback .=  $_POST['email1'] . ' is not valid' . '<br>' ;

	$bValidPword = validPassword($pword);
	if(strlen($_POST['email1'])<1)
		$feedback .= 'Please input a password' . '<br>';
	else if(false === $bValidPword)
		$feedback .= $_POST['pword1'] . ' is not valid' . '<br>';

	if(hash('sha256', strval($_POST['antibotanswer'])) != $_POST['captchaAns']){
		if(strlen($_POST['antibotanswer'])<1){
			$feedback .= 'Please answer the anti-bot question.' . '<br>';
		}
		else{
		$feedback .= $_POST['antibotanswer'] .  ' is not correct' . '<br>';
		}
	}

	if(strlen($feedback)<1)
		header('Location: dashboard.php');
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
    <title>User Login</title>
  </head>
  <body>
    <h1>Login to access that juicy premium content - Mr M. Online exclusive!</h1>
    <div class="container">
      <div class="row">
        <select class="form-control m-4 col-2" id="pwordselect">
          <option value=""> Password Testing</option>
          <option value="pworddollarsign">Dollar Sign in pword</option>
          <option value="pwordasterisk">Asterisks Sign in pword</option>
          <option value="pwordtooshort">Too Short</option>
          <option value="pwordallgood">Password is good</option>
        </select>
	 

        <select class="form-control m-4 col-2" id="emailselect">
          <option value=""> Email Testing</option>
		  <option value="emailnoat">No atsign in email</option>
          <option value="emailnodot">No dot in email</option>
          <option value="emailtooshort">Too Short</option>
          <option value="emailallgood">Email is good</option>
		  <option value="emaildotbeforeat">Dot before atsign</option>
        </select>
 </div>
	  <form id="regform" method="post" action = "" class="border rounded m-4">
	  <div class="row">
        <div class="input-group mb-3 col-6">
          <div class="input-group-prepend ">
            <span class="input-group-text" id="usernameBox" >Email</span>
          </div>
          <input type="text" class="form-control" name="email1" id="email1" placeholder="email@gmail.com" aria-label="username" aria-describedby="usernameBox">
        </div>
      </div>
      <div class="row">
        <div class="input-group mb-3 col-6">
          <div class="input-group-prepend">
            <span class="input-group-text" id="passwordBox">Password</span>
          </div>
          <input type="text" class="form-control" id="pword1" name="pword1" placeholder="password" aria-label="password" aria-describedby="passwordBox">
        </div>
      </div>
      <div class="row">
        <div class="input-group mb-3 col-6">
          <div class="input-group-prepend">
            <span class="input-group-text" id="botCheck">
              <span id="botq">What is <?php echo $recaptchaData['n1']; ?> + <?php echo $recaptchaData['n2'];?></span>
            </span>
          </div>
          <input type="number" class="form-control loginform" placeholder="enter solution" name="antibotanswer" id="antibotanswer" aria-label="numberCheck" aria-describedby="botCheck">
        </div>
      </div>
		<input name="captchaAns" type="hidden" value="<?php echo $captchaHash ?>"/>
      <div class="ml-5 mt-3">
        <button id="loginBtn" type="btn" value="login" class="btn btn-primary btn-lg"> login </button>
      </div>

</form>
      <div id="errormsg" style="display:none;">
 
      </div>
	<div id="errormsg2" style = "display:none;">
        
      </div>
	  <div id="errormsg3" style = "display:none;"> 
		</div>

	<?php 
	if($bFormSubmitted && strlen($feedback)>0){
		echo '<div class="col-12 bg-danger text-white mt-4 p-3" >'; 
		echo $feedback; 
		echo ' </div>';
	}

?>
    </div>
    <script>
      let docG = (id) => {
        return document.getElementById(id);
      }

      let loginClicked = (event) => {
		
        let bHasError = false;
		let cHasError=false;
		let dHasError = false;
        let pWordElem = docG("pword1");
        let bValidPword = isValidPword(pWordElem.value);
		let emailElem = docG("email1");
		let cValidEmail = isValidEmail(emailElem.value);
        console.log("bValidPword : " + bValidPword);
		console.log("cValidEmail : " + cValidEmail);
        console.log("loginClicked()");

        let errorDiv = docG('errormsg');
        if (bValidPword === false) {
		  $("#errormsg").fadeIn();
          errorDiv.className = "bg-danger text-light m-4 p-4 mt-2 ";
          errorDiv.innerHTML = " <p> Your password does not meet the criteria </p>";
          errorDiv.innerHTML += " <ul> ";
          errorDiv.innerHTML += " <li> At least 5 characters </li>";
          errorDiv.innerHTML += " <li> NO dollar sign($) </li>";
          errorDiv.innerHTML += " <li> NO asterisk( * ) </li>";
          errorDiv.innerHTML += " </ul>";
          pWordElem.select();
          bHasError = true;
        }

		let errorDiv2 = docG('errormsg2');
		if(cValidEmail===false){
		  $("#errormsg2").fadeIn();
			errorDiv2.className = "bg-danger text-light m-4 p-4 mt-2";
					errorDiv2.innerHTML = " <p> Your email does not meet the criteria </p>";
          errorDiv2.innerHTML += " <ul> ";
          errorDiv2.innerHTML += " <li> At least 5 characters </li>";
          errorDiv2.innerHTML += " <li> Must contain the @ symbol  </li>";
          errorDiv2.innerHTML += " <li> Must contain the . symbol </li>";
	      errorDiv2.innerHTML += " <li> The @ symbol must come before the . symbol </li>";	
          errorDiv2.innerHTML += " </ul>";
          emailElem.select();
          cHasError = true;
				}

				
        if (bHasError === false) {
					$("#errormsg").fadeOut();}
		if(cHasError === false){
					$("#errormsg2").fadeOut();}	
      
		if (dHasError === false){
					$("#errormsg3").fadeOut();}
    }


		let isValidEmail = (str) => 
		{ console.log("(isValidEmail " + str + ")"); 
		let indexOfAtsign = str.indexOf("@"); 
		let indexOfPeriod = str.indexOf("."); 
		if (str.length<5){ return false; } 
		if (indexOfAtsign<0){ return false;}
		if (indexOfPeriod<0){ return false;} 
		if (indexOfAtsign>indexOfPeriod){ return false;}	
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

      docG("loginBtn").addEventListener("click", loginClicked);
      let pWordSelect = docG("pwordselect");
      pWordSelect.addEventListener('change', function(e) {

        let selected = pWordSelect.value;
        console.log(selected);
        const CASE_PWORD_TOO_SHORT = 'pwordtooshort';
        const CASE_PWORD_HAS_DOLLARSIGN = 'pworddollarsign';
		const CASE_PWORD_HAS_ASTERISK = 'pwordasterisk';
		const CASE_PWORD_ALLGOOD = 'pwordallgood';
        let pWordElem = docG("pword1");
        if (selected == CASE_PWORD_TOO_SHORT) {
					pWordElem.value = "abc";	} 
		if (selected == CASE_PWORD_HAS_DOLLARSIGN) {
          pWordElem.value = "abcde$"; }
        if (selected == CASE_PWORD_HAS_ASTERISK) {
          pWordElem.value = "abcde*";
        }
        if (selected == CASE_PWORD_ALLGOOD) {
          pWordElem.value = "abcde";
        }
        loginClicked();
      });
	let emailSelect = docG("emailselect");
		emailSelect.addEventListener('change', function(e){
			let selected = emailSelect.value;
			console.log(selected);
			const CASE_EMAIL_TOO_SHORT = 'emailtooshort';
			const CASE_EMAIL_NO_AT  = 'emailnoat';
			const CASE_EMAIL_NO_DOT = 'emailnodot';
			const CASE_EMAIL_ALLGOOD = 'emailallgood';
			const CASE_EMAIL_DOT_FIRST = 'emaildotbeforeat'
			
			let emailElem = docG('email1');
					if (selected == CASE_EMAIL_TOO_SHORT){
							emailElem.value = "a@j."}
					if (selected == CASE_EMAIL_NO_AT){
							emailElem.value = "abcdejoe.com"}
					if (selected == CASE_EMAIL_NO_DOT){
							emailElem.value = "abcde@joecom"}
					if (selected == CASE_EMAIL_ALLGOOD){
							emailElem.value = "abcde@joe.com"}
					if (selected == CASE_EMAIL_DOT_FIRST){
							emailElem.value = "abcde.joe@com"}
					loginClicked();
				});


    </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
