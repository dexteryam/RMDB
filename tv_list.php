<?php
	include_once("include/header.php");
?>

	<div id="header_bar">
		<div id="right">
			<a href="tv_list.php?order=ASC">Sort A-Z</a>
			<a href="tv_list.php?order=DESC">Sort Z-A</a>
		</div>
	</div>
	<div id="full_width_title_bar">
		<h1>Tv Shows</h1>
	</div>
<?php
	$order = $_GET['order'];
	$order = mysql_real_escape_string($order);  
	$result = mysql_query("SELECT * FROM shows WHERE (type = 'TV') ORDER BY name $order");

	while($row = mysql_fetch_array($result))
	  {
	  echo "<div id=\"full_width_content_bar\">";
	  echo "<a href=\"showPage.php?id=" . $row['id'] . "\">";
	  echo $row['name'];
	  echo "</a></div>";
	  }
?>

<?php
	include_once("include/footer.php");
?>
