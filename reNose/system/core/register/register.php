<?PHP
require_once(BASE_PATH . "/system/core/database/database.php");
require_once(BASE_PATH . "/system/core/cms/Savant3.php");
require_once(BASE_PATH . "/system/core/mailer/phpmailer.inc.php");

//open reNose Main-Class
class register
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
	    $version = database::getSetting("register", "version"); // get version from db
	    $name = "open reNose " . $version . " | Registrierung"; // <title>

	    // Content
	    $dbtest = database::getSetting("register", "site_title");

	    // register to tpl engine
	    $this->tpl->title = $name;
	    $this->tpl->dbtest = $dbtest;
	    $this->tpl->version = $version;

	    $this->tpl->display(database::getModuleTpl('register', 'header.tpl')); // load tpl file

	    $this->tpl->display(database::getModuleTpl('register', 'register.tpl')); // load tpl file
	    echo "BASE_PATH: " . BASE_PATH . "<br>";
		echo "BASE_URL: " . BASE_URL . "<br>";
	    echo "database::getModulePath('register', 'root'): " . database::getModulePath('register', 'root') . "<br>";
		echo "database::getModulePath('register', 'tpl'): " . database::getModulePath('register', 'tpl') . "<br>";

	    $this->tpl->display(database::getModuleTpl('register', 'footer.tpl')); // load tpl file
	}

	public function registerNewUser($rNUusername, $rNUmail, $rNUpassword) {
	    $rNUusername = $_POST['username'];
	    $rNUusername = stripslashes($rNUusername);

	    $rNUmail = $_POST['mail'];
	    $rNUmail = stripslashes($rNUmail);

	    $rNUpassword = $_POST['password'];
	    $rNUpassword = stripslashes($rNUpassword);
	    $rNUpassword = sha1($rNUpassword);
	    
	    if ($rNUusername && $rNUmail && $rNUpassword != "") {
		$res = mysql_query("INSERT INTO " . database::praefix . "users (id, username, mail, password)
		    VALUES ('NULL', '". $rNUusername ."', '". $rNUmail ."', '". $rNUpassword ."');");
	    } else {
		echo "<script type='text/javascript'>alert('Bitte alle Felder ausfüllen');</script>";
	    }
		
	    if ($res) {
		echo "Success";
		// start mailing with PHPMAILER:
		$mail = new phpmailer;
		$mail->IsSendmail(); // set mailer to use sendmail
		$mail->From = "noreply@renose.de";
		$mail->FromName = "open reNose";
		$mail->AddAddress($rNUmail);
		$mail->Subject = "Deine Anmeldung bei reNose.de";
		$mail->Body = "Hallo <strong>$rNUusername</strong>,\nDanke f&uuml;r die Registrierung auf reNose.de";
		$mail->WordWrap = 50;
		$mail->Send(); // send message
	    } else {
		echo "Fail";
	    }
	}
}

?>