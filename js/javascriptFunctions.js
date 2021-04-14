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
function modal(){
    // Get the modal
    var modal = document.getElementById("myModal");

    

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("closeModal")[0];

    // When the user clicks the button, open the modal 
    
    modal.style.display = "block";
    

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
    modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}