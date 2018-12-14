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
<?php
  require('db.php');
  $query = "SELECT * FROM login";
  $record = mysqli_query($db_conn, $query) or die("Query Error!".mysqli_error($db_conn));
  $username = $_POST['desiredusername'];
  $password = $_POST['desiredpassword'];
  $flag = 0;
  while ($row = mysqli_fetch_array($record)) {
    if ($row['UserId'] == $username) {
      $flag = 1;
?>
        <h2>Oops...</h2>
        <span class="aside"><i>account already exists, use another username.</i></span>
      </div>
      <i class="fas fa-exclamation-triangle full-icon"></i>
<?php
      header( "refresh:3;url=createaccount.html" );
    }
  }
  if ($flag == 0) {
    $query = "INSERT INTO login VALUES ('$username', '$password')";
    if (!mysqli_query($db_conn, $query)) {
      echo "<p>Error insert!!<br>".mysqli_error($db_conn)."</p>";
    }
?>
        <h2>Yaaay!</h2>
        <span class="aside"><i>you've registered. You'll be redirected to login, where you can use these details.</i></span>
      </div>
      <i class="fas fa-check-square full-icon"></i>
<?php
    header( "refresh:3;url=index.html" );
  }
  mysqli_free_result($record);
  mysqli_close($db_conn);
?>

    </main>
  </body>
</html>
