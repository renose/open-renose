<?PHP
	include('system\core\database\dbconfig.php');
	
	$connection = mysql_connect($dbhost, $dbuser, $dbpassword);
	mysql_select_db($db, $connection);
?>