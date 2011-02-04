<?PHP
require_once("/../database/database.php");
require_once("/Savant3.php");

//open reNose Main-Class
class renose
{
	public $tpl;
	
	public function __construct()
	{
		$this->tpl = new Savant3();
		database::init();
	}
	
	public function show()
	{
	    $version = $this->getSetting("cms", "version"); // get version from db
	    $name = "open reNose " . $version . ""; // <title>
	
	    // Content
	    $helloworld = "hello world!";
	    $dbtest = $this->getSetting("cms", "site_title");
	
	    // register to tpl engine
	    $this->tpl->title = $name;
	    $this->tpl->helloworld = $helloworld;
	    $this->tpl->dbtest = $dbtest;
	    $this->tpl->version = $version;
	    	    
	    $this->tpl->display('/tpl/header.tpl'); // load tpl file
	    $this->tpl->display('/tpl/index.tpl'); // load tpl file
	    $this->tpl->display('/tpl/footer.tpl'); // load tpl file
	}
	
	function getSetting($module, $property)
	{
		$res = mysql_query("SELECT value FROM " . database::praefix . "settings WHERE module = '" . $module . "' AND property = '" . $property . "'");
		$row = mysql_fetch_row($res);
		
		return $row[0];
	}
}

?>