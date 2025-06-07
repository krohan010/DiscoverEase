const mssgbox = document.getElementById("mssgbox");
const p = document.getElementById('mssg');
let mssg ;
function ValidateForm(){

    const username = document.forms['signup']['name'].value;
    const email = document.forms['signup']['email'].value;
    const password = document.forms['signup']['password'].value;
    const cpassword = document.forms['signup']['cpassword'].value;
    const loginAs = document.forms['signup']['loginAs'].value;
    const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    
    if(username==='' || email==='' || password==='' || cpassword==='' || loginAs=== ""){
        printError("All Fields must filled");
        return false;
    }
    else if (!passwordPattern.test(password)) {
        printError("Password must be at least 8 characters long and include an uppercase letter, a lowercase letter, a number, and a special character.");
        return false;
    }
    else if(password != cpassword){
        printError("Password and confirm-Password must match");
        return false;
    }
    // else{
    //     printSuccess("You Have Successfully Registered yourself.");
    //     return true;
    // }
    // mssgbox.style.display="block";
}

function printError(mssg){
    if(mssgbox.classList.contains('success')){
        mssgbox.classList.remove('success');
    }
    mssgbox.classList.toggle('danger');
    p.innerHTML=mssg;
 }
 function printSuccess(mssg){
    if(mssgbox.classList.contains("danger")){
        mssgbox.classList.remove("danger");
    }
    mssgbox.classList.toggle("success");
    p.innerText=mssg;
 }

let p_visibility = document.getElementById("p_visibility");
let cp_visibility = document.getElementById("cp_visibility");

p_visibility.onclick = function(){
    if(password.type=="password"){
        password.type="text";
        p_visibility.src="eye-hide-icon.png";
    }
    else{
        password.type="password";
        p_visibility.src="eye-on-icon.png";
    }
}

cp_visibility.onclick = function(){
    if(cpassword.type=="password"){
        cpassword.type="text";
        cp_visibility.src="eye-hide-icon.png";
    }
    else{
        cpassword.type="password";
        cp_visibility.src="eye-on-icon.png"
    }
}