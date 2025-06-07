
let visibility = document.getElementById("visibility");
visibility.onclick = function(){
let password = document.getElementById("password");

    if(password.type=="password"){
        password.type="text";
        visibility.src="eye-hide-icon.png";
    }
    else{
        password.type="password";
        visibility.src="eye-on-icon.png";
    }
}

// Validate login form
function validateForm(){
    const userid = document.forms['loginForm']['userid'].value;
    const password = document.forms['loginForm']['password'].value;
    const loginAs = document.forms['loginForm']['loginAs'].value;
    if(userid==='' || password===''){
        alert("All Fields must be fill");
        return false;
    }
    else if( loginAs === "null"){
        alert("Select the appropriate option below");
        return false;
    }
    else{
        return true;
    }
}