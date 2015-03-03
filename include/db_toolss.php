<?php
	

	class Db
	{
		const HOST = "mysql2.000webhost.com";
		const USER = "a7233272_dex";
		const PASSWORD = "way4u2die";
		const DATABASE = "a7233272_dexter";


		private static $handle;
		private static $is_open = false;
		
		public static function open()
		{
			if( Db::$is_open )
				return;
			
			Db::$handle = mysql_connect(Db::HOST, Db::USER, Db::PASSWORD);
			if( !Db::$handle )
				die( "Failed to connect to database: " . mysql_error() );
				
			mysql_select_db(Db::DATABASE, Db::$handle);
			Db::$is_open = true;
		}
		
		public static function close()
		{
			mysql_close( Db::$handle );
			Db::$is_open = false;
		}
		
		public static function query_row( $query )
		{
			$result = mysql_query( $query );
			if( !$result )
				die( "Invalid query: " . mysql_error() );
				
			return mysql_fetch_assoc( $result );
		}
		
		public static function query_rows( $query )
		{
			$result = mysql_query( $query );
			if( !$result )
				die( "Invalid query: " . mysql_error() );
			
			$filled_array = array();
			$i = 0;
			
			while( $row = mysql_fetch_assoc($result) )
				$filled_array[$i++] = $row;
			
			return  $filled_array;
		}
		
		public static function query_value( $query )
		{
			$result = mysql_query( $query );
			if( !$result )
				die( "Invalid query: " . mysql_error() );
			$row = mysql_fetch_row($result);
			return $row[0];
		}
		
		public static function results_exist( $query )
		{
			$result = mysql_query( $query );
			if( !$result )
				die( "Invalid query: " . mysql_error() );
				
			return mysql_num_rows( $result ) > 0;
		}
		
		public static function print_results( $results )
		{
			print "<pre>";
			if( is_array( $results ) )
				print_r( $results );
			else
				print( $results );
			print "</pre>";
		}

		public static function insert( $query )
		{
			$result = mysql_query( $query );
			if( !$result )
				die( "Invalid query: " . mysql_error() );
		}

		public static function delete( $query )
		{
			$result = mysql_query( $query );
			if( !$result )
				die( "Invalid query: " . mysql_error() );
		}

		//Produces strings of form ('1','2','3').
		//This is useful when using the IN function in a query.fv
		public static function convert_to_string_array( $array )
		{
			$s = "(";
			for( $i = 0; $i < count( $array ); ++$i )
			{
				$s .= "'".$array[$i]."'";
				if( $i < ( count( $array )-1 ) )
					$s .= ",";
			}

			return $s.")";
		}

		public static function is_show( $id )
		{
			$id = mysql_real_escape_string( $id );
			$query = "SELECT id ".
					 "FROM shows ".
					 "WHERE id='$id'";

			return Db::results_exist( $query );
		}

		public static function is_movie( $id )
		{
			$id = mysql_real_escape_string( $id );
			$query = "SELECT id ".
					 "FROM shows ".
					 "WHERE id='$id' && type='MOVIE'";

			return Db::results_exist( $query );
		}

		public static function is_theater( $id )
		{
			$id = mysql_real_escape_string( $id );
			$query = "SELECT id ".
					 "FROM theaters ".
					 "WHERE id='$id'";

			return Db::results_exist( $query );
		}

		public static function is_user( $id )
		{
			$id = mysql_real_escape_string( $id );
			$query = "SELECT id ".
					 "FROM users ".
					 "WHERE id='$id'";

			return Db::results_exist( $query );
		}

		public static function get_show_info( $id )
		{
			$id = mysql_real_escape_string( $id );
			$query = "SELECT * ".
					 "FROM shows ".
					 "WHERE id='$id'";
			return Db::query_row( $query );
		}

		public static function get_theater_info( $id )
		{
			$id = mysql_real_escape_string( $id );
			$query = "SELECT * ".
					 "FROM theaters ".
					 "WHERE id='$id'";
			return Db::query_row( $query );
		}

		public static function get_user_info( $id )
		{
			$id = mysql_real_escape_string( $id );
			$query = "SELECT * ".
					 "FROM users ".
					 "WHERE id='$id'";
			return Db::query_row( $query );
		}

		public static function get_all_user_ids()
		{
			$query = 
				"SELECT id ".
				"FROM users";

			$results = Db::query_rows( $query );
			$ids = array();
			foreach( $results as $result )
				$ids[] = $result['id'];
			return $ids;
		}

		public static function get_all_theater_ids()
		{
			$query = 
				"SELECT id ".
				"FROM theaters";

			$results = Db::query_rows( $query );
			$ids = array();
			foreach( $results as $result )
				$ids[] = $result['id'];
			return $ids;
		}

		public static function get_all_tv_show_ids()
		{
			$query = 
				"SELECT id ".
				"FROM shows ".
				"WHERE type='TV'";

			$results = Db::query_rows( $query );
			$ids = array();
			foreach( $results as $result )
				$ids[] = $result['id'];
			return $ids;
		}

		public static function get_all_movie_ids()
		{
			$query = 
				"SELECT id ".
				"FROM shows ".
				"WHERE type='Movie'";

			$results = Db::query_rows( $query );
			$ids = array();
			foreach( $results as $result )
				$ids[] = $result['id'];
			return $ids;
		}

		public static function get_all_show_ids()
		{
			$query = 
				"SELECT id ".
				"FROM shows";

			$results = Db::query_rows( $query );
			$ids = array();
			foreach( $results as $result )
				$ids[] = $result['id'];
			return $ids;
		}

		public static function get_all_cast_ids()
		{
			$query = 
				"SELECT DISTINCT actor_id ".
				"FROM cast ";

			$results = Db::query_rows( $query );
			$ids = array();
			foreach( $results as $result )
				$ids[] = $result['actor_id'];
			return $ids;
		}

		public static function get_cast_info( $id )
		{
			$id = mysql_real_escape_string( $id );
			$query = "SELECT * ".
					 "FROM cast ".
					 "WHERE actor_id='$id'";
			return Db::query_row( $query );
		}
	} 

	
?>
