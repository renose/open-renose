<?PHP
require_once(BASE_PATH . "/system/core/database/database.php");

//open reNose Main-Class
class renose
{
	public $tpl;
	
	public function __construct()
	{
		require_once(database::getModulePath('cms', 'root') . "/autoloader.php");
		require_once(database::getModulePath('cms', 'root') . "/plugin.php");
		require_once(database::getModulePath('cms', 'root') . "/Savant3.php");
		
		$this->tpl = new Savant3();
		$this->tpl->setPath('template', BASE_PATH);
	}

	public static function anredeLoggedIn()
	{
	    date_default_timezone_set('Europe/Berlin');
	    
	    $time = date('G');
	    if ($time < 12) $anrede = "Guten Morgen";
	    if ($time <= 18 && $time >= 12) $anrede = "Guten Tag";
	    if ($time >= 19) $anrede = "Guten Abend";

	    return $anrede;
	}

	public function show()
	{
		if(!isset($_GET["module"]))
			$moduleName = 'main';
		else
			$moduleName = $_GET["module"];
		
		if($moduleName == 'main')
	    {
		    $myPlugin = new content_test($this->tpl);
	    }
	    else
	    {
	    	$database = database::get();
			$sql = "SELECT classname
					FROM ".dbconfig::praefix."plugins
					WHERE module=:module
					AND state='ON'";
			
			$stmn = $database->prepare($sql);
			$stmn->bindValue(':module', $moduleName, PDO::PARAM_STR);
			$stmn->execute();
			
			$row = $stmn->fetch();			
			$stmn->closeCursor();
			
			$className = $row['classname'];
			
			if($className != NULL)			
				$myPlugin = new $className($this->tpl);
			else
				$myPlugin = new errorPage($this->tpl);
	    }
		
	    $site_title = database::getSetting("cms", "site_title"); // get site title from db
	    $version = database::getSetting("cms", "version"); // get version from db
	    $name = "$site_title [$version] - " . $myPlugin->getTitle(); // <title>
	    
	    //Navigation
    	$database = database::get();
		$sql = "SELECT link, text
				FROM ".dbconfig::praefix."navi";
		
		foreach ($database->query($sql) as $row)
		{
			$navigation[] = array('link' => $row['link'], 'text' => $row['text']);
		}
	
	    // register to tpl engine
	    $this->tpl->title = $name;
	    $this->tpl->version = $version;
	    $this->tpl->navigation = $navigation;
	    $this->tpl->anredeLoggedIn = $this->anredeLoggedIn();
	    
	    $this->tpl->display(database::getModuleTpl('cms', 'header.tpl')); // load tpl file
	    
	    echo "<br><b>--- Plugin ---</b><br>";
	    echo "<b>Name:</b> $myPlugin->name <br>";
	    echo "<b>Description:</b> $myPlugin->description <br>";
	    echo "<b>Version:</b> $myPlugin->version <br><br>";
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