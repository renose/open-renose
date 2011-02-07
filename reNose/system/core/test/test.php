<?php 

class trash_content extends plugin
{
	public $name = "Test";
	public $description = "A Test Plugin with much trash...";
	public $version = "T.R.A.S.H.";
	
	public function getTitle()
	{
		return "Test-Module Page";
	}
	
	public function show()
	{
		echo '<br><h1>TEST, WUHU!!!</h1>';
		
		$this->tpl->display(database::getModuleTpl('test', 'test.tpl')); // load tpl file
	}
}

?>