<?php 
require_once('dbconfig.php');

class database
{
	const praefix = dbconfig::dbpraefix;
	
	public static function init()
	{
		$connection = mysql_connect(dbconfig::dbhost, dbconfig::dbuser, dbconfig::dbpassword);
		mysql_select_db(dbconfig::dbname, $connection);
	}
}
?>