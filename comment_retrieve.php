<?php
  require('db.php');
	$query = "SELECT * FROM comment WHERE FilmId=" . $_GET['FilmId'];
  $result = mysqli_query($db_conn, $query) or die ('Failed to query '.mysqli_error($db_conn));

  while($row = mysqli_fetch_array($result)) {
    print "<section style='padding: 1rem 3rem;'>";
    print "<h3>Viewer: " . $row['UserId'] . "</h3>";
    print "<p style='padding:0;'>" . $row['Comment'] . "</p>";
    print "</section>";
  }
	mysqli_free_result($result);
  mysqli_close($db_conn);


?>
