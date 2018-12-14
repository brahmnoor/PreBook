<?php
  session_start();
  require('db.php');
  $query = "SELECT * FROM login";
  $record = mysqli_query($db_conn, $query) or die("Query Error!".mysqli_error($db_conn));
  $username = $_POST['username'];
  $password = $_POST['password'];
  $flag = 0;
  while ($row = mysqli_fetch_array($record)) {
    if ($row['UserId'] == $username && $row['PW'] == $password) {
      $_SESSION["username"] = $username;
      session_write_close();
      $flag = 1;
      header('location: main.php');
    }
  }
  if ($flag == 0) {
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Create an Account | PreBook</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" type="image/png" href="img/logo.png">
  </head>
  <body>
    <nav>
      <div class="logo">
        <img src="img/logo.png"> <h1> PreBook</h1><span><i>Cheap, Reliable, Instant</i></span>
      </div>
    </nav>
    <main>
      <div class="bar">
        <h2>Oops...</h2>
        <span class="aside"><i>you got the wrong username or/and password.</i></span>
      </div>
      <i class="fas fa-exclamation-triangle full-icon"></i>
    </main>
  </body>
</html>

<?php
    header( "refresh:3;url=index.html" );
  }
  mysqli_free_result($record); 
  mysqli_close($db_conn);
?>
