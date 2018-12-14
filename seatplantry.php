<?php
  session_start();
  require('db.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ticketing | PreBook</title>
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
        <h2>Ticketing</h2>
        <span class="aside"><i>...get your lucky seat, instantly.</i></span>
      </div>
      <section>
        <?php

          $query = "SELECT * FROM broadcast WHERE BroadCastId = " . $_POST['broadcast'];
          $record = mysqli_query($db_conn, $query) or die("Query Error!".mysqli_error($db_conn));
          $broadcastInfo = mysqli_fetch_array($record);
          mysqli_free_result($record);
        ?>
        <p><b>Cinema</b>: Broadway</p>
        <p><b>House</b>: House <?php print chr(65 + $broadcastInfo['HouseId'] - 1) ?></p>
        <?php
          $query = "SELECT * FROM film WHERE FilmId = " . $broadcastInfo['FilmId'];
          $record = mysqli_query($db_conn, $query) or die("Query Error!".mysqli_error($db_conn));
          $filmInfo = mysqli_fetch_array($record);
          mysqli_free_result($record);
        ?>
        <p><b>Film</b>: <?php print $filmInfo['FilmName'] ?></p>
        <p><b>Category</b>: <?php print $filmInfo['Category'] ?></p>
        <p><b>Show Time</b>: <?php print $broadcastInfo['Dates'] . " " . $broadcastInfo['Time'] . " (" . $broadcastInfo['day'] . ")" ?></p>
      </section>

      <section class="clearfix">
        <form method="post" action="buyticket.php" onsubmit="return check();">
          <?php
            $query = "SELECT * FROM house WHERE HouseId = " . $broadcastInfo['HouseId'];
            $record = mysqli_query($db_conn, $query) or die("Query Error!".mysqli_error($db_conn));
            $houseInfo = mysqli_fetch_array($record);
            mysqli_free_result($record);

            $query = "SELECT * FROM ticket WHERE BroadCastId = " . $broadcastInfo['BroadCastId'];
            $record = mysqli_query($db_conn, $query) or die("Query Error!".mysqli_error($db_conn));
            $seatsOccupied;
            $numberOfSeatsOccupied = 0;
            while ($row = mysqli_fetch_array($record)) {
              $seatsOccupied[$numberOfSeatsOccupied][0] = $row['SeatRow'];
              $seatsOccupied[$numberOfSeatsOccupied][1] = $row['SeatCol'];
              $numberOfSeatsOccupied++;
            }
            mysqli_free_result($record);
          ?>
          <?php
            while ($houseInfo['HouseRow']) {
              $rowName = chr(65 + $houseInfo['HouseRow'] - 1);
          ?>
              <div class="ticketing-row">

              <?php
              for ($i = 1; $i <= $houseInfo['HouseCol']; $i++) {
                $isReserved = 0;

                for ($it = 0; $it < $numberOfSeatsOccupied; $it++) {
                  if ($seatsOccupied[$it][0] == $houseInfo['HouseRow'] && $seatsOccupied[$it][1] == $i)
                    $isReserved = 1;
                }


                if ($isReserved) {
                  echo "<div class='ticketing-col reserved'>";
                  print "Sold " . $rowName . $i;
                }
                else {
                  echo "<div class='ticketing-col'>";
                  print "<input type='checkbox' class='checkbox' name='seat[]' value='" . $houseInfo['HouseRow'] . "|" . $i . "'>";
                  print $rowName . $i;
                }
                echo "</div>";
              }
              $houseInfo['HouseRow']--;
              echo "</div>"; // Ticketing-row end
            }
          ?>
          <div class="ticketing-row">
            <div class="ticketing-col screen">
              Screen
            </div>
          </div>
          <button type="submit" name="submit" id="submit" class="two-button-one">Select Seat(s)</button>
          <a href="buywelcome.php">
            <button type="button" name="cancel" class="two-button-two">Cancel</button>
          </a>
          <input type="hidden" name="broadcast" value=" <?php echo $broadcastInfo['BroadCastId'] ?> ">
        </form>
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
    <script type="text/javascript">
      function check() {
        var flag = -1;
        var listOfCheckboxes = document.getElementsByClassName('checkbox');
        for (var i = 0; i < listOfCheckboxes.length; i++) {
          if (listOfCheckboxes[i].checked)
            flag = 1;
        }
        if (flag == -1) {
          alert("Please choose at least one seat.");
          return false;
        }
      }
    </script>
  </body>
</html>
