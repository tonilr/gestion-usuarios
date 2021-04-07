function togglepasswordsignup(){
    let pass1=document.getElementsByClassName("passwordField")[0];
    let pass2=document.getElementsByClassName("passwordField")[1];
    if (pass1.type==="password"){
        pass1.type="text";
        pass2.type="text";
    }else{
        pass1.type="password";
        pass2.type="password";
    }
}
function togglepasswordsignin(){
    let pass1=document.getElementsByClassName("passwordField")[0];
    if (pass1.type==="password"){
        pass1.type="text";
    }else{
        pass1.type="password";
    }
}