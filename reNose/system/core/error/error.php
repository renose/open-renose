<?PHP

//errorPage Main-Class
class errorPage extends plugin
{
	public $name = "Error Module";
	public $description = "Error Page";
	public $version = "stable";
	
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