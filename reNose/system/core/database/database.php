<?php 
require_once('dbconfig.php');

class database
{
	const praefix = dbconfig::praefix;
	private static $pdo_object = NULL;
	
	public static function get()
	{
		if(self::$pdo_object == NULL)
		{
			self::$pdo_object = new PDO('mysql:host='.dbconfig::host.';dbname='.dbconfig::name,
										dbconfig::user,
										dbconfig::password,
										array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
										
			self::$pdo_object->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		
		return self::$pdo_object;
	}
	public static function close()
	{
		self::$pdo_object = NULL;
	}
	
	public static function getSetting($module, $property)
	{
		$database = database::get();
		
		//Datenbankverbindung aufbauen
		$sql = "SELECT value
				FROM ".dbconfig::praefix."settings
				WHERE module=:module AND property=:property";
		
		//Abfrage vorbereiten
		$stmn = $database->prepare($sql);
		
		//Parameter an PDO übergeben
		$stmn->bindValue(':module', $module, PDO::PARAM_STR);
		$stmn->bindValue(':property', $property, PDO::PARAM_STR);
		
		//Abfrage ausführen
		$stmn->execute();
		
		$row = $stmn->fetch();
		
		//bereinige Abfrage
		$stmn->closeCursor();
		
		return $row['value'];
	}
	
	public static function getModulePath($module, $dir)
	{
		$database = database::get();
		$sql = "SELECT path
				FROM ".dbconfig::praefix."path
				WHERE module=:module AND dir=:dir";
		
		$stmn = $database->prepare($sql);
		$stmn->bindValue(':module', $module, PDO::PARAM_STR);
		$stmn->bindValue(':dir', $dir, PDO::PARAM_STR);
		$stmn->execute();
		
		$row = $stmn->fetch();
		$stmn->closeCursor();
		
		return BASE_PATH . '/' . $row['path'];
	}
	
	public static function getModuleTpl($module, $tplFile)
	{
		$database = database::get();
		$sql = "SELECT path
				FROM ".dbconfig::praefix."path
				WHERE module=:module
				AND dir='tpl'";
		
		$stmn = $database->prepare($sql);
		$stmn->bindValue(':module', $module, PDO::PARAM_STR);
		$stmn->execute();
		
		$row = $stmn->fetch();
		$stmn->closeCursor();
		
		return $row['path'] . '/' . $tplFile;
	}
}
?>