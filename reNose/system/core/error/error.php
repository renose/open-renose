<?PHP

//errorPage Main-Class
class errorPage extends plugin
{
	public $name = "Error Module";
	public $description = "Error Page";
	public $version = "0.1.0.0";
	
	public function getTitle()
	{
		return "Fehler: Seite nicht gefunden";
	}

	public function show()
	{
	    $this->tpl->display(database::getModuleTpl('errorPage', 'error.tpl')); // load tpl file
	}
}

?>