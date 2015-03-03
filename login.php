<?php
	include_once("include/header.php");

	function print_login()
	{
		$current_page = $_SERVER['REQUEST_URI'];
		$error = '';
		if( Authenticate::has_login_failed() )
			$error =
				'<div id="error">Username and/or password we\'re invalid.</div>';

		$url = $current_page;
		if( isset($_SESSION['last_page']) )
			$url = $_SESSION['last_page'];
		$url = urlencode($url);

		print
			'<form method="post" action="?url='.$url.'" style="width:400px">'.
			'<h1>LOGIN</h1>'.
			$error.
			'<label>Email:</label>'.
			'<input type="text" name="email">'.
			'<label>Password:</label>'.
			'<input type="password" name="password"><br/>'.
			'<input type="submit" value="Login" id="button"/>'.
			'<br/>'.
			'</form>';
	}

	print_login();
?>



<?php
	include_once("include/footer.php");
?>