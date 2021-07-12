const run = () => {
    console.log("hello");
}
// this is test
function calendar() {
    var today = new Date();
    var dd = today.getDate();
    var dd2 = today.getDate() + 1;
    var mm = today.getMonth() + 1;
    var yyyy = today.getFullYear();
    if (dd < 10) {
        dd = '0' + dd
        dd2 = '0' + dd2
    }
    if (mm < 10) {
        mm = '0' + mm
    }

    today = yyyy + '-' + mm + '-' + dd;
    document.getElementById("CheckIn").setAttribute("min", today);
    document.getElementById("CheckIn").setAttribute("value", today);
    today = yyyy + '-' + mm + '-' + dd2;
    document.getElementById("CheckOut").setAttribute("min", today);
    document.getElementById("CheckOut").setAttribute("value", today);
}



function checkcalendar() {



    var checkin = document.getElementById("CheckIn");
    var checkout = document.getElementById("CheckOut");
    var checkinval = checkin.value;
    var checkoutval = checkout.value;


    if (checkinval >= checkoutval) {
        var newDate = new Date(checkinval);
        newDate.setDate(newDate.getUTCDate() + 1);
        var futureDate = newDate.getFullYear() + '-' + ('0' + (newDate.getMonth() + 1)).slice(-2) + '-' + ('0' + (newDate.getDate())).slice(-2);
        checkout.value = futureDate;
    }
}