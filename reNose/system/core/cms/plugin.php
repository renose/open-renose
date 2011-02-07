<?php 

class plugin
{
	public $tpl;
	public $name;
	public $description;
	public $version;
	
	public function __construct($tpl)
	{		
		$this->tpl = $tpl;
	}
	
	public function getTitle()
	{
		return "|Plugin|";
	}
	
	public function show()
	{
		echo '<h1>Plugin</h1>';
	}
}

?>