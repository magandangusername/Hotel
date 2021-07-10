const run = () => {
    console.log("hello");
};

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