<?php
  session_start();
  require('db.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Leave a comment | PreBook</title>
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
        <h2>Comments</h2>
        <span class="aside"><i>...what do you and other people think.</i></span>
      </div>
      <section>
        <form method="post" action="comment_submit.php" style="padding-bottom: 0;" onsubmit="return verify();">
          <h3 style="padding:0 1rem 0.3rem 0.5rem;float:left;width:10%;box-sizing: border-box;">Film Name: </h3>
          <select id="FilmId" name="FilmId" style="width:90%;">
          <?php
            $query = "SELECT * FROM film";
            $record = mysqli_query($db_conn, $query) or die("Query Error!".mysqli_error($db_conn));
            while($filmInfo = mysqli_fetch_array($record)) {
          ?>
            <option value="<?php echo $filmInfo['FilmId'] ?>"><?php echo $filmInfo['FilmName'] ?></option>
          <?php
            }
            mysqli_free_result($record);
           ?>
           <textarea name="comment" placeholder="Leave your comment here." id="textbox"></textarea>
           <button class="form-button" id="submit" name="submit">Submit Comment</button>
        </form>
        <div style="padding: 0 2rem">
          <button class="aside-button view-comment" id="view" onclick="retrive();">View Comment</button>
        </div>
      </section>
      <div id="comments" style="margin-top: 4rem;">

      </div>
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
    ?>
    <script type="text/javascript">
    function verify() {
      if (!document.getElementById('textbox').value) {
        alert("Please enter a comment.");
        return false;
      }
    }
    function retrive() {
        var xmlhttp;
        if (window.XMLHttpRequest) {
          xmlhttp = new XMLHttpRequest();
        } else {
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange = function () {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var commentshow = document.getElementById("comments");
            commentshow.innerHTML = xmlhttp.responseText;
          }
        }
        xmlhttp.open("GET", "comment_retrieve.php?FilmId=" + document.getElementById("FilmId").value, true);
        xmlhttp.send();
      }
    </script>
  </body>
</html>
