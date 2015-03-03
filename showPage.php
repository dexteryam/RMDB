<?php
	include_once("include/header.php");
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/mp.css\">";

?>
</div>

<div class="frame group">
	<div>
	<?php
		$show_id = $_GET['id'];
		
		//Viewcount
		date_default_timezone_set('America/Los_Angeles');
		$date = date("Y-m-d");
		$query = "SELECT * FROM popularity WHERE date = '$date' AND show_id ='$show_id'";
		$result = Db::query_row($query);
		if($result){
			$views = $result['views'];
			$views+=1;
			echo "Pageviews: ".$views;
			$query = "UPDATE popularity SET views = '$views' WHERE show_id='$show_id' AND date='$date'";
			$result = mysql_query($query);
		}
		else{
			$query = "INSERT INTO popularity VALUES ('$show_id',1,'$date')";
			$result = mysql_query($query);
			echo "Pageviews: 1";
		}
		
		//Social buttons
		$query = "SELECT * FROM social WHERE show_id = $show_id";
		$result = Db::query_row($query);
		
			
		$social_html = "";
		if( isset($result['google']) || $result['twitter'] || $result['facebook'] || Access::user_has_access_level( Access::ADMINISTRATOR ) )
			$social_html .= '<div id="header_bar"><div id="right">';
		if( Access::user_has_access_level( Access::ADMINISTRATOR ) )
			$social_html .= "<a href = \"addsocial.php?id=$show_id\">Manage Social</a>";
		if($result['google']){
			$social_html .=
			"<!-- Google+ --> 
			<!-- Place this tag where you want the +1 button to render -->
			<g:plusone size=\"medium\" annotation=\"none\" href=\"http://localhost/showPage.php?id=$show_id\"></g:plusone>

			<!-- Place this render call where appropriate -->
			<script type=\"text/javascript\">
			  (function() {
				var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
				po.src = 'https://apis.google.com/js/plusone.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			  })();
			</script>";
		}
		
		
		if($result['twitter']){
			$social_html .=
			"<!-- Twitter -->
			<a href=\"https://twitter.com/share\" class=\"twitter-share-button\" data-count=\"none\">Tweet</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id))
			{js=d.createElement(s);js.id=id;js.src=\"//platform.twitter.com/widgets.js\";fjs.parentNode.insertBefore(js,fjs);}}
			(document,\"script\",\"twitter-wjs\");</script>";
		}
		
		if($result['facebook']){
			$social_html .=
			"<!-- Facebook -->
			<iframe src=\"//www.facebook.com/plugins/like.php?href=http%3A%2F%2Flocalhost%2Frmdb%2FshowPage.php%3Fid%3D$show_id&amp;send=false&amp;
			layout=button_count&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;
			font&amp;height=21\" scrolling=\"no\" frameborder=\"0\" style=\"border:none; overflow:hidden; width:44px; height:21px;\" allowTransparency=\"true\">
			</iframe>";
		}
		if( isset($result['google']) || $result['twitter'] || $result['facebook'] || Access::user_has_access_level( Access::ADMINISTRATOR ) )
			$social_html .= '</div></div>';
		
		$type;
		
		function movie_basics()
		{
			global $type;
			$show_id = $_GET['id'];
			$result = mysql_query("SELECT * FROM shows WHERE (id = $show_id)");
			while($row = mysql_fetch_array($result))
			  {
			  	  $type = $row['type'];
				  $rDate=$row['release_date'];
				  echo "<h1 id=\"full_width_title_bar\">" . $row['name'] . " (" . date("Y", strtotime($rDate)) . ")</h1>";
				  echo "<div class=\"group\">";
				  echo "<a href=\"https://www.facebook.com/sharer.php?u=localhost/".$row['url']."&t=".$row['name']."\" target=\"_blank\"><img class=\"left mainImg\" src=\"" . $row['url'] . "\"/></a>";
				  echo "<p class=\"textLeft\">" . $row['description'] . "</p>";
				  echo "<p class=\"textLeft\">Created by: " . $row['studio'] . "</p>";
				  echo "</div>";
			  }	
		}
		
		$show_id = $_GET['id'];		
		function avgRating(){
			$show_id = $_GET['id'];
			$count=0;
			$rSum=0;
			$result = mysql_query("SELECT * FROM ratings WHERE (ratings.show_id =".$show_id.")");
			while($row = mysql_fetch_array($result))
				{
					$rSum += $row['rating'];
 					$count++;
				}
				if($count == 0){echo "<p class=\"textLeft reset\">No user ratings yet.</p>";}
				else{ echo "<p class=\"textLeft reset\">Avg rating: " . $rSum / $count . "</p>"; }
		}
		
		
		$uid = Authenticate::get_id();
		if ( $uid == "" ) {
			movie_basics();
			avgRating();
			echo "<a href=\"reviews.php?id=".$show_id."\"><p class=\"textLeft\">Read reviews.</p></a>";
		}
		else{
			movie_basics();
			avgRating();
			$result = mysql_query("SELECT * FROM ratings WHERE (ratings.user_id =".$uid.") AND (ratings.show_id =".$show_id.")");
			$row = mysql_fetch_array($result);
			if($row == "")
				{ echo "<a href=\"ratings.php?id=".$show_id."\"><p class=\"textLeft reset\">Rate this movie!</p></a>"; }
			else
				{ echo "<p class=\"textLeft reset\">My rating: " . $row['rating'] . "<a href=\"ratings.php?id=".$show_id."\"> (Change)</a></p>"; }
			echo "<a href=\"reviews.php?id=".$show_id."\"><p class=\"textLeft\">Read reviews.</p></a>";
		}


	?>	
	</div>
	<div class="comments">
		
	</div>  
	<div>
		<h2 class="textLeft">Cast</h2>
		<?php
			$result = mysql_query("SELECT * FROM cast WHERE (show_id = $show_id)");
		
			while($row = mysql_fetch_array($result))
			  {
				echo "<p class=\"reset textLeft\"><a href=\"peoplePage.php?id=".$row['actor_id']."\">" . $row['name'] . "</a></p>";
			  }
		?>
	</div>
	
	<div class="frame lowNav">
		<div class="center">
			<?php
			echo "<a href=\"trailer.php?id=" . $show_id . "\">Watch Trailer</a>" . 
			" |<a href=\"quotes.php?id=" . $show_id . "\">Quotes</a>" . 
			" |<a href=\"trivia.php?id=" . $show_id . "\">Trivia</a>" . 
			" |<a href=\"goofs.php?id=" . $show_id . "\">Goofs</a>" . 
			" |<a href=\"photos.php?id=" . $show_id . "\">Photos</a>";
			if( $type == "MOVIE" )
				print " |<a href=\"show_times.php?movie_id=$show_id\">Find showtimes</a>";
			echo "| <a name=\"fb_share\" share_url=\"localhost/showpage.php?id=".$show_id."\">Share</a>";
			?>
		</div>
	</div>
	<?php
		echo $social_html;
	?>
</div>

<?php
	include_once("include/footer.php");
?>
