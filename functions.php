<?php
//if ($url === 'index.php' || $url === 'roomtab.php' || $url === 'reservation.php' || $url === 'checkout.php') {
    /*
    my notes:
    - add validation function
    - add csrf(optional)
    */

    if (isset($_POST['checkavail'])) {
      //echo date("Y-m-d");

      $checkin = $_POST['CheckIn'];
      $checkout = $_POST['CheckOut'];
      if (isset($_POST['roomcount'])) {
        $rooms = $_POST['roomcount'];
      }
      $adult = $_POST['guestcount'];
      $child = $_POST['guestcountchild'];

      $totalrooms = "SELECT COUNT(room_number) AS total_rooms FROM room_status";
    //   $totalsuites = "SELECT COUNT(suite_number) AS total_suites FROM suite_list";
      $total = $conn->query($totalrooms);
      $total = $total->fetch_row();
    //   $ts = $conn->query($totalsuites);
    //   $ts = $ts->fetch_row();
    //   $total = $tr[0] + $ts[0];

      //echo $total;

      $command = "SELECT COUNT(confirmation_number) AS rooms FROM reservation_table WHERE arrival_date < '$checkout' and departure_date > '$checkin'";
      //echo $command;
      $reservedrooms = $conn->query($command);
      $reservedrooms = $reservedrooms->fetch_row();
      $reservedrooms = $reservedrooms[0];

      //echo $reservedrooms;

      if ($reservedrooms < $total) {
        //echo 'found available rooms';
        $_SESSION['availabilityCheck'] = true;
        $_SESSION['checkin'] = $checkin;
        $_SESSION['checkout'] = $checkout;
        if (isset($rooms)) {
          $_SESSION['rooms'] = $rooms;
        }
        $_SESSION['adult'] = $adult;
        $_SESSION['child'] = $child;
        header("Location: roomtab.php");
      } else {
        $_SESSION['availabilityCheck'] = false;
        echo 'Sorry, all rooms and suites are already taken';
      }
    }
    if (isset($_POST['confirmreserve'])) {
      $title = $_POST['name_with_initials'];
      $fn = $_POST['fn'];
      $ln = $_POST['ln'];
      $email = $_POST['email'];
      $address = $_POST['address'];
      $city = $_POST['city'];
      $mobilenum = $_POST['mobilenum'];
      $titlepayment = $_POST['name_with_initials_payment'];
      $chname = $_POST['chname'];
      $chnum = $_POST['chnum'];
      $month = $_POST['month'];
      $year = $_POST['year'];

      $countguest = "SELECT COUNT(guest_code) FROM guest_information";
      $countguest = $conn->query($countguest);
      $countguest = $countguest->fetch_row();
      $countguest = $countguest[0];

      $guestcode = "GC-0".strval($countguest);
      $paymentcode = "PC-0".strval($countguest);
      $expiration = $month.'/'.$year;

      $guestinformation = "INSERT INTO guest_information(guest_code, title, first_name, last_name, address, city, email_address, payment_code)
      VALUES('$guestcode', '$title', '$fn', '$ln', '$address', '$city', '$email', '$paymentcode')";
      $paymentinformation = "INSERT INTO payment_information(payment_code, payment_type, card_number, card_holder_name, expiration)
      VALUES('$paymentcode', '', '$chnum', '$chname', '$expiration')";
      

    }
    if (isset($_POST['chooseroom'])) {
      if (isset($_POST['room_type']) && isset($_POST['rate_type']) && isset($_POST['bed'])) {
        $roomtype = $_POST['room_type'];
        $ratetype = $_POST['rate_type'];
        $bed = $_POST['bed'];
      } else {
        echo "AN ERROR OCCURED TRYING TO SUBMIT";
      }
      
    }
  //}