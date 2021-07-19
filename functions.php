<?php
/*
my notes:
- add validation function
- add csrf(optional)

- for submitting reservation:
- always check if the room is still available before submitting everything
- someone might reserved the room before the current user

- fix multiple room reservation:
- what if the user has 2 or more rooms
- user selected a room where there is
- only 1 left available
- user must not be able to select that room again
- my current logic:
- session the number of rooms availabe for each type
- modify that session when the user selects a room

- for 4 or more rooms reserving (might do in future):
- use array then pass it to session
- there will be changes in database (pivot table)
- array will be used to looping where the looping contains queries
- WARNING: this will bring more pain in my tiny brain
*/


//CHECKING ROOM AVAILABILITY
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

  if ($rooms > 1) {
    $adult2 = $_POST['guestcount2'];
    $child2 = $_POST['guestcountchild2'];
    if ($rooms == 3) {
      $adult3 = $_POST['guestcount3'];
      $child3 = $_POST['guestcountchild3'];
    }
  }

  if (isset($_POST['promocode'])) {
    $promocode = $_POST['promode'];
  } else {
    $promocode = '';
  }

  $promotioncheck = "SELECT * FROM promotion_description WHERE promotion_code = '$promocode'";
  $promotioncheck = $conn->query($promotioncheck);
  $promotioncheck = $promotioncheck->fetch_row();
  if(!$promotioncheck){
    echo "<h1>ERROR: Promotion code does not exists.</h1>";
  }

  $totalrooms = "SELECT COUNT(room_number) AS total_rooms FROM room_status";
  $total = $conn->query($totalrooms);
  $total = $total->fetch_row();

  $command = "SELECT COUNT(confirmation_number) AS rooms FROM reservation_table WHERE arrival_date < '$checkout' and departure_date > '$checkin'";

  $reservedrooms = $conn->query($command);
  $reservedrooms = $reservedrooms->fetch_row();
  $reservedrooms = $reservedrooms[0];

  //echo $reservedrooms;

  if ($reservedrooms < $total) {
    $_SESSION['availabilityCheck'] = true;
    $_SESSION['checkin'] = $checkin;
    $_SESSION['checkout'] = $checkout;
    $_SESSION['adult'] = $adult;
    $_SESSION['child'] = $child;
    if (isset($rooms)) {
      $_SESSION['rooms'] = $rooms;
      $_SESSION['room'] = 1;
      if (isset($adult2)) {
        $_SESSION['adult2'] = $adult2;
        if (isset($child2)) {
          $_SESSION['child2'] = $child2;
        }
      }
      if (isset($adult3)) {
        $_SESSION['adult3'] = $adult3;
        if (isset($child3)) {
          $_SESSION['child3'] = $child3;
        }
      }
      if (isset($promocode)) {
        $_SESSION['promocode'] = $promocode;
      }
    }


    header("Location: reservation.php");
  } else {
    $_SESSION['availabilityCheck'] = false;
    echo 'Sorry, all rooms and suites are already taken';
  }
}


