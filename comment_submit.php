<?php
  session_start();
  require('db.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Your Home | PreBook</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" type="image/png" href="img/logo.png">
  </head>
  <body>
    <?php
      if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $comment = $_POST['comment'];
        $filmid = $_POST['FilmId'];
        $query = "INSERT INTO comment(FilmId, UserId, Comment) VALUES ('$filmid', '$username', '$comment')";
        mysqli_query($db_conn, $query) or die("Query Error!".mysqli_error($db_conn));
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
        <h2>Comment Submitted</h2>
        <span class="aside"><i>...thanks a lot for sharing your opinion. Redirecting you back.</i></span>
      </div>
      <i class="fas fa-check-square full-icon"></i>
    </main>

    <?php
      header( "refresh:3;url=comment.php" );
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
    ?>
  </body>
</html>
