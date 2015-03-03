<?php
	include_once("include/header.php");
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/mp.css\">";
?>

<div class="frame group">
	<div>
	<?php
		$show_id = $_GET['id'];
		$result = mysql_query("SELECT * FROM shows WHERE (id = $show_id)");
	
		while($row = mysql_fetch_array($result))
		  {
		  $type = $row['type'];
		  $rDate=$row['release_date'];
		  echo "<h1 id=\"full_width_title_bar\">" . $row['name'] . " (" . date("Y", strtotime($rDate)) . ")</h1>";
echo "</div>";
		  }
	?>
</div>

<div class="frame group">
	<div>
	<?php
		$show_id = $_GET['id'];
		$result = mysql_query("SELECT * FROM photos WHERE (show_id = $show_id)");
	
		while($row = mysql_fetch_array($result))
		  {
		  echo "<div class=\"group\">";
		  echo "<a href=\"https://www.facebook.com/sharer.php?u=localhost/".$row['url']."&t=".$row['url']."\" target=\"_blank\"><img class=\"mainImg\" src=\"" . $row['url'] . "\"/></a>";
		  echo "</div>";
		  }

		echo "</div><div class=\"lowNav\">";
		echo "<a href=\"showPage.php?id=" . $show_id . "\">Main</a>" . 
		" |<a href=\"trailer.php?id=" . $show_id . "\">Trailer</a>" . 
		" |<a href=\"quotes.php?id=" . $show_id . "\">Quotes</a>" .
		" |<a href=\"trivia.php?id=" . $show_id . "\">Trivia</a>" . 
		" |<a href=\"goofs.php?id=" . $show_id . "\">Goofs</a>" ;
		if( $type == "MOVIE" )
			print " |<a href=\"show_times.php?movie_id=$show_id\">Find showtimes</a>";
		echo "| <a name=\"fb_share\" share_url=\"localhost/photos.php?id=".$show_id."\">Share</a>";
		?>
		</p>
	</div>
	
</div>

<?php
	include_once("include/footer.php");
?>