//FINAL STEP OF RESERVATION
if (isset($_POST['confirmreserve'])) {

  //final form (custoemr and payment info)
  $title = $_POST['name_with_initials'];
  $fn = $_POST['fn'];
  $ln = $_POST['ln'];
  $email = $_POST['email'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $mobilenum = $_POST['mobilenum'];
  $paymenttype = $_POST['name_with_initials_payment'];
  $chname = $_POST['chname'];
  $chnum = $_POST['chnum'];
  $month = $_POST['month'];
  $year = $_POST['year'];

  $countguest = "SELECT COUNT(guest_code) FROM guest_information";
  $countguest = $conn->query($countguest);
  $countguest = $countguest->fetch_row();
  $countguest = $countguest[0];

  $guestcode = "GC-0" . strval($countguest);
  $paymentcode = "PC-0" . strval($countguest);
  $expiration = $month . '/' . $year;






  //reservation info
  $totalc = "SELECT COUNT(confirmation_number) FROM reservation_table";
  $totalc = $conn->query($totalc);
  $totalc = $totalc->fetch_row();
  $totalc = $totalc[0];
  $confirmation_number = strval(date('Ymd')) . strval($totalc + 1);
  $arrival = $_SESSION['checkin'];
  $departure = $_SESSION['checkout'];
  $adult = $_SESSION['adult'];
  $child = $_SESSION['child'];
  if ($_SESSION['rooms'] >= 2) {
    $adult2 = $_SESSION['adult2'];
    $child2 = $_SESSION['child2'];
    if ($_SESSION['rooms'] == 3) {
      $adult3 = $_SESSION['adult3'];
      $child3 = $_SESSION['child3'];
    }
  }


  $rr_code = "SELECT COUNT(rr_code) FROM reserved_rooms";
  $rr_code = $conn->query($rr_code);
  $rr_code = $rr_code->fetch_row();
  $rr_code = "RR-0" . strval($rr_code[0] + 1);


  $roomsuitename = $_SESSION['roomtype'];
  $roomsuitebed = $_SESSION['bed'];
  if (isset($_SESSION['roomtype2']) && $_SESSION['roomtype2'] != '' && $_SESSION['bed2'] && $_SESSION['bed2'] != '') {
    $roomsuitename2 = $_SESSION['roomtype2'];
    $roomsuitebed2 = $_SESSION['roomtype2'];
  } else {
    $roomsuitename2 = '';
    $roomsuitebed2 = '';
  }
  if (isset($_SESSION['roomtype3']) && $_SESSION['roomtype3'] != '' && $_SESSION['bed3'] && $_SESSION['bed3'] != '') {
    $roomsuitename3 = $_SESSION['roomtype3'];
    $roomsuitebed3 = $_SESSION['roomtype3'];
  } else {
    $roomsuitename3 = '';
    $roomsuitebed3 = '';
  }
  $roomnum = "SELECT room_number FROM room_status 
	  WHERE room_suite_name = '$roomsuitename' AND 
	  room_suite_bed = '$roomsuitebed' AND 
	  status = 0";
  $roomnum = $conn->query($roomnum);
  $roomnum = $roomnum->fetch_row();
  if (!$roomnum) {
    echo "ERROR: One of the rooms became unavailable before you submitted your reservation. Please check the availability of the rooms again.";
    exit;
  } else {
    $roomnum = $roomnum[0];
  }

  if ($roomsuitename2 != '') {
    $roomnum2 = "SELECT room_number FROM room_status 
		  WHERE room_suite_name = '$roomsuitename2' AND 
		  room_suite_bed = '$roomsuitebed2' AND 
		  status = 0";
    $roomnum2 = $conn->query($roomnum2);
    $roomnum2 = $roomnum2->fetch_row();
    if (!$roomnum2) {
      echo "ERROR: One of the rooms became unavailable before you submitted your reservation. Please check the availability of the rooms again.";
      exit;
    } else {
      $roomnum2 = $roomnum2[0];
    }
  }

  if ($roomsuitename3 != '') {
    $roomnum3 = "SELECT room_number FROM room_status 
		  WHERE room_suite_name = '$roomsuitename3' AND 
		  room_suite_bed = '$roomsuitebed3' AND 
		  status = 0";
    $roomnum3 = $conn->query($roomnum3);
    $roomnum3 = $roomnum3->fetch_row();
    if (!$roomnum3) {
      echo "ERROR: One of the rooms became unavailable before you submitted your reservation. Please check the availability of the rooms again.";
      exit;
    } else {
      $roomnum3 = $roomnum3[0];
    }
  }

  $ratetype = $_SESSION['ratetype'];
  $ratetype2 = '';
  $ratetype3 = '';
  if(isset($_SESSION['ratetype2'])) {
    $ratetype2 = $_SESSION['ratetype2'];
  }
  if(isset($_SESSION['ratetype3'])) {
    $ratetype3 = $_SESSION['ratetype3'];
  }

  if(isset($_SESSION['promocode'])) {
    $promocode = $_SESSION['promocode'];
  } else {
    $promocode = '';
  }


  $paymentinformation = "INSERT INTO payment_information(
	  payment_code, 
	  payment_type, 
	  card_number, 
	  card_holder_name, 
	  expiration) VALUES (
	  '$paymentcode', 
	  '$paymenttype', 
	  '$chnum', 
	  '$chname', 
	  '$expiration'
	  );";

  $guestinformation = "INSERT INTO guest_information(
	  guest_code, 
	  title, 
	  first_name, 
	  last_name, 
	  address, 
	  city, 
	  email_address, 
	  payment_code) VALUES (
	  '$guestcode', 
	  '$title', 
	  '$fn', 
	  '$ln', 
	  '$address', 
	  '$city', 
	  '$email', 
	  '$paymentcode');";

  $reservedroomsinfo = "INSERT INTO reserved_rooms(
	  rr_code,
	  r1,
	  r2,
	  r3,
	  rate1,
	  rate2,
	  rate3) VALUES (
	  '$rr_code',
	  '$roomnum',
	  '$roomnum2',
	  '$roomnum3',
	  '$ratetype',
	  '$ratetype2',
	  '$ratetype3'
	  );";

  $reservationinfo = "INSERT INTO reservation_table(
	  confirmation_number,
	  arrival_date,
	  departure_date,
	  guest_code,
	  rr_code,
	  promotion_code
	  ) VALUES (
	  '$confirmation_number', 
	  '$arrival', 
	  '$departure', 
	  '$guest_code', 
	  '$rr_code', 
	  '$promocode');
	  ";


  $roomstatus = "UPDATE room_status
  SET status=1, confirmation_number='$confirmation_number'
  WHERE some_column=some_value;";

  $commands = $paymentinformation.$guestinformation.$reservedroomsinfo.$reservationinfo.$roomstatus;

  if($conn->query($commands)) {
    echo "may or may not worked";
  } else {
    echo "it worked";
  }



