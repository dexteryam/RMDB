<?php
	include_once("include/header.php");
	
	print " Lurker :". Access::user_has_access_level( Access::LURKER );
	print " User :".Access::user_has_access_level( Access::USER );
	print " Super_User :".Access::user_has_access_level( Access::SUPER_USER );
	print " Administrator :".Access::user_has_access_level( Access::ADMINISTRATOR );
	
	include_once("include/footer.php");
 ?>