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
	
	public static function getSetting($module, $property)
	{
		$res = mysql_query("SELECT value FROM " . database::praefix . "settings WHERE module = '" . $module . "' AND property = '" . $property . "'");
		$row = mysql_fetch_row($res);
		
		return $row[0];
	}
	
	public static function getModulePath($module, $dir)
	{
		$res = mysql_query("SELECT path FROM " . database::praefix . "path WHERE module = '" . $module . "' AND dir = '" . $dir . "'");
		$row = mysql_fetch_row($res);
		
		$path = BASE_PATH . '/' . $row[0];
		
		return $path;
	}
	
	public static function getModuleTpl($module, $tplFile)
	{
		$res = mysql_query("SELECT path FROM " . database::praefix . "path WHERE module = '" . $module . "' AND dir = 'tpl'");
		$row = mysql_fetch_row($res);
		
		$path = $row[0] . $tplFile;
		
		return $path;
	}
}
?>