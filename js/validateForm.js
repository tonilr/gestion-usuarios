//Check if username is empty
function validate_username(){
	let username = document.getElementById("username").value;
	if (username == "") {
		document.getElementById("usernameMessage").innerHTML = "Username is necessary";
	}else{
		document.getElementById("usernameMessage").innerHTML = "";
		check_username();
	}
}

//Check if email is empty
function validate_email(){
	// console.log(String.fromCharCode(46));
	let email = document.getElementById("email").value;
	if (email == "") {
		document.getElementById("emailMessage").innerHTML = "Email is necessary";
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
			document.getElementById("emailMessage").innerHTML = "";
			check_email();
		}else{
			document.getElementById("emailMessage").innerHTML = "Your email is not valid";
		}
	}
}

//check if password is empty and his strength
function validate_password(){
	let pass = document.getElementById("password1").value;
	if (pass == "") {
		document.getElementById("password_warning").innerHTML = "Password is necessary";
		document.getElementById("pass1Field").value=false;
	}else{
		if(pass.length < 8) { //minimum 8 chars
			document.getElementById("password_warning").innerHTML = "8 characters minimum";
			document.getElementById("pass1Field").value=false;
		}else{
			let characters = pass.split(""); //array chars
			let mayus = 0; //count Upper chars
			let minus = 0; //count lower chars
			let nums  = 0; //count int numbers

			//check if contains a num or minus or mayus
			for (n = 0; n < characters.length; n++){ //check char by char
				if(characters[n] == parseInt(characters[n])){ //if is num
					nums++;
				}else	if (characters[n] == characters[n].toLowerCase()){ //if minus
					minus++;
				}else if (characters[n] == characters[n].toUpperCase()){ //if mayus
					mayus++;
				}
			}

			if (nums != 0 && minus != 0 && mayus != 0){ //check if have nums, minus and mayus
				document.getElementById("password_warning").innerHTML = "";
				document.getElementById("pass1Field").value=true;
				//If the password is valid, trigger the check of password 2
				validate_password2();
			}else{ //show error
				document.getElementById("password_warning").innerHTML = "Password needs uppercase, lowercase and numbers";
				document.getElementById("pass1Field").value=false;
			}
		}
	}
}

//check if password is empty or if pass and pass2 are different.
function validate_password2(){
	let pass = document.getElementById("password1").value;
	let pass2 = document.getElementById("password2").value;
	if (pass2 == "") {
		document.getElementById("password_warning2").innerHTML = "Password is necessary";
		document.getElementById("pass2Field").value=false;
	}else if (pass != pass2){
		document.getElementById("password_warning2").innerHTML = "Passwords don't match";
		document.getElementById("pass2Field").value=false;
	}else{
		document.getElementById("password_warning2").innerHTML = "";
		document.getElementById("pass2Field").value=true;
	}
}
