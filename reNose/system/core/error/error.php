<?PHP
require_once(BASE_PATH . "/system/core/database/database.php");
require_once(BASE_PATH . "/system/core/cms/Savant3.php");

//errorPage Main-Class
class errorPage
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
	    $version = database::getSetting("errorPage", "version"); // get version from db
	    $name = "open reNose " . $version . " | Fehler"; // <title>

	    // Content
	    $dbtest = database::getSetting("errorPage", "site_title");

	    // register to tpl engine
	    $this->tpl->title = $name;
	    $this->tpl->version = $version;

	    $this->tpl->display(database::getModuleTpl('errorPage', 'header.tpl')); // load tpl file

	    $this->tpl->display(database::getModuleTpl('errorPage', 'error.tpl')); // load tpl file

	    $this->tpl->display(database::getModuleTpl('errorPage', 'footer.tpl')); // load tpl file
	}
}

?>