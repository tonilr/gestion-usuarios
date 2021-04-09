//Check if username is empty
function validate_username(){
	let username = document.getElementById("username").value;
	if (username == "") {
		document.getElementById("username_warning").innerHTML = "Username is necessary";
	}else{
		document.getElementById("username_warning").innerHTML = "";
		return true;
	}
}

//Check if email is empty
function validate_email(){
	// console.log(String.fromCharCode(46));
	let email = document.getElementById("email").value;
	if (email == "") {
		document.getElementById("email_warning").innerHTML = "Email is necessary";
	}else{
		//Check if the email has a valid format
		let characters = email.split("");
		// console.log(characters);
		// console.log(characters.length);
		let at = 0;
		let dot = 0;
		//Check if the email has an "@" not followed by a "."
		for(n=0;n<characters.length;n++){
			if(characters[n] == "@" && characters[n+1]!="."){
				at++;
				// console.log(at);
			}
		}
		//Check 
		if(characters[characters.length-4] == String.fromCharCode(46) || characters[characters.length-3] == String.fromCharCode(46) ){
			// console.log("dot");
			dot++;
		}
		// console.log(at);
		// console.log(dot);
		if (at==1 && dot==1){
			document.getElementById("email_warning").innerHTML = "";
		}else{
			document.getElementById("email_warning").innerHTML = "Your email is not valid";
		}
	}
}

//check if password is empty and his strength
function validate_password(){
	let pass = document.getElementById("password1").value;
	if (pass == "") {
		document.getElementById("password_warning").innerHTML = "Password is necessary";
	}else{
		if(pass.length < 8) { //minimum 8 chars
			document.getElementById("password_warning").innerHTML = "8 characters minimum";
		}else{
			let characters = pass.split(""); //array chars
			let mayus = 0; //count Upper chars
			let minus = 0; //count lower chars
			let nums  = 0; //count int numbers
			let spec  = 0; //count special chars

			//check if is contains a num or minus or mayus
			for (n = 0; n < characters.length; n++){ //check char by char
				if(characters[n] == parseInt(characters[n])){ //if is num
					nums++;
				}else	if (characters[n] == characters[n].toLowerCase()){ //if minus
					minus++;
				}else if (characters[n] == characters[n].toUpperCase()){ //if mayus
					mayus++;
				}
			}

			//check if exist some special char
			special_chars = "[-’/`~!¡#*$@_%+=.,^&(){}[|;:<>?¿]"; //special chars allowed
			for (n = 0; n < characters.length; n++){ //check char by char
				if(special_chars.includes(characters[n])) {
					spec++;
					minus = minus-spec; //the special character was previously previously counted as lowercase
				}
			}
			//console.log("n: "+nums, "m: "+minus, "M: "+mayus, "S: "+spec, "T: "+characters.length); //shows password minus, mayus, nums and specialchars

			if (nums != 0 && minus != 0 && mayus != 0 && spec != 0){ //check if have nums, minus, mayus and specs
				document.getElementById("password_warning").innerHTML = "";
				return true
			}else{ //shows error
				document.getElementById("password_warning").innerHTML = "Password needs uppercase, lowercase, numbers and special chars";
			}
		}
	}
}

//check if password is empty an shows an error and if pass and pass2 are different.
function validate_password2(){
	let pass = document.getElementById("password1").value;
	let pass2 = document.getElementById("password2").value;
	if (pass2 == "") {
		document.getElementById("password_warning2").innerHTML = "Password is necessary";
	}else if (pass != pass2){
		document.getElementById("password_warning2").innerHTML = "Passwords don't match";
	}else{
		document.getElementById("password_warning2").innerHTML = "";
		return true;
	}
}

//check the fields and return true or false. If true, the form will be submitted
function validate_register() {
	if (validate_username() && validate_password() && validate_password2()){
		return true;
	}else{
		return false;
	}
}