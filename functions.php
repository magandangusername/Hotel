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

      //$rooms = 3;
      if (isset($_POST['roomcount'])) {
        $rooms = $_POST['roomcount'];
      }
      
      $adult = $_POST['guestcount'];
      $child = $_POST['guestcountchild'];

      if($rooms > 1) {
        $adult2 = $_POST['guestcount'];
        $child2 = $_POST['guestcountchild'];
        if($rooms == 3) {
          $adult3 = $_POST['guestcount'];
          $child3 = $_POST['guestcountchild'];
        }
      }
        

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
        $_SESSION['adult'] = $adult;
        $_SESSION['child'] = $child;
        if (isset($rooms)) {
          $_SESSION['rooms'] = $rooms;
          $_SESSION['room'] = 1;
          if(isset($adult2)) {
            $_SESSION['adult2'] = $adult2;
            if(isset($child2)) {
              $_SESSION['child2'] = $child2;
            }
          }
          if(isset($adult3)) {
            $_SESSION['adult3'] = $adult3;
            if(isset($child3)) {
              $_SESSION['child3'] = $child3;
            }
          }
        }
        

        header("Location: reservation.php");
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
      include_once 'destroysession.php';

    }
    if (isset($_POST['chooseroom'])) {
      if (isset($_POST['room_type']) && isset($_POST['rate_type']) && isset($_POST['bed'])) {
        if(isset($_SESSION['room'])){
          
          if($_SESSION['rooms'] == $_SESSION['room']) {
            
            if(isset($_SESSION['room']) && $_SESSION['room'] == 1) {
              $_SESSION['roomtype'] = $_POST['room_type'];
              $_SESSION['ratetype'] = $_POST['rate_type'];
              $_SESSION['bed'] = $_POST['bed'];
              $_SESSION['command'] = "";
              $submit = $_SESSION['command'];
            }
            if(isset($_SESSION['room']) && $_SESSION['room'] == 2) {
              $_SESSION['roomtype2'] = $_POST['room_type'];
              $_SESSION['ratetype2'] = $_POST['rate_type'];
              $_SESSION['bed2'] = $_POST['bed'];
              $_SESSION['command2'] = "";
              $submit2 = $_SESSION['command2'];
            }
            if(isset($_SESSION['room']) && $_SESSION['room'] == 3) {
              $_SESSION['roomtype3'] = $_POST['room_type'];
              $_SESSION['ratetype3'] = $_POST['rate_type'];
              $_SESSION['bed3'] = $_POST['bed'];
              $_SESSION['command3'] = "";
              $submit3 = $_SESSION['command3'];
            }
            header("Location: editUser.php");
            echo 'it works';
          }
          if($_SESSION['rooms'] > $_SESSION['room']) {
            $_SESSION['room'] +=1;
          }
        }

      } else {
        echo "AN ERROR OCCURED TRYING TO SUBMIT. PLEASE TRY AGAIN";
      }
      
    }

    if (isset($_POST['booknow'])) {
      
    }
  //}