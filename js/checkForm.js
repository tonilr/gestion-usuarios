function check_username(){
    let username=document.getElementById("username").value;
    return $.ajax({ //Ajax
        url:"php/checkUser.php", //Php fyle that validates
        data: {username:username}, //the username
        type: "POST", //Type of method
        
        success: function(response){ //If the anwser of checkForm is correct
            if (response == 0){ //If there is no username in the database
                // $("#usernameMessage").removeClass("messageWarning");
                $("#usernameMessage").html("");
                $("#usernameField").prop("value",true);
                // console.log (0);
            }else{
                $("#usernameMessage").addClass("messageWarning");
                $("#usernameMessage").html("User not available");
                $("#usernameField").prop("value",false);
                // console.log(1);
            }
        },
        error: function(){
            console.log("error");
        }
    });
}

function check_email(){
    let email=document.getElementById("email").value;
    return $.ajax({ //Ajax
        url:"php/checkEmail.php", //Php file that validates
        data: {email:email}, //the username
        type: "POST", //Type of method
        
        success: function(response){ //If the anwser of checkForm is correct
            if (response == 0){ //If there is no email in the database
                $("#emailMessage").html("");
                $("#emailField").prop("value",true);//Set the hidden value to true
                // console.log (0);
            }else{ //If there is an email
                $("#emailMessage").addClass("messageWarning"); //Show the alert
                $("#emailMessage").html("Email already registered");
                $("#emailField").prop("value",false); //Set the hidden value to false
                // console.log(1);
            }
        },
        error: function(){
            console.log("error");
        }
    });
}

function checkFields(){
    //Check the 
    $username=document.getElementById("usernameField").value;
    $email=document.getElementById("emailField").value;
    $pass1=document.getElementById("pass1Field").value;
    $pass2=document.getElementById("pass2Field").value;
    $
    if ($email=="false" || $username=="false" || $pass1=="false" || $pass2=="false"){
        document.getElementById("sendButton").type="button";
    }else{
        document.getElementById("sendButton").type="submit";
    }
}