<?php

	function __autoload($class_name)
	{
		$res = mysql_query("SELECT module, filename FROM " . database::praefix . "plugins WHERE classname = '" . $class_name . "' AND state = 'ON'");
		$row = mysql_fetch_row($res);
		
		$moduleName = $row[0];
		$path = database::getModulePath($moduleName, 'root');
		
		//Alternativer Dateiname in der Datenbank hinterlegt?
		if($row[1] != NULL)
			$fileName = $row[1];
		else
			$fileName = strtolower($class_name) . '.php';
		
		require_once $path . '/' . $fileName;
	}

?>