echo $commands;










  include_once 'destroysession.php';
}

//CHOOSING ROOMS
if (isset($_POST['chooseroom'])) {
  if (isset($_POST['room_type']) && isset($_POST['rate_type']) && isset($_POST['bed'])) {
    if (isset($_SESSION['room'])) {

      if ($_SESSION['rooms'] >= $_SESSION['room']) {

        if (isset($_SESSION['room']) && $_SESSION['room'] == 1) {
          $_SESSION['roomtype'] = $_POST['room_type'];
          $_SESSION['ratetype'] = $_POST['rate_type'];
          $_SESSION['bed'] = $_POST['bed'];
          $_SESSION['command'] = "";
          $submit = $_SESSION['command'];
        }
        if (isset($_SESSION['room']) && $_SESSION['room'] == 2) {
          $_SESSION['roomtype2'] = $_POST['room_type'];
          $_SESSION['ratetype2'] = $_POST['rate_type'];
          $_SESSION['bed2'] = $_POST['bed'];
          $_SESSION['command2'] = "";
          $submit2 = $_SESSION['command2'];
        }
        if (isset($_SESSION['room']) && $_SESSION['room'] == 3) {
          $_SESSION['roomtype3'] = $_POST['room_type'];
          $_SESSION['ratetype3'] = $_POST['rate_type'];
          $_SESSION['bed3'] = $_POST['bed'];
          $_SESSION['command3'] = "";
          $submit3 = $_SESSION['command3'];
        }
        header("Location: checkout.php");
        echo 'it works';
      }
      if ($_SESSION['rooms'] > $_SESSION['room']) {
        $_SESSION['room'] += 1;
      }
    }
  } else {
    echo "AN ERROR OCCURED TRYING TO SUBMIT. PLEASE TRY AGAIN";
  }
}



if (isset($_POST['booknow'])) {
}
