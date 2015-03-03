<?php
	include_once("include/header.php");
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/mp.css\">";
?>

<div id="full_width_title_bar">
	<h1>Upcoming Movies</h1>
</div>
<div class="group">
<?php
	$result = mysql_query("SELECT * FROM shows WHERE (release_date >= CURDATE()) and type='MOVIE'");

	while($row = mysql_fetch_array($result))
	  {
		  echo "<a href=\"showPage.php?id=" . $row['id'] . "\">";
		  echo "<div class=\"movie left\">";
		  echo "<img class=\"mainImg\" src=\"" . $row['url'] . "\"/>";
		  echo "<strong><p>" . $row['name'] . "</p></strong></a>";
		  echo "<p>" . $row['release_date'] . "</p>";
		  echo "</div>";
	  }
?>
</div>

<?php
	include_once("include/footer.php");
?>
