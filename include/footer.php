
		</div>
		<div id="footer">
			<div id="bar">
				<a href="punbb/">Forum</a> | 
				<a href="sitemap.php">Site Map</a> | 
				<a href="about.php">About Us</a> | 
				<a href="help.php">Help</a></a>
			</div>
		</div>
		</div>
	</body>
</html>

<?php
	include_once("db_tools.php");
	$_SESSION['last_page'] = $current_page = $_SERVER['REQUEST_URI'];;
	Db::close();
?>