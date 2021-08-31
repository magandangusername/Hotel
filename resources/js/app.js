require('./bootstrap');

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



function checkcalendarin() {
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

function checkcalendarout() {
    var checkin = document.getElementById("CheckIn");
    var checkout = document.getElementById("CheckOut");
    var checkinval = checkin.value;
    var checkoutval = checkout.value;


    if (checkinval >= checkoutval) {
        var newDate = new Date(checkoutval);
        newDate.setDate(newDate.getUTCDate() - 1);
        var futureDate = newDate.getFullYear() + '-' + ('0' + (newDate.getMonth() + 1)).slice(-2) + '-' + ('0' + (newDate.getDate())).slice(-2);
        checkin.value = futureDate;
    }
}

document.addEventListener("DOMContentLoaded", function() {
    // make it as accordion for smaller screens
    if (window.innerWidth > 992) {

        document.querySelectorAll('.navbar .nav-item').forEach(function(everyitem) {

            everyitem.addEventListener('mouseover', function(e) {

                let el_link = this.querySelector('a[data-bs-toggle]');

                if (el_link != null) {
                    let nextEl = el_link.nextElementSibling;
                    el_link.classList.add('show');
                    nextEl.classList.add('show');
                }

            });
            everyitem.addEventListener('mouseleave', function(e) {
                let el_link = this.querySelector('a[data-bs-toggle]');

                if (el_link != null) {
                    let nextEl = el_link.nextElementSibling;
                    el_link.classList.remove('show');
                    nextEl.classList.remove('show');
                }


            })
        });

    }
    // end if innerWidth
});
// DOMContentLoaded  end



function rooms(n) {
    var adult2l = document.getElementById("adultcount2l");
    var adult2i = document.getElementById("adultcount2i");
    var child2l = document.getElementById("childadult2l");
    var child2i = document.getElementById("childadult2i");

    var adult3l = document.getElementById("adultcount3l");
    var adult3i = document.getElementById("adultcount3i");
    var child3l = document.getElementById("childadult3l");
    var child3i = document.getElementById("childadult3i");


    if (n >= 2) {
        adult2l.hidden = false;
        adult2i.hidden = false;
        child2l.hidden = false;
        child2i.hidden = false;
    } else {
        adult2l.hidden = true;
        adult2i.hidden = true;
        child2l.hidden = true;
        child2i.hidden = true;
    }
    if (n == 3) {
        adult3l.hidden = false;
        adult3i.hidden = false;
        child3l.hidden = false;
        child3i.hidden = false;
    } else {
        adult3l.hidden = true;
        adult3i.hidden = true;
        child3l.hidden = true;
        child3i.hidden = true;
    }
}