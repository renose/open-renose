<?PHP
	include('system\core\database\dbconnect.php');

	function getSetting($module, $property)
	{
		global $dbpraefix;
		$res = mysql_query("SELECT value FROM ".$dbpraefix."settings WHERE module = '".$module."' AND property = '".$property."'");
		$row = mysql_fetch_row($res);
		
		return $row[0];
	}
?>