<?php
  session_start();
  require('db.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Your Cart | PreBook</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" type="image/png" href="img/logo.png">
  </head>
  <body>

    <?php
      if (isset($_SESSION['username'])) {
    ?>
    <nav>
      <div class="logo">
        <img src="img/logo.png"> <h1> PreBook</h1><span><i>Cheap, Reliable, Instant</i></span>
      </div>
      <ul>
        <li class="special"><a href="buywelcome.php">Buy a Ticket</a></li>
        <li><a href="comment.php">Movie Review</a></li>
        <li><a href="history.php">Purchase History</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>

    <main>
      <div class="bar">
        <h2>Order Confirmed</h2>
        <span class="aside"><i>...here's your order information.</i></span>
      </div>
      <?php

        $query = "SELECT * FROM broadcast WHERE BroadCastId = " . $_POST['broadcast'];
        $record = mysqli_query($db_conn, $query) or die("Query Error!".mysqli_error($db_conn));
        $broadcastInfo = mysqli_fetch_array($record);
        mysqli_free_result($record);

        $broadcastID = $_POST['broadcast'];
        $username = $_SESSION['username'];
        $query = "SELECT * FROM film WHERE FilmId = " . $broadcastInfo['FilmId'];
        $record = mysqli_query($db_conn, $query) or die("Query Error!".mysqli_error($db_conn));
        $filmInfo = mysqli_fetch_array($record);
        mysqli_free_result($record);
      ?>
      <?php
        $total = 0;
        for ($i = 0; $i < sizeof($_POST['seat']); $i++) {
          list($row,$col) = explode('|', $_POST['seat'][$i]);
          $rowName = chr(65 + $row - 1);
      ?>
      <section>
        <p><b>Cinema</b>: Broadway</p>
        <p><b>House</b>: House <?php print chr(65 + $broadcastInfo['HouseId'] - 1) ?></p>
        <p><b>SeatNo</b>: <?php print $rowName . $col ?></p>
        <p><b>Film</b>: <?php print $filmInfo['FilmName'] ?></p>
        <p><b>Category</b>: <?php print $filmInfo['Category'] ?></p>
        <p><b>Show Time</b>: <?php print $broadcastInfo['Dates'] . " " . $broadcastInfo['Time'] . " (" . $broadcastInfo['day'] . ")" ?></p>
        <p><b>Ticket Fee</b>: <?php
          $total = $total + $_POST['type'][$i];
          if ($_POST['type'][$i] == 50)
            print "$50(Student/Senior)";
          else
            print "$75(Adult)";

        ?></p>
        <?php
          $ticketFee = $_POST['type'][$i];
          $ticketType;
          if ($ticketFee == 50)
            $ticketType = "Student/Senior";
          else
            $ticketType = "Adult";
          $query = "INSERT INTO ticket(SeatRow, SeatCol, BroadCastId, Valid, UserId, TicketType, TicketFee) VALUES ('$row', '$col', '$broadcastID', 'YES', '$username', '$ticketType', '$ticketFee')";
          mysqli_query($db_conn, $query) or die("Query Error!".mysqli_error($db_conn));
         ?>
      </section>
      <?php
        }
      ?>
      <section style="padding: 1rem 3rem;">
        <h3>Total Fee: $ <?php print $total ?></h3>
        <p>Please present valid proof of age/status when purchasing Student or Senior tickets before entering the cinema house.</p>
        <a href="buywelcome.php">
          <button type="button" name="okay" class="form-button">Okay!</button>
        </a>
      </section>
    </main>

    <?php
      }
      else {
    ?>
    <nav>
      <div class="logo">
        <img src="img/logo.png"> <h1> PreBook</h1><span><i>Cheap, Reliable, Instant</i></span>
      </div>
    </nav>
    <main>
      <div class="bar">
        <h2>Oops...</h2>
        <span class="aside"><i>you don't seem to be logged in, redirecting you to login page.</i></span>
      </div>
      <i class="fas fa-exclamation-triangle full-icon"></i>
    </main>
    <?php
        header( "refresh:3;url=index.html" );
      }
      mysqli_close($db_conn);
    ?>
  </body>
</html>
