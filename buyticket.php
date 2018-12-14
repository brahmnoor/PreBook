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
        <h2>Your Cart</h2>
        <span class="aside"><i>...almost there, just one click away.</i></span>
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
        <form method="post" action="confirm.php">
          <?php
            for ($i = 0; $i < sizeof($_POST['seat']); $i++) {
              list($row,$col) = explode('|', $_POST['seat'][$i]);
              $rowName = chr(65 + $row - 1);
              echo "<h3 style='padding: 0 1rem 0.3rem 0.5rem; float:left; width:10%; box-sizing: border-box;'>" . $rowName . $col . ": </h3>";
          ?>
            <select name="type[]" style="width:90%;">
              <option value="75">
                Adult ($75)
              </option>
              <option value="50">
                Student/Senior ($50)
              </option>
            </select>

            <input type="hidden" name="seat[]" value="<?php echo $_POST['seat'][$i] ?>">
            <div class="clearfix"></div>
          <?php
            }
          ?>
          <div class="clearfix"></div>
          <button type="submit" name="submit" id="submit" class="two-button-one">Confirm Order</button>
          <a href="buywelcome.php">
            <button type="button" name="cancel" class="two-button-two">Cancel</button>
          </a>
          <input type="hidden" name="broadcast" value="<?php echo $_POST['broadcast'] ?>">
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
  </body>
</html>
