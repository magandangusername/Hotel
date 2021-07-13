<html>

<head>
  <?php
  session_start();
  $url = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
  include_once('db.php');

  if ($url === 'index.php' || $url === 'roomtab.php' || $url === 'reservation.php' || $url === 'checkout.php') {
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

      $totalrooms = "SELECT COUNT(room_number) AS total_rooms FROM room_list";
      $totalsuites = "SELECT COUNT(suite_number) AS total_suites FROM suite_list";
      $tr = $conn->query($totalrooms);
      $tr = $tr->fetch_row();
      $ts = $conn->query($totalsuites);
      $ts = $ts->fetch_row();
      $total = $tr[0] + $ts[0];

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
    if (isset($_POST['chooseroomeb'])) {
      $roomtype;
      if (isset($_POST['bed'])) {
        $bed = $_POST['bed'];
      }
    }
  }

  ?>
  <title>Mondstadt Hotel</title>
  <link rel="stylesheet" href="styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/c7c1afa5a2.js" crossorigin="anonymous"></script>
  <script src="index.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
</head>

<body <?php
      if ($url === 'index.php' || $url === 'roomtab.php' || $url === 'reservation.php') {
        echo "onLoad='calendar()'";
      }
      ?>>
  <!----title--->
  <section id="title">
    <nav class="navbar ">
      <div class="container-fluid justify-content-center">
        <a class="navbar-brand " href="#" font-size="40%">
          Mondstadt Hotel
          <img src="photos/leftarrow.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
        </a>
      </div>
    </nav>
  </section>

  <section id="all">
    <!---------------------------------nav-bar------------------------------->
    <section id="navtabs">
      <div class="container">

        <ul class="nav nav-pills mb-3 nav-fill justify-content-center" id="pills-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link <?php
                                if ($url === 'index.php') {
                                  echo 'active';
                                }

                                ?>" href="index.php">Overview</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php
                                if ($url === 'roomtab.php' || $url === 'suitestab.php' || $url === 'standard.php' || $url === 'deluxe.php' || $url === 'joint.php' || $url === 'executive.php' || $url === 'junior.php' || $url === 'presidential.php') {
                                  echo 'active';
                                }

                                ?>" href="roomtab.php">Room & Suites </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php
                                if ($url === 'promo.php' || $url === 'bonuspromo.php' || $url === 'onlinepromo.php' || $url === 'earlypromo.php') {
                                  echo 'active';
                                }

                                ?>" href="promo.php">Promotion</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php
                                if ($url === 'avail.php' || $url === 'search.php' || $url === 'modifyreservation.php' || $url === 'editUser.php' || $url === 'modifyroom.php' || $url === 'checkout.php' || $url === 'review.php') {
                                  echo 'active';
                                }

                                ?>" href="avail.php">Reservation</a>
          </li>

        </ul>
      </div>
      <?php if ($url === 'roomtab.php' || $url === 'suitestab.php' || $url === 'standard.php' || $url === 'deluxe.php' || $url === 'joint.php' || $url === 'executive.php' || $url === 'junior.php' || $url === 'presidential.php') { ?>
        <div class="container">
          <ul class="nav nav-pills justify-content-center " id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link <?php
                                  if ($url === 'roomtab.php' || $url === 'standard.php' || $url === 'deluxe.php' || $url === 'joint.php') {
                                    echo 'active';
                                  }

                                  ?>" href="roomtab.php">Room </a>
            </li>
            <li class="nav-item <?php
                                if ($url === 'suitestab.php' || $url === 'executive.php' || $url === 'junior.php' || $url === 'presidential.php') {
                                  echo 'active';
                                }

                                ?>">
              <a class="nav-link " href="suitestab.php"> Suites </a>
            </li>
          </ul>
        </div>
      <?php } ?>
      <?php if ($url === 'reservation.php' || $url === 'search.php'  || $url === 'modifyroom.php') { ?>
        <div class="container">
          <ul class="nav nav-pills justify-content-center " id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link <?php
                                  if ($url === 'reservation.php') {
                                    echo 'active';
                                  }

                                  ?>" href="avail.php">Booking </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php
                                  if ($url === 'search.php' || $url === 'modifyroom.php') {
                                    echo 'active';
                                  }

                                  ?>" href="search.php"> Modify/Cancel Reservation </a>
            </li>
          </ul>
        </div>
      </section>  
    </section>  
      <?php } ?>
    