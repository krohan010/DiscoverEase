const dashboard = document.getElementById("dashboard");
let btnUpdate = document.getElementById("btnUpdate");
let updateForm = document.getElementById("updateForm");
let nationality = document.getElementById("nationality");

// Drop-down menu for Nationality
let stateArr = ['Indian', 'Bangladeshi', 'Nepali', 'Russian', 'American', 'Chinese', 'Brazilian'];
stateArr.forEach(state =>{
    nationality.innerHTML += `<option value='${state}'>${state}</option>`;
    // document.write(`<option value='${state}'>${state}</option>`);
})

function confirmDelete(){
    if (confirm("Are you sure you want to delete your account? This action cannot be undone.")) {
        document.getElementById("deleteForm").submit();
    }
}


btnUpdate.addEventListener("click", function(){
    dashboard.style.filter="blur(5px)";
    updateForm.style.display="flex";
});



let close = document.getElementById("cross");

close.addEventListener("click", function(){
    dashboard.style.filter="none";
    updateForm.style.display="none";
});



