<?php

	function __autoload($class_name)
	{
		$database = database::get();
		$sql = "SELECT module, filename
				FROM ".dbconfig::praefix."plugins
				WHERE classname=:classname
				AND state = 'ON'";
		
		$stmn = $database->prepare($sql);
		$stmn->bindValue(':classname', $class_name, PDO::PARAM_STR);
		$stmn->execute();
		
		$row = $stmn->fetch();		
		$stmn->closeCursor();
		
		$moduleName = $row['module'];
		$path = database::getModulePath($moduleName, 'root');
		
		//Alternativer Dateiname in der Datenbank hinterlegt?
		if($row['filename'] != NULL)
			$fileName = $row['filename'];
		else
			$fileName = strtolower($class_name) . '.php';
		
		require_once $path . '/' . $fileName;
	}

?>