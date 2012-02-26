<?PHP
require_once(BASE_PATH . "/system/core/database/database.php");
require_once(BASE_PATH . "/system/core/cms/Savant3.php");

//open reNose Main-Class
class renose
{
	public $tpl;
	
	public function __construct()
	{
		$this->tpl = new Savant3();
		$this->tpl->setPath('template', BASE_PATH);
		database::init();
	}
	
	public function show()
	{
	    $version = database::getSetting("cms", "version"); // get version from db
	    $name = "open reNose " . $version . ""; // <title>
	
	    // Content
	    $helloworld = "hello world!";
	    $dbtest = database::getSetting("cms", "site_title");
	
	    // register to tpl engine
	    $this->tpl->title = $name;
	    $this->tpl->helloworld = $helloworld;
	    $this->tpl->dbtest = $dbtest;
	    $this->tpl->version = $version;
	    	    
	    $this->tpl->display(database::getModuleTpl('cms', 'header.tpl')); // load tpl file
	    
	    $this->tpl->display(database::getModuleTpl('cms', 'index.tpl')); // load tpl file
	    echo "BASE_PATH: " . BASE_PATH . "<br>";
		echo "BASE_URL: " . BASE_URL . "<br>";
	    echo "database::getModulePath('cms', 'root'): " . database::getModulePath('cms', 'root') . "<br>";
		echo "database::getModulePath('cms', 'tpl'): " . database::getModulePath('cms', 'tpl') . "<br>";
	    
	    $this->tpl->display(database::getModuleTpl('cms', 'footer.tpl')); // load tpl file
	}
}

?>