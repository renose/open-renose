<?PHP
require_once(BASE_PATH . "/system/core/database/database.php");

//open reNose Main-Class
class renose
{
	public $tpl;
	
	public function __construct()
	{
		database::init();
		
		//TODO: FIX BASE_PATH include ERRORS!!!
		//require_once(BASE_PATH . database::getModulePath('cms', 'root') . "/autoloader.php");
		//require_once(BASE_PATH . database::getModulePath('cms', 'root') . "/Savant3.php");
		require_once(database::getModulePath('cms', 'root') . "/autoloader.php");
		require_once(database::getModulePath('cms', 'root') . "/plugin.php");
		require_once(database::getModulePath('cms', 'root') . "/Savant3.php");
		
		$this->tpl = new Savant3();
		$this->tpl->setPath('template', BASE_PATH);
	}
	
	function __autoload($class_name)
	{
		$res = mysql_query("SELECT value FROM " . database::praefix . "settings WHERE module = '" . $module . "' AND property = '" . $property . "'");
		$row = mysql_fetch_row($res);
		require_once "system/classes/".strtolower($class_name).".php";
	}
	
	public function show()
	{
		if(empty($_GET) || $_GET["module"] == NULL || $_GET["module"] == 'main')
	    {
		    $myPlugin = new content_test($this->tpl);
	    }
	    else
	    {
	    	$query = mysql_query("SELECT classname FROM " . database::praefix . "plugins WHERE module = '" . $_GET["module"] . "' AND state = 'ON'");
			$row = mysql_fetch_row($query);
			$className = $row[0];
			
			$myPlugin = new $className($this->tpl);
	    }
		
	    $site_title = database::getSetting("cms", "site_title"); // get site title from db
	    $version = database::getSetting("cms", "version"); // get version from db
	    $name = "$site_title [$version] - " . $myPlugin->getTitle(); // <title>
	
	    // register to tpl engine
	    $this->tpl->title = $name;
	    $this->tpl->version = $version;
	    	    
	    $this->tpl->display(database::getModuleTpl('cms', 'header.tpl')); // load tpl file
	    
	    echo "<b>--- Plugin ---</b><br>";
	    echo "<b>Name:</b> $myPlugin->name <br>";
	    echo "<b>Description:</b> $myPlugin->description <br>";
	    echo "<b>Version:</b> $myPlugin->version <br>";
	    $myPlugin->show();
	    
	    $this->tpl->display(database::getModuleTpl('cms', 'footer.tpl')); // load tpl file
	}
}

//TODO: muss noch ausgelagert werden!!!
require_once(BASE_PATH . "/system/core/cms/plugin.php");
class content_test extends plugin
{
	public $name = "Main Content Test";
	public $description = "Main Content";
	public $version = "0.0.0.1";
	
	public function getTitle()
	{
		return "Main Page";
	}
	
	public function show()
	{
		$helloworld = "hello world!";
	    $dbtest = database::getSetting("cms", "site_title");
	    
		$this->tpl->helloworld = $helloworld;
		$this->tpl->dbtest = $dbtest;
		
		$this->tpl->display(database::getModuleTpl('cms', 'index.tpl')); // load tpl file
	    echo "BASE_PATH: " . BASE_PATH . "<br>";
		echo "BASE_URL: " . BASE_URL . "<br>";
	    echo "database::getModulePath('cms', 'root'): " . database::getModulePath('cms', 'root') . "<br>";
		echo "database::getModulePath('cms', 'tpl'): " . database::getModulePath('cms', 'tpl') . "<br>";
	}
}

?>