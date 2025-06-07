function vehicleValidateForm(){

    const source = document.forms['vehicle']['source'].value;
    const destination = document.forms['vehicle']['destination'].value;
    const  startDate = document.forms['vehicle']['startDate'].value;
    const endDate = document.forms['vehicle']['endDate'].value;
    const coutTraveller = document.forms['vehicle']['traveller'].value;

    if(source==='' || destination==='' || startDate==='' || endDate==='' || countTraveller=== ""){
        // printError("All Fields must filled");
        alert("All fields must be fiill");
        return false;
    }

}

