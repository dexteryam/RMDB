<?php
	include_once("include/header.php");
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/mp.css\">";
?>

<?php
function avgRating($show_id){
    /*$show_id = $_GET['id'];*/
    $count=0;
    $rSum=0;
    $result = mysql_query("SELECT * FROM ratings WHERE (ratings.show_id =".$show_id.")");
    while($row = mysql_fetch_array($result))
        {
            $rSum += $row['rating'];
            $count++;
        }
        if($count == 0){return 0;}
        else{ return ($rSum / $count); }
}
function updateRating($show_id){
	$rating = avgRating($show_id);
	$addrating = mysql_query("UPDATE shows SET avg_rating = $rating WHERE id='$show_id'");
}
?>

<div id="full_width_title_bar">
	<h1>Popular Movies</h1>
</div>
<div class="group">

	<div id="header_bar">
		<div id="right">
			Sort by Genre: 
			<a href="popular.php?genre=action">Action</a>/
			<a href="popular.php?genre=comedy">Comedy</a>/
			<a href="popular.php?genre=drama">Drama</a>/
			<a href="popular.php?genre=horror">Horror</a>/
			<a href="popular.php?genre=romance">Romance</a>/
			<a href="popular.php">All Genres</a>

		</div>
	</div>

<?php
	$result = mysql_query("SELECT * FROM shows WHERE type='MOVIE'");

	while($row = mysql_fetch_array($result)){
		updateRating($row['id']);
	}
	
	if(isset($_GET['genre'])){
		$genre = $_GET['genre'];
		echo "<form method = \"POST\" action = \"popular.php?genre=$genre\">
			 <select name = \"order\">
			 <option value='null'>-Select Ordering-</option>
			 <option value='top'>Top Rated Movies</option>
			 <option value='pop'>Most Popular Today</option>
			 <option value='low'>Lowest Rated Movies</option>
			 </select>
			 <input type = \"submit\" value = \"Submit\" name =\"submit\"></form>
			 ";
		if(isset($_POST['submit'])){	 
				$order = $_POST['order'];
				if($order == "top"){
				echo "<h2> Top Rated ".$genre."  Movies:</h2>";
					$result = mysql_query("SELECT * FROM shows ORDER BY avg_rating DESC");

					while($row = mysql_fetch_array($result)){
					$show_id = $row['id'];
					$result2 = mysql_query("SELECT * FROM shows WHERE type='MOVIE' AND id = '$show_id' AND genre = '$genre'");
						while($movie = mysql_fetch_array($result2)){
						 echo "<a href=\"showPage.php?id=" . $movie['id'] . "\">";
						 echo "<div class=\"movie left\">";
						 echo "<img class=\"mainImg\" src=\"" . $movie['url'] . "\"/>";
						 echo "<strong><p>" . $movie['name'] . "</p></strong></a>";
						 echo "<p>" . avgRating($movie['id'])*20  . "% Positive</p>";
						 echo "</div>";
						}
					}
				}
				
				if($order == "pop"){
				echo "<h2> Popular ".$genre."  Movies of the Day:</h2>";
					date_default_timezone_set('America/Los_Angeles');
					$date = date("Y-m-d");
					
					$result = mysql_query("SELECT * FROM popularity WHERE date = '$date' ORDER BY views DESC");
					if (!$row = mysql_fetch_array($result)){
						die("No movies have been viewed today!");
					}
					while($row = mysql_fetch_array($result)){
					$show_id = $row['show_id'];
					$result2 = mysql_query("SELECT * FROM shows WHERE type='MOVIE' AND id = '$show_id' AND genre = '$genre'");
						while($movie = mysql_fetch_array($result2)){
						 echo "<a href=\"showPage.php?id=" . $movie['id'] . "\">";
						 echo "<div class=\"movie left\">";
						 echo "<img class=\"mainImg\" src=\"" . $movie['url'] . "\"/>";
						 echo "<strong><p>" . $movie['name'] . "</p></strong></a>";
						 echo "<p>" . $row['views']  . " Views</p>";
						 echo "</div>";
						}
					}
				}
				
				if($order == "low"){
					echo "<h2> Lowest Rated ".$genre."  Movies:</h2>";
					$result = mysql_query("SELECT * FROM shows ORDER BY avg_rating ASC");
					while($row = mysql_fetch_array($result)){
						$show_id = $row['id'];
						$result2 = mysql_query("SELECT * FROM shows WHERE type='MOVIE' AND id = '$show_id' AND genre = '$genre'");
						while($movie = mysql_fetch_array($result2)){
						 echo "<a href=\"showPage.php?id=" . $movie['id'] . "\">";
						 echo "<div class=\"movie left\">";
						 echo "<img class=\"mainImg\" src=\"" . $movie['url'] . "\"/>";
						 echo "<strong><p>" . $movie['name'] . "</p></strong></a>";
						 echo "<p>" . avgRating($movie['id'])*20  . "% Positive</p>";
						 echo "</div>";
						}
					}
				}
			
			}
		else{
			echo "<h2> Top Rated ".$genre." Movies:</h2>";
			$result = mysql_query("SELECT * FROM shows ORDER BY avg_rating DESC");

			while($row = mysql_fetch_array($result)){
				$show_id = $row['id'];
				$result2 = mysql_query("SELECT * FROM shows WHERE type='MOVIE' AND id = '$show_id' AND genre = '$genre'");
				while($movie = mysql_fetch_array($result2)){
					echo "<a href=\"showPage.php?id=" . $movie['id'] . "\">";
					echo "<div class=\"movie left\">";
					echo "<img class=\"mainImg\" src=\"" . $movie['url'] . "\"/>";
					echo "<strong><p>" . $movie['name'] . "</p></strong></a>";
					echo "<p>" . avgRating($movie['id'])*20  . "% Positive</p>";
					echo "</div>";
				}
			}
		}
	
	}
	
	//No genre
	else{
		echo "<form method = \"POST\" action = \"popular.php\">
				 <select name = \"order\">
				 <option value='null'>-Select Ordering-</option>
				 <option value='top'>Top Rated Movies</option>
				 <option value='pop'>Most Popular Today</option>
				 <option value='low'>Lowest Rated Movies</option>
				 </select>
				 <input type = \"submit\" value = \"Submit\" name =\"submit\"></form>
				 ";
		 if(isset($_POST['submit'])){	 
				$order = $_POST['order'];
				if($order == "top"){
					echo "<h2> Top Rated Movies:</h2>";
					$result = mysql_query("SELECT * FROM shows ORDER BY avg_rating DESC");

					while($row = mysql_fetch_array($result)){
						$show_id = $row['id'];
						$result2 = mysql_query("SELECT * FROM shows WHERE type='MOVIE' AND id = '$show_id'");
						while($movie = mysql_fetch_array($result2)){
						 echo "<a href=\"showPage.php?id=" . $movie['id'] . "\">";
						 echo "<div class=\"movie left\">";
						 echo "<img class=\"mainImg\" src=\"" . $movie['url'] . "\"/>";
						 echo "<strong><p>" . $movie['name'] . "</p></strong></a>";
						 echo "<p>" . avgRating($movie['id'])*20  . "% Positive</p>";
						 echo "</div>";
						}
					}
				}
				
				if($order == "pop"){
					echo "<h2> Popular Movies of the Day:</h2>";
					date_default_timezone_set('America/Los_Angeles');
					$date = date("Y-m-d");
					
					$result = mysql_query("SELECT * FROM popularity WHERE date = '$date' ORDER BY views DESC");
					if (!$row = mysql_fetch_array($result)){
						die("No movies have been viewed today!");
					}
					while($row = mysql_fetch_array($result)){
						$show_id = $row['show_id'];
						$result2 = mysql_query("SELECT * FROM shows WHERE type='MOVIE' AND id = '$show_id'");
						while($movie = mysql_fetch_array($result2)){
						 echo "<a href=\"showPage.php?id=" . $movie['id'] . "\">";
						 echo "<div class=\"movie left\">";
						 echo "<img class=\"mainImg\" src=\"" . $movie['url'] . "\"/>";
						 echo "<strong><p>" . $movie['name'] . "</p></strong></a>";
						 echo "<p>" . $row['views']  . " Views</p>";
						 echo "</div>";
						}
					}
				}
				
				if($order == "low"){
					echo "<h2> Lowest Rated Movies:</h2>";
					$result = mysql_query("SELECT * FROM shows ORDER BY avg_rating ASC");
					while($row = mysql_fetch_array($result)){
						$show_id = $row['id'];
						$result2 = mysql_query("SELECT * FROM shows WHERE type='MOVIE' AND id = '$show_id'");
						while($movie = mysql_fetch_array($result2)){
						 echo "<a href=\"showPage.php?id=" . $movie['id'] . "\">";
						 echo "<div class=\"movie left\">";
						 echo "<img class=\"mainImg\" src=\"" . $movie['url'] . "\"/>";
						 echo "<strong><p>" . $movie['name'] . "</p></strong></a>";
						 echo "<p>" . avgRating($movie['id'])*20  . "% Positive</p>";
						 echo "</div>";
						}
					}
				}
			
			}
		else{
			echo "<h2> Top Rated Movies:</h2>";
			$result = mysql_query("SELECT * FROM shows ORDER BY avg_rating DESC");

			while($row = mysql_fetch_array($result)){
				$show_id = $row['id'];
				$result2 = mysql_query("SELECT * FROM shows WHERE type='MOVIE' AND id = '$show_id'");
				while($movie = mysql_fetch_array($result2)){
					echo "<a href=\"showPage.php?id=" . $movie['id'] . "\">";
					echo "<div class=\"movie left\">";
					echo "<img class=\"mainImg\" src=\"" . $movie['url'] . "\"/>";
					echo "<strong><p>" . $movie['name'] . "</p></strong></a>";
					echo "<p>" . avgRating($movie['id'])*20  . "% Positive</p>";
					echo "</div>";
				}
			}
		}
	}
?>
</div>

<?php
	include_once("include/footer.php");
?>